<?php
/* Carrito mayoristas. Página para revisar el pedido. */
// www.ignatius01.com.ar/index.php?module=fr_eshop_revisarpedido
$seccion = "carritomayorista";
$actual = "carritomayorista";
$title = "eshop";

$cantidad_decimales = 2;
// Las constantes se definen en /specification/variables.php.
$montoMinimoMayorista = MONTO_MINIMO_DE_COMPRA_MAYORISTA;

include(TPL_FOLDER . "tpl.front_template_arriba.php");
?>

<style type="text/css">
    table { border: 1px #cccccc solid; }
    table.tablita td { border-bottom: 1px #cccccc solid; border-right: 1px #cccccc solid; padding:5px; color: #000000; }
    table.tablita th { border-right: 1px #FFFFFF solid; padding:5px; color:#000000; background-color: #cccccc; }
    table.tablita th.derecha { border-right: inherit; }
</style>

<script type="text/javascript">
    function volver()
    {
        window.location = "index.php?module=fr_eshop_productos";
    }

    function confirmarPedido()
    {
        // window.location = "index.php?module=fr_eshop_revisarpedido";
        // Hago SUBMIT para enviar por POST los parámetros.
        document.getElementById('form').action = "index.php?module=fr_eshop_confirmacionpedido";
        document.getElementById('form').submit();
    }
</script>

<table style="border: none;">
    <tr>
        <td><img src="/imagenes/menu_carrito/bot1_selprod_on.jpg" border="0" /></td>
        <td><img src="/imagenes/menu_carrito/bot2_comprar_on.jpg" border="0" /></td>
        <td><img src="/imagenes/menu_carrito/bot3_confped_off.jpg" border="0" /></td>
    </tr>
</table>


<?
print("<p>Cliente: " . $cliente['nombre'] . " " . $cliente['apellido'] . "</p>");
print("<p>Pedido nro.: " . $compra['id']);
if($cliente['bonificacion'] > 0)
	{ print("<p>Porcentaje de bonificación: " . $cliente['bonificacion'] . "%"); };
if($cliente['percepcion_ingresos_brutos'] > 0)
	{ print("<p>Percepción II. BB.: " . $cliente['percepcion_ingresos_brutos'] . "%"); };
print("<p>Tipo de cliente: " . $cliente['tipo_cliente']);
print("<p>Domicilio: " . $cliente['direccion']);
print("<p>Localidad: " . $cliente['localidad']);
print("<p>CUIT: " . $cliente['dni']);
print("<p>Tipo de responsable: " . $cliente['tipo_responsable_inscripto']);

?>

<h3>Por favor controle su pedido</h3>
<form method = "post" action = "index.php?module=<?= $_GET['module'] ?>&id=" id="form">
    <table class="tablita" cellpadding="0" cellspacing="0" >

        <th >Descripci&oacute;n</th>
        <th >Cantidad</th>
        <th >Precio</th>
        <th class="derecha" >Importe</th>

        <? $subtotal = 0;
        ?>
        <?
        foreach ($elementos as $key => $elemento) {

            $precio = 0;

            // El precio se determina según el tipo de cliente.
            switch ($cliente['tipo_cliente']) {
                case "Web":
                    /* web (venta al público) */
                    $precio = $elemento['object']['precio'];
                    break;
                case "Minorista":
                    /* Minorista */
                    $precio = $elemento['object']['precio_minorista'];
                    break;
                case "Mayorista":
                    /* Mayorista */
                    $precio = $elemento['object']['precio_mayorista'];
                    break;
            }
            ?>
            <tr class="contenido">
                <td ><?= utf8_encode($elemento['object']['nombreweleda']) ?></td>
                <td align="center"><?= $elemento['count'] ?></td>
                <td align="right">$ <?= number_format($precio, $cantidad_decimales, ',', '.'); ?></td>
                <td align="right">$ <?= number_format($precio * $elemento['count'], $cantidad_decimales, ',', '.'); ?></td>
            </tr>
            <? $subtotal += $precio * $elemento['count']; ?>
        <? } ?>
        <? if ($descuento_pesos > 0 OR $costoEnvio > 0) { ?>
            <tr class="costo">
                <td></td>
                <td class="texto" colspan="2">Costo de la compra</td>
                <td class="importe" align="right">$ <?= number_format($subtotal, $cantidad_decimales, ',', '.'); ?></td>
            </tr>
        <? } ?>
        <?
        if ($descuento_pesos > 0) {
            print('<tr class="total" align="right">');
            print('<td></td><td colspan="2" align="left">' . utf8_encode($compra['nombre_promocion']) . '</td><td>$ - ' . number_format($descuento_pesos, $cantidad_decimales, ',', '.') . '</td>');
            print('</tr>');
        }
        ?>
        <? if ($costoEnvio > 0) { ?>
            <tr class="costo">
                <td></td>
                <td class="texto" colspan="2">Costo del env&iacute;o</td>
                <td class="importe" align="right">$ <?= number_format($costoEnvio, $cantidad_decimales, ',', '.'); ?></td>
            </tr>
        <? } ?>
        <? if ($descuento_pesos == 0 AND $costoEnvio == 0) { ?>
            <tr class="total">
                <td></td>
                <td colspan="2">Importe total</td>
                <td align="right">$ <?= number_format($costoTotal, $cantidad_decimales, ',', '.'); ?></td>
            </tr>
        <? } ?>
        <? if ($recargo_pesos > 0) { ?>
            <tr class="total">
                <td></td>
                <td colspan="2">Percepción ingresos brutos</td>
                <td align="right">$ <?= number_format($recargo_pesos, $cantidad_decimales, ',', '.'); ?></td>
            </tr>
        <? } ?>
        <?
        if ($descuento_pesos > 0) {
            print('<tr class="total">');
            print('<td></td><td colspan="2">Total con descuento</td><td align="right">$ ' . number_format($costoTotalConDescuento, $cantidad_decimales, ',', '.') . '</td>');
            print('</tr>');
        }
        ?>
    </table>

    <input type="button" name="btnvolver" id="btnvolver" value="Volver" onclick="javascript:volver();" />
	<?
    // No se muestra el botón "confirmar pedido" si no se llega al monto mínimo de compra mayorista.
    if ($costoTotalConDescuento >= $montoMinimoMayorista) { ?>
		<input type="button" name="btnconfirmar" id="btnconfirmar" value="Confirmar pedido" onclick="javascript:confirmarPedido();" />
	<? }
	else { ?>
		<span style="color:#FF0000; font-weight:bold;">&nbsp;&nbsp;El monto mínimo de compra es de $ <?=$montoMinimoMayorista ?>.</span>
	<? } ?>
                
                
        <p style="font-size: 12px; width: 420px;">
            Estimado cliente, debido a las dificultades de importación de público conocimiento a las cuales nos enfrentamos, el stock disponible estará sujeto al momento del armado del pedido, el cual puede variar.
        </p>

</form>

<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>