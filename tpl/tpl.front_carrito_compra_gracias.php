<?php
// Api Key A.B.
//$ApiKey = 'dwOW3Js29f6cf8hB9JnS22oGX6';
// API key Weleda Argentina
$ApiKey = "yXBGGuEe0rb09hRs3n1ZV8VO2L";

$merchant_id = $_REQUEST['merchantId'];
$referenceCode = $_REQUEST['referenceCode'];
$TX_VALUE = $_REQUEST['TX_VALUE'];
// Se debe usar "round half to even". 
/*
Para obtener el nuevo valor new_value se debe aproximar TX_VALUE siempre a un decimal con el método de redondeo "Round half to even":
    * Si el primer decimal es par y el segundo es 5, se redondeará hacia el menor valor.
    * Si el primer decimal es impar y el segundo es 5, se redondeará hacia el valor mayor.
    * En cualquier otro caso se redondeará al decimal más cercano.
*/
$New_value = round($TX_VALUE, 1, PHP_ROUND_HALF_EVEN);
// Ahora le agrego un decimal para que si llega "150" quede "150.0".
$New_value = number_format($TX_VALUE, 1, '.', '');

$currency = $_REQUEST['currency'];
$transactionState = $_REQUEST['transactionState'];
$firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
$firmacreada = md5($firma_cadena);
$firma = $_REQUEST['signature'];
$reference_pol = $_REQUEST['reference_pol'];
$cus = $_REQUEST['cus'];
$extra1 = $_REQUEST['description'];
$pseBank = $_REQUEST['pseBank'];
$lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
$transactionId = $_REQUEST['transactionId'];

if ($_REQUEST['transactionState'] == 4 ) {
	$estadoTx = "Transacción aprobada";
}

else if ($_REQUEST['transactionState'] == 6 ) {
	$estadoTx = "Transacción rechazada";
}

else if ($_REQUEST['transactionState'] == 104 ) {
	$estadoTx = "Error";
}

else if ($_REQUEST['transactionState'] == 7 ) {
	$estadoTx = "Transacción pendiente";
}

else {
	$estadoTx=$_REQUEST['mensaje'];
}

?>

<?php
// Datos para conectar a la base.
include("./specification/database.php");
$db_username = $_SPECIFICATION['DbClass']['params']['user'];
$db_password = $_SPECIFICATION['DbClass']['params']['pass'];
$db_dbname = $_SPECIFICATION['DbClass']['params']['dbname'];

$conexion = mysql_connect("localhost", $db_username, $db_password) or die("No conecta.");
mysql_select_db($db_dbname, $conexion);
			   
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
                WHERE compra.id = " . $referenceCode . ";";
            $result = mysql_query($sql, $conexion) or die("No lee. " . $sql);
            $trans = mysql_fetch_array($result);

			   

	// Lista de artículos comprados en esta compra.
	$sql = "SELECT P.nombreweleda, CP.precio, CP.cantidad, P.codigo,
		CASE
			WHEN familia_directa.id IS NOT NULL THEN familia_directa.nombre
			ELSE concat(familia.nombre, ' / ', linea.nombre)
		END AS familia_linea
	FROM compra_producto CP
		INNER JOIN producto P ON CP.id_producto = P.id
		LEFT JOIN linea on linea.id = P.id_linea
		LEFT JOIN familia on linea.id_familia = familia.id
		LEFT JOIN familia as familia_directa on familia_directa.id = P.id_familia_directa
	WHERE id_compra = " . $referenceCode . ";";
	$items = mysql_query($sql, $conexion) or die("No lee. " . $sql);
	
	
	
// https://developers.google.com/analytics/devguides/collection/analyticsjs/ecommerce

// Function to return the JavaScript representation of a TransactionData object.
function getTransactionJs(&$trans) {
  return <<<HTML
ga('ecommerce:addTransaction', {
  'id': '{$trans['id']}',
  'affiliation': 'Weleda Argentina',
  'revenue': '{$trans['costo_total']}',
  'shipping': '{$trans['costo_envio']}',
  'tax': '0'
});
HTML;
}

// Function to return the JavaScript representation of an ItemData object.
function getItemJs(&$transId, &$item) {
  return <<<HTML
ga('ecommerce:addItem', {
  'id': '$transId',
  'name': '{$item['nombreweleda']}',
  'sku': '{$item['codigo']}',
  'category': '{$item['familia_linea']}',
  'price': '{$item['precio']}',
  'quantity': '{$item['cantidad']}'
});
HTML;
}


?>


<html>
<head>
	
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NR2RW7L');</script>
	<!-- End Google Tag Manager -->
	
	
	<script>
	ga('require', 'ecommerce');

	<?php
	echo getTransactionJs($trans);

	foreach ($items as &$item) {
	  echo getItemJs($trans['id'], $item);
	}
	?>

	ga('ecommerce:send');
	</script>
	

</head>

<style>

div#contenedor {

    padding:8px 22px 0 22px;

    width:760px;widt\h:716px;

	}

div#encabezado_carrito {

    width:760px;

    height:120px;

    background-image:url('imagenes/estructura/carrito/encabezado_carrito.jpg');

    background-position: center;

    background-repeat: no-repeat;

    }

p {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	}

</style>

<body>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NR2RW7L"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

<div id="contenedor" >

<div id="encabezado_carrito"></div>

<p style="text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
    Gracias por realizar la compra.
</p>

<p style="text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
    En breve recibir&aacute; un correo electr&oacute;nico confirmado su pedido.
</p>


<?php
if (strtoupper($firma) == strtoupper($firmacreada)) {
?>
	
	<table style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
	<tr>
	<td>Estado</td>
	<td><?php echo $estadoTx; ?></td>
	</tr>
	<tr>
	<tr>
	<? /*
	<td>Compra número</td>
	<td><?php echo $transactionId; ?></td>
	</tr>
	*/ ?>
	<? /*
	<tr>
	<td>Referencia de la venta</td>
	<td><?php echo $reference_pol; ?></td> 
	</tr>
	*/ ?>
	<tr>
	<td>Compra número</td>
	<td><?php echo $referenceCode; ?></td>
	</tr>
	<tr>
	<?php
	if($pseBank != null) {
	?>
		<tr>
		<td>cus </td>
		<td><?php echo $cus; ?> </td>
		</tr>
		<tr>
		<td>Banco </td>
		<td><?php echo $pseBank; ?> </td>
		</tr>
	<?php
	}
	?>
	<tr>
	<td>Valor total</td>
	<td>$<?php echo number_format($TX_VALUE); ?></td>
	</tr>
	<tr>
	<td>Moneda</td>
	<td><?php echo $currency; ?></td>
	</tr>
	<? /*
	<tr>
	<td>Descripción</td>
	<td><?php echo ($extra1); ?></td>
	</tr>
	*/ ?>
	<tr>
	<td>Entidad:</td>
	<td><?php echo ($lapPaymentMethod); ?></td>
	</tr>
	</table>
<?php
}
else
{
?>
	<h1>Error validando firma digital.</h1>
<?php
}
?>

<p style="text-align:center;">
    <a href="index.php?module=logout"><img src="imagenes/estructura/carrito/boton_salir.jpg" border="0"/></a>
</p>

</div>


</body>
</html>