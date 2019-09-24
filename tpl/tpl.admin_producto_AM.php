<? include(TPL_FOLDER."tpl.admin_global_arriba.php");
date_default_timezone_set('America/Argentina/Buenos_Aires');
 ?>

<? if(isset($errores)) foreach($errores as $error) { ?>
<span style="color:red"><?=$error?></span>
<? } ?>
<script type="text/javascript">
<?$em->createJavascripts();?>
</script>

Edici&oacute;n de Producto

<form method="post" enctype="multipart/form-data" action="index.php?module=productos_alta&id=<?=(isset($_GET['id']))?$_GET['id']:'';?>">
<table border="0" align="center" width="800px">
	<tr>
		<td>Nombre</td>
		<td><? $em->fields['nombre']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>L&iacute;nea</td>
		<td><? $em->fields['linea']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Familia</td>
		<td><? $em->fields['familia_directa']->showFormField(null) ?> Complete solo cuando el producto est&eacute; relacionado directamente a una Familia.</td>
	</tr>
	<tr>
		<td>Foto</td>
		<td><img src="..<?=$em->fields['foto']->valuesImages['image_full_file']?>" />
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
		<td>Descripcion</td>
		<td><? $em->fields['descripcion']->showFormField(null) ?></td>
	</tr>
<?php /*
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
 */?>

	<tr>
		<td>Orden</td>
		<td><? $em->fields['orden']->showFormField(null) ?></td>
	</tr>
	<tr>
		<td>Imagen superior (top)</td>
		<td>
			<?
			// Si el campo foto_top no est� vac�o, muestro la imagen con un link para verla m�s grande
			if($em->fields['foto_top']->valuesImages['image_file'] != '')
			{ ?>
				<a href="..<?=$em->fields['foto_top']->valuesImages['image_full_file']?>" target="_BLANK" >
					<img src="..<?=$em->fields['foto_top']->valuesImages['image_full_file']?>" width="384" height="102"  alt="Clic para agrandar" title="Clic para agrandar" />
				</a>
			<? } ?>
			<? $em->fields['foto_top']->showFormFieldImage(null) ?><br/>
			<? $em->fields['foto_top']->showFormFieldEpigraph(null) ?>
		</td>

	</tr>
</table>

<table border="0" align="center" width="800px">
        <tr><td colspan="2" style="background-color:#CBFBFD;"> Maestro de productos</td></tr>
	<tr>
		<td>C&oacute;digo</td>
		<td><? $em->fields['codigo']->showFormField(null) ?></td>
	</tr>
        <tr>
		<td>Nombre Weleda</td>
		<td><?php echo $em->entityObject->values['nombreweleda'] ?>
		<input type="hidden" name="nombreweleda" value="<?php echo $em->entityObject->values['nombreweleda'] ?>" />
		</td>
	</tr>
 	<tr>
		<td>Precio web</td>
		<td>$ <?php echo $em->entityObject->values['precio'] ?>
		<input type="hidden" name="precio" value="<?php echo $em->entityObject->values['precio'] ?>" />
		</td>
	</tr>
	<tr>
		<td>Precio minorista</td>
		<td>$ <?php echo $em->entityObject->values['precio_minorista'] ?>
		<input type="hidden" name="precio_minorista" value="<?php echo $em->entityObject->values['precio_minorista'] ?>" />
		</td>
	</tr>
	<tr>
		<td>Precio mayorista</td>
		<td>$ <?php echo $em->entityObject->values['precio_mayorista'] ?>
		<input type="hidden" name="precio_mayorista" value="<?php echo $em->entityObject->values['precio_mayorista'] ?>" />
		</td>
	</tr>
	<tr>
		<td>Peso</td>
		<td><?php echo $em->entityObject->values['peso'] ?> g
		<input type="hidden" name="peso" value="<?php echo $em->entityObject->values['peso'] ?>" />
		</td>
	</tr>
	<tr>
		<td>En Maestro</td>
		<td>
			<?php $en_maestro = $em->entityObject->values['en_maestro'] ?>
			<?php if($en_maestro) echo "S&iacute;"; else echo "No"?>
			<input type="hidden" name="en_maestro" value="<?php echo $en_maestro?>" />
		</td>
	</tr>
    <tr>
        <td style="background-color: azure;">Producto sin stock web</td>
        <td style="background-color: azure;">
            <? $em->fields['sin_stock']->showFormField(null); ?>
        </td>
    </tr>
    <tr>
        <td style="background-color: azure;">Producto sin stock mayorista</td>
        <td style="background-color: azure;">
            <? $em->fields['sin_stock_mayorista']->showFormField(null); ?>
        </td>
    </tr>
    <tr>
        <td style="background-color: azure;">Producto sin stock minorista</td>
        <td style="background-color: azure;">
            <? $em->fields['sin_stock_minorista']->showFormField(null); ?>
        </td>
    </tr>
    <tr>
        <td>Mostrar en la web (si no, solo se mostrará en carrito mayorista/minorista)</td>
        <td>
            <? $em->fields['mostrar_en_web']->showFormField(null); ?>
        </td>
    </tr>
    <tr>
        <td>Producto solo para minoristas</td>
        <td>
            <? $em->fields['solo_para_minoristas']->showFormField(null); ?>
        </td>
    </tr>
	<tr>
		<td>Orden carrito mayorista</td>
		<td><? $em->fields['orden_carrito']->showFormField(null) ?></td>
	</tr>
	
	<tr><td colspan="2" style="background-color:#CBFBFD;">Meta tags</td></tr>
	
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
			<input name="submit" type="submit" value="Grabar"/>
		</td>
	</tr>
</table>
</form>
<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>