<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

// http://www.ignatius01.com.ar/carrito/realizar_consulta_de_pedidos_mayoristas.php
// Datos de conexión al FTP de Weleda
/*
$ftp_server = 'ftp.ignatius01.com.ar';
$ftp_user_name = 'pruebas@ignatius01.com.ar';
$ftp_user_pass = 'pruebas';
*/

$ftp_server = '200.61.255.14';
$ftp_user_name = 'Weleda';
$ftp_user_pass = 'Dico15963';


/*
 * Este archivo se debe programar como proceso CRON en el cpanel.
 * En "command" en el cpanel, se debe escribir lo siguiente:
 * php /home/username/public_html/carrito/realizar_consulta_de_pedidos_mayoristas.php
 * En el servidor de producción de Weleda:
 * php /home/weledac/public_html/carrito/realizar_consulta_de_pedidos_mayoristas.php
 *
 * "php" al principio, luego un espacio, luego el path.
 * Reemplazar username por el nombre de usuario (ignati05, crearcon, etc.)
 *
 * La configuración del cron, para que corra de 8 a 20 hs., y en el minuto 45 es:
 *
 * 45 05-16 * * *
 *
 * "45" son los minutos. "05-16" es la hora (es de 8 a 20 menos 3 horas, por la diferencia horaria).
 * Luego siguen tres "*" para día, mes y día de semana.
 *
 * Este script también se puede ejecutar manualmente ingresando a:
 * http://www.weleda.com.ar/carrito/realizar_consulta_de_pedidos_mayoristas.php
 */


// Dirección de mail adonde enviar errores
$mailToErrores = "adrian@ignatius.com.ar";


// Datos para conectar a la base.
include_once("../specification/database.php");
$db_username = $_SPECIFICATION['DbClass']['params']['user'];
$db_password = $_SPECIFICATION['DbClass']['params']['pass'];
$db_dbname = $_SPECIFICATION['DbClass']['params']['dbname'];

include_once("../includes/external/phpMailer/class.phpmailer.php");
include_once("../includes/external/phpMailer/class.smtp.php");

function generarCuerpoDeMailParaCompradorMayorista($elements, $compra) {
    // Genera el cuerpo del mail que se envía al cliente mayorista que compra.
    ob_start(); // start buffer
    include("template_mail_compra_cliente_mayorista.php");    // el include copia el archivo al buffer
    $cuerpo = ob_get_contents();    // el contenido del buffer (el archivo incluido) se pasa a una variable
    ob_end_clean(); // se cierra el buffer
    return $cuerpo;
}

function generarCuerpoDeMailParaWeledaMayorista($elements, $compra) {
    // Genera el cuerpo del mail que se envía a Weleda (compra de cliente mayorista)
    ob_start(); // start buffer
    include("template_mail_compra_weleda_mayorista.php");    // el include copia el archivo al buffer
    $cuerpo = ob_get_contents();    // el contenido del buffer (el archivo incluido) se pasa a una variable
    ob_end_clean(); // se cierra el buffer
    return $cuerpo;
}

function enviarEmailAlCompradorMayorista($body, $compra) {
    // Envía un mail al cliente que realiza la compra
    global $mailToErrores;
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
	//$mail->AddAddress($mailToErrores, $compra['nombre_comprador'] . " " . $compra['apellido_comprador']);

    // Envío copia oculta al mismo mail que recibe los errores.
    $mail->AddBCC($mailToErrores, $compra['nombre_comprador'] . " " . $compra['apellido_comprador']);

    $mail->IsHTML(true);
    if (!$mail->Send()) {
        error_log("No se pudo enviar el mail al cliente que hizo la compra. Pedido número " . $compra['id'], 1, $mailToErrores);
        return false;
    } else {
        return true;
    }
}

function enviarEmailAWeledaMayorista($body, $compra) {
    // Envía un mail a Weleda (compras mayoristas)
    global $mailToErrores;
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

    $mail->AddAddress("ventas@weleda.com.ar", "Weleda");
    $mail->AddAddress("rlotito@weleda.com.ar", "Weleda");
    //$mail->AddAddress($mailToErrores, "Weleda");

    // Envío copia oculta al mismo mail que recibe los errores.
    $mail->AddBCC($mailToErrores, $compra['nombre_comprador'] . " " . $compra['apellido_comprador']);

    $mail->IsHTML(true);
    if (!$mail->Send()) {
        error_log("No se pudo enviar el mail al cliente que hizo la compra. Pedido número " . $compra['id'], 1, $mailToErrores);
        return false;
    } else {
        return true;
    }
}


