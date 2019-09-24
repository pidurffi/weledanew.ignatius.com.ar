<?php

include_once(GALIX_FOLDER . "/class.Module.php");

$maestroFileComentReg = '/^\/\//';
$maestroFileFieldDelimiter = '|';   // Separador de campos en el archivo TXT
$limitePrecio = 10000;
$limitePeso = 10000;

class ModuleImportarMaestro extends Module {

    var $template_list = "";
    var $template_result = "";
    var $errors = array();
    var $report = array('OK' => 0, 'Error' => array(), 'Faltan' => 0);

    /* [OK] => cant ok
     * [Error] => [fila] => problema
     * [Faltan] => nro 
     */

    function ModuleImportarMaestro($params) {
        $this->template_list = $params['template_list'];
        $this->template_result = $params['template_result'];
    }

    function exec($params) {
        if (empty($_GET['task']))
            return $this->execList();
        if ($_GET['task'] == "import")
            return $this->execImport();
        return $this->execList();
    }

    function execList() {
        $dir = opendir(FTP_MAESTRO_FOLDER);
        if (!$dir) {
            $this->errors[] = "Imposible abrir directorio INPUT " . FTP_MAESTRO_FOLDER;
            return $this->finalize_list();
        }
        $files = array();
        while (false !== ($file = readdir($dir))) {
            if (is_dir(FTP_MAESTRO_FOLDER . $dir))
                continue;
            if (($file == ".") || ($file == ".."))
                continue;
            $files[] = $file;
        }

        GlobalManager::getTplMng()->setValue("archivos", $files);
        return $this->finalize_list();
    }

    function finalize_list() {
        GlobalManager::getTplMng()->setValue("errores", $this->errors);
        GlobalManager::getTplMng()->setTemplate($this->template_list);
        $cuerpo = GlobalManager::getTplMng()->drawTemplate();
    }

    function finalize_result() {
        GlobalManager::getTplMng()->setValue("errores", $this->errors);
        GlobalManager::getTplMng()->setTemplate($this->template_result);
        $cuerpo = GlobalManager::getTplMng()->drawTemplate();
    }

    /* Return 0 si es comentario, 1 si esta ok y el texto del error si falla */

    function procesarLinea($linea) {
        global $maestroFileComentReg, $maestroFileFieldDelimiter, $limitePrecio, $limitePeso;
        if (preg_match($maestroFileComentReg, $linea))
            return 0;
        // SI SE AGREGA UN CAMPO AL TXT DEL MAESTRO, AGREGARLO EN ESTA LÍNEA.
        list($cod_producto, $nombre_producto, $precio, $peso, $precio_minorista, $precio_mayorista) = explode($maestroFileFieldDelimiter, $linea);
        // Las líneas del txt son así: 201005|IRIS LECHE LIMPIADORA 100 ML.|40.50|287.350|30.123|20.123
        // Es decir, código del producto en Presea | nombre producto Presea | precio | peso | precio minorista | precio mayorista
        $precio = trim($precio);
        $peso = trim($peso);
        $cod_producto = trim($cod_producto);
        $precioReal = $precio * 1;
        $pesoReal = $peso * 1;
        $precio_mayorista = trim($precio_mayorista);
        $precio_minorista = trim($precio_minorista);
        $precio_mayorista = $precio_mayorista * 1;
        $precio_minorista = $precio_minorista * 1;

        if (($precio != $precioReal . "") || (!$precioReal > $limitePrecio)) {
            return "Valor de precio incorrecto";
        }
        if (($peso != $pesoReal . "") || ($pesoReal > $limitePeso)) {
            return "Valor de peso incorrecto";
        }

        $sql = "UPDATE producto SET precio = '" . $this->_db->real_escape_string($precioReal) . "',
                        peso = '" . $this->_db->real_escape_string($pesoReal) . "',
                        nombreweleda = '" . $this->_db->real_escape_string($nombre_producto) . "',
                        precio_mayorista = '" . $this->_db->real_escape_string($precio_mayorista) . "',
                        precio_minorista = '" . $this->_db->real_escape_string($precio_minorista) . "',
                        en_maestro = 1
                        WHERE codigo = '" . $this->_db->real_escape_string($cod_producto) . "'";
        $result = $this->_db->execute($sql);
        if (!$result) {
            return "Imposible actualizar producto";
        }
        return 1;
    }

    function resetearProductos() {
        // Pongo un guión en nombre_weleda para que no quede vacío, ya que DineroMail no acepta nombres vacíos en los productos.
        $sql = "UPDATE producto SET precio = 0, peso = 0
                    , nombreweleda = '-', en_maestro = 0
                    , precio_mayorista = 0, precio_minorista = 0;";
        $this->_db->execute($sql);
    }

    function getProductosFaltantes() {
        $sql = "SELECT COUNT(*) as cant FROM producto WHERE en_maestro = 0;";
        $res = $this->_db->execute($sql);
        if (!$res) {
            return 99999;
        }
        $reg = $this->_db->getRow($res);
        return $reg['cant'];
    }

    function procesarArchivo($fileHandler) {
        $this->resetearProductos();
        $nroLinea = 0;
        while (!feof($fileHandler)) {
            $nroLinea++;
            $linea = fgets($fileHandler);
            // No preoceso líneas vacías.
            if ($linea != "") {
                $res = $this->procesarLinea($linea);
                if ($res == 1) {
                    $this->report['OK']++;
                } elseif ($res !== 0) {
                    $this->report['Error'][$nroLinea] = $res;
                }
            }
        }
        $this->report['Faltan'] = $this->getProductosFaltantes();
    }

    function execImport() {
        $arch = $_GET['file'];
        if (!file_exists(FTP_MAESTRO_FOLDER . $arch)) {
            $this->errors[] = "Archivo inexistente";
            return $this->finalize_result();
        }

        $file = fopen(FTP_MAESTRO_FOLDER . $arch, "r");
        if (!$file) {
            $this->errors[] = "Imposible abrir el archivo " . FTP_MAESTRO_FOLDER . $arch;
            return $this->finalize_result();
        }
        $this->procesarArchivo($file);
        GlobalManager::getTplMng()->setValue("resultado", $this->report);

        $this->finalize_result();
    }

}

?>