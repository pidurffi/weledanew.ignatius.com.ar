<html>
    <style>
        p {text-align:center;}
    </style>
    <head>
        <title>Weleda</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    </head>
    <body style="font-family:Arial,Helvetica,'Neo Sans',NeoSans,sans-serif; font-size:10px;">
        <p>
            <?
            if (CONSTANTE_PAIS == "Argentina")
                print('<img src="http://weleda.com.ar/imagenes/estructura/carrito/encabezado_carrito.jpg" />');
            elseif (CONSTANTE_PAIS == "Chile")
                print('<img src="http://weleda.cl/imagenes/estructura/carrito/encabezado_carrito.jpg" />');
            ?>
        </p>
        <p>
            Estimado/a <?= $compra['nombre_comprador'] . " " . $compra['apellido_comprador']; ?>:
        </p>
        <p>
            Su compra ha sido efectuada con éxito.
        </p>
        <p>
            <strong>Pedido número <?= $compra['id'] ?></strong>.
        </p>
        <table border="0" cellpadding="0" cellspacing="0" width="98%">
            <tr>
                <td align="center">
                    <table border="0" cellpadding="4" cellspacing="1">
                        <tr style="background-color:#d3bf96;color:#FFFFFF;height:27px;">
                            <td>Descripci&oacute;n</td>
                            <td align="center">Cantidad</td>
                            <td align="center">Precio</td>
                            <td align="center">Importe</td>
                        </tr>
                        <? $subtotal = 0; ?>
                        <? while ($elemento = mysql_fetch_array($elements)) {
                            ?>
                            <tr style="background-color:#d6e0f9;height:27px;color:#111111;">
                                <td ><?= $elemento['nombreweleda'] ?></td>
                                <td style="text-align:center; padding-left: 5px;"><?= $elemento['cantidad'] ?></td>
                                <td style="text-align:center; padding-left: 5px;">$ <?= number_format($elemento['precio'] / $elemento['cantidad'], 2, ',', '.'); ?></td>
                                <td style="text-align:center; padding-left: 5px;">$ <?= number_format($elemento['precio'], 2, ',', '.'); ?></td>
                            </tr>
                            <? $subtotal += $elemento['precio'] ?>
                        <? } ?>
                        <tr style="height:30px;">
                            <td>&nbsp;</td>
                            <td colspan="2" style="padding-left:5px;background-color:#bfc8de;color:#FFFFFF;">Costo de la compra</td>
                            <td style="background-color:#f0f0f0;color:#6699cc;text-align:center;">$ <?= number_format($subtotal, 2, ',', '.'); ?></td>
                        </tr>
                        <tr style="height:30px;">
                            <td>&nbsp;</td>
                            <td colspan="2" style="padding-left:5px;background-color:#bfc8de;color:#FFFFFF;">Costo del env&iacute;o</td>
                            <td align="right" style="background-color:#f0f0f0;color:#6699cc;text-align:center;">$ <?= number_format($compra['costo_envio'], 2, ',', '.'); ?></td>
                        </tr>
                        <tr style="height:30px;">
                            <td>&nbsp;</td>
                            <td colspan="2" style="padding-left:5px;background-color:#bfc8de;color:#FFFFFF;">Demora del env&iacute;o</td>
                            <td align="center" style="background-color:#f0f0f0;color:#6699cc;text-align:center;">
                                <? /* =$compra['dias_envio'];?> d&iacute;a<?=($compra['dias_envio']>1)?'s':''; */ ?>
                                Dentro de los pr&oacute;ximos 5 d&iacute;as
                            </td>
                        </tr>
                        <tr style="color:#6085af;font-size:16px;">
                            <td>&nbsp;</td>
                            <td colspan="2" style="padding-left:5px;background-color:#bfc8de;color:#FFFFFF;">Importe total</td>
                            <td align="center">$ <?= number_format($compra['costo_total'], 2, ',', '.'); ?></td>
                        </tr>
                        <?
                        if ($compra['descuento_pesos'] > 0) {

                            print('<tr style="text-align:center;color:#6085af;"');
                            print('<td></td><td colspan="2">' . utf8_encode($compra['$nombre_promocion']) . '</td><td>$ - ' . number_format($compra['descuento_pesos'], 2, ',', '.') . '</td>');
                            print('</tr>');

                            print('<tr style="text-align:center;color:#6085af;"');
                            print('<td></td><td colspan="2">Total con descuento</td><td>$ ' . number_format($compra['costo_total'], 2, ',', '.') . '</td>');
                            print('</tr>');
                        }
                        ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <br />
                    <table border="0" cellpadding="4" cellspacing="1">
                        <tr style="background-color:#d3bf96;color:#FFFFFF;height:27px;">
                            <td colspan="2" align="center">Datos de env&iacute;o</td>
                        </tr>
                        <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                            <td>Nombre</td>
                            <td style="text-align:left; padding-left:5px;"><?= $compra['nombre'] ?></td>
                        </tr>
                        <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                            <td>Direcci&oacute;n de env&iacute;o</td>
                            <td style="text-align:left; padding-left:5px;"><?= $compra['direccion'] ?></td>
                        </tr>
                        <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                            <td>Ciudad</td>
                            <td style="text-align:left; padding-left:5px;"><?= $compra['ciudad'] ?></td>
                        </tr>
                        <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                            <td>Provincia</td>
                            <td style="text-align:left; padding-left:5px;"><?= $compra['provincia'] ?></td>
                        </tr>
                        <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                            <td>C&oacute;digo postal</td>
                            <td style="text-align:left; padding-left:5px;"><?= $compra['codpostal'] ?></td>
                        </tr>
                        <? /*
                          <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                          <td colspan="2">
                          Productos envueltos para regalo: <? echo ($compra['para_regalo'] == 0 ? 'No' : 'Sí'); ?>
                          </td>
                          </tr>
                         */ ?>
                    </table>
                    <?
                    /* Solo muestro los datos de facturación si se completó Nombre,
                      Dirección, Ciudad y CP. */
                    ?>
                    <? /*
                      if ($compra['nombre_facturacion'] != "" AND
                      $compra['direccion_facturacion'] != "" AND
                      $compra['codigo_postal_facturacion'] != "" AND
                      $compra['ciudad_facturacion'] != "") {
                      ?>
                      <table border="0" cellpadding="4" cellspacing="1">
                      <tr style="background-color:#d3bf96;color:#FFFFFF;height:27px;">
                      <td colspan="2" align="center">Datos de facturación</td>
                      </tr>
                      <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                      <td>Nombre</td>
                      <td style="text-align:left; padding-left:5px;"><?= $compra['nombre_facturacion'] ?></td>
                      </tr>
                      <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                      <td>Dirección</td>
                      <td style="text-align:left; padding-left:5px;"><?= $compra['direccion_facturacion'] ?></td>
                      </tr>
                      <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                      <td>C.P.</td>
                      <td style="text-align:left; padding-left:5px;"><?= $compra['codpostal_facturacion'] ?></td>
                      </tr>
                      <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                      <td>Localidad</td>
                      <td style="text-align:left; padding-left:5px;"><?= $compra['ciudad_facturacion'] ?></td>
                      </tr>
                      <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                      <td>Provincia</td>
                      <td style="text-align:left; padding-left:5px;"><?= $compra['provincia_facturacion'] ?></td>
                      </tr>
                      </table>
                      <? } ?>
                     */ ?>
                </td>
            </tr>
        </table>
        <br />
        <p>Gracias por elegir nuestra exclusiva línea de Cosmética Natural Weleda.</p>
        <?
        if (CONSTANTE_PAIS == "Argentina") {
            print('<p style="font-size:10px;">Ramallo 2566, C1429DUR, Ciudad Autónoma de Buenos Aires, Argentina. Tel. 011-4704-4700. Fax. 011-4702-1961<br />
            Horario de atención: lunes a viernes de 9 a 18 hs. ventas@weleda.com.ar / www.weleda.com.ar
            </p>');
        } elseif (CONSTANTE_PAIS == "Chile") {
            print('<p style="font-size:10px;">XXX, Santiago, Chile. Tel. XXX<br />
            Horario de atención: lunes a viernes de 9 a 18 hs. ventas@weleda.cl / www.weleda.cl
            </p>');
        }
        ?>
    </body>
</html>