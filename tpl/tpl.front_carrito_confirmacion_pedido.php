<?php
/* Carrito mayoristas. Página con la confirmación del pedido. */
// www.ignatius01.com.ar/index.php?module=fr_eshop_confirmacionpedido
$seccion = "carritomayorista";
$actual = "carritomayorista";
$title = "Productos";

$cantidad_decimales = 2;

include(TPL_FOLDER . "tpl.front_template_arriba.php");
?>

<style type="text/css">
    table { border: 1px #cccccc solid; }
    table.tablita td { border-bottom: 1px #cccccc solid; border-right: 1px #cccccc solid; padding:5px; color: #000000; }
    table.tablita th { border-right: 1px #FFFFFF solid; padding:5px; color:#000000; background-color: #cccccc; }
    table.tablita th.derecha { border-right: inherit; }
</style>

<script type="text/javascript">

</script>

<table style="border: none;">
    <tr>
        <td><img src="/imagenes/menu_carrito/bot1_selprod_on.jpg" border="0" /></td>
        <td><img src="/imagenes/menu_carrito/bot2_comprar_on.jpg" border="0" /></td>
        <td><img src="/imagenes/menu_carrito/bot3_confped_on.jpg" border="0" /></td>
    </tr>
</table>

<?
print("<p>Cliente: " . $cliente['nombre'] . " " . $cliente['apellido'] . "</p>");
print("<p>Pedido confirmado nro.: " . $compra['id']);
?>


<h3>Se ha realizado su pedido</h3>
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
            print('<td></td><td colspan="2">' . utf8_encode($compra['nombre_promocion']) . '</td><td>$ - ' . number_format($descuento_pesos, $cantidad_decimales, ',', '.') . '</td>');
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

</form>



<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>