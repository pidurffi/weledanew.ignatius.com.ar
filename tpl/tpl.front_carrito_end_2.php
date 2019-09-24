<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NR2RW7L');</script>
	<!-- End Google Tag Manager -->
	
	
	<?
        // <title>...</title>
        if (CONSTANTE_PAIS == "Argentina")
            print("<title>Weleda e-shop paso 2</title>");
        elseif (CONSTANTE_PAIS == "Chile")
            print("<title>Weleda e-shop paso 2</title>");

        // Los precios se muestran con dos decimales en Argentina y con cero en Chile.
        $cantidad_decimales = ( CONSTANTE_PAIS == 'Argentina' ? 2 : 0);
        ?>
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
            }

            div#contenedor {
                padding:8px 22px 0 22px;
                width:760px;widt\h:716px;
            }

            h3 {
                font-family:Arial, Helvetica, sans-serif;
                color:#6699cc;
                font-size:16px;
            }

            table {
                font-family:Arial, Helvetica, sans-serif;
                font-size:11px;
                font-weight:bold;
            }

            table tr.titulo {
                background-color:#d3bf96;
                color:#FFFFFF;
                height:22px;
            }

            table tr.titulo td {text-align:center;}

            table tr.contenido {
                background-color:#bfc8de;
                height:27px;
                color:#111111;
            }

            table tr.contenido td {text-align:center;}

            table tr.costo {height:30px;}

            table tr.costo td.texto {
                padding-left:5px;
                background-color:#6085af;
                color:#FFFFFF;
            }


            table tr.costo td.importe {
                background-color:#f0f0f0;
                color:#6699cc;
                text-align:center;
            }

            table tr.total {
                text-align:center;
                font-family:Arial, Helvetica, sans-serif;
                color:#6085af;
                font-size:18px;
            }

            div#menu_control {
                width:460px;
                height:44px;
                padding-left: 280px;
            }

            div#menu_control ul {
                padding:0;
                list-style-type:none;
            }

            div#menu_control ul li {
                display:inline;
            }

            div#menu_control ul li a {
                display:block;
                float:left;
                height:0;
                padding-top:22px;
                overflow:hidden;
                text-decoration:none;
            }

            div#menu_control ul li a.atras {background-image:url('/imagenes/menu_carrito/atras.jpg'); width:67px;}
            div#menu_control ul li a.confirmar {background-image:url('/imagenes/menu_carrito/confirmar.jpg'); width:113px; margin-left:10px;}
            * html div#menu_control a:link, * html div#menu_control a:visited {height:22px; he\ight:0;}
            div#menu_control a:hover {background-position:0 -22px;}

            div#encabezado_carrito {
                width:760px;
                height:120px;
                background-image:url('imagenes/estructura/carrito/encabezado_carrito.jpg');
                background-position: center;
                background-repeat: no-repeat;
            }
        </style>

        <script type="text/javascript">
            function ver_perfil()
            {
                window.opener.location = "index.php?module=fr_clientes_modificacion";
                window.close()
            }
        </script>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    </head>

    <body>
    
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NR2RW7L"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	
    
    
        <div id="encabezado_carrito"></div>
        <p style="text-align:left; font-family:Arial, Helvetica, sans-serif; font-size:11px;">
            <?= $usuario['nombre'] ?>&nbsp;<?= $usuario['apellido'] ?>&nbsp;
            <a href="#" onClick="ver_perfil()">Ver perfil</a>
        </p>
        <div id="contenedor" class="clearfix">
            <h3>Por favor controle su pedido</h3>
            <form method="post" action="index.php?module=<?= $_GET['module'] ?>&id=">
                <table border="0" cellpadding="1" cellspacing="1" width="98%">
                    <tr class="titulo">
                        <td >Descripci&oacute;n</td>
                        <td >Cantidad</td>
                        <td >Precio</td>
                        <td >Importe</td>
                    </tr>
                    <? $subtotal = 0; ?>
                    <? foreach ($elementos as $key => $elemento) { ?>
                        <tr class="contenido">
                            <td ><?= utf8_encode($elemento['object']['nombreweleda']) ?></td>
                            <td ><?= $elemento['count'] ?></td>
                            <td >$ <?= number_format($elemento['object']['precio'], $cantidad_decimales, ',', '.'); ?></td>
                            <td >$ <?= number_format($elemento['object']['precio'] * $elemento['count'], $cantidad_decimales, ',', '.'); ?></td>
                        </tr>
                        <? $subtotal += $elemento['object']['precio'] * $elemento['count']; ?>
                    <? } ?>
                    <tr class="costo">
                        <td></td>
                        <td class="texto" colspan="2">Costo de la compra</td>
                        <td class="importe">$ <?= number_format($subtotal, $cantidad_decimales, ',', '.'); ?></td>
                    </tr>

                    <?
                    // OCULTO PESO DEL ENVIO
                    /*
                      <tr class="costo">
                      <td></td>
                      <td class="texto" colspan="2">Peso del env&iacute;o</td>
                      <td class="importe"> <?=($pesoTotal) ?> gramos</td>
                      </tr>
                     */
                    ?>
                    <?
                    if ($descuento_pesos > 0) {
                        print('<tr class="total">');
                        print('<td></td><td colspan="2" style="font-size:12px;">' . utf8_encode($promocion['nombre']) . '</td><td>$ - ' . number_format($descuento_pesos, $cantidad_decimales, ',', '.') . '</td>');
                        print('</tr>');
                    }
                    ?>

                    <tr class="costo">
                        <td></td>
                        <td class="texto" colspan="2">Costo del env&iacute;o</td>
                        <td class="importe">$ <?= number_format($costoEnvio, $cantidad_decimales, ',', '.'); ?></td>
                    </tr>
                    <tr class="costo">
                        <td></td>
                        <td class="texto" colspan="2">Demora del env&iacute;o</td>
                        <td class="importe">
                            <? /* =$diasTotal;?> d&iacute;a<?=($diasTotal>1)?'s':''; */ ?>
                            Dentro de los pr&oacute;ximos 5 d&iacute;as
                        </td>
                    </tr>
                    <tr class="total">
                        <td></td>
                        <td colspan="2">Importe total</td>
                        <td>$ <?= number_format($costoTotal, $cantidad_decimales, ',', '.'); ?></td>
                    </tr>
                    <?
                    if ($descuento_pesos > 0) {
                        // print('<tr class="total">');
                        // print('<td></td><td colspan="2" style="font-size:12px;">' . utf8_encode($promocion['nombre']) . '</td><td>$ - ' . number_format($descuento_pesos, 2, ',', '.') . '</td>');
                        // print('</tr>');

                        print('<tr class="total">');
                        print('<td></td><td colspan="2">Total con descuento</td><td>$ ' . number_format($costoTotalConDescuento, $cantidad_decimales, ',', '.') . '</td>');
                        print('</tr>');
                    }
                    ?>
                </table>

                <?
                /* Si se ingresó un código de descuento y no se produjo descuento, le aviso al cliente
                  que el código es incorrecto o que ya se utilizó. */
                if ($compra['codigo_promocion'] != '' AND $descuento_pesos == 0 AND $descuento_por_producto == FALSE
						AND strtoupper($compra['codigo_promocion']) != 'WELEDAVERANO______') {
                    ?>
                    <table border="0" cellpadding="1" cellspacing="1" width="98%" style="padding-top:25px;">
                        <tr class="contenido">
                            <td colspan="2">El código de promoción <?= strtoupper($compra['codigo_promocion']) ?> no es válido o ya ha sido utilizado.
                            </td>
                        </tr>
                    </table>
                <? } ?>

                <table border="0" cellpadding="1" cellspacing="1" width="98%" style="padding-top:25px;">
                    <tr class="titulo">
                        <td colspan="2">Datos para envío</td>
                    </tr>
                    <tr class="contenido">
                        <td>Nombre</td>
                        <td><?= utf8_encode($compra['nombre']) ?></td>
                    </tr>
                    <tr class="contenido">
                        <td>Dirección</td>
                        <td><?= utf8_encode($compra['direccion']) ?></td>
                    </tr>
                    <?
                    if (CONSTANTE_PAIS == "Argentina") {
                        ?>
                        <tr class="contenido">
                            <td>C.P.</td>
                            <td><?= $compra['codigo_postal'] ?></td>
                        </tr>
                    <? } ?>
                    <tr class="contenido">
                        <?
                        if (CONSTANTE_PAIS == "Argentina") {
                            print("<td>Localidad</td>");
                            print("<td>" . utf8_encode($compra['ciudad']) . "</td>");
                        } elseif (CONSTANTE_PAIS == "Chile") {
                            print("<td>Comuna</td>");
                            print("<td>" . utf8_encode($compra['ciudad_envio']) . "</td>");
                        }
                        ?>
                    </tr>
                    <tr class="contenido">
                        <td>
                            <?
                            if (CONSTANTE_PAIS == "Argentina") {
                                print("Provincia");
                            } elseif (CONSTANTE_PAIS == "Chile") {
                                print("Región");
                            }
                            ?>
                        </td>
                        <td>
                            <?= utf8_encode($compra['provincia']) ?>
                        </td>
                    </tr>
                    <? /* Los productos envueltos para regalo nunca se implementaron. */ ?>
                      <tr class="contenido">
                      <td colspan="2">
                      Productos envueltos para regalo:
                      <? echo ($compra['para_regalo'] == 0 ? 'No':'Sí'); ?>
                      </td>
                      </tr>
                     
                </table>
                <?
                /* Solo muestro los datos de facturación si se completó Nombre,
                  Dirección, Ciudad y CP. */
                if ($compra['nombre_facturacion'] != "" AND
                        $compra['direccion_facturacion'] != "" AND
                        $compra['codigo_postal_facturacion'] != "" AND
                        $compra['ciudad_facturacion'] != "") {
                    ?>
                    <table border="0" cellpadding="1" cellspacing="1" width="98%" style="padding-top:25px;">
                        <tr class="titulo">
                            <td colspan="2">Datos de facturación</td>
                        </tr>
                        <tr class="contenido">
                            <td>Nombre</td>
                            <td><?= utf8_encode($compra['nombre_facturacion']) ?></td>
                        </tr>
                        <tr class="contenido">
                            <td>Dirección</td>
                            <td><?= utf8_encode($compra['direccion_facturacion']) ?></td>
                        </tr>
                        <tr class="contenido">
                            <td>C.P.</td>
                            <td><?= $compra['codigo_postal_facturacion'] ?></td>
                        </tr>
                        <tr class="contenido">
                            <td>Localidad</td>
                            <td>
                                <?= utf8_encode($compra['ciudad_facturacion']) ?>
                            </td>
                        </tr>
                        <tr class="contenido">
                            <td>Provincia</td>
                            <td><?= utf8_encode($compra['provincia_facturacion']) ?></td>
                        </tr>
                    </table>
                <? } ?>

                <div id="menu_control">
                    <ul>
                        <li><a class="atras" href="index.php?module=fr_carrito_end_1"></a></li>
                        <? /* <li><a class="confirmar" href="index.php?module=fr_carrito_end_3"></a></li> */ ?>
                        <li style="margin-left:10px; padding-left:10px;">
                            <input type="submit" name="submit" id="submit" value=" " style="width:113px; height:22px; border:none; background:url(/imagenes/menu_carrito/confirmar.jpg) no-repeat 100% 100%; cursor:pointer;" />
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </body>
</html>