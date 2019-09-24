<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

/* Este script debe correr con un cron job cada 60 minutos.
 * Buscará los pedidos que hayan cambiado su estado en DineroMail (del día actual y del día anterior).
 * Si el cliente ha pagado, enviará el mail al cliente
 * y subirá los TXT al FTP.
 *
 * Este archivo se debe programar como proceso CRON en el cpanel.
 * En "command" en el cpanel, se debe escribir lo siguiente:
 * php /home/username/public_html/carrito/IPNv2_realizar_consulta_de_pedidos_con_cron.php
 * En el servidor de producción de Weleda:
 * php /home/weledac/public_html/carrito/IPNv2_realizar_consulta_de_pedidos_con_cron.php
 *
 * "php" al principio, luego un espacio, luego el path.
 * Reemplazar username por el nombre de usuario (ignati05, crearcon, etc.)
 *
 * La configuración del cron, para que corra de 8 a 20 hs., y en el minuto 40 es:
 *
 * 40 05-16 * * *
 *
 * "40" son los minutos. "05-16" es la hora (es de 8 a 20 menos 3 horas, por la diferencia horaria).
 * Luego siguen tres "*" para día, mes y día de semana.
 *
 * Este script también se puede ejecutar manualmente ingresando a:
 * http://www.weleda.com.ar/carrito/IPNv2_realizar_consulta_de_pedidos_con_cron.php
 */

// Importo variables.php para leer la constante de país.
include_once("../specification/variables.php");


// Datos de conexiÓn al FTP de Weleda
/*
  $ftp_server = 'ftp.ignatius01.com.ar';
  $ftp_user_name = 'pruebas@ignatius01.com.ar';
  $ftp_user_pass = 'pruebas';
 */

$ftp_server = '200.61.255.14';
$ftp_user_name = 'Weleda';
$ftp_user_pass = 'Dico15963';


// DirecciÓn de mail adonde enviar errores
$mailToErrores = "adrian@ignatiusweb.com.ar";

// Datos para conectar a la base.
include_once("../specification/database.php");
$db_username = $_SPECIFICATION['DbClass']['params']['user'];
$db_password = $_SPECIFICATION['DbClass']['params']['pass'];
$db_dbname = $_SPECIFICATION['DbClass']['params']['dbname'];

include_once("../includes/external/phpMailer/class.phpmailer.php");
include_once("../includes/external/phpMailer/class.smtp.php");

function generarCuerpoDeMailParaComprador($elements, $compra) {
    // Genera el cuerpo del mail que se envÍa al cliente que compra.
    ob_start(); // start buffer
    include("template_mail_compra_cliente.php");    // el include copia el archivo al buffer
    $cuerpo = ob_get_contents();    // el contenido del buffer (el archivo incluido) se pasa a una variable
    ob_end_clean(); // se cierra el buffer
    return $cuerpo;
}

function generarCuerpoDeMailParaWeleda($elements, $compra) {
    // Genera el cuerpo del mail que se envía al cliente que compra.
    ob_start(); // start buffer
    include("template_mail_compra_weleda.php");    // el include copia el archivo al buffer
    $cuerpo = ob_get_contents();    // el contenido del buffer (el archivo incluido) se pasa a una variable
    ob_end_clean(); // se cierra el buffer
    return $cuerpo;
}

