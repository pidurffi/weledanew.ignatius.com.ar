<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?
        // <title>...</title>
        if (CONSTANTE_PAIS == "Argentina")
            print("<title>Weleda e-shop paso 3</title>");
        elseif (CONSTANTE_PAIS == "Chile")
            print("<title>Weleda e-shop paso 3</title>");

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

            div#contenedor {
                padding:8px 22px 0 22px;
                width:770px;widt\h:726px;
                text-align: center;
            }

            h3 {
                text-align:left;
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

            table tr.contenido td {text-align:left; padding-left: 5px;}

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

            table.datos td {font-size:18px;}

            table.datos td.dato_usuario {font-size:14px; text-align:left; padding-left:5px;}

            table.datos tr.titulo {font-size:18px;}

            hr {margin-top:20px;}

            div.texto {text-align:center;}

            div.texto h4 {
                font-family:Arial, Helvetica, sans-serif;
                color:#6085af;
                font-size:14px;
            }

            div#encabezado_carrito {
                width:760px;
                height:120px;
                background-image:url('imagenes/estructura/carrito/encabezado_carrito.jpg');
                background-position: center;
                background-repeat: no-repeat;
            }
        </style>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

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

    <body>
        <div id="encabezado_carrito"></div>
        <div id="contenedor" class="clearfix">
            <?
            if (!empty($errores))
                die("Imposible grabar compra. Pruebe luego");
            ?>
            <table width="98%" cellpadding="2" cellspacing="0">
                <tr>
                    <? /*
                      <td height="58" width="65" align="left"><img src="/imagenes/estructura/carrito/logoweledatop.jpg" /></td>
                     */ ?>
                    <td align="left" valign="middle">
                        <h3>Confirmaci&oacute;n del pedido N&ordm; <?= $compra['id'] ?></h3>
                    </td>
                    <td align="right" valign="middle">
                        <a href="javascript:print()">Imprimir</a>
                    </td>
                </tr>
            </table>
            <table border="0" cellpadding="2" cellspacing="1" width="98%">
                <tr class="titulo">
                    <td>Descripci&oacute;n</td>
                    <td>Cantidad</td>
                    <td>Precio</td>
                    <td>Importe</td>
                </tr>
                <? $subtotal = 0; ?>
                <? foreach ($elementos as $elemento) {
                    ?>
                    <tr class="contenido">
                        <td ><?= utf8_encode($elemento['object']['nombreweleda']) ?></td>
                        <td style="text-align:center;"><?= $elemento['count'] ?></td>
                        <td style="text-align:center;">$ <?= number_format($elemento['object']['precio'], $cantidad_decimales, ',', '.'); ?></td>
                        <td style="text-align:center;">$ <?= number_format($elemento['object']['precio'] * $elemento['count'], $cantidad_decimales, ',', '.'); ?></td>
                    </tr>
                    <? $subtotal += $elemento['object']['precio'] * $elemento['count'] ?>
                <? } ?>

                <tr class="costo">
                    <td></td>
                    <td class="texto" colspan="2">Costo de la compra</td>
                    <td class="importe">$ <?= number_format($subtotal, $cantidad_decimales, ',', '.'); ?></td>
                </tr>
                <?
                if ($descuento_pesos > 0) {
                    print('<tr class="total">');
                    print('<td></td><td colspan="2" style="font-size:12px;">' . utf8_encode($nombre_promocion) . '</td><td>$ - ' . number_format($descuento_pesos, $cantidad_decimales, ',', '.') . '</td>');
                    print('</tr>');
                }
                ?>

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
                    // print('<td></td><td colspan="2" style="font-size:12px;">' . utf8_encode($nombre_promocion) . '</td><td>$ - ' . number_format($descuento_pesos, 2, ',', '.') . '</td>');
                    // print('</tr>');

                    print('<tr class="total">');
                    print('<td></td><td colspan="2">Total con descuento</td><td>$ ' . number_format($costoTotalConDescuento, $cantidad_decimales, ',', '.') . '</td>');
                    print('</tr>');
                }
                ?>
            </table>

            <table width="98%" cellpadding="1" cellspacing="0" style="padding-top:15px;">
                <tr>
                    <td valign="top" align="center">
                        <table border="0" cellpadding="4" cellspacing="1" width="100%">
                            <tr class="titulo">
                                <td colspan="2">Informaci&oacute;n del Cliente</td>
                            </tr>
                            <tr class="contenido">
                                <td>Nombre</td><td class="dato_usuario"><?= utf8_encode($usuario['nombre']) ?></td>
                            </tr>
                            <tr class="contenido">
                                <td>Apellido</td><td class="dato_usuario"><?= utf8_encode($usuario['apellido']) ?></td>
                            </tr>
                            <tr class="contenido">
                                <td>Email</td><td class="dato_usuario"><?= $usuario['email'] ?></td>
                            </tr>
                            <tr class="contenido">
                                <td>Tel&eacute;fono</td><td class="dato_usuario"><?= utf8_encode($usuario['telefono']) ?></td>
                            </tr>
                        </table>
                    </td>

                    <td valign="top" align="center">
                        <table border="0" cellpadding="4" cellspacing="1" width="100%">
                            <tr class="titulo">
                                <td colspan="2">Informaci&oacute;n de la forma de env&iacute;o</td>
                            </tr>
                            <tr class="contenido">
                                <td>Nombre</td><td class="dato_usuario"><?= utf8_encode($compra['nombre']) ?></td>
                            </tr>
                            <tr class="contenido">
                                <td>Direcci&oacute;n<br />de env&iacute;o</td><td class="dato_usuario"><?= utf8_encode($compra['direccion']) ?></td>
                            </tr>
                            <tr class="contenido">
                                <td>
                                    <?
                                    if (CONSTANTE_PAIS == "Argentina") {
                                        print("Localidad");
                                    } elseif (CONSTANTE_PAIS == "Chile") {
                                        print("Comuna");
                                    }
                                    ?>
                                </td>
                                <td class="dato_usuario">
                                    <?
                                    if (CONSTANTE_PAIS == "Argentina") {
                                        print(utf8_encode($compra['ciudad']));
                                    } elseif (CONSTANTE_PAIS == "Chile") {
                                        print(utf8_encode($compra['ciudad_envio']));
                                    }
                                    ?>
                                </td>
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
                                <td class="dato_usuario"><?= utf8_encode($compra['provincia']) ?></td>
                            </tr>
                            <?
                            if (CONSTANTE_PAIS == "Argentina") {
                                ?>
                                <tr class="contenido">
                                    <td>C&oacute;digo postal</td><td class="dato_usuario"><?= $compra['codigo_postal'] ?></td>
                                </tr>
                            <? } ?>
                            <? /* El envoltorio para regalo nunca se implementó.
                              <tr class="contenido">
                              <td colspan="2">Productos envueltos para regalo: <? echo ($compra['para_regalo'] == 0 ? 'No':'Sí'); ?></td>
                              </tr>
                             */ ?>
                        </table>
                        <?
                        /* Solo muestro los datos de facturación si se completó Nombre,
                          Dirección, Ciudad y CP. */
                        if ($compra['nombre_facturacion'] != "" AND
                                $compra['direccion_facturacion'] != "" AND
                                $compra['codigo_postal_facturacion'] != "" AND
                                $compra['ciudad_facturacion'] != "") {
                            ?>
                            <table border="0" cellpadding="4" cellspacing="1" width="100%">
                                <tr class="titulo">
                                    <td colspan="2">Datos de facturación</td>
                                </tr>
                                <tr class="contenido">
                                    <td>Nombre</td><td class="dato_usuario"><?= utf8_encode($compra['nombre_facturacion']) ?></td>
                                </tr>
                                <tr class="contenido">
                                    <td>Direcci&oacute;n<br />de env&iacute;o</td><td class="dato_usuario"><?= utf8_encode($compra['direccion_facturacion']) ?></td>
                                </tr>
                                <tr class="contenido">
                                    <td>Localidad</td><td class="dato_usuario"><?= utf8_encode($compra['ciudad_facturacion']) ?></td>
                                </tr>
                                <tr class="contenido">
                                    <td>Provincia</td><td class="dato_usuario"><?= utf8_encode($compra['provincia_facturacion']) ?></td>
                                </tr>
                                <tr class="contenido">
                                    <td>C&oacute;digo postal</td><td class="dato_usuario"><?= $compra['codigo_postal_facturacion'] ?></td>
                                </tr>
                            </table>
                        <? } ?>
                    </td>
                </tr>
            </table>

            <table width="98%" cellpadding="0" cellspacing="0" style="padding-top:10px;">
                <tr>
                    <td align="left" valign="top" style="padding-right:30px; font-weight:normal;" width="50%">
                        Para concretar la compra, haga clic en el bot&oacute;n "Pagar" de la derecha.<br />
                        <?
                        if (CONSTANTE_PAIS == "Argentina") {
                            print("All&iacute; podr&aacute; elegir el tipo de pago (tarjeta de cr&eacute;dito, Pago F&aacute;cil, Rapipago, transferencia bancaria).");
                            print("<br />Weleda utiliza los servicios de Dinero Mail.");
                            print("<br/>Toda la transacci&oacute;n se encuentra encriptada para su seguridad.");
                        } elseif (CONSTANTE_PAIS == "Chile") {
                            print("All&iacute; podr&aacute; elegir el tipo de pago (tarjeta de cr&eacute;dito, SeviPag, transferencia bancaria).");
                        }
                        ?>
                    </td>
                    <td align="center" valign="top" width="50%">
                        <?
                        /* BOT�N DE COMPRAS DE DINERO MAIL.
                          El c�digo de Adri�n es 1022972. Se pone donde dice E_Comercio.
                          Cuando el carrito est� en producci�n, hay que cambiar el c�digo
                          por el del usuario de Weleda de DineroMail, que es 1023416.
                         */
                        /* Para ver los c�digos, ver manual de integraci�n (integracion dinero mail.zip,
                         * Integracion_es.pdf) */
                        if (CONSTANTE_PAIS == "Argentina") {
                            // N�mero de cuenta en DineroMail Weleda Argentina
                            $nrocuenta = '1023416';
                            $seller_name = 'Weleda Argentina';
                            $url = 'http://weleda.com.ar';
                            $currency = 'ars';
                            $buyer_country = 'arg';
							
							
							if ($descuento_pesos > 0) {
                                $TBK_MONTO = $costoTotalConDescuento;
                            } else {
                                $TBK_MONTO = $costoTotal;
                            }
							
                            // N�mero de cuenta en DineroMail ADRI�N Argentina
                            //$nrocuenta = '1022972';
                            ?>
                            <form action="https://checkout.dineromail.com/CheckOut" method="post" >
                                <!-- Sale settings -->
                                <input type="hidden" name="tool" value="button" />
                                <input type="hidden" name="merchant" value="<?= $nrocuenta ?>" />
                                <input type="hidden" name="country_id" value="1" />
                                <input type="hidden" name="seller_name" value="<?= $seller_name; ?> - <?= "Pedido número " . $compra['id'] ?>" />
                                <input type="hidden" name="language" value="es" />
                                <input type="hidden" name="transaction_id" value="<?= $compra['id']; ?>" />
                                <input type="hidden" name="currency" value="<?= $currency; ?>" />
                                <input type="hidden" name="ok_url" value="<?= $url; ?>/index.php?module=fr_carrito_gracias" />
                                <input type="hidden" name="error_url" value="" />
                                <input type="hidden" name="pending_url" value="<?= $url; ?>/index.php?module=fr_carrito_gracias" />
                                <input type="hidden" name="buyer_message" value="1" />
                                <input type="hidden" name="header_image" value="https://static.e-junkie.com/sslpic/40864.412029fdfd147b33cdefdf79b818f3dd.jpg" />
                                <input type="hidden" name="header_width" value="1" />
                                <input type="hidden" name="change_quantity" value="0" />
                                <input type="hidden" name="display_shipping" value="0" />
                                <input type="hidden" name="display_additional_charge" value="0" /> <!-- Cargos adicionales -->
                                <input type="hidden" name="expanded_step_PM" value="1" /> <!-- Medio de pago desplegado -->
                                <input type="hidden" name="expanded_step_AD" value="0" /> <!-- Mensaje al vendedor expandido -->
                                <input type="hidden" name="expanded_step_SC" value="0" />
                                <input type="hidden" name="expanded_sale_detail" value="1" />
								
								<? /* cargo el monto total como un ítem */ ?>
								<input type="hidden" name="item_name_1" value="Monto total" />
								<input type="hidden" name="item_ammount_1" value="<?= number_format($TBK_MONTO, 2, '.', '') ?>" />
								<input type="hidden" name="item_quantity_1" value="1" />
								<input type="hidden" name="item_currency_1" value="<?= $currency; ?>" />

                                <!-- Paymet Method -->
                                <input type="hidden" name="payment_method_available" value="all" />

                                <!-- Items -->
                                <?
								/*
                                $item = 1;
                                foreach ($elementos as $elemento) {
                                    ?>
                                    <input type="hidden" name="item_name_<?= $item; ?>" value="<?= utf8_encode($elemento['object']['nombreweleda']); ?>" />
                                    <input type="hidden" name="item_code_<?= $item; ?>" value="<?= $elemento['object']['codigo'] ?>" />
                                    <input type="hidden" name="item_quantity_<?= $item; ?>" value="<?= $elemento['count'] ?>" />
                                    <input type="hidden" name="item_ammount_<?= $item; ?>" value="<?= number_format($elemento['object']['precio'] * $porcentaje_precio_final, 2, '.', ''); ?>" />
                                    <input type="hidden" name="item_currency_<?= $item; ?>" value="<?= $currency; ?>" />
                                    <input type="hidden" name="shipping_type_<?= $item; ?>" value="0" />
                                    <input type="hidden" name="weight_<?= $item; ?>" value="kg" />
                                    <input type="hidden" name="item_weight_<?= $item; ?>" value="<?= $elemento['object']['peso'] / 1000 ?>" />
                                    <input type="hidden" name="shipping_currency_<?= $item; ?>" value="<?= $currency; ?>" />
                                    <?
                                    $item++;
                                }
								*/
                                ?>

                                <!-- Agrego el costo del envío como un producto más, si es mayor a cero. -->
								<? /* if($costoEnvio > 0) { ?>
									<input type="hidden" name="item_name_<?= $item; ?>" value="<?= 'Costo de envío' ?>" />
									<input type="hidden" name="item_code_<?= $item; ?>" value="<?= $codigoEnvio ?>" />
									<input type="hidden" name="item_quantity_<?= $item; ?>" value="1" />
									<input type="hidden" name="item_ammount_<?= $item; ?>" value="<?= number_format($costoEnvio, 2, '.', ''); ?>" />
									<input type="hidden" name="item_currency_<?= $item; ?>" value="<?= $currency; ?>" />
									<input type="hidden" name="shipping_type_<?= $item; ?>" value="0" />
									<input type="hidden" name="weight_<?= $item; ?>" value="kg" />
									<input type="hidden" name="item_weight_<?= $item; ?>" value="0" />
									<input type="hidden" name="shipping_currency_<?= $item; ?>" value="<?= $currency; ?>" />
								<? } */ ?>

                                <!-- Buyer info -->
                                <input type="hidden" name="buyer_name" value="<?= utf8_encode($usuario['nombre']) ?>" />
                                <input type="hidden" name="buyer_lastname" value="<?= utf8_encode($usuario['apellido']) ?>" />
                                <input type="hidden" name="buyer_email" value="<?= $usuario['email'] ?>" />
                                <input type="hidden" name="buyer_phone" value="<?= $usuario['telefono'] ?>" />
                                <input type="hidden" name="buyer_zip_code" value="<?= $compra['codigo_postal'] ?>" />
                                <input type="hidden" name="buyer_street" value="<?= utf8_encode($compra['direccion']) ?>" />
                                <input type="hidden" name="buyer_city" value="<?= utf8_encode($compra['ciudad']) ?>" />
                                <input type="hidden" name="buyer_state" value="<?= utf8_encode($compra['provincia']) ?>" />
                                <input type="hidden" name="buyer_country" value="<?= $buyer_country; ?>" />

                                <input type="submit" name="submit" id="submit" value=" " style="width:250px; height:70px; border:none; background:url(/imagenes/menu_carrito/DineroMail_pagar-medios_c.gif) no-repeat 100% 100%; cursor:pointer;" />
                            </form>
                            <?
                        } elseif (CONSTANTE_PAIS == "Chile") {
                            if ($descuento_pesos > 0) {
                                $TBK_MONTO = $costoTotalConDescuento;
                            } else {
                                $TBK_MONTO = $costoTotal;
                            }
                            //$TBK_ORDEN_COMPRA = date("Ymdhis"); 
                            $TBK_ORDEN_COMPRA = $compra['id'];
                            $TBK_ID_SESION = date("Ymdhis");
                            /* ***************** CONFIGURACION ****************** */
                            $TBK_TIPO_TRANSACCION = "TR_NORMAL";
                            $URL_SERVIDOR = $_SERVER['HTTP_HOST'];
                            $TBK_URL_EXITO = "http://$URL_SERVIDOR/index.php?module=fr_carrito_gracias";
                            $TBK_URL_FRACASO = "http://$URL_SERVIDOR/index.php?module=fr_carrito_fracaso";
                            $url_cgi = "http://$URL_SERVIDOR/cgi-bin/tbk_bp_pago.cgi";
                            //Archivos de datos para uso de pagina de cierre
                            $myPath = APPLICATION_ROOT . "/cgi-bin/log/dato$TBK_ID_SESION.log";
                            /* ***************** FIN CONFIGURACION **************** */
                            //formato Moneda  
                            $partesMonto = split(",", $TBK_MONTO);
                            $TBK_MONTO = $partesMonto[0] . "00";
                            //Grabado de datos en archivo de transaccion  
                            $fic = fopen($myPath, "w+");
                            $linea = "$TBK_MONTO;$TBK_ORDEN_COMPRA";
                            fwrite($fic, $linea);
                            fclose($fic);
                            ?>
                            <form action="<?php echo $url_cgi; ?>" name="frm" method="post">
                                <input type="hidden" name="TBK_TIPO_TRANSACCION" value="<?php echo $TBK_TIPO_TRANSACCION; ?>"/>
                                <input type="hidden" name="TBK_MONTO" value="<?php echo $TBK_MONTO; ?>"/>
                                <input type="hidden" name="TBK_ORDEN_COMPRA" value="<?php echo $TBK_ORDEN_COMPRA; ?>"/>
                                <input type="hidden" name="TBK_ID_SESION" value="<?php echo $TBK_ID_SESION; ?>"/>
                                <input type="hidden" name="TBK_URL_EXITO" value="<?php echo $TBK_URL_EXITO; ?>"/>
                                <input type="hidden" name="TBK_URL_FRACASO" value="<?php echo $TBK_URL_FRACASO; ?>"/>
                                <input type="submit" name="submit" id="submit" value=" " style="width:250px; height:200px; border:none; background:url(/imagenes/menu_carrito/webpay-pagar.jpg) no-repeat 100% 100%; cursor:pointer;" />
                            </form>
                            <?
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>

        <?
        /* Armo el link para pagar por mail, en caso de que el cliente cierre la ventana y no pague. */
        /*
          $link = "https://argentina.dineromail.com/Shop/Shop_Ingreso.asp?";
          $link.= "NombreItem=Weleda+Argentina+-+Pedido+".utf8_encode("número")."+".$compra['id']."&TipoMoneda=1&";
          $link.= "PrecioItem=".$costoTotal."&";
          $link.= "NroItem=".$compra['id']."&";
          $link.= "image_url=http%3A%2F%2Fwww.weleda.com.ar%2Fimagenes%2Festructura%2Fcarrito%2Fencabezado_carrito_mini.jpg&";
          $link.= "Mensaje=1&";
          $link.= "E_Comercio=".$nrocuenta."&";
          $link.= "Carrito=Weleda+Argentina&";
          $link.= "trx_id=".$compra['id']."&";
          $link.= "transaction_id=".$compra['id']."&";
          $link.= "DireccionEnvio=0&Mensaje=1";
         */
        // Este link se debe copiar en un campo nuevo en la base.
        // Luego se le envía al cliente en caso de que el campo dinero_mail_estado_operacion est� en 0.
        ?>
    </body>
</html>