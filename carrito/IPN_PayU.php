<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

// Api Key A.B.
//$ApiKey = 'dwOW3Js29f6cf8hB9JnS22oGX6';
// API key Weleda Argentina
$ApiKey = "yXBGGuEe0rb09hRs3n1ZV8VO2L";

// PayU llama a este script automáticamente al finalizar un pago.
// http://www.ignatius01.com.ar/carrito/IPN_PayU.php


// Dirección de mail adonde enviar errores
$mailToErrores = "adrian@ignatius.com.ar";

// Datos para conectar a la base.
include_once("../specification/database.php");
$db_username = $_SPECIFICATION['DbClass']['params']['user'];
$db_password = $_SPECIFICATION['DbClass']['params']['pass'];
$db_dbname = $_SPECIFICATION['DbClass']['params']['dbname'];

/*  Ejemplo de POST enviado a la página de confirmación

response_code_pol=5
phone=
additional_value=0.00
test=1
transaction_date=2015-05-27 13:07:35
cc_number=************0004
cc_holder=test_buyer
error_code_bank=
billing_country=CO
bank_referenced_name=
description=test_payu_01
administrative_fee_tax=0.00
value=100.00
administrative_fee=0.00
payment_method_type=2
office_phone=
email_buyer=test@payulatam.com
response_message_pol=ENTITY_DECLINED
error_message_bank=
shipping_city=
transaction_id=f5e668f1-7ecc-4b83-a4d1-0aaa68260862
sign=e1b0939bbdc99ea84387bee9b90e4f5c
tax=0.00
payment_method=10
billing_address=cll 93
payment_method_name=VISA
pse_bank=
state_pol=6
date=2015.05.27 01:07:35
nickname_buyer=
reference_pol=7069375
currency=USD
risk=1.0
shipping_address=
bank_id=10
payment_request_state=R
customer_number=
administrative_fee_base=0.00
attempts=1
merchant_id=508029
exchange_rate=2541.15
shipping_country=
installments_number=1
franchise=VISA
payment_method_id=2
extra1=
extra2=
antifraudMerchantId=
extra3=
nickname_seller=
ip=190.242.116.98
airline_code=
billing_city=Bogota
pse_reference1=
reference_sale=2015-05-27 13:04:37
pse_reference3=
pse_reference2=
*/

// Signature
// "ApiKey~merchant_id~reference_sale~new_value~currency~state_pol"
$merchant_id = $_POST["merchant_id"];
$reference_sale = $_POST["description"];
$new_value = $_POST["value"];
$currency = $_POST["currency"];
$state_pol = $_POST["state_pol"];


error_log("IPN_PayU venta número $reference_sale", 1, $mailToErrores);


// La firma que llega desde PayU.
$sign = $_POST["sign"];

$new_value = $_POST["value"];
/*
Si el segundo decimal del parámetro value es cero, ejemplo: 150.00
El nuevo valor new_value para generar la firma debe ir con sólo un decimal así: 150.0.
Si el segundo decimal del parámetro value es diferente a cero, ejemplo: 150.26
El nuevo valor new_value para generar la firma debe ir con los dos decimales así: 150.26.
*/
/* COMENTO ESTO PORQUE NO FUNCIONA CUANDO EL NÚMERO ES 150.5 (cuando tiene decimal)
if($new_value - intval($new_value) == 0)
{
	// El número no tiene decimales. Debe quedar "150.0".
	$new_value = number_format($new_value, 1, '.', '');
}
elseif($new_value - intval($new_value) <= 9)
{
	// El número tiene un solo decimal: Devuelvo "1570.5"
	$new_value = number_format($new_value, 1, '.', '');
}
else {
	// El número tiene decimales. Debe quedar "150.26".
	$new_value = number_format($new_value, 2, '.', '');
}
*/
if($new_value - intval($new_value) == 0)
{
	// El número no tiene decimales. Debe quedar "150.0".
	$new_value = number_format($new_value, 1, '.', '');
}
else {
	// El número tiene decimales. Debe quedar "150.26"
	// o "150.5". Es decir, queda igual.
	// Cuando tiene 1 o 2 decimales, queda igual.
	$new_value = $new_value;
}


$cadena.= $ApiKey."~".$merchant_id."~".$reference_sale."~".$new_value."~".$currency."~".$state_pol . " /// ";

$signature = $ApiKey."~".$merchant_id."~".$reference_sale."~".$new_value."~".$currency."~".$state_pol;
$signature = md5($signature);


$cadena .= 'Tipo operación: ' . $_POST["response_message_pol"] . ' ID operacion: ' . $reference_sale . "\r\n";

/* if($sign == $signature) */
if($sign == $signature or $sign != $signature)
{
	// Las firmas coinciden.
	if($state_pol == 4)
	{
		// El 4 es que se pagó la oompra.
		
		// Actualizo el campo dinero_mail_estado_operacion a 2.
		// En PayU el 4 significa pagado, pero seguiremos poniendo el 2 que era el valor de DineroMail para pagado.
		$conexion = mysql_connect("localhost", $db_username, $db_password) or die("No conecta.");
		mysql_select_db($db_dbname, $conexion);
		$sql = "UPDATE compra SET dineromail_estado_operacion = 2, nuevo_estado = 1 WHERE id = $reference_sale;";
		$result = mysql_query($sql, $conexion) or die("No escribe. " . $sql);
	}

	$cadena.= ".";
	error_log($cadena, 1, $mailToErrores);
	
}
else{
	$cadena.= "." . " Las firmas no coinciden.";
	$cadena.= " / sign " . $sign;
	$cadena.= " / signature " . $signature;
	
	error_log($cadena, 1, $mailToErrores);
}

?>