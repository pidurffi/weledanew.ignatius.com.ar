<?php

// Dinero mail llama a este script automáticamente cuando algún pedido cambia de estado.
// http://www.ignatius01.com.ar/carrito/IPN_Notificacion.php

/* La ejecución de este script se debe configurar en DineroMail.
 * Cuando algún pedido (operación) cambia de estado, DineroMail
 * ejecuta este script.
 * NOTA: este script está sacado de DineroMail, sin embargo, no funciona.
 */

// Dirección de mail adonde enviar errores
$mailToErrores = "adrian@ignatiusweb.com.ar";

// Datos para conectar a la base.
include_once("../specification/database.php");
$db_username = $_SPECIFICATION['DbClass']['params']['user'];
$db_password = $_SPECIFICATION['DbClass']['params']['pass'];
$db_dbname = $_SPECIFICATION['DbClass']['params']['dbname'];

$notificacion;
$notificacion = $_REQUEST['Notificacion'];

/*
  foreach ($_POST as $key => $val) {
  $cadena = "key: ".$key." val: ".$val.". ";
  }
 */

/*
  Notificacion

  <?xml version='1.0' encoding='ISO-8859-1'?>
  <notificacion>
  <tiponotificacion>1</tiponotificacion>
  <operaciones>
  <operacion><tipo>1</tipo><id>494</id></operacion>
  </operaciones>
  </notificacion>
 */

// Ejemplo de notificacion
$str_RequestNotif = "<NOTIFICACION><TIPONOTIFICACION>1</TIPONOTIFICACION><OPERACIONES>";
$str_RequestNotif = $str_RequestNotif . "<OPERACION><TIPO>1</TIPO><ID>354</ID></OPERACION>";
$str_RequestNotif = $str_RequestNotif . "<OPERACION><TIPO>1</TIPO><ID>347</ID></OPERACION>";
$str_RequestNotif = $str_RequestNotif . "</OPERACIONES></NOTIFICACION>";

//error_log("IPN_Notificacion.php\r\nComienzo del script. " . $notificacion . ".---");

// Línea original, que procesa el XML recibido automáticamente desde DineroMail
$doc = new SimpleXMLElement($notificacion);

// Para hacer pruebas, uso la variable $str_RequestNotif, que contiene un XML simulado.
//$doc = new SimpleXMLElement($str_RequestNotif);

/* CARGO EN LA VARIABLE tipo_notificacion  EL CONTENIDO QUE TIENE EL NODO TIPONOFITICACION */
//$tipo_notificacion = $doc->TIPONOTIFICACION;
$tipo_notificacion = $doc->tiponotificacion;
//$cadena = 'Tipo notificacion :' . $tipo_notificacion;
//error_log($cadena);

$cadena = "IPN_Notificacion.php \r\n";
$cadena .= "Se recibió un cambio desde DineroMail sobre los pedidos: ";

/* RECORRO LAS OPERACIONES Y LAS MUESTRO POR PANTALLA */
foreach ($doc->operaciones->operacion as $OPERACION) {
    $tipo_operacion = $OPERACION->tipo;
    $id_operacion = $OPERACION->id;

    $cadena .= 'Tipo operación: ' . $tipo_operacion . ' ID operacion: ' . $id_operacion . "\r\n";

    // El script IPNv2_realizar_consulta_de_pedidos.php necesita el ID del pedido en
    // una variable llamada pedido.
    // $pedido = $id_operacion;
    // include("IPNv2_realizar_consulta_de_pedidos.php");
    //
    // Actualizo el campo nuevo_estado para indicar que cambió de estado
    // si la operación cambió de estado ($tipo_operacion == 1).
    if ($tipo_operacion == 1) {
        $conexion = mysql_connect("localhost", $db_username, $db_password) or die("No conecta.");
        mysql_select_db($db_dbname, $conexion);
        $sql = "UPDATE compra SET nuevo_estado = 1 WHERE id = $id_operacion;";
        $result = mysql_query($sql, $conexion) or die("No escribe. " . $sql);
    }
}

$cadena.= ".";
error_log($cadena, 1, $mailToErrores);
?>