<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
/* Si el cliente no es WEB (es minorista o mayorista), no debe ver esta pop-up;
 *  entonces se redirecciona la página principal a fr_eshop_productos y se cierra el pop-up.
 */
if (($cliente['tipo_cliente'] === 'Minorista' OR $cliente['tipo_cliente'] === 'Mayorista')) {
    ?>
    <script type="text/javascript">
        window.opener.location.href = "index.php?module=fr_eshop_productos";
        window.close();
    </script>
<? } ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <style>
            .clearfix:after {
                content: ".";
                display: block;
                height: 0;
                clear: both;
                visibility: hidden;
            }

            .clearfix {display: inline-table;}

            /* Hides from IE-mac \*/
            * html .clearfix {height: 1%;}
            .clearfix {display: block;}

            /* End hide from IE-mac */

            body {
                margin:0;
                padding:0px;
                text-align: center;
            }

            div#contenedor_carrito {
                margin:auto;
                width:790px;
            }

            div#encabezado_carrito {
                width:790px;
                height:155px;
                background-image:url('imagenes/estructura/carrito/encabezado_carrito.jpg');
                background-repeat:no-repeat;
                background-position:center;
            }

            div#cuerpo_carrito {
                padding:8px 22px 0 22px;
                width:790px;widt\h:746px;
                text-align: center;
            }

            table {
                font-family:Arial, Helvetica, sans-serif;
                font-size:11px;
                font-weight:bold;
            }

            table tr td {text-align:center;}

            table tr.titulo {
                background-color:#d3bf96;
                color:#FFFFFF;
                height:22px;
            }

            table tr.contenido {
                background-color:#d6e0f9;
                height:27px;
                color:#868a93;
            }

            table tr.compra_total {
                background-color:#bfc8de;
                color:#484848;
                height:27px;
            }

            div#menu_carrito {
                width:600px;widt\h:450px;
                height:22px;
                margin-top:20px;
                padding-left: 150px;
            }

            div#menu_carrito ul {
                margin:0;
                padding:0;
                list-style-type:none;
            }

            div#menu_carrito ul li {
                display:inline;
            }

            div#menu_carrito ul li a {
                display:block;
                float:left;
                height:0;
                padding-top:22px;
                overflow:hidden;
                text-decoration:none;
            }

            div#menu_carrito ul li a.seguir {background-image:url('/imagenes/menu_carrito/seguir.jpg'); width:115px;}
            div#menu_carrito ul li a.recalcular {background-image:url('/imagenes/menu_carrito/recalcular.jpg'); width:74px; margin-left:27px;}
            div#menu_carrito ul li a.limpiar {background-image:url('/imagenes/menu_carrito/limpiar.jpg'); width:100px; margin-left:29px;}
            div#menu_carrito ul li a.comprar {background-image:url('/imagenes/menu_carrito/comprar.jpg'); width:67px; margin-left:32px;}

            * html div#menu a:link, * html div#menu a:visited {height:22px; he\ight:0;}

            div#menu a:hover {background-position:0 -22px;}

            div#pie_carrito p {
                margin-top:20px;
                font-family:Arial, Helvetica, sans-serif;
                font-size:10px;
                color:#606062;
                font-weight:bold;
                text-align:center;
            }

            input.cantidad {width:22px;}

            a.borrar {
                display:block;
                overflow:hidden;
                padding-top:14px;
                margin-left:19px;
                width:11px;
                height:0;
                background:url(../imagenes/estructura/carrito/b_borrar.jpg);
            }


        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>E-shop Weleda</title>
        <script type="text/javascript">
            var changingId;
            var changingLastValue;
            var cerrar_la_ventana = true;
            var recargar_ventana_principal = true;

            function changeCount() {
                // Cuando se hace clic en "Recalcular", no debe cerrar la ventana.
                cerrar_la_ventana = false;
                document.getElementById('form').submit();
                window.opener.location.href = window.opener.location.href;
            }

            function startChanging(id, element) {
                changingId = id;
                changingLastValue = element.value;
            }

            function stopChanging(id, element) {
                if ((changingId == id) && (changingLastValue != element.value)) {
                    changeCount();
                }
            }

            function ver_perfil()
            {
                recargar_ventana_principal = false;
                window.opener.location = "index.php?module=fr_clientes_modificacion";
                window.close();
            }

            function cerrar_popup_y_recargar_ventana_principal()
            {
                // Recargar la ventana principal.
                window.opener.location.href = window.opener.location.href;
                if (window.opener.progressWindow)
                {
                    window.opener.progressWindow.close();
                }
                window.close();
            }

            function recargar_ventana_principal()
            {
                // Recargar la ventana principal.
                window.opener.location.href = window.opener.location.href;
            }

            function comprar()
            {
                // Cuando se hace clic en "Comprar", no debe cerrar la ventana.
                cerrar_la_ventana = false;
                window.location = "index.php?module=fr_carrito_end_1";
            }

            function limpiar_carrito()
            {
                cerrar_la_ventana = false;
                window.location = "index.php?module=fr_carrito_reset";
                window.opener.location.href = window.opener.location.href;
            }

            var active_element;
            var bIsMSIE;

            /* Esta función se carga en BODY ONLOAD. Es un truco porque el ONBLUR no funciona en Explorer. */
            function initiateSelfClosing() {
                if (navigator.appName == "Microsoft Internet Explorer") {
                    active_element = document.activeElement;
                    document.onfocusout = closeWnd;
                    bIsMSIE = true;
                }
                else {
                    window.onblur = closeWnd;
                }
            }

            /* Cierra la ventana.  */
            function closeWnd() {
                if (window.opener != null) {
                    if (bIsMSIE && (active_element != document.activeElement)) {
                        active_element = document.activeElement;
                    }
                    else {
                        window.close();
                    }
                }
            }

            function seguir_comprando(carrito_vacio)
            {
                /*
                 * A esta función la quité del onunload del body
                 * porque cuando pongo el body no sé si el carrito está vacío,
                 * entonces no puedo redireccionar.
                 */
                if (recargar_ventana_principal == true)
                {
                    if (carrito_vacio == true)
                    {
                        /* Si el carrito está vacío, llevo a la página de productos, para que empiecen a comprar. */
                        window.opener.document.location.href = "index.php?module=fr_productos";
                    }
                    else
                    {
                        window.opener.document.location.href = window.opener.location.href;
                    }
                }
                if (cerrar_la_ventana == true)
                {
                    window.close();
                }
            }

            function borrar_item(key)
            {
                cerrar_la_ventana = false;
                window.location = "index.php?module=fr_carrito_delete&item=" + key;
            }

        </script>

        <?php /* Google Analytics */ ?>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-29628921-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>

    </head>
    <body onload="javascript:initiateSelfClosing();" <? /* onunload="javascript:seguir_comprando()" */ ?> >
        <?
