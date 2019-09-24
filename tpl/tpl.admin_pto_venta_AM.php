<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>
<? if(isset($errores)) foreach($errores as $error) { ?>
    <span style="color:red"><?=$error?></span>
<? } ?>
<script type="text/javascript">
    <?$em->createJavascripts();?>
</script>

Edici&oacute;n de Punto de Venta

<form method="post" enctype="multipart/form-data" action="index.php?module=ptos_venta_alta&id=<?=(isset($_GET['id']))?$_GET['id']:'';?>">
<table border="0" align="center" width="800px">
	<tr>
		<td>Nombre</td>
		<td><? $em->fields['nombre']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Mail</td>
		<td><? $em->fields['mail']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Tel&eacute;fono</td>
		<td><? $em->fields['telefono']->showFormField(null) ?></td>
	</tr>
    <tr>
        <td>Fax</td>
        <td><? $em->fields['fax']->showFormField(null) ?></td>
    </tr>
    <tr>
        <td>Web</td>
        <td><? $em->fields['web']->showFormField(null) ?></td>
    </tr>
	<tr>
		<td>Direcci&oacute;n</td>
		<td><? $em->fields['direccion']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Ubicaci&oacute;n</td>
		<td><? $em->fields['subregion']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td colspan="2">
			<input name="submit" type="submit"/>
		</td>
	</tr>
</table>
</form>
<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>