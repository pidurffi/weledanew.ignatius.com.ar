<?php
/* Carrito mayoristas. Página de pedidos realizados por cliente que está logueado. */
// www.ignatius01.com.ar/index.php?module=fr_eshop_pedidos
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
    function verPedido(id_pedido)
    {
        window.location = "index.php?module=fr_eshop_pedido&p=" + id_pedido;
    }


</script>

<p>Pedidos realizados</p>

<form action="" method="post" id="form" >


    <table class="tablita" cellpadding="0" cellspacing="0">
        <th>Pedido nro.</th>
        <th>Fecha</th>
        <? /* <th>Costo total</th> */ ?>
        <th class="derecha">&nbsp;</th>
        <?
        $i = 0;

        foreach ($list as $pedido) {
            $i++;
            ?>
            <tr>
                <td><?= $pedido['id'] ?></td>
                <td><?= date("d/m/Y H:i", strtotime($pedido['fecha'])) ?></td>
                <? /* <td style="text-align:right;">$ <?= number_format($pedido['costo_total'], 2, ",", ".") ?></td> */ ?>
                <td>
                    <input type="button" onclick="javascript:verPedido(<?= $pedido['id'] ?>);" value="Ver pedido N° <?= $pedido['id'] ?>" />
                </td>
            </tr>

        <? } ?>
    </table>


</form>    


<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>