// Los precios se muestran con dos decimales en Argentina y con cero en Chile.
        $cantidad_decimales = ( CONSTANTE_PAIS == 'Argentina' ? 2 : 0);

        if (!empty($errors))
            foreach ($errors as $error) {
                ?>
                <span style="color:red"><?= $error ?></span><br/>
            <? } ?>
        <form action="index.php?module=fr_carrito_change_count" method="post" id="form" >
            <div id="contenedor_carrito" class="clearfix">
                <div id="encabezado_carrito"></div>

                <table cellspacing="0" cellpadding="0" border="0" width="760" style="padding-bottom:5px;">
                    <tr>
                        <td style="text-align:left; padding-left:25px;">
                            <?= $usuario['nombre'] ?>&nbsp;<?= $usuario['apellido'] ?>&nbsp;&nbsp;&nbsp;
                            <a href="#" onClick="ver_perfil()">Ver perfil</a>
                        </td>
                        <td style="text-align:right;">
                            <a href="index.php?module=logout">Cerrar sesión</a>
                        </td>
                    </tr>
                </table>

                <div id="cuerpo_carrito" class="clearfix">
                    <div id="tabla_carrito" class="clearfix">
                        <table width="100%" border="0" cellpadding="2" cellspacing="0">

                            <tr class="titulo">
                                <td width="50">Borrar</td>
                                <td style="padding-left:10px; text-align:left;">Descripci&oacute;n</td>
                                <td width="60">Cantidad</td>
                                <td width="65">Precio</td>
                                <td width="65">Importe</td>
                            </tr>
                            <?
                            $precioTotal = 0;
                            $totalElementos = 0;
                            foreach ($items as $key => $item) {
                                ?>
                                <tr>
                                    <td width="50"><a href="javascript:borrar_item(<?= $key ?>);" class="borrar">Borrar</a></td>
                                    <td style="padding-left:10px; text-align:left;"><?= utf8_encode($item['object']["nombreweleda"]) ?></td>
                                    <td width="60">
                                        <? /* Si el precio es cero, puede ser un producto de regalo.
                                         No permito que la cantidad sea mayor a 1 (es porque el cliente puede volver atrás
                                         y aumentar la cantidad del producto de regalo). */
                                        if($item['object']['precio'] == 0 && $item['count'] > 1)
                                            { $item['count'] = 1; }
                                        ?>
                                        <input name="count[<?= $key ?>]" onfocus="startChanging('<?= $key ?>', this);" onblur="stopChanging('<?= $key ?>', this);" type="text" class="cantidad" value="<?= $item['count'] ?>" style="text-align:right;" />
                                    </td>
                                    <td width="65" align="right">$ <?= number_format($item['object']['precio'], $cantidad_decimales, ',', '.'); ?></td>
                                    <td width="65" align="right">$ <?= number_format($item['object']['precio'] * $item['count'], $cantidad_decimales, ',', '.'); ?></td>
                                    <?
                                    $precioTotal += ($item['object']['precio'] * $item['count']);
                                    $totalElementos += $item['count'];
                                    ?>
                                </tr>
                            <? } ?>
                            <tr class="compra_total">
                                <td colspan="2" style="text-align:left;padding-left:5px;">Total de elementos: <?= $totalElementos ?></td>
                                <td colspan="2" style="text-align:right;">Total de la compra</td>
                                <td>$ <?= number_format($precioTotal, $cantidad_decimales, ',', '.'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <?
// Las constantes de monto m�nimo de compra y para env�o gratis se definen en /specification/variables.php.
                    $montoMinimo = MONTO_MINIMO_DE_COMPRA;
                    ?>
                    <div style="padding-top:15px; font-family:Arial, Helvetica, sans-serif;" >
                        El monto m&iacute;nimo de compra es de $<?= number_format($montoMinimo, $cantidad_decimales, ',', '.') ?>.<br />
                        El env&iacute;o es gratis para compras superiores a $<? echo number_format(MONTO_MINIMO_PARA_ENVIO_GRATIS, $cantidad_decimales, ',', '.'); ?>.
                    </div>

                    <div id="menu_carrito">
                        <ul>
                            <li><a class="<?= ($precioTotal > 0 ? 'seguir' : 'comprar') ?>" href="javascript:seguir_comprando(<?= ($precioTotal > 0 ? 'false' : 'true') ?>);" >Seguir comprando</a></li>
                            <li><a class="recalcular" href="javascript:changeCount();">Recalcular</a></li>

                            <li><a class="limpiar" href="javascript:limpiar_carrito()">Limpiar carrito</a></li>
                            <? if (!empty($items)) { ?>
                                <li>
                                    <?
                                    // SE DEFINE UN VALOR MÍNIMO DE COMPRA. SI NO SE CUMPLE, NO SE PUEDE AVANZAR
                                    if ($precioTotal >= $montoMinimo) {
                                        // Se llegó� al monto mínimo. 
                                        ?>
                                        <a class="comprar" href="javascript:comprar()">Comprar</a>
                                        <?
                                    } else {
                                        ?>
                                        <a class="comprar" href="#" title="El monto mínimo de compra es de $<?= $montoMinimo ?>">Comprar</a>
                                    <? } ?>
                                </li>
                            <? } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </form>

        <? include("tpl.front_carrito_promociones.php"); ?>

        <div id="pie_carrito" class="clearfix">
            <p>Para cambiar la cantidad pedida de un &iacute;tem, modifique la misma y presione "Recalcular".<br />Para borrar un &iacute;tem de su carrito, haga clic sobre "Borrar".</p>
        </div>
		
    </body>
</html>