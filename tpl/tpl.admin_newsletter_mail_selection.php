<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>
<? if(!empty($errors)) foreach($errors as $error) { ?>
<span style="color:red"><?=$error ?></span><br/>
<? } ?>
<form name="form" method="post" action="index.php?module=newsletters_envio&id=<?=$_GET['id']?>" />
<table>
	<tr>
		<th>Enviar</th>
		<th>Apellido</th>
		<th>Nombre</th>
		<th>Mail</th>
	</tr>
	<? foreach($list as $cliente) { ?>
	<tr>
		<td><?=$module->showFormField($cliente['id'])?></td>
		<td><?=$cliente['last_name']?></td>
		<td><?=$cliente['first_name']?></td>
		<td><?=$cliente['email']?></td>
	</tr>
	<? } ?>
    
</table>
<input type="submit" value="Send" name="send" />
</form>
<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>