<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>


<? if(isset($errores)) foreach($errores as $error) { ?>
<span style="color:red"><?=$error?></span>
<? } ?>
<script type="text/javascript">
<?$em->createJavascripts();?>
</script>



Edici&oacute;n de Noticia


<form method="post" enctype="multipart/form-data" action="index.php?module=noticias_alta&id=<?=(isset($_GET['id']))?$_GET['id']:'';?>">
<table border="0" align="center" width="800px">
	<tr>
		<td>Título</td>
		<td><? $em->fields['titulo']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Copete</td>
		<td><? $em->fields['copete']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Foto</td>
		<td>
			<img src="..<?=$em->fields['foto']->valuesImages['image_full_file']?>" width="90" height="160"  alt="" title="" />
			<? $em->fields['foto']->showFormFieldImage(null) ?><br/>
			<? $em->fields['foto']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td>Fotito</td>
		<td>
			<img src="..<?=$em->fields['fotito']->valuesImages['image_full_file']?>" width="45" height="45"  alt="" title="" />
			<? $em->fields['fotito']->showFormFieldImage(null) ?><br/>
			<? $em->fields['fotito']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td>Orden</td>
		<td><? $em->fields['orden']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Resumen</td>
		<td><? $em->fields['resumen']->showFormField(null) ?></td>
	</tr>
	<tr>
	<tr>
		<td>Texto</td>
		<td><? $em->fields['texto']->showFormField(null) ?></td>
	</tr>
    <tr>
        <td>Sección</td>
        <td><? $em->fields['seccion']->showFormField(null) ?></td>
    </tr>
	<tr>
		<td colspan="2">
			<input name="submit" type="submit" value="Enviar" />
		</td>
	</tr>
</table>
</form>
<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>