function enviarEmailAlComprador($body, $compra) {
    // Envía un mail al cliente que realiza la compra
    global $mailToErrores;
    $mail = new PHPMailer();
    if (CONSTANTE_PAIS == "Argentina") {
        $mail->From = "noreply@weleda.com.ar";
    } elseif (CONSTANTE_PAIS == "Chile") {
        $mail->From = "noreply@weleda.cl";
    }
    $mail->FromName = "Weleda";
    $mail->CharSet = "UTF-8";
    $mail->Subject = "Weleda, confirmación de pedido número " . $compra['id'];
    $mail->AltBody = "";
    if (!$body) {
        return false;
    }
    $mail->MsgHTML($body);
    $mail->AddAddress($compra['email_comprador'], $compra['nombre_comprador'] . " " . $compra['apellido_comprador']);
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

function enviarEmailAWeleda($body, $compra) {
    // Envía un mail a Weleda
    global $mailToErrores;
    $mail = new PHPMailer();
    if (CONSTANTE_PAIS == "Argentina") {
        $mail->From = "noreply@weleda.com.ar";
    } elseif (CONSTANTE_PAIS == "Chile") {
        $mail->From = "noreply@weleda.cl";
    }
    $mail->FromName = "Weleda";
    $mail->Subject = "Weleda, pedido acreditado, número " . $compra['id'];
    $mail->AltBody = "";
    if (!$body) {
        return false;
    }
    $mail->MsgHTML($body);
    if (CONSTANTE_PAIS == "Argentina") {
        $mail->AddAddress('ventas@weleda.com.ar', 'Weleda');
    } elseif (CONSTANTE_PAIS == "Chile") {
        $mail->AddAddress('ventas@weleda.cl', 'Weleda');
    }
    // Envio copia oculta al mismo mail que recibe los errores.
    $mail->AddBCC($mailToErrores, $compra['nombre_comprador'] . " " . $compra['apellido_comprador']);
    $mail->IsHTML(true);
    if (!$mail->Send()) {
        error_log("No se pudo enviar el mail a Weleda. Pedido número " . $compra['id'], 1, $mailToErrores);
        return false;
    } else {
        return true;
    }
}


// Consulto los pedidos del día actual, del día anterior y de 5 días antes.
// El estado de la operación debe ser distinto de 2 (Acreditado), ya que no me
// interesa verificar de nuevo los pedidos que ya han sido acreditados.
// También distinto de 3 (cancelado).
// Además "Válida" debe ser 1, es decir que el cliente finalizó la compra.
$conexion = mysql_connect("localhost", $db_username, $db_password) or die("No conecta.");
mysql_select_db($db_dbname, $conexion);
/*
  $sql = "SELECT ID, dineromail_estado_operacion
  FROM compra
  WHERE (DATE(fecha) <= CURDATE() AND DATE(fecha) >= DATE_ADD(CURDATE(), INTERVAL '-5' DAY))
  AND dineromail_estado_operacion NOT IN (2, 3)
  AND valida = 1
  ORDER BY ID;";
 */
// Busco los pedidos con nuevo_estado = 1 y que estén pagos (dineromail_estado_operacion = 2).
/*
$sql = "SELECT ID, dineromail_estado_operacion
        FROM compra
        WHERE (DATE(fecha) >= DATE_ADD(CURDATE(), INTERVAL '-60' DAY))
            AND nuevo_estado = 1
            ORDER BY ID;";
*/
$sql = "SELECT ID, dineromail_estado_operacion, nuevo_estado
        FROM compra
        WHERE nuevo_estado = 1 AND dineromail_estado_operacion = 2
        ORDER BY ID;";
		
			
$lista_pedidos = mysql_query($sql, $conexion) or die("No lee. " . $sql);


$operaciones_procesadas = 0;
$lista_operaciones_procesadas = "";

/*
while ($pedido = mysql_fetch_array($lista_pedidos)) {

    //print("<p>PEDIDO NÚMERO: " . $pedido['ID'] . "<br />");
    //print("ESTADO PEDIDO: " . $pedido['dineromail_estado_operacion'] . "</p>");
    print(utf8_encode("PEDIDO NÚMERO: " . $pedido['ID'] . "\r\n"));
    print("ESTADO PEDIDO: " . $pedido['dineromail_estado_operacion'] . "\r\n\r\n");

	$operaciones_procesadas++;
    $lista_operaciones_procesadas .= $id_operacion . "/" . $estado_operacion . ", ";
	
}

*/




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
    ftp_chdir($conn_id, 'Input');
    /* RECORRO LAS OPERACIONES  */
    while ($pedido = mysql_fetch_array($lista_pedidos)) {
		
        $operaciones_procesadas++;
        $lista_operaciones_procesadas .= $id_operacion . ", ";

       

        // Si el estado de la operación ha cambiado y el cliente ha pagado (estado=2),
        // envío los mails y los TXT por FTP.
        

            // Traigo los datos para enviar mail al cliente.
            // No los pongo más abajo ya que necesito los datos de la compra ahora.
            // Lista de artículos comprados en esta compra.
            $sql = "SELECT P.nombreweleda, CP.precio, CP.cantidad
            FROM compra_producto CP
                INNER JOIN producto P ON CP.id_producto = P.id
            WHERE id_compra = " . $pedido['ID'] . ";";
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
                LEFT JOIN PROVINCIA_ENVIOS PRO2 ON PRO2.ID = compra.id_provincia_facturacion
                WHERE compra.id = " . $pedido['ID'] . ";";
            $result = mysql_query($sql, $conexion) or die("No lee. " . $sql);
            $compra = mysql_fetch_array($result);

            $archivo_txt_carrito = $compra['archivo_txt_carrito'];
            $archivo_txt_cliente = $compra['archivo_txt_cliente'];
            // Subo los dos archivos TXT a un FTP.
            // Una vez subido al FTP, el archivo se mueve de la carpeta INPUT a la carpeta BACKUP.
            // Connected to $ftp_server, for user $ftp_user_name
            // SUBIR ARCHIVOS A CARPETA FTP.
            $upload1 = false;
            $upload2 = false;

            //print "<p>Current directory: " . ftp_pwd($conn_id) . "</p>";
            //print "<p>SUBO ARCHIVO CLIENTE.</p>";

            
                // En la Argentina se suben los archivos por FTP.
                print "SUBO ARCHIVO CLIENTE (compra " . $pedido['ID'] . ")" . "\r\n";
                $upload1 = ftp_put($conn_id, $archivo_txt_cliente, "../ftp_folder/INPUT/" . $archivo_txt_cliente, FTP_BINARY);
                // check upload status
                if (!$upload1) {
                    // FTP upload has failed!
                    error_log("No funcionó la subida del archivo del cliente al FTP. Compra: " . $id_operacion . ".", 1, $mailToErrores);
                } else {
                    // Uploaded $source_file to $ftp_server as $destination_file
                    // SI ANDUVO LA COPIA, MOVER ARCHIVO de la carpeta INPUT a la carpeta BACKUP.
                    rename("../ftp_folder/INPUT/" . $archivo_txt_cliente, "../ftp_folder/BACKUP/" . $archivo_txt_cliente);
                }
                // Subo el segundo archivo.
                //print "<p>SUBO ARCHIVO CARRITO.</p>";
                print "SUBO ARCHIVO CARRITO (compra " . $pedido['ID'] . ")" . "\r\n";
                $upload2 = ftp_put($conn_id, $archivo_txt_carrito, "../ftp_folder/INPUT/" . $archivo_txt_carrito, FTP_BINARY);
                // check upload status
                if (!$upload2) {
                    // FTP upload has failed!
                    error_log("No funcionó la subida del archivo del carrito al FTP.  Compra: " . $id_operacion . ".", 1, $mailToErrores);
                } else {
                    // Uploaded $source_file to $ftp_server as $destination_file
                    // SI ANDUVO LA COPIA, MOVER ARCHIVO de la carpeta INPUT a la carpeta BACKUP.
                    rename("../ftp_folder/INPUT/" . $archivo_txt_carrito, "../ftp_folder/BACKUP/" . $archivo_txt_carrito);
                }
            

            // Si los 2 archivos TXT se subieron bien, actualizo el estado de la operación.
            // Campo nuevo_estado a 0 en la tabla COMPRAS.
            // En nuevo_estado pongo 0 ya que no volverá a verificar esta operación.
            if ($upload1 AND $upload2) {
                $sql = "UPDATE compra
                        SET nuevo_estado = 0
                        WHERE id = " . $compra['id'] . ";";
                $result = mysql_query($sql, $conexion) or die("No escribe. " . $sql);

                // Envío mail al cliente.
                $cuerpo_mail_cliente = generarCuerpoDeMailParaComprador($elements, $compra);
                enviarEmailAlComprador($cuerpo_mail_cliente, $compra);
            }
        } // while (recorre las compras pagadas)
		
		// close the FTP stream
		ftp_close($conn_id);



        } // conectó al ftp


if ($operaciones_procesadas == 0) {
    //print("<p>DineroMail no informó cambios en ninguna operación.</p>");
    print(utf8_encode("No hubo cambios en ninguna operación.\r\n\r\n"));
} else {
    //print("<p>DineroMail informó cambios en " . $operaciones_procesadas . " operaciones (acreditadas o pendientes).</p>");
    //print("<p>Operaciones confirmadas/acreditadas nuevas: " . $operaciones_que_cambiaron_de_estado . "</p>");
    print(utf8_encode("Hubo cambios en " . $operaciones_procesadas . " operaciones (acreditadas o pendientes). [" . $lista_operaciones_procesadas . "] \r\n\r\n"));
  
}

//error_log("Se ejecutó el proceso php /home/weledac/public_html/carrito/IPNv2_realizar_consulta_de_pedidos_con_cron.php.", 1, $mailToErrores);
?>