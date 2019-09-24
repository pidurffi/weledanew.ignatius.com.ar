<?php

/* Clase para importar clientes mayorista y minorista desde un TXT.
  No se importan clientes "web" (particulares). */
include_once(GALIX_FOLDER . "/class.Module.php");

$maestroFileComentReg = '/^\/\//';
$maestroFileFieldDelimiter = '|';   // Separador de campos en el archivo TXT
//$limitePrecio = 10000;
//$limitePeso = 10000;

class ModuleImportarClientes extends Module {

    var $template_list = "";
    var $template_result = "";
    var $errors = array();
    var $report = array('OK' => 0, 'Error' => array(), 'Faltan' => 0);

    /* [OK] => cant ok
     * [Error] => [fila] => problema
     * [Faltan] => nro 
     */

    function ModuleImportarClientes($params) {
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
        // $dir = opendir(FTP_MAESTRO_FOLDER);
        $dir = opendir(FTP_CLIENTES_FOLDER);
        if (!$dir) {
            $this->errors[] = "Imposible abrir directorio INPUT " . FTP_CLIENTES_FOLDER;
            return $this->finalize_list();
        }
        $files = array();
        while (false !== ($file = readdir($dir))) {
            if (is_dir(FTP_CLIENTES_FOLDER . $dir))
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
        global $maestroFileComentReg, $maestroFileFieldDelimiter;
        if (preg_match($maestroFileComentReg, $linea))
            return 0;
        // SI SE AGREGA UN CAMPO AL TXT DEL MAESTRO, AGREGARLO EN ESTA LÍNEA.
        list($codigo_cliente, $nombre, $direccion, $localidad, $email,
                $tipo_responsable_inscripto, $cuit, $percepcion_ingresos_brutos,
                $tipo_cliente, $porcentaje_bonificacion, $condicion) = explode($maestroFileFieldDelimiter, $linea);

        $codigo_cliente = $this->cortar($codigo_cliente);
        $nombre = $this->cortar($nombre);
        $direccion = $this->cortar($direccion);
        $localidad = $this->cortar($localidad);
        $email = $this->cortar($email);
        // Tipo responsable inscripto: cambio los números por cadenas.
        switch ($this->cortar($tipo_responsable_inscripto)) {
            case '1.0':
                $tipo_responsable_inscripto = 'Responsable inscripto';
                break;
            case '1.1':
                $tipo_responsable_inscripto = 'Zona franca';
                break;
            case '2.0':
                $tipo_responsable_inscripto = 'Responsable no inscripto';
                break;
            case '3.0':
                $tipo_responsable_inscripto = 'No responsable';
                break;
            case '3.1':
                $tipo_responsable_inscripto = 'Responsable monotributo';
                break;
            case '3.2':
                $tipo_responsable_inscripto = 'Sujeto no categorizado';
                break;
            case '4.0':
                $tipo_responsable_inscripto = 'Sujero exento';
                break;
            case '5.0':
                $tipo_responsable_inscripto = 'Consumidor final';
                break;
            case '6.0':
                $tipo_responsable_inscripto = 'Exportación/importación';
                break;
            case '7.0':
                $tipo_responsable_inscripto = 'Exportación zona franca';
                break;
            default:
                $tipo_responsable_inscripto = '-';
        }
        $cuit = $this->cortar($cuit);
        $percepcion_ingresos_brutos = $this->cortar($percepcion_ingresos_brutos) * 1;
        $tipo_cliente = $this->cortar($tipo_cliente) * 1;
        $porcentaje_bonificacion = $this->cortar($porcentaje_bonificacion) * 1;
        $condicion = $this->cortar($condicion) * 1;

        if ($porcentaje_bonificacion > 100 || $porcentaje_bonificacion < 0) {
            return "Porcentaje de bonificación incorrecto (debe estar entre 0 y 100).";
        }
        if ($percepcion_ingresos_brutos > 100 || $percepcion_ingresos_brutos < 0) {
            return "Porcentaje de bonificación incorrecto (debe estar entre 0 y 100).";
        }
        // El id_tipo_cliente debe ser 2 (minorista) o 3 (mayorista). No se pueden importar clientes Web (1).
        // NO DOY ERROR ACÁ porque en el TXT están mandando todos los tipos de clientes, con números
        // del 0 al 9.
        // El 0 es minorista --> Cambia a 2
        // El 3 es mayorista --> Cambia a 3
        // El 4 es público general o web, que no se importa.
        // Tampoco se importan los tipos 1, 2, 5, 6, 7, 8 y 9.
        /*
          if ($tipo_cliente != 0 AND $tipo_cliente != 3) {
          return "El ID de tipo de cliente debe ser 0 (minorista) o 3 (mayorista).";
          }
         */

        // Tipo de cliente: cambio los números que me envían en el TXT por los ID correctos.
        switch ($tipo_cliente) {
            case 0:
                $tipo_cliente = 2;
                break;
            case 3:
                $tipo_cliente = 3;
                break;
            default:
                $tipo_cliente = -1;
        }

        // Solo hago INSERT o UPDATE si el tipo_cliente es mayor o igual a 0 (para importar solo 0 y 3).
        // Además, el email no puede estar vacío porque se usa para loguearse.
        if ($tipo_cliente >= 0 AND $email != '') {
            // Busco si ya existe el cliente con ese código o con el mismo email.
            // Debo verificar si ya existe cargado con ese email, porque en el TXT
            // de importación, mandan registros repetidos. Entonces, si hay varios registros
            // con el mismo mail, solo se insertará el primero, y si aparece de nuevo ese email,
            // se hará un UPDATE.
            $sql = "SELECT count(*) AS cant FROM cliente WHERE email = '$email';";
            $result = $this->_db->execute($sql);
            $reg = $this->_db->getRow($result);
            if ($reg['cant'] > 0) {
                return 'E-mail duplicado. ' + $email;
            }

            $sql = "SELECT count(*) AS cant FROM cliente WHERE codigo = '$codigo_cliente';";
            $result = $this->_db->execute($sql);
            $reg = $this->_db->getRow($result);

            // Si no existe, lo doy de alta. Debo generarle una contraseña.
            if ($reg['cant'] == 0) {
                // Genero una contraseña aleatoria (longitud = 8; el "4" le agrega números).
                $password = $this->generatePassword(8, 4);
                $sql = "INSERT INTO cliente(codigo
                                , nombre
                                , direccion, localidad, email
                                , tipo_responsable_inscripto, dni, percepcion_ingresos_brutos
                                , id_tipo_cliente, bonificacion, condicion, password)
			VALUES('$codigo_cliente'
                                , '" . $this->_db->real_escape_string($nombre) . "'
                                , '$direccion', '$localidad', '$email'
                                , '$tipo_responsable_inscripto', '$cuit', $percepcion_ingresos_brutos
                                , $tipo_cliente, $porcentaje_bonificacion, $condicion, '$password');";
                /*
                  $result = $this->_db->execute($sql);
                  if (!$result) {
                  return "Imposible insertar cliente nuevo. " + $sql + "<br />";
                  }
                 */
                if (!$result = $this->_db->execute($sql)) {
                    return "Imposible insertar cliente nuevo. " + $sql + "<br />";
                }
                // Si se pudo grabar, envío mail al cliente informándole su nueva contraseña.
                // COMENTAR ESTA LINEA CUANDO SE HAGAN PRUEBAS
                $this->enviarMailAClientes($nombre, $email, $password);
            }
            // Si ya existe el cliente, hago una actualización.
            else {
                $sql = "UPDATE cliente SET nombre = '$nombre',
                        direccion = '$direccion',
                        localidad = '$localidad',
                        email = '$email',
                        tipo_responsable_inscripto = '$tipo_responsable_inscripto',
                        dni = '$cuit',
                        percepcion_ingresos_brutos = $percepcion_ingresos_brutos,
                        id_tipo_cliente = $tipo_cliente,
                        bonificacion = $porcentaje_bonificacion,
                        condicion = '$condicion'
                        WHERE codigo = '$codigo_cliente';";
                $result = $this->_db->execute($sql);
                if (!$result) {
                    return "Imposible actualizar cliente.";
                }
            }
        }
        return 1;
    }