// Traigo las compras (que tenga valida = 1 y que el tipo de cliente
// sea mayor a 1 (no 1 porque son los clientes particulares).
$sql = "SELECT compra.id, compra.costo_envio, compra.dias_envio, compra.costo_total,
                compra.nombre, compra.direccion, 
                cliente.nombre as nombre_comprador, cliente.apellido as apellido_comprador,
                cliente.email as email_comprador, cliente.codigo as codigo_cliente, 
                compra.archivo_txt_carrito, compra.archivo_txt_cliente,
                compra.id_cliente, compra.descuento_pesos, compra.nombre_promocion
                FROM compra INNER JOIN cliente ON compra.id_cliente = cliente.id
                WHERE compra.valida = 1 and cliente.id_tipo_cliente > 1;";
$conexion = mysqli_connect("localhost", $db_username, $db_password, $db_dbname) or die("No conecta.");
$compras = mysqli_query($conexion, $sql) or die("No lee. " . $sql);

while ($compra = mysqli_fetch_array($compras)) {
    // Por cada compra mayorista válida, subo los TXT al FTP y pongo el campo compra.valida en 2.
    // Traigo los datos para enviar mail al cliente.
    // No los pongo más abajo ya que necesito los datos de la compra ahora.
    // Lista de artículos comprados en esta compra.
    $sql = "SELECT P.nombreweleda, CP.precio, CP.cantidad
            FROM compra_producto CP
                INNER JOIN producto P ON CP.id_producto = P.id
            WHERE id_compra = " . $compra['id'] . ";";
    $elements = mysqli_query($conexion, $sql) or die("No lee. " . $sql);

    $archivo_txt_carrito = $compra['archivo_txt_carrito'];
    $archivo_txt_cliente = $compra['archivo_txt_cliente'];
    // Subo los dos archivos TXT a un FTP.
    // Una vez subido al FTP, el archivo se mueve de la carpeta INPUT a la carpeta BACKUP.
    // set up basic connection
    $conn_id = ftp_connect($ftp_server);
    // login with username and password
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

    // Para subir a Weleda/Presea...
    // La conexión debe ser activa: ftp_pasv($conn_id, false);
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
        $archivo_txt_carrito = $compra['archivo_txt_carrito'];
        $archivo_txt_cliente = $compra['archivo_txt_cliente'];
        $upload1 = false;
        $upload2 = false;
        ftp_chdir($conn_id, 'Input');
        //print "<p>Current directory: " . ftp_pwd($conn_id) . "</p>";
        $upload1 = ftp_put($conn_id, $archivo_txt_carrito, "../ftp_folder/INPUT/" . $archivo_txt_carrito, FTP_BINARY);
        // check upload status
        if (!$upload1) {
            // FTP upload has failed!
            error_log("No funcionó la subida del archivo del carrito al FTP.", 1, $mailToErrores);
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
            error_log("No funcionó la subida del archivo del cliente al FTP.", 1, $mailToErrores);
        } else {
            // Uploaded $source_file to $ftp_server as $destination_file
            // SI ANDUVO LA COPIA, MOVER ARCHIVO de la carpeta INPUT a la carpeta BACKUP.
            rename("../ftp_folder/INPUT/" . $archivo_txt_cliente, "../ftp_folder/BACKUP/" . $archivo_txt_cliente);
        }

        $sql = "SELECT cliente.id, tipo_cliente.nombre AS tipo_cliente FROM cliente JOIN tipo_cliente ON cliente.id_tipo_cliente = tipo_cliente.id WHERE cliente.id = " . $compra['id_cliente'] . ";";
        $result = mysqli_query($conexion, $sql) or die("No escribe. " . $sql);
        $cliente = mysqli_fetch_array($result);

        // Si los 2 archivos TXT se subieron bien, actualizo el estado de la operación.
        if ($upload1 AND $upload2) {
            $sql = "UPDATE compra SET valida = 2 WHERE id = " . $compra['id'] . ";";
            $result = mysqli_query($conexion, $sql) or die("No escribe. " . $sql);

            // $element2 = $elements;
            
            // Envío mail al cliente.
            $cuerpo_mail_cliente = generarCuerpoDeMailParaCompradorMayorista($elements, $compra, $cliente);
            enviarEmailAlCompradorMayorista($cuerpo_mail_cliente, $compra, $cliente);
            
            mysqli_data_seek($elements,0);
            
            // Envío mail a Weleda.
            $cuerpo_mail_weleda = generarCuerpoDeMailParaWeledaMayorista($elements, $compra, $cliente);
            enviarEmailAWeledaMayorista($cuerpo_mail_weleda, $compra, $cliente);
        }
    }
    // close the FTP stream
    ftp_close($conn_id);
}
?>