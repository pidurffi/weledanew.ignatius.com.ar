<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>


<? if(isset($errores)) foreach($errores as $error) { ?>
<span style="color:red"><?=$error?></span>
<? } ?>
<script type="text/javascript">
<?$em->createJavascripts();?>
</script>

Edici&oacute;n de Newsletter

<form method="post" enctype="multipart/form-data" action="index.php?module=newsletters_alta&id=<?=(isset($_GET['id']))?$_GET['id']:'';?>">
<table border="0" align="center" width="800px">
	<tr>
		<td>T&iacute;tulo:</td>
		<td><? $em->fields['titulo']->showFormField(null,80) ?></td>
	</tr>
	<tr>
		<td>Cabecera:</td>
		<td><? $em->fields['cabecera']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Pie:</td>
		<td><? $em->fields['pie']->showFormField(null) ?></td>
	</tr>
    <tr><td colspan="2" style="background-color:#FFFFFF;" height="5">&nbsp;</td></tr>
	<tr>
		<td colspan="2" style="background-color:#CBFBFD;">Noticia 1</td>
	</tr>
	<tr>
		<td>T&iacute;tulo:</td>
		<td><? $em->fields['noticia_1_titulo']->showFormField(null,80) ?></td>
	</tr>
	<tr>
		<td>Tipo:</td>
		<td><? $em->fields['noticia_1_tipo_noticia']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Texto:</td>
		<td><? $em->fields['noticia_1_texto']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Imagen:</td>
		<td><img src="<?=$em->fields['noticia_1_imagen']->valuesImages['image_full_file']?>" />
			<? $em->fields['noticia_1_imagen']->showFormFieldImage(null) ?><br/>
			<? $em->fields['noticia_1_imagen']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td>Enlace:</td>
		<td><? $em->fields['noticia_1_enlace']->showFormField(null,80) ?></td>
	</tr>
    <tr><td colspan="2" style="background-color:#FFFFFF;" height="5">&nbsp;</td></tr>
	<tr>
		<td colspan="2" style="background-color:#CBFBFD;">Noticia 2</td>
	</tr>
	<tr>
		<td>T&iacute;tulo:</td>
		<td><? $em->fields['noticia_2_titulo']->showFormField(null,80) ?></td>
	</tr>
	<tr>
		<td>Tipo:</td>
		<td><? $em->fields['noticia_2_tipo_noticia']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Texto:</td>
		<td><? $em->fields['noticia_2_texto']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Imagen:</td>
		<td><img src="<?=$em->fields['noticia_2_imagen']->valuesImages['image_full_file']?>" />
			<? $em->fields['noticia_2_imagen']->showFormFieldImage(null) ?><br/>
			<? $em->fields['noticia_2_imagen']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td>Enlace:</td>
		<td><? $em->fields['noticia_2_enlace']->showFormField(null,80) ?></td>
	</tr>
    <tr><td colspan="2" style="background-color:#FFFFFF;" height="5">&nbsp;</td></tr>
	<tr>
		<td colspan="2" style="background-color:#CBFBFD;">Noticia 3</td>
	</tr>
	<tr>
		<td>T&iacute;tulo:</td>
		<td><? $em->fields['noticia_3_titulo']->showFormField(null,80) ?></td>
	</tr>
	<tr>
		<td>Tipo:</td>
		<td><? $em->fields['noticia_3_tipo_noticia']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Texto:</td>
		<td><? $em->fields['noticia_3_texto']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Imagen:</td>
		<td><img src="<?=$em->fields['noticia_3_imagen']->valuesImages['image_full_file']?>" />
			<? $em->fields['noticia_3_imagen']->showFormFieldImage(null) ?><br/>
			<? $em->fields['noticia_3_imagen']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td>Enlace:</td>
		<td><? $em->fields['noticia_3_enlace']->showFormField(null,80) ?></td>
	</tr>
    <tr><td colspan="2" style="background-color:#FFFFFF;" height="5">&nbsp;</td></tr>
	<tr>
		<td  colspan="2" style="background-color:#CBFBFD;">Noticia 4</td>
	</tr>
	<tr>
		<td>T&iacute;tulo:</td>
		<td><? $em->fields['noticia_4_titulo']->showFormField(null,80) ?></td>
	</tr>
	<tr>
		<td>Tipo:</td>
		<td><? $em->fields['noticia_4_tipo_noticia']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Texto:</td>
		<td><? $em->fields['noticia_4_texto']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Imagen:</td>
		<td><img src="<?=$em->fields['noticia_4_imagen']->valuesImages['image_full_file']?>" />
			<? $em->fields['noticia_4_imagen']->showFormFieldImage(null) ?><br/>
			<? $em->fields['noticia_4_imagen']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td>Enlace:</td>
		<td><? $em->fields['noticia_4_enlace']->showFormField(null,80) ?></td>
	</tr>
    <tr><td colspan="2" style="background-color:#FFFFFF;" height="5">&nbsp;</td></tr>
	<tr>
		<td  colspan="2" style="background-color:#CBFBFD;"> Noticia 5</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>T&iacute;tulo:</td>
		<td><? $em->fields['noticia_5_titulo']->showFormField(null,80) ?></td>
	</tr>
	<tr>
		<td>Tipo:</td>
		<td><? $em->fields['noticia_5_tipo_noticia']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Texto:</td>
		<td><? $em->fields['noticia_5_texto']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Imagen:</td>
		<td><img src="<?=$em->fields['noticia_5_imagen']->valuesImages['image_full_file']?>" />
			<? $em->fields['noticia_5_imagen']->showFormFieldImage(null) ?><br/>
			<? $em->fields['noticia_5_imagen']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td>Enlace:</td>
		<td><? $em->fields['noticia_5_enlace']->showFormField(null,80) ?></td>
	</tr>
    <tr><td colspan="2" style="background-color:#FFFFFF;" height="5">&nbsp;</td></tr>
	<tr>
		<td  colspan="2" style="background-color:#CBFBFD;">Noticia 6</td>
	</tr>
	<tr>
		<td>T&iacute;tulo:</td>
		<td><? $em->fields['noticia_6_titulo']->showFormField(null,80) ?></td>
	</tr>
	<tr>
		<td>Tipo:</td>
		<td><? $em->fields['noticia_6_tipo_noticia']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Texto:</td>
		<td><? $em->fields['noticia_6_texto']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Imagen:</td>
		<td><img src="<?=$em->fields['noticia_6_imagen']->valuesImages['image_full_file']?>" />
			<? $em->fields['noticia_6_imagen']->showFormFieldImage(null) ?><br/>
			<? $em->fields['noticia_6_imagen']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td>Enlace:</td>
		<td><? $em->fields['noticia_6_enlace']->showFormField(null,80) ?></td>
	</tr>
    <tr><td colspan="2" style="background-color:#FFFFFF;" height="5">&nbsp;</td></tr>
	<tr>
		<td colspan="2" style="background-color:#CBFBFD;">Breve 1</td>
	</tr>
	<tr>
		<td>T&iacute;tulo:</td>
		<td><? $em->fields['breve_1_titulo']->showFormField(null,80) ?></td>
	</tr>
        <tr>
		<td>Tipo:</td>
		<td><? $em->fields['breve_1_tipo_noticia']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Texto:</td>
		<td><? $em->fields['breve_1_texto']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Imagen:</td>
		<td><img src="<?=$em->fields['breve_1_imagen']->valuesImages['image_full_file']?>" />
			<? $em->fields['breve_1_imagen']->showFormFieldImage(null) ?><br/>
			<? $em->fields['breve_1_imagen']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td>Enlace:</td>
		<td><? $em->fields['breve_1_enlace']->showFormField(null,80) ?></td>
	</tr>
    <tr><td colspan="2" style="background-color:#FFFFFF;" height="5">&nbsp;</td></tr>
	<tr>
		<td colspan="2" style="background-color:#CBFBFD;">Breve 2</td>
	</tr>
	<tr>
		<td>T&iacute;tulo:</td>
		<td><? $em->fields['breve_2_titulo']->showFormField(null,80) ?></td>
	</tr>
        <tr>
		<td>Tipo:</td>
		<td><? $em->fields['breve_2_tipo_noticia']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Texto:</td>
		<td><? $em->fields['breve_2_texto']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Imagen:</td>
		<td><img src="<?=$em->fields['breve_2_imagen']->valuesImages['image_full_file']?>" />
			<? $em->fields['breve_2_imagen']->showFormFieldImage(null) ?><br/>
			<? $em->fields['breve_2_imagen']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td>Enlace:</td>
		<td><? $em->fields['breve_2_enlace']->showFormField(null,80) ?></td>
	</tr>
    <tr><td colspan="2" style="background-color:#FFFFFF;" height="5">&nbsp;</td></tr>
	<tr>
		<td colspan="2">
			<input name="submit" type="submit" value="Enviar" />
		</td>
	</tr>
</table>

</form>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>