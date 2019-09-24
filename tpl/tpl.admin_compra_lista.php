<? include(TPL_FOLDER."tpl.admin_global_arriba.php");
date_default_timezone_set('America/Argentina/Buenos_Aires');
?>

<h4>Pedidos</h4>
<table>
	<tr>
            <th>Pedido N°</th>
            <th>Fecha y hora</th>
            <th>Cliente</th>
            <th>Importe total</th>
            <th>Estado<br />DineroMail</th>
            <th width="20px">Ver</th>
	</tr>
	<? foreach($list as $pedido)
            {
            if($pedido['dineromail_estado_operacion'] > 0 )
            {
                // Solo muestro los pedidos que tengan un estado > 0.
            ?>
                <tr>
                    <td><?=$pedido['id']?></td>
                    <? /* LE SUMO TRES HORAS A LA HORA PARA QUE MUESTRE LA HORA DE BUENOS AIRES */ ?>
                    <td><?=date("d/m/Y – H:i", strtotime($pedido['fecha']." +3 hours"));?></td>
                    <td><?=  utf8_encode($pedido['nombre']);?></td>
                    <td style="white-space: nowrap;">$ <?=number_format($pedido['costo_total'], 2, ',', '');?></td>
                    <td>
                        <?
                            switch($pedido['dineromail_estado_operacion'])
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
                    <td><a href="index.php?module=pedido_detalle&id=<?=$pedido['id']?>" ><img src="../admin/imagenes/icon-pencil.gif" title="Modificar" alt="Modificar" /></a></td>
                </tr>
	<? } // IF
        } // FOR EACH
        ?>

</table>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>