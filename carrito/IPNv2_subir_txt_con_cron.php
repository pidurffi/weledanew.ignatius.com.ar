<?php

/* Este script debe correr con un cron job cada 15 minutos.
 * Buscará los pedidos que hayan cambiado su estado en DineroMail (del día actual y del día anterior).
 * Si el cliente ha pagado, enviará el mail al cliente
 * y subirá los TXT al FTP.
 *
 * Este archivo se debe programar como proceso CRON en el cpanel.
 * En "command" en el cpanel, se debe escribir lo siguiente:
 * php /home/username/public_html/carrito/IPNv2_realizar_consulta_de_pedidos_con_cron.php
 *
 * "php" al principio, luego un espacio, luego el path.
 * Reemplazar username por el nombre de usuario (ignati05, crearcon, etc.)
 *
 */

// Datos de conexión al FTP de Weleda
/*
  $ftp_server = 'ftp.ignatius01.com.ar';
  $ftp_user_name = 'pruebas@ignatius01.com.ar';
  $ftp_user_pass = 'pruebas';
 */

$ftp_server = '200.61.255.14';
$ftp_user_name = 'Weleda';
$ftp_user_pass = 'Dico15963';





// sube un archivo de clientes (siempre el mismo) cada 15 minutos.
// es para probar el funcionamiento del FTP.
//$archivo_txt_carrito = $compra['archivo_txt_carrito'];

//$archivo_txt_cliente = 'clientes_110203_145036_449.txt';
$archivo_txt_cliente = 'WELEDA_PRODUCTOS-01-03-2011.TXT';


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
    $upload1 = false;
    $upload2 = false;
    ftp_chdir($conn_id, 'Input');



    $upload2 = ftp_put($conn_id, $archivo_txt_cliente, "../ftp_folder/INPUT/" . $archivo_txt_cliente, FTP_BINARY);
    // check upload status
    if (!$upload2) {
        // FTP upload has failed!
        error_log("No funcionó la subida del archivo del cliente al FTP.", 1, $mailToErrores);
    } else {
        // Uploaded $source_file to $ftp_server as $destination_file
        // SI ANDUVO LA COPIA, MOVER ARCHIVO de la carpeta INPUT a la carpeta BACKUP.
        //rename("../ftp_folder/INPUT/" . $archivo_txt_cliente, "../ftp_folder/BACKUP/" . $archivo_txt_cliente);
    }
}
// close the FTP stream
ftp_close($conn_id);



?>