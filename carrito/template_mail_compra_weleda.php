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
            <strong>Se ha realizado el pago del pedido n&uacute;mero <?= $compra['id']; ?></strong>.
            <br />
            <?
            if (CONSTANTE_PAIS == "Argentina")
                print('http://www.weleda.com.ar/admin/index.php?module=pedido_detalle&id=' . $compra['id']);
            elseif (CONSTANTE_PAIS == "Chile")
                print('http://www.weleda.cl/admin/index.php?module=pedido_detalle&id=' . $compra['id']);
            ?>
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
                                <td ><?= utf8_encode($elemento['nombreweleda']) ?></td>
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
                            <td style="text-align:left; padding-left:5px;"><?= utf8_encode($compra['nombre']) ?></td>
                        </tr>
                        <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                            <td>Direcci&oacute;n de env&iacute;o</td>
                            <td style="text-align:left; padding-left:5px;"><?= utf8_encode($compra['direccion']) ?></td>
                        </tr>
                        <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                            <?
                            if (CONSTANTE_PAIS == "Argentina") {
                                print('<td>Ciudad</td>');
                                print('<td style="text-align:left; padding-left:5px;">' . utf8_encode($compra['ciudad']) . '</td>');
                            } elseif (CONSTANTE_PAIS == "Chile") {
                                print('<td>Comuna</td>');
                                print('<td style="text-align:left; padding-left:5px;">' . utf8_encode($compra['ciudad']) . '</td>');
                            }
                            ?>
                        </tr>
                        <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                            <?
                            if (CONSTANTE_PAIS == "Argentina") {
                                print('<td>Provincia</td>');
                                print('<td style="text-align:left; padding-left:5px;">' . utf8_encode($compra['provincia']) . '</td>');
                            } elseif (CONSTANTE_PAIS == "Chile") {
                                print('<td>Regi&oacute;n</td>');
                                print('<td style="text-align:left; padding-left:5px;">' . utf8_encode($compra['provincia']) . '</td>');
                            }
                            ?>
                        </tr>
                        <? if (CONSTANTE_PAIS == "Argentina") {
                            ?>
                            <tr style="background-color:#bfc8de;height:27px;color:#111111;">
                                <td>C&oacute;digo postal</td>
                                <td style="text-align:left; padding-left:5px;"><?= $compra['codpostal'] ?></td>
                            </tr>
                        <? } ?>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>