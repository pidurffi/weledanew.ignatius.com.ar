<?php
/* Carrito mayoristas. Página de pedido realizado. Muestra los productos que contiene un pedido. */
// http://www.ignatius01.com.ar/index.php?module=fr_eshop_pedido&p=xxx
$seccion = "carritomayorista";
$actual = "carritomayorista";
$title = "Productos";

include(TPL_FOLDER . "tpl.front_template_arriba.php");
?>

<style type="text/css">
    table { border: 1px #cccccc solid; }
    table.tablita td { border-bottom: 1px #cccccc solid; border-right: 1px #cccccc solid; padding:5px; color: #000000; }
    table.tablita th { border-right: 1px #FFFFFF solid; padding:5px; color:#000000; background-color: #cccccc; }
    table.tablita th.derecha { border-right: inherit; }
</style>

<script type="text/javascript">
    function repetirPedido()
    {
        document.getElementById('form').submit();
    }


</script>

<p>Pedido número: <?= $_GET['p']; ?></p>

<input type="submit" onclick="javascript:repetirPedido();" value="Repetir pedido" name="repetirpedido" id="repetirpedido" />



<form action="index.php?module=fr_eshop_change_count" method="post" id="form" >

    <? /* Creo un objeto oculto con los IDs de los productos.
     * Si se repite el pedido, se llama a fr_eshop_change_count.
     * Este método es el mismo que se utiliza en la tpl.front_carrito_productos.php
     * para recalcular la cantidad de ítems de cada producto. 
     * A diferencia de la página donde están todos los productos, este objeto oculto solo
     * contiene los productos con stock. */ ?>
    <input type="hidden" name="ids_productos" value="<?
    foreach ($list as $producto) {
        if (!$producto['sin_stock']) {
            echo $producto['id_producto'] . "-";
        }
    }
    ?>"  />

    <table class="tablita" cellpadding="0" cellspacing="0">
        <th>&nbsp;</th>
        <th>Código</th>
        <th>Producto</th>
        <th class="derecha">Cantidad</th>
        <?
        $i = 0;

        foreach ($list as $producto) {
            $i++;
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $producto['codigo_producto'] ?></td>
                <td><?= $producto['nombre_producto'] ?></td>
                <td style="text-align:center;">
                    <?= $producto['cantidad'] ?>
                    <?
                    /* Si hay stock del producto, creo un objeto llamado count[xxx] con la cantidad de ítems de cada producto.
                     * xxx es el ID del producto. */
                    if (!$producto['sin_stock']) { /* Hay stock del producto */
                        ?>
                        <input type="hidden" name="count[<?= $producto['id_producto'] ?>]" id="count[<?= $producto['id_producto'] ?>]" value="<?= $producto['cantidad'] ?>" />
                        <?
                    } else {
                        /* No hay stock del producto */
                        print('<span style="font-weight:bold;">(Sin stock)</span>');
                    }
                    ?>
                </td>
            </tr>

        <? } ?>
    </table>


</form>    


<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>