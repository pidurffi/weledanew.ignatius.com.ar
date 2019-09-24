<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>

<? if(!empty($errors)) foreach($errors as $error) { ?>
<span style="color:red"><?=$error ?></span><br/>
<? } ?>

<h4>Administraci&oacute;n de Env&iacute;os</h4>
<div class="enlace_nuevo"><span><a href="index.php?module=newsletters_aviso&nextmodule=newsletters_envio&task=new_send&id=<?=RequestHandler::getGetValue("id")?>">NUEVO ENV&Iacute;O</a></span></div> 
<table>
	<tr>
		<th>Nro Env&iacute;o</th>
		<th>Newsletter</th>
		<th>Fecha Env&iacute;o</th>
		<th>Estado</th>
		<th>Enviar</th>
	</tr>
	<? foreach($list as $envio) { ?>
	<tr>
		<td><?=$envio['id']?></td>
		<td><?=$envio['id_newsletter']?></td>
		<td><?=$envio['date']?></td>
		<td><?=($envio['stat']==NEWSLETTER_SENDING_STATUS_COMPLETE)?"Completo":"Pendiente" ?></td>
		<td><a href="index.php?module=newsletters_envio&task=send&id=<?=$envio['id_newsletter']?>&id_sending=<?=$envio['id']?>" >Enviar</a></td>
	</tr>
	<? } ?>
    
</table>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>