    function procesarArchivo($fileHandler) {
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
        // $this->report['Faltan'] = $this->getProductosFaltantes();
    }

    function execImport() {
        $arch = $_GET['file'];
        if (!file_exists(FTP_CLIENTES_FOLDER . $arch)) {
            $this->errors[] = "Archivo inexistente";
            return $this->finalize_result();
        }

        $file = fopen(FTP_CLIENTES_FOLDER . $arch, "r");
        if (!$file) {
            $this->errors[] = "Imposible abrir el archivo " . FTP_CLIENTES_FOLDER . $arch;
            return $this->finalize_result();
        }
        $this->procesarArchivo($file);
        GlobalManager::getTplMng()->setValue("resultado", $this->report);

        $this->finalize_result();
    }

    function generatePassword($length = 9, $strength = 0) {
        $vowels = 'aeiou';
        $consonants = 'bcdfghjklmnpqrstvwxyz';
        if ($strength & 1) {
            $consonants .= 'BCDFGHJKLMNPQRSTVWXYZ';
        }
        if ($strength & 2) {
            $vowels .= "AEIOU";
        }
        if ($strength & 4) {
            $consonants .= '123456789';
        }
        if ($strength & 8) {
            $consonants .= '@#$%';
        }
        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }

    private function generaCuerpoDeMailAClientes($nombre, $email, $password) {
        // Genera el cuerpo del mail que se envía al cliente que se acaba de importar desde el TXT.
        GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STRING;
        GlobalManager::getTplMng()->setValue("nombre", utf8_encode($nombre));
        GlobalManager::getTplMng()->setValue("email", utf8_encode($email));
        GlobalManager::getTplMng()->setValue("password", utf8_encode($password));
        GlobalManager::getTplMng()->setTemplate("front_mail_nuevo_cliente_mayorista");
        $cuerpo = GlobalManager::getTplMng()->drawTemplate();
        GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STANDARD;
        return $cuerpo;
    }

    // Envía mails a clientes que se acaban de importar desde el TXT.
    private function enviarMailAClientes($nombre, $email, $password) {
        $mail = new PHPMailer();
        $mail->From = "noreply@weleda.com.ar";
        $mail->FromName = "Weleda";
        $mail->Subject = "Weleda - Datos e.shop";
        $mail->AltBody = "";
        $body = $this->generaCuerpoDeMailAClientes($nombre, $email, $password);
        if (!$body) {
            return false;
        }
        $mail->MsgHTML($body);
        $mail->AddAddress($email, $nombre);
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        if (!$mail->Send()) {
            error_log("No se pudo enviar el mail al cliente luego de importar desde el TXT.", 1, $this->mailToErrores);
            return false;
        } else {
            return true;
        }
    }

    // Quito "|° porque es el separador de campos en el txt.
    // También le hago trim.
    private function cortar($cadena) {
        return trim(str_replace('|', '', $cadena));
    }

}

?>