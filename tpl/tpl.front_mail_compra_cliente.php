<html>
<head>
    <title>Weleda Argentina</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body title="Weleda Argentina" style="font-family:'Neo Sans',NeoSans,Arial,Helvetica,sans-serif; font-size:10px;">

<p>
    Estimado/a <?=$usuario['nombre']." ".$usuario['apellido'];?>:
</p>

<p>
    Su compra ha sido efectuada con éxito.
</p>
<p>
    <strong>Pedido número <?=$compra['id']?></strong>.
</p>

<table border="0" cellpadding="0" cellspacing="0" width="98%">
    <tr>
        <td align="center">
            <table border="0" cellpadding="4" cellspacing="1">
                <tr style="background-color:#e0380b;color:#FFFFFF;height:27px;">
                    <td>Descripci&oacute;n</td>
                    <td align="center">Cantidad</td>
                    <td align="center">Precio</td>
                    <td align="center">Importe</td>
                </tr>
                <? $subtotal = 0; ?>
                <? foreach($elements as $elemento) { ?>
                <tr style="background-color:#d6e0f9;height:27px;color:#111111;">
                    <td ><?=$elemento['object']['nombreweleda']?></td>
                    <td style="text-align:center; padding-left: 5px;"><?=$elemento['count'] ?></td>
                    <td style="text-align:center; padding-left: 5px;">$ <?=number_format($elemento['object']['precio'], 2, ',', '');?></td>
                    <td style="text-align:center; padding-left: 5px;">$ <?=number_format($elemento['object']['precio']*$elemento['count'], 2, ',', '');?></td>
                </tr>
                <? $subtotal += $elemento['object']['precio']*$elemento['count'] ?>
                <? } ?>

                <tr style="height:30px;">
                    <td>&nbsp;</td>
                    <td colspan="2" style="padding-left:5px;background-color:#6085af;color:#FFFFFF;">Costo de la compra</td>
                    <td style="background-color:#f0f0f0;color:#6699cc;text-align:center;">$ <?=number_format($subtotal, 2, ',', '');?></td>
                </tr>

                <tr style="height:30px;">
                    <td>&nbsp;</td>
                    <td colspan="2" style="padding-left:5px;background-color:#6085af;color:#FFFFFF;">Costo del env&iacute;o</td>
                    <td align="right" style="background-color:#f0f0f0;color:#6699cc;text-align:center;">$ <?=number_format($costoEnvio, 2, ',', ''); ?></td>
                </tr>
                <tr style="height:30px;">
                    <td>&nbsp;</td>
                    <td colspan="2" style="padding-left:5px;background-color:#6085af;color:#FFFFFF;">Demora del env&iacute;o</td>
                    <td align="center" style="background-color:#f0f0f0;color:#6699cc;text-align:center;"><?=$diasTotal;?> d&iacute;a<?=($diasTotal>1)?'s':'';?></td>
                </tr>

                <tr style="color:#6085af;font-size:16px;">
                    <td>&nbsp;</td>
                    <td colspan="2" style="padding-left:5px;background-color:#6085af;color:#FFFFFF;">Importe total</td>
                    <td align="center">$ <?=number_format($costoTotal, 2, ',', '');?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
            <br />
            <table border="0" cellpadding="4" cellspacing="1">
                <tr style="background-color:#e0380b;color:#FFFFFF;height:27px;">
                    <td colspan="2" align="center">Datos de env&iacute;o</td>
                </tr>
                <tr style="background-color:#d6e0f9;height:27px;color:#111111;">
                    <td>Nombre</td>
                    <td style="text-align:left; padding-left:5px;"><?=$compra['nombre'] ?></td>
                </tr>
                <tr style="background-color:#d6e0f9;height:27px;color:#111111;">
                    <td>Direcci&oacute;n de env&iacute;o</td>
                    <td style="text-align:left; padding-left:5px;"><?=$compra['direccion'] ?></td>
                </tr>
                <tr style="background-color:#d6e0f9;height:27px;color:#111111;">
                    <td>Ciudad</td>
                    <td style="text-align:left; padding-left:5px;"><?=$compra['ciudad'] ?></td>
                </tr>
                <tr style="background-color:#d6e0f9;height:27px;color:#111111;">
                    <td>Provincia</td>
                    <td style="text-align:left; padding-left:5px;"><?=$compra['provincia'] ?></td>
                </tr>
                <tr style="background-color:#d6e0f9;height:27px;color:#111111;">
                    <td>C&oacute;digo postal</td>
                    <td style="text-align:left; padding-left:5px;"><?=$compra['codigo_postal'] ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<br />

<p>Gracias por elegir nuestra exclusiva línea de Cosmética Natural Weleda.</p>

<p style="font-size:10px;">Ramallo 2566, C1429DUR, Cuidad Autónoma de Buenos Aires, Argentina. Tel. 011-4704-4700. Fax. 011-4702-1961<br />
Horario de atención: lunes a viernes de 9 a 18 hs. ventas@weleda.com.ar / www.weleda.com.ar
</p>


</body>
</html>