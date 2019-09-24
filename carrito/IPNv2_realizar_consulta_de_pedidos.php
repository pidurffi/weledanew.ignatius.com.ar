<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

// http://www.ignatius01.com.ar/carrito/IPNv2_realizar_consulta_de_pedidos.php?pedido=354
// N�mero de cuenta en DineroMail Weleda
$nrocuenta = '1023416';
// N�mero de cuenta en DineroMail ADRI�N
//$nrocuenta = '1022972';
// clave del IPN en dinero mail (no es la contrase?a para ingresar a DineroMail)
$clave = 'weledaipn45';

// Datos de conexi�n al FTP de Weleda
/*
  $ftp_server = 'ftp.ignatius01.com.ar';
  $ftp_user_name = 'pruebas@ignatius01.com.ar';
  $ftp_user_pass = 'pruebas';
 */

$ftp_server = '200.61.255.14';
$ftp_user_name = 'Weleda';
$ftp_user_pass = 'Dico15963';

// Direcci�n de mail adonde enviar errores
$mailToErrores = "adrian@ignatiusweb.com.ar";


// Datos para conectar a la base.
include_once("../specification/database.php");
$db_username = $_SPECIFICATION['DbClass']['params']['user'];
$db_password = $_SPECIFICATION['DbClass']['params']['pass'];
$db_dbname = $_SPECIFICATION['DbClass']['params']['dbname'];

include_once("../includes/external/phpMailer/class.phpmailer.php");
include_once("../includes/external/phpMailer/class.smtp.php");

if (!function_exists('generarCuerpoDeMailParaComprador')) {

    function generarCuerpoDeMailParaComprador($elements, $compra) {
        // Genera el cuerpo del mail que se env�a al cliente que compra.
        ob_start(); // start buffer
        include("template_mail_compra_cliente.php");    // el include copia el archivo al buffer
        $cuerpo = ob_get_contents();    // el contenido del buffer (el archivo incluido) se pasa a una variable
        ob_end_clean(); // se cierra el buffer
        return $cuerpo;
    }

}

if (!function_exists('enviarEmailAlComprador')) {

    function enviarEmailAlComprador($cuerpo, $compra) {
        // Env�a un mail al cliente que realiza la compra
        $mail = new PHPMailer();
        $mail->From = "noreply@weleda.com.ar";
        $mail->FromName = "Weleda";
        $mail->CharSet = "UTF-8";
        $mail->Subject = "Weleda, confirmación de pedido número " . $compra['id'];
        $mail->AltBody = "";
        if (!$body) {
            return false;
        }
        $mail->MsgHTML($body);
        $mail->AddAddress($compra['email_comprador'], $compra['nombre_comprador'] . " " . $compra['apellido_comprador']);
        $mail->IsHTML(true);
        if (!$mail->Send()) {
            error_log("No se pudo enviar el mail al cliente que hizo la compra. Pedido n�mero " . $compra['id'], 1, $this->mailToErrores);
            return false;
        } else {
            return true;
        }
    }

}

// Direcci�n de DineroMail que recibe un XML.
$ch = curl_init('http://argentina.dineromail.com/Vender/Consulta_IPN.asp');

$data = 'Data=';
$data .= '<REPORTE><NROCTA>' . $nrocuenta . '</NROCTA><DETALLE><CONSULTA><CLAVE>' . $clave . '</CLAVE><TIPO>1</TIPO><OPERACIONES>';

if (isset($_GET['pedido'])) {
    // Recibo pedido por URL
    $data .= "<ID>" . $_GET['pedido'] . "</ID>";
} else {
    // No recibo pedido por URL.
    // Es decir que este script est� incluido en otro (con INCLUDE).
    // Antes de usar el include, se define la variable $pedido.
    $data .= "<ID>" . $pedido . "</ID>";
}

