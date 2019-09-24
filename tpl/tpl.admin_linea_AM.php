<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>


<? if(isset($errores)) foreach($errores as $error) { ?>
<span style="color:red"><?=$error?></span>
<? } ?>
<script type="text/javascript">
<?$em->createJavascripts();?>
</script>



Edici&oacute;n de L&iacute;nea


<form method="post" enctype="multipart/form-data" action="index.php?module=lineas_alta&id=<?=(isset($_GET['id']))?$_GET['id']:'';?>">
<table border="0" align="center" width="800px">
	<tr>

		<td>Nombre</td>

		<td><? $em->fields['nombre']->showFormField(null) ?></td>

	</tr>

	<tr>

		<td>Familia</td>

		<td><? $em->fields['familia']->showFormField(null) ?></td>

	</tr>

	<tr>

		<td>Foto</td>

		<td>
			<a href="..<?=$em->fields['foto']->valuesImages['image_full_file']?>" target="_BLANK" >
				<img src="..<?=$em->fields['foto']->valuesImages['image_full_file']?>" width="384" height="102"  alt="Clic para agrandar" title="Clic para agrandar" />
			</a>

			<? $em->fields['foto']->showFormFieldImage(null) ?><br/>

			<? $em->fields['foto']->showFormFieldEpigraph(null) ?>

		</td>

	</tr>

	<tr>

		<td>Foto Listado</td>

		<td><img src="..<?=$em->fields['foto_listado']->valuesImages['image_full_file']?>" />

			<? $em->fields['foto_listado']->showFormFieldImage(null) ?><br/>

			<? $em->fields['foto_listado']->showFormFieldEpigraph(null) ?>

		</td>

	</tr>

	<tr>

		<td>Subt&iacute;tulo</td>

		<td><? $em->fields['subtitulo']->showFormField(null) ?></td>

	</tr>

	<tr>

		<td>Copete</td>

		<td><? $em->fields['copete']->showFormField(null) ?></td>

	</tr>

	<tr>

		<td>Descripcion</td>

		<td><? $em->fields['descripcion']->showFormField(null) ?></td>

	</tr>

    <? /*
	<tr>

		<td>Foto Nombre</td>

		<td><img src="..<?=$em->fields['foto_nombre']->valuesImages['image_full_file']?>" />

			<? $em->fields['foto_nombre']->showFormFieldImage(null) ?><br/>

			<? $em->fields['foto_nombre']->showFormFieldEpigraph(null) ?>

		</td>

	</tr>

	<tr>

		<td>Foto Banner</td>

		<td><img src="..<?=$em->fields['foto_banner']->valuesImages['image_full_file']?>" />

			<? $em->fields['foto_banner']->showFormFieldImage(null) ?><br/>

			<? $em->fields['foto_banner']->showFormFieldEpigraph(null) ?>

		</td>

	</tr>

	<tr>

		<td>T&iacute;tulo banner</td>

		<td><? $em->fields['titulo_banner']->showFormField(null) ?></td>

	</tr>

	<tr>

		<td>Descripcion banner</td>

		<td><? $em->fields['descripcion_banner']->showFormField(null) ?></td>

	</tr>

	<tr>

		<td>Link banner</td>

		<td><? $em->fields['link_banner']->showFormField(null) ?></td>

	</tr>
*/?>
	<tr>
		<td>Orden</td>
		<td><? $em->fields['orden']->showFormField(null) ?></td>
	</tr>

	<tr>
		<td>Fondo productos</td>
		<td><? $em->fields['fondo_productos']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Color t�tulos productos</td>
		<td><? $em->fields['color_titulos_productos']->showFormField(null) ?> Ingrese el color en formato hexadecimal (RRGGBB), por ejemplo 00FF00.</td>
	</tr>
	<tr>
		<td>Fondo columna izquierda</td>
		<td><? $em->fields['fondo_columna_izquierda']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Foto enlace izquierda</td>
		<td><img src="..<?=$em->fields['foto_enlace']->valuesImages['image_full_file']?>" />
			<? $em->fields['foto_enlace']->showFormFieldImage(null) ?><br/>
			<? $em->fields['foto_enlace']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td>Foto enlace izquierda (URL)</td>
		<td><? $em->fields['link_foto_enlace']->showFormField(null) ?></td>
	</tr>
    <tr>
        <td>Foto enlace izquierda abre en nueva ventana</td>
        <td><? $em->fields['nueva_ventana_foto_enlace']->showFormField(null) ?></td>
    </tr>
	
	<tr>
		<td>Meta keywords</td>
		<td><? $em->fields['meta_keywords']->showFormField(null,80) ?></td>
	</tr>
	<tr>
		<td>Meta title</td>
		<td><? $em->fields['meta_title']->showFormField(null,80) ?></td>
	</tr>
	<tr>
		<td>Meta description</td>
		<td><? $em->fields['meta_keywords']->showFormField(null,80) ?></td>
	</tr>

	

	<tr>
		<td colspan="2">
			<input name="submit" type="submit"/>
		</td>
	</tr>
	
	
	
</table>

</form>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>