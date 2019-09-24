<?php
/* Carrito mayoristas. Página de productos. */
// www.ignatius01.com.ar/index.php?module=fr_eshop_productos
$seccion = "carritomayorista";
$actual = "carritomayorista";
$title = "Productos";
$cantidad_decimales = 2;

include(TPL_FOLDER . "tpl.front_template_arriba.php");
?>

<script src="../includes/jquery-1.9.1.js"></script>
<script src="../includes/jquery-ui-1.10.3.custom.min.js"></script>
<link rel="stylesheet" href="../includes/jquery-ui-1.10.3.custom.min.css" />

<style type="text/css">
    a.borrar {
        display: inline;
        display:inline-block;
        overflow:hidden;
        padding-top:13px;
        /* margin-left:19px; */
        width:11px;
        height:0;
        background:url(../imagenes/estructura/carrito/b_borrar.jpg);
    }
    a {
        color:#0000FF;
        font-weight: bold;
    }
    p {
        color: #000000;
    }
    h3.p-familia {
        font-size:16px;
        color:#ff9933;
    }
    body {
        font-family: Arial, Helvetica, Sans-Serif;
        font-size: 12px;
    }
    a.btnAgregar {
        display: inline;
        display:inline-block;
        overflow:hidden;
        padding-top:19px;
        margin-bottom:-3px;
        /* margin-left:19px; */
        width:20px;
        height:0;
        background:url(../imagenes/estructura/carrito/agregar-20.png);
        background-repeat: no-repeat;
    }
</style>

<script type="text/javascript">
    function agregarProducto(id, cantidad) {
        if (cantidad == 0)
        {
            cantidad = 1;
        }
        window.location.href = "index.php?module=fr_eshop_agregar_producto&id=" + id + "&cant=" + cantidad;
    }

    function changeCount() {
        document.getElementById('form').submit();
    }

    function borrar_item(key)
    {
        window.location = "index.php?module=fr_eshop_delete&item=" + key;
    }

    function verPedidosAnteriores()
    {
        window.location = "index.php?module=fr_eshop_pedidos";
    }

    function revisarPedido()
    {
        // window.location = "index.php?module=fr_eshop_revisarpedido";
        // Hago SUBMIT para enviar por POST los parámetros.
        document.getElementById('form').action = "index.php?module=fr_eshop_revisarpedido";
        document.getElementById('form').submit();
    }
</script>
<script>
    /* Para la animación del acordeón. 
     collapsible: true (hace que se puedan cerrar todos (si no, siempre queda uno abierto).
     active: false (para que no aparezca abierto siempre el primer panel).
     heightStyle: "content" (para que los divs no tenga un alto calculado en píxeles).
     --- esto es para que recuerde el div abierto después de un post, pero no funciona porque hace post a fr_eshop_change_count
     --- y luego redirecciona a fr_eshop_carrito_productos
     active: <?= (!empty($_POST['div_abierto']) ? $_POST['div_abierto'] : 'false' ) ?>
     */
    $(function() {
        $("#accordion").accordion({
            collapsible: true,
            heightStyle: "content",
            active: false
        });
    });
</script>

<?
$total_items_en_carrito = 0;
$importe_total_de_carrito = 0;
// Para leer los datos del carrito...
if (isset($_SESSION['GALIX']['WeledaFront']['carrito'])) {
    foreach ($_SESSION['GALIX']['WeledaFront']['carrito'] as $key => $val) {
        foreach ($_SESSION['GALIX']['WeledaFront']['carrito'][$key] as $key2 => $val2) {
            if ($key2 == 'count') {
                $cantidad = $_SESSION['GALIX']['WeledaFront']['carrito'][$key][$key2];
                $total_items_en_carrito += $cantidad;
                switch ($cliente['tipo_cliente']) {
                    case "Web":
                        /* web (venta al público) */
                        $precio = $precio = $_SESSION['GALIX']['WeledaFront']['carrito'][$key]['object']['precio'];
                        break;
                    case "Minorista":
                        /* Minorista */
                        $precio = $precio = $_SESSION['GALIX']['WeledaFront']['carrito'][$key]['object']['precio_minorista'];
                        break;
                    case "Mayorista":
                        /* Mayorista */
                        $precio = $precio = $_SESSION['GALIX']['WeledaFront']['carrito'][$key]['object']['precio_mayorista'];
                        break;
                }
                // Calculo total sin descuento.
                $importe_total_de_carrito += $cantidad * $precio;
                if ($cliente['bonificacion'] > 0) {
                    $descuento_pesos = $importe_total_de_carrito * $cliente['bonificacion'] / 100;
                } else {
                    $descuento_pesos = 0;
                }
            }
        }
    }
}
?>

