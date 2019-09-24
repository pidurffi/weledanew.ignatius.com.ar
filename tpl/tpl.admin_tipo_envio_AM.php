<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>

<? if(isset($errores)) foreach($errores as $error) { ?>
<span style="color:red"><?=$error?></span>
<? } ?>
<script type="text/javascript">
<?$em->createJavascripts();?>
</script>

Edici&oacute;n de Tipo de Envío

<form method="post" enctype="multipart/form-data" action="index.php?module=tipo_envio_alta&id=<?=(isset($_GET['id']))?$_GET['id']:'';?>">
<table border="0" align="center" width="800px">
	<tr>
		<td>Tipo de envío</td>
		<td><? $em->fields['tipo_envio']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Costo</td>
		<td>$ <? $em->fields['costo']->showFormField(null) ?></td>
	</tr>
    <tr>
        <td>Orden</td>
        <td><? $em->fields['orden']->showFormField(null) ?></td>
    </tr>

	<tr>
		<td colspan="2">
			<input name="submit" type="submit"/>
		</td>
	</tr>
</table>
</form>
<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>