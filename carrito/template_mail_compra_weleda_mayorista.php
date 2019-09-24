<html>
    <style>
        p {text-align:center;}
    </style>
    <head>
        <title>Weleda</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body style="font-family:Arial,Helvetica,'Neo Sans',NeoSans,sans-serif; font-size:10px;">
        <p>
            <strong>Se ha realizado el pedido n&uacute;mero <?= $compra['id']; ?></strong>.
		</p>
		<p>
            <strong>Cliente:</strong> <?= $compra['nombre_comprador'] . " " . $compra['apellido_comprador']; ?>
        </p>
		<p>
            <strong>Nro. de cliente:</strong> <?= $compra['codigo_cliente']; ?>
        </p>
		<p>
            <strong>Correo electrónico:</strong> <?= $compra['email_comprador']; ?>
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
                        <?
                        while ($elemento = mysqli_fetch_assoc($elements)) {
                            // No me fijo el tipo de cliente ya que en la tabla compra_producto
                            // se graba el precio correcto (según sea cliente mayorista o minorista).
                            $precio = $elemento['precio'];
                            ?>
                            <tr style="background-color:#d6e0f9;height:27px;color:#111111;">
                                <td ><?= utf8_encode($elemento['nombreweleda']) ?></td>
                                <td style="text-align:center; padding-left: 5px;"><?= $elemento['cantidad'] ?></td>
                                <td style="text-align:center; padding-left: 5px;">$ <?= number_format($precio / $elemento['cantidad'], 2, ',', '.'); ?></td>
                                <td style="text-align:center; padding-left: 5px;">$ <?= number_format($precio, 2, ',', '.'); ?></td>
                            </tr>
                            <? $subtotal += $precio; ?>
                        <? } ?>
                            
                        <? if ($compra['descuento_pesos'] > 0) { ?>
                            <tr style="height:30px;">
                                <td>&nbsp;</td>
                                <td colspan="2" style="padding-left:5px;background-color:#bfc8de;color:#FFFFFF;">Costo de la compra</td>
                                <td style="background-color:#f0f0f0;color:#6699cc;text-align:center;">$ <?= number_format($subtotal, 2, ',', '.'); ?></td>
                            </tr>
                        <? } ?>

                        <? if ($compra['descuento_pesos'] == 0) { ?>
                            <tr style="color:#6085af;font-size:16px;">
                                <td>&nbsp;</td>
                                <td colspan="2" style="padding-left:5px;background-color:#bfc8de;color:#FFFFFF;">Importe total</td>
                                <td>$ <?= number_format($compra['costo_total'], 2, ',', '.'); ?></td>
                            </tr>
                        <? } ?>

                        <? if ($compra['descuento_pesos'] > 0) { ?>
                            <tr style="color:#6085af;">
                                <td></td>
                                <td colspan="2" style="padding-left:5px;background-color:#bfc8de;color:#FFFFFF;"><?= utf8_encode($compra['nombre_promocion']) ?></td>
                                <td>$ - <?= number_format($compra['descuento_pesos'], 2, ',', '.') ?></td>
                            </tr>
                            <tr style="color:#6085af;">
                                <td></td>
                                <td colspan="2">Total con descuento</td>
                                <td>$ <?= number_format($compra['costo_total'], 2, ',', '.') ?></td>
                            </tr>
                        <? } ?>
                    </table>
                </td>
            </tr>

        </table>
    </body>
</html>