<table>
    <tr>
        <td><img src="/imagenes/menu_carrito/bot1_selprod_on.jpg" border="0" /></td>
        <td><img src="/imagenes/menu_carrito/bot2_comprar_off.jpg" border="0" /></td>
        <td><img src="/imagenes/menu_carrito/bot3_confped_off.jpg" border="0" /></td>
    </tr>
</table>


<table style="padding-bottom:10px; width:100%;">
    <tr>
        <td><a href="index.php?module=fr_cl_may_modificacion">Ver perfil</a></td>
        <td style="text-align: right;"><a href="index.php?module=logout&pu=0">Cerrar sesión</a></td>
    </tr>
    <tr>
        <td><strong>Cliente:</strong> <?= $cliente['nombre'] ?>&nbsp;<?= $cliente['apellido'] ?></td>
        <td rowspan="5" align="right" valign="top">
            <? /* Detalle de pedido. DEBE IR A LA DERECHA. */ ?>
            <? if ($total_items_en_carrito > 0) { ?>
                <div style="height:100px; overflow-y: auto;">
                    <table class="tablita" cellpadding="0" cellspacing="0" style="background-color: azure; border:1px solid #96d7eb;">
                        <tr>
                            <td colspan="3" align="right" style="background-color: #96d7eb; padding-right:2px;">Mi compra</td>
                        </tr>
                        <?
                        if (isset($_SESSION['GALIX']['WeledaFront']['carrito'])) {
                            foreach ($_SESSION['GALIX']['WeledaFront']['carrito'] as $key => $elemento) {
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
                                    <td style="border-right:1px solid #96d7eb; padding-right: 1px; padding-left: 1px;"><?= substr(utf8_encode($elemento['object']['nombreweleda']), 0, 20) ?>...</td>
                                    <td align="right" style="border-right:1px solid #96d7eb; padding-right: 1px;"><?= $elemento['count'] ?></td>
                                    <td align="right" style="padding-right: 1px;">$ <?= number_format($precio * $elemento['count'], $cantidad_decimales, ',', '.'); ?></td>
                                </tr>
                                <?
                            }
                        }
                        ?>
                        <? if ($descuento_pesos > 0) { ?>
                            <tr>
                                <td colspan="2" style="background-color: #96d7eb; padding-right:2px; border-bottom:1px solid azure;">Descuento</td>
                                <td align="right" style="background-color: #96d7eb; padding-right:2px; border-bottom:1px solid azure;">$ <?= number_format($descuento_pesos, $cantidad_decimales, ',', '.'); ?></td>
                            </tr>
                        <? } ?>
                        <tr>
                            <td colspan="2" style="background-color: #96d7eb; padding-right:2px;">Total</td>
                            <td align="right" style="background-color: #96d7eb; padding-right:2px;">$ <?= number_format($importe_total_de_carrito - $descuento_pesos, $cantidad_decimales, ',', '.'); ?></td>
                        </tr>
                    </table>
                </div>
            <? } ?>
            <? /* Fin tabla Detalle pedido. */ ?>
        </td>
    </tr>
    <tr>
        <td><strong>Tipo cliente:</strong> <?= $cliente['tipo_cliente'] ?></td>
    </tr>
    <?
    if ($cliente['bonificacion'] > 0) {
        print("<tr><td><strong>Bonificación:</strong> " . $cliente['bonificacion'] . "%</td></tr>");
    }
    ?>
	<?
    if ($cliente['percepcion_ingresos_brutos'] > 0) {
        print("<tr><td><strong>Percepción II. BB.:</strong> " . $cliente['percepcion_ingresos_brutos'] . "%</td></tr>");
    }
    ?>
    <tr>
        <td><strong>Total ítems:</strong> <?= $total_items_en_carrito ?></td>
    </tr>
    <tr>
        <td valign="top"><strong>Importe total:</strong> $ <?= number_format($importe_total_de_carrito, $cantidad_decimales, ",", ".") ?></td>
    </tr>
