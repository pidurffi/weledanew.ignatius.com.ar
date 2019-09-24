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

    </head>

    <body>
    
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NR2RW7L"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	
	

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
                            <? /* El envoltorio para regalo nunca se implementó. */ ?>
                              <tr class="contenido">
                              <td colspan="2">Productos envueltos para regalo: <? echo ($compra['para_regalo'] == 0 ? 'No':'Sí'); ?></td>
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

			<?php
			if ($compra['provincia']=="Misiones")
			{ ?>
			<table width="98%" cellpadding="0" cellspacing="0" style="padding-top:10px;" >
			<tr>
			<td style="font-size:14px; font-weight:normal; text-align:left;">
			Muchas gracias por su compra. Para ejecutar el pago y el envío a la provincia de Misiones,
			le sugerimos que se contacte por email a ventas@weleda.com.ar o telefónicamente al 4704-4700.
			<br />
			Nuestra intención es brindarle una asistencia personalizada para asegurarnos de que su compra llegue a destino.
			<br />Muchas gracias por comprender, estamos a su entera disposición.
			</td>
			</tr>
			</table>
				
			<? } ?>
			
            <table width="98%" cellpadding="0" cellspacing="0" style="padding-top:10px; <?= ($compra['provincia']=="Misiones" ? "display: none;" : "") ?> " >
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
							// Datos de PayU A. B. para pruebas
							/*
							$accountId = '617006';
							$merchantId = '614009';
							$apiKey = 'dwOW3Js29f6cf8hB9JnS22oGX6';
							*/
						
                            // Datos de Weleda Argentina de PayU
                            $accountId = '614143';
							$merchantId = '611184';
							$apiKey = 'yXBGGuEe0rb09hRs3n1ZV8VO2L';

                            $seller_name = 'Weleda Argentina';
                            $url = 'https://weleda.com.ar';
                            $currency = 'ARS';
                            $buyer_country = 'arg';
							
							 if ($descuento_pesos > 0) {
                                $TBK_MONTO = $costoTotalConDescuento;
                            } else {
                                $TBK_MONTO = $costoTotal;
                            }
							
							// ApiKey~merchantId~referenceCode~amount~currency.
							$signature = $apiKey."~".$merchantId."~".$compra['id']."~".$TBK_MONTO."~".$currency;
							// Le aplico MD5 a la firma.							
							$signature = md5($signature);

                            ?>
                            <form action="https://gateway.payulatam.com/ppp-web-gateway/" method="post" >
                                <!-- Sale settings -->
								<input name="merchantId"    type="hidden"  value="<?= $merchantId ?>" />
								<input name="accountId"     type="hidden"  value="<?= $accountId ?>" />
								
								<input name="referenceCode" type="hidden"  value="<?= $compra['id']; ?>" />
								<input name="description"   type="hidden"  value="<?= $compra['id']; ?>"   >
								<input name="amount"        type="hidden"  value="<?= $TBK_MONTO ?>" />
								<input name="tax"			type="hidden"  value="0" />
								<input name="taxReturnBase" type="hidden"  value="0" />
								<input name="signature"     type="hidden"  value="<?= $signature ?>"   />
								<input name="currency"     type="hidden"  value="<?= $currency ?>"   />
								
								<input name="buyerFullName"   type="hidden"  value="<?= utf8_encode($usuario['nombre']." ".$usuario['apellido']) ?>"   />
								<input name="buyerEmail"      type="hidden"  value="<?= $usuario['email'] ?>"   />
								<input name="shippingAddress" type="hidden"  value="<?= utf8_encode($compra['direccion']) ?>" />
								<input name="shippingCity"      type="hidden"  value="<?= utf8_encode($compra['ciudad'])?>" />
								<input name="shippingCountry"      type="hidden"  value="AR"   />
								<input name="telephone"      type="hidden"  value="<?= utf8_encode($usuario['telefono']) ?>"   />
								<input name="lng"      type="hidden"  value="es"   />
								<input name="responseUrl"      type="hidden"  value="<?= $url; ?>/index.php?module=fr_carrito_gracias" />
								<input name="confirmationUrl"      type="hidden"  value="<?= $url; ?>/carrito/IPN_PayU.php" />
								<input name="algorithmSignature"   type="hidden"  value="MD5" />
								
								<? /* Variable para poder utilizar tarjetas de crédito de pruebas, los valores pueden ser 1 ó 0. */ ?>
								<input name="test" type="hidden"  value="0" />
							
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