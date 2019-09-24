<?php

// Importo variables.php para leer la constante de país.
include_once("../specification/variables.php");

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
	
		$upload1 = false;
	 print "SUBO ARCHIVO CLIENTE (compra " . $id_operacion . ")" . "\r\n";
     $upload1 = ftp_put($conn_id, "xxx.txt", "../ftp_folder/INPUT/" . "xxx.txt", FTP_BINARY);
	 
	 // check upload status
                if (!$upload1) {
                    // FTP upload has failed!
                    error_log("No funcionó la subida del archivo del cliente al FTP. Compra: " . $id_operacion . ".", 1, $mailToErrores);
                } else {
                    // Uploaded $source_file to $ftp_server as $destination_file
                    // SI ANDUVO LA COPIA, MOVER ARCHIVO de la carpeta INPUT a la carpeta BACKUP.
                    //rename("../ftp_folder/INPUT/" . $archivo_txt_cliente, "../ftp_folder/BACKUP/" . $archivo_txt_cliente);
                }
	
	}

// close the FTP stream
ftp_close($conn_id);

?>