</table>

<?php /* <p>Estamos realizando tareas de mantenimiento.</p> */ ?>

<form action="index.php?module=fr_eshop_change_count" method="post" id="form">

    <input type="submit" name="recalcular" id="recalcular" value="Recalcular" onclick="javascript:changeCount();" />
    <input type="button" name="verpedidos" id="verpedidos" value="Ver pedidos anteriores" onclick="javascript:verPedidosAnteriores();" />
    <input type="button" name="revisarpedido" id="revisarpedido" value="Comprar" onclick="javascript:revisarPedido();" <?= ($total_items_en_carrito == 0 ? 'disabled' : ''); ?>  />
    <? /* <p>Estamos realizando mantenimiento en el sitio. Disculpe las molestias.</p> */ ?>
    <input type="hidden" name="ids_productos" value="<?
    foreach ($list as $producto) {
        echo $producto['id'] . "-";
    }
    ?>"  />

    <?
    $i = 0;
    $familia_anterior = "";
    $linea_anterior = "";
    ?>
    <div id="accordion">
        <?
        foreach ($list as $producto) {
            $i++;
            $precio = 0;

            // El precio se determina según el tipo de cliente.
            // Determino si hay stock (minorista o mayorista) según el tipo de cliente.
            $sin_stock = false;
            $mostrar_producto = true;
            switch ($cliente['tipo_cliente']) {
                case "Web":
                    /* web (venta al público) */
                    $precio = $producto['precio'];
                    $sin_stock = $producto['sin_stock'];
                    if($producto['solo_para_minoristas']){
                        $mostrar_producto = false;
                    }
                    break;
                case "Minorista":
                    /* Minorista */
                    $precio = $producto['precio_minorista'];
                    $sin_stock = $producto['sin_stock_minorista'];
                    if($producto['solo_para_minoristas']){
                        $mostrar_producto = true;
                    }
                    break;
                case "Mayorista":
                    /* Mayorista */
                    $precio = $producto['precio_mayorista'];
                    $sin_stock = $producto['sin_stock_mayorista'];

                    if($producto['solo_para_minoristas']){
                        $mostrar_producto = false;
                    }
                    break;
            }

            // Defino la familia actual según si el producto tiene línea/familia o solo familia_directa.
            $familia = ( isset($producto['id_familia_directa']) ? $producto['familia_directa'] : $producto['familia'] );

            if ($familia != $familia_anterior && isset($producto['id_familia_directa'])) {
                // Cambió la familia (familia_directa)
                // Cierro el div de los productos de la línea anterior (excepto si estoy en el primer producto).
                if ($i > 1) {
                    print("</div>");
                }
                print('<h3><span style="font-weight: bold;">' . utf8_encode($familia) . '</span></h3>');
                // Abro el DIV para meter a los productos de esta línea.
                print("<div>");
            } elseif ($producto['linea'] != $linea_anterior) {
                // Cambió la linea (o la línea y la familia)
                // Cierro el div de los productos de la línea anterior (excepto si estoy en el primer producto).
                if ($i > 1) {
                    print("</div>");
                }
                print('<h3><span style="font-weight: bold;">' . utf8_encode($familia) . '</span>');
                print('&nbsp;&bullet;&nbsp;<span>' . utf8_encode($producto['linea']) . '</span></h3>');
                // Abro el DIV para meter a los productos de esta línea.
                print("<div>");
            }

            if($mostrar_producto) {
                ?>
                <p style="">
                    <?
                    /* Defino link a la página de producto (se abre en pop-up). */
                    if (isset($producto['id_familia_directa'])) {
                        $link_producto = '/index.php?module=fr_producto_suelto&id=' . $producto['id'];
                    } else {
                        $link_producto = '/index.php?module=fr_producto&id=' . $producto['id'] . '&id_linea=' . $producto['id_linea'] . '&id_familia=' . $producto['id_familia'];
                    }
                    ?>
                    <?= utf8_encode($producto['codigo']) ?> &bullet;
                    <a href="<?= $link_producto ?>" target="_BLANK"><?= utf8_encode($producto['nombre']) ?></a> &bullet;
                    $ <?= number_format($precio, $cantidad_decimales, ",", ".") ?>

                    <?
                    /*
                     * Imprimir cuántos ítems hay en el carrito.
                     */

                    if (isset($_SESSION['GALIX']['WeledaFront']['carrito'][$producto['id']])) {
                        $cantidad_items_producto = $_SESSION['GALIX']['WeledaFront']['carrito'][$producto['id']]['count'];
                    } else {
                        $cantidad_items_producto = 0;
                    }
                    ?>

                    <? if (!$sin_stock AND $precio != 0) { /* Hay stock del producto y el precio no es cero. */ ?>

                        <input type="text" name="count[<?= $producto['id'] ?>]" id="count[<?= $producto['id'] ?>]"
                               value="<?= $cantidad_items_producto ?>" maxlength="3" style="width:30px;"/>


                        <? if ($cantidad_items_producto > 0) { ?>
                            <a href="javascript:borrar_item(<?= $producto['id'] ?>);" class="borrar" title="Quitar"></a>
                        <? } ?>

                        <a href="javascript:agregarProducto(<?= $producto['id'] ?>, document.getElementById('count[<?= $producto['id'] ?>]').value)"
                           class="btnAgregar" title="Agregar"></a>

                        <?
                    } else {
                        /* No hay stock del producto */
                        print('&bullet; <span style="font-weight:bold;">Sin stock</span>');
                    }
                    ?>

                </p>

                <?
            }
            $familia_anterior = $familia;
            $linea_anterior = $producto['linea'];
            ?>

        <? } ?>
    </div> <? /* cierro div de la línea o familia */ ?>
