<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>


<? if(isset($errores)) foreach($errores as $error) { ?>
<span style="color:red"><?=$error?></span>
<? } ?>
<script type="text/javascript">
<?$em->createJavascripts();?>
</script>



Edici&oacute;n de Regi&oacute;n


<form method="post" enctype="multipart/form-data" action="index.php?module=regiones_alta&id=<?=(isset($_GET['id']))?$_GET['id']:'';?>">
<table border="0" align="center" width="800px">
	<tr>
		<td>Nombre</td>
		<td><? $em->fields['nombre']->showFormField(null,50) ?></td>
	</tr>
	<tr>
		<td>Orden</td>
		<td><? $em->fields['orden']->showFormField(null,5) ?></td>
	</tr>
	<tr>
		<td colspan="2">
			<input name="submit" type="submit"/>
		</td>
	</tr>
</table>

</form>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>