$data .= '</OPERACIONES></CONSULTA></DETALLE></REPORTE>';

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$Rec_Data = curl_exec($ch);
curl_close($ch);
//echo $Rec_Data;
// Leo el XML recibido desde DineroMail.
$doc = new SimpleXMLElement($Rec_Data);

//print $doc->asXML;

$operaciones_procesadas = 0;
$operaciones_que_cambiaron_de_estado = 0;
/* RECORRO LAS OPERACIONES QUE DEVOLVI� DineroMail */
foreach ($doc->DETALLE->OPERACIONES->OPERACION as $OPERACION) {
    $id_operacion = $OPERACION->ID;
    $estado_operacion = $OPERACION->ESTADO;
    $operaciones_procesadas++;
    /* C�digo de los estados de operaciones en DineroMail:
     * 1 = Pendiente
     * 2 = Acreditado
     * 3 = Cancelado
     */

	 
	 $conexion = mysql_connect("localhost", $db_username, $db_password) or die("No conecta.");
	mysql_select_db($db_dbname, $conexion);
	 
    // Debo verificar si cambi� el estado de la operaci�n (entre lo que informa DineroMail y la tabla COMPRA).
    // Traigo el registro de la compra.
	$sql = "SELECT ID, dineromail_estado_operacion FROM compra WHERE id = $id_operacion;";
    $result = mysql_query($sql, $conexion) or die("No lee. " . $sql);
    $compra = mysql_fetch_array($result);

    // Si el estado de la operaci�n ha cambiado y el cliente ha pagado (estado=2),
    // env�o los mails y los TXT por FTP.
    //if($estado_operacion != $compra['dineromail_estado_operacion'] AND $estado_operacion == 2)
    if ($estado_operacion != $compra['dineromail_estado_operacion'] AND ($estado_operacion == 2 or $estado_operacion == 1)) {
        // El estado de la operaci�n ha cambiado.
        $operaciones_que_cambiaron_de_estado++;
        print("<p>El estado de la compra " . $id_operacion . " ha cambiado. De " . $compra['dineromail_estado_operacion'] . " a " . $estado_operacion . ".</p>");

        // Traigo los datos para enviar mail al cliente.
        // No los pongo m�s abajo ya que necesito los datos de la compra ahora.
        // Lista de art�culos comprados en esta compra.
        $sql = "SELECT P.nombreweleda, CP.precio, CP.cantidad
            FROM compra_producto CP
                INNER JOIN producto P ON CP.id_producto = P.id
            WHERE id_compra = $id_operacion;";
        $elements = mysql_query($sql, $conexion) or die("No lee. " . $sql);
        // Datos de la compra.
         $sql = "SELECT compra.id, compra.costo_envio, compra.dias_envio, compra.costo_total,
                compra.nombre, compra.direccion, compra.ciudad, P.PROVINCIA as provincia, compra.codpostal,
                cliente.nombre as nombre_comprador, cliente.apellido as apellido_comprador,
                cliente.email as email_comprador,
                compra.archivo_txt_carrito, compra.archivo_txt_cliente,
                compra.nombre_facturacion, compra.direccion_facturacion,
                compra.ciudad_facturacion, compra.codpostal_facturacion,
                PRO2.PROVINCIA as provincia_facturacion, compra.para_regalo
                FROM compra INNER JOIN cliente ON compra.id_cliente = cliente.id
                INNER JOIN PROVINCIA_ENVIOS P ON P.ID = compra.id_provincia
                INNER JOIN PROVINCIA_ENVIOS PRO2 ON PRO2.ID = compra.id_provincia_facturacion
                WHERE compra.id = $id_operacion;";
        $result = mysql_query($sql, $conexion) or die("No lee. " . $sql);
        $compra = mysql_fetch_array($result);

        //print "<p>PEDIDO $estado_operacion PAGADO.</p>";

        $archivo_txt_carrito = $compra['archivo_txt_carrito'];
        $archivo_txt_cliente = $compra['archivo_txt_cliente'];
        // Subo los dos archivos TXT a un FTP.
        // Una vez subido al FTP, el archivo se mueve de la carpeta INPUT a la carpeta BACKUP.
        // set up basic connection
        $conn_id = ftp_connect($ftp_server);
        // login with username and password
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

        // Para subir a Weleda/Presea...
        // La conexi�n debe ser activa: ftp_pasv($conn_id, false);
        // La carpeta debe ser Input: ftp_chdir($conn_id, 'Input');
        // La subida se hace en modo binario: ftp_put($conn_id, ..., ..., FTP_BINARY);
        // Apago el modo pasivo (o sea, enciendo el modo activo)
        // Si pongo modo pasivo, da el error "Can't open data connection".
        ftp_pasv($conn_id, false);

        // check connection
        if ((!$conn_id) || (!$login_result)) {
            // FTP connection has failed!
            error_log("No conecta al FTP.", 1, $mailToErrores);
        } else {
            // Connected to $ftp_server, for user $ftp_user_name
            // SUBIR ARCHIVOS A CARPETA FTP.
            $upload1 = false;
            $upload2 = false;
            ftp_chdir($conn_id, 'Input');
            //print "<p>Current directory: " . ftp_pwd($conn_id) . "</p>";
            $upload1 = ftp_put($conn_id, $archivo_txt_carrito, "../ftp_folder/INPUT/" . $archivo_txt_carrito, FTP_BINARY);
            // check upload status
            if (!$upload1) {
                // FTP upload has failed!
                error_log("No funcion� la subida del archivo del carrito al FTP.", 1, $mailToErrores);
            } else {
                // Uploaded $source_file to $ftp_server as $destination_file
                // SI ANDUVO LA COPIA, MOVER ARCHIVO de la carpeta INPUT a la carpeta BACKUP.
                rename("../ftp_folder/INPUT/" . $archivo_txt_carrito, "../ftp_folder/BACKUP/" . $archivo_txt_carrito);
            }
            // Subo el segundo archivo.
            $upload2 = ftp_put($conn_id, $archivo_txt_cliente, "../ftp_folder/INPUT/" . $archivo_txt_cliente, FTP_BINARY);
            // check upload status
            if (!$upload2) {
                // FTP upload has failed!
                error_log("No funcion� la subida del archivo del cliente al FTP.", 1, $mailToErrores);
            } else {
                // Uploaded $source_file to $ftp_server as $destination_file
                // SI ANDUVO LA COPIA, MOVER ARCHIVO de la carpeta INPUT a la carpeta BACKUP.
                rename("../ftp_folder/INPUT/" . $archivo_txt_cliente, "../ftp_folder/BACKUP/" . $archivo_txt_cliente);
            }

            // Si los 2 archivos TXT se subieron bien, actualizo el estado de la operaci�n.
            // Campo dineromail_estado_operacion en la tabla COMPRAS.
            if ($upload1 AND $upload2) {
                $sql = "UPDATE compra SET dineromail_estado_operacion = $estado_operacion WHERE id = $id_operacion;";
                $result = mysql_query($sql, $conexion) or die("No escribe. " . $sql);

                // Env�o mail al cliente.
                $cuerpo_mail_cliente = generarCuerpoDeMailParaComprador($elements, $compra);
                enviarEmailAlComprador($cuerpo_mail_cliente, $compra);
            }
        }
        // close the FTP stream
        ftp_close($conn_id);
    } // Cambi� el estado de la operaci�n.
}

if ($operaciones_procesadas == 0) {
    print("<p>DineroMail no informó cambios en ninguna operación.</p>");
} else {
    print("<p>DineroMail informó cambios en " . $operaciones_procesadas . " operaciones.</p>");
    print("<p>Operaciones confirmadas/acreditadas nuevas: " . $operaciones_que_cambiaron_de_estado . "</p>");
}
?>