</div> <? /* cierro div id=acordion */ ?>

<input type="submit" name="recalcular2" id="recalcular2" value="Recalcular" onclick="javascript:changeCount();" />

<input type="hidden" name="nombre" id="nombre" value="<?= $cliente['nombre'] . " " . $cliente['apellido'] ?>" />
<input type="hidden" name="direccion" id="direccion" value="-" />
<input type="hidden" name="codigo_postal" id="codigo_postal" value="-" />
<input type="hidden" name="ciudad" id="ciudad" value="-" />
<input type="hidden" name="provincia" id="provincia" value="" />
<input type="hidden" id="ciudad_id" name="ciudad_id" value="0" />

<input type="hidden" id="codigo_promocion" name="codigo_promocion" value="" />
<input type="hidden" id="costo_envio" name="costo_envio" value="" />
<input type="hidden" id="dineromail_estado_operacion" name="dineromail_estado_operacion" value="0" />
<input type="hidden" id="valida" name="valida" value="0" />
<input type="hidden" id="descuento_pesos" name="descuento_pesos" value="0" />
<input type="hidden" id="descuento_porcentaje" name="descuento_porcentaje" value="0" />
<input type="hidden" id="nombre_promocion" name="nombre_promocion" value="" />
<input type="hidden" id="nombre_facturacion" name="nombre_facturacion" value="" />
<input type="hidden" id="direccion_facturacion" name="direccion_facturacion" value="" />
<input type="hidden" id="ciudad_facturacion" name="ciudad_facturacion" value="" />
<input type="hidden" id="codigo_postal_facturacion" name="codigo_postal_facturacion" value="" />
<input type="hidden" id="provincia_facturacion" name="provincia_facturacion" value="" />
<input type="hidden" id="nombre_promocion" name="nombre_promocion" value="" />

<input type="hidden" id="div_abierto" name="div_abierto" value="3" />

</form>


<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>