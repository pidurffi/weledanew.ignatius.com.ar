<? include(TPL_FOLDER."tpl.admin_global_arriba.php");
date_default_timezone_set('America/Argentina/Buenos_Aires');
 ?>
    <table border="0" cellpadding="1" cellspacing="1">
        <tr>
            <td  style="background-color:#FFFFFF; text-align:left;">
                <h3>Confirmación del Pedido Nº <?=$compra['id'] ?></h3>
            </td>
            <? /* LE SUMO TRES HORAS A LA HORA PARA QUE MUESTRE LA HORA DE BUENOS AIRES */ ?>
            <td  style="background-color:#FFFFFF; text-align:right;">
                <h3><?=date("d/m/Y – H:i", strtotime($compra['fecha']." +3 hours"));?></h3>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="background-color:#FFFFFF; text-align:left;">
                    Estado DineroMail:&nbsp;
                    <?
                    switch($compra['dineromail_estado_operacion'])
                    {
                        case 1:
                            echo '<span style="color:#000000;background-color:#ffcc00; padding:3px;">Pendiente</span>';
                            break;
                        case 2:
                            echo '<span style="color:#FFFFFF;background-color:#009900; padding:3px;">Acreditado</span>';
                            break;
                        case 3:
                            echo '<span style="color:#FFFFFF;background-color:#cc3300; padding:3px;">Cancelado</span>';
                            break;
                        default:
                            echo "-";
                    }
                ?>
            </td>

        </tr>
    </table>

    <table border="0" cellpadding="1" cellspacing="1">
    	<tr class="titulo">
            <td width="" style="font-weight:bold;">Cód.</td>
            <td width="" style="font-weight:bold;">Descripción</td>
            <td width="" style="font-weight:bold;">Cantidad</td>
            <td width="" style="font-weight:bold;">Precio de compra</td>
            <td width="" style="font-weight:bold;">Importe</td>
        </tr>
        <? $total = 0 ?>
        <? foreach($productos as $prod) { ?>
        <tr class="contenido">
            <td width=""><?=$prod['codigo'] ?></td>
            <td width=""><?=$prod['nombreweleda'] ?></td>
            <td width=""><?=$prod['cantidad'] ?></td>
            <td width="">$ <?=number_format($prod['subtotal']/$prod['cantidad'], 2, ',', '') ?></td>
            <td width="">$ <?=number_format($prod['subtotal'], 2, ',', '') ?></td>
        </tr>
        <? $total+= $prod['subtotal'] ?>
        <? } ?>

        <tr class="costo">
        	<td style="background-color:#FFFFFF;"></td>
            <td class="texto" colspan="3" style="font-weight:bold;">Costo de la compra</td>
            <td class="importe" style="font-weight:bold;">$ <?=number_format($total, 2, ',', '') ?></td>
        </tr>

        <tr class="costo">
        	<td style="background-color:#FFFFFF;"></td>
            <td class="texto" colspan="3" style="font-weight:bold;">Costo del envío</td>
            <td class="importe">$ <?=number_format($compra['costo_envio'], 2, ',', '') ?></td>
        </tr>
		
		<tr class="total">
        	<td style="background-color:#FFFFFF;"></td>
            <td colspan="3" style="font-weight:bold;">Importe total</td>
            <td style="font-weight:bold;">$ <?=number_format($total + $compra['costo_envio'], 2, ',', '') ?></td>
        </tr>
		
		<?
			// Muestro el descuento si hubiera.
                if ($compra['descuento_pesos'] > 0) {
                    print('<tr class="costo">');
					print('<td style="background-color:#FFFFFF;"></td>');
					print('<td class="texto" colspan="3" style="font-weight:bold;">Descuento</td>');
					print('<td class="importe">$ - ' . number_format($compra['descuento_pesos'], 2, ',', '') . '</td>');
                    print('</tr>');
					
					$total_con_descuento = $total + $compra['costo_envio'] - $compra['descuento_pesos'];
					
					print('<tr class="costo">');
					print('<td style="background-color:#FFFFFF;"></td>');
					print('<td class="texto" colspan="3" style="font-weight:bold;">Total con descuento</td>');
					print('<td class="importe" style="font-weight:bold;">$ ' . number_format($total_con_descuento, 2, ',', '') . '</td>');
                    print('</tr>');
               
                }
        ?>

  
    </table>

    <table style="margin-top:20px;" class="datos" border="0" cellpadding="1" cellspacing="1">
    	<tr class="titulo">
        	<td colspan="2" style="font-weight:bold;">Informaci&oacute;n del Cliente</td>
        </tr>
        <tr class="contenido">
            <td style="font-weight:bold;">Nombre</td><td class="dato_usuario"><?=utf8_encode($cliente['nombre']); ?></td>
        </tr>
        <tr class="contenido">
        	<td style="font-weight:bold;">Apellido</td><td class="dato_usuario"><?=utf8_encode($cliente['apellido']); ?></td>
        </tr>
        <tr class="contenido">
        	<td style="font-weight:bold;">E-mail</td><td class="dato_usuario"><?=utf8_encode($cliente['email']); ?></td>
        </tr>
        <tr class="contenido">
        	<td style="font-weight:bold;">Teléfono</td><td class="dato_usuario"><?=utf8_encode($cliente['telefono']); ?></td>
        </tr>
    </table>

    <table class="datos" border="0" cellpadding="1" cellspacing="1">
    	<tr class="titulo">
        	<td colspan="2" style="font-weight:bold;">Informaci&oacute;n de la forma de envío</td>
        </tr>
        <? /*
        <tr class="contenido">
        	<td style="font-weight:bold;">Tipo de Env&iacute;o</td><td class="dato_usuario"><?=$tipo_envio['tipo_envio'] ?></td>
        </tr>
         */ ?>
        <tr class="contenido">
        	<td style="font-weight:bold;">Nombre</td><td class="dato_usuario"><?=utf8_encode($compra['nombre'])?></td>
        </tr>
        <tr class="contenido">
        	<td style="font-weight:bold;">Direcci&oacute;n de<br />Env&iacute;o</td><td class="dato_usuario"><?=utf8_encode($compra['direccion'])?></td>
        </tr>
        <tr class="contenido">
        	<td style="font-weight:bold;">Ciudad</td><td class="dato_usuario"><?=utf8_encode($compra['ciudad'])?></td>
        </tr>
        <tr class="contenido">
        	<td style="font-weight:bold;">Provincia</td><td class="dato_usuario"><?=utf8_encode($compra['provincia'])?></td>
        </tr>
        <tr class="contenido">
        	<td style="font-weight:bold;">Código postal</td><td class="dato_usuario"><?=$compra['codigo_postal']?></td>
        </tr>
    </table>
    <a href="index.php?module=pedido_lista">Volver</a>
<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>