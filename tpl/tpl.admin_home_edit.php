<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>

<? if(isset($errores)) foreach($errores as $error) { ?>
<span style="color:red"><?=$error?></span>
<? } ?>
<script type="text/javascript">
<?$em->createJavascripts();?>
</script>

Edici&oacute;n de Home

<form method="post" enctype="multipart/form-data" action="index.php?module=home_edit&id=<?=(isset($_GET['id']))?$_GET['id']:'';?>">
<table border="0" align="center" width="800px">
	<tr>

		<td>Foto</td>

		<td colspan="5">
			<!--	Muestra el thumbnail de la imagen grande de la p�gina de inicio.
					Al hacer clic en la imagen, se abre la imagen completa en otra ventana. -->
			<a href="..<?=$em->fields['foto_grande']->valuesImages['image_full_file']?>" target="_BLANK" >
					<img src="..<?=$em->fields['foto_grande']->valuesImages['image_thumbnail_full_file']?>" alt="Clic para agrandar" title="Clic para agrandar" />
			</a>

			<? $em->fields['foto_grande']->showFormFieldImage(null) ?>

			<? $em->fields['foto_grande']->showFormFieldEpigraph(null) ?>

		</td>

	</tr>
    <tr>

        <td>Imagen Pie de Banner</td>

        <td colspan="5">
            <!--	Muestra el thumbnail de la imagen grande de la p�gina de inicio.
                    Al hacer clic en la imagen, se abre la imagen completa en otra ventana. -->
            <a href="..<?=$em->fields['imagen_footer']->valuesImages['image_full_file']?>" target="_BLANK" >
                <img src="..<?=$em->fields['imagen_footer']->valuesImages['image_thumbnail_full_file']?>" alt="Clic para agrandar" title="Clic para agrandar" />
            </a>

            <? $em->fields['imagen_footer']->showFormFieldImage(null) ?>

            <? $em->fields['imagen_footer']->showFormFieldEpigraph(null) ?>

        </td>

    </tr>
    <tr>

        <td>Imagen Flotante de Banner</td>

        <td colspan="5">
            <!--	Muestra el thumbnail de la imagen grande de la p�gina de inicio.
                    Al hacer clic en la imagen, se abre la imagen completa en otra ventana. -->
            <a href="..<?=$em->fields['imagen_flotante']->valuesImages['image_full_file']?>" target="_BLANK" >
                <img src="..<?=$em->fields['imagen_flotante']->valuesImages['image_thumbnail_full_file']?>" alt="Clic para agrandar" title="Clic para agrandar" />
            </a>

            <? $em->fields['imagen_flotante']->showFormFieldImage(null) ?>

            <? $em->fields['imagen_flotante']->showFormFieldEpigraph(null) ?>

        </td>

    </tr>
    <tr>
        <td style="background-color:#CBFBFD;">T&iacute;tulo Banner</td>
        <td colspan="5" style="background-color:#CBFBFD;"><? $em->fields['titulo_banner_1']->showFormField(null,80); ?></td>
    </tr>
    <tr>
        <td style="background-color:#CBFBFD;">Copete Banner 1</td>
        <td colspan="5" style="background-color:#CBFBFD;"><? $em->fields['copete_banner_1']->showFormField(null,80); ?></td>
    </tr>
    <tr>
        <td style="background-color:#CBFBFD;">Copete Banner 2</td>
        <td colspan="5" style="background-color:#CBFBFD;"><? $em->fields['copete_banner_2']->showFormField(null,80); ?></td>
    </tr>
    <tr>
        <td style="background-color:#CBFBFD;">Link Boton Banner</td>
        <td style="background-color:#CBFBFD;"><? $em->fields['link_botton_banner']->showFormField(null); ?></td>
        <td style="background-color:#CBFBFD;">Texto Boton Banner</td>
        <td style="background-color:#CBFBFD;"><? $em->fields['texto_link_botton_banner']->showFormField(null); ?></td>
        <td style="background-color:#CBFBFD;">Abre en nueva ventana</td>
        <td style="background-color:#CBFBFD;"><? $em->fields['nueva_ventana_link_botton_banner']->showFormField(null); ?></td>
    </tr>


	<tr>
		<td style="background-color:#CBFBFD;" style="background-color:#CBFBFD;">T&iacute;tulo 1</td>
		<td colspan="5" style="background-color:#CBFBFD;"><img src="..<?=$em->fields['titulo_1']->valuesImages['image_full_file']?>" />
			<? $em->fields['titulo_1']->showFormFieldImage(null) ?><br/>
			<? $em->fields['titulo_1']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td style="background-color:#CBFBFD;">Subt&iacute;tulo 1</td>
		<td colspan="5" style="background-color:#CBFBFD;"><? $em->fields['subtitulo_1']->showFormField(null,80); ?></td>
	</tr>
	<tr>
		<td style="background-color:#CBFBFD;">Copete 1</td>
		<td colspan="5" style="background-color:#CBFBFD;"> <? $em->fields['copete_1']->showFormField(null,80); ?></td>
	</tr>
	<tr>
		<td style="background-color:#CBFBFD;">Imagen 1</td>
		<td colspan="5" style="background-color:#CBFBFD;"><img src="..<?=$em->fields['imagen_1']->valuesImages['image_full_file']?>"  alt="<?=$em->fields['imagen_1']->valuesImages['epigraph']?>" />
			<? $em->fields['imagen_1']->showFormFieldImage(null) ?><br/>
			<? $em->fields['imagen_1']->showFormFieldEpigraph(null) ?>
		</td>

	</tr>
	<tr>
		<td style="background-color:#CBFBFD;">Link 1</td>
		<td style="background-color:#CBFBFD;"><? $em->fields['link_1']->showFormField(null); ?></td>
		<td style="background-color:#CBFBFD;">Texto link</td>
		<td style="background-color:#CBFBFD;"><? $em->fields['texto_link_1']->showFormField(null); ?></td>
		<td style="background-color:#CBFBFD;">Abre en nueva ventana</td>
		<td style="background-color:#CBFBFD;"><? $em->fields['nueva_ventana_link_1']->showFormField(null); ?></td>
	</tr>

	<tr>
		<td style="background-color:#F6D287;">T&iacute;tulo 2</td>
		<td colspan="5" style="background-color:#F6D287;"><img src="..<?=$em->fields['titulo_2']->valuesImages['image_full_file']?>" />
			<? $em->fields['titulo_2']->showFormFieldImage(null) ?><br/>
			<? $em->fields['titulo_2']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td style="background-color:#F6D287;">Subt&iacute;tulo 2</td>
		<td colspan="5" style="background-color:#F6D287;"><? $em->fields['subtitulo_2']->showFormField(null,80); ?></td>
	</tr>
	<tr>
		<td style="background-color:#F6D287;">Copete 2</td>
		<td colspan="5" style="background-color:#F6D287;"> <? $em->fields['copete_2']->showFormField(null,80); ?></td>
	</tr>
	<tr>
		<td style="background-color:#F6D287;">Imagen 2</td>
		<td colspan="5" style="background-color:#F6D287;"><img src="..<?=$em->fields['imagen_2']->valuesImages['image_full_file']?>" />
			<? $em->fields['imagen_2']->showFormFieldImage(null) ?><br/>
			<? $em->fields['imagen_2']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td style="background-color:#F6D287;">Link 2</td>
		<td style="background-color:#F6D287;"><? $em->fields['link_2']->showFormField(null); ?></td>
		<td style="background-color:#F6D287;">Texto link</td>
		<td style="background-color:#F6D287;"><? $em->fields['texto_link_2']->showFormField(null); ?></td>
		<td style="background-color:#F6D287;">Abre en nueva ventana</td>
		<td style="background-color:#F6D287;"><? $em->fields['nueva_ventana_link_2']->showFormField(null); ?></td>
	</tr>

	<tr>
		<td style="background-color:#D1F8AC;">T&iacute;tulo 3</td>
		<td colspan="5" style="background-color:#D1F8AC;"><img src="..<?=$em->fields['titulo_3']->valuesImages['image_full_file']?>" />
			<? $em->fields['titulo_3']->showFormFieldImage(null) ?><br/>
			<? $em->fields['titulo_3']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td style="background-color:#D1F8AC;">Subt&iacute;tulo 3</td>
		<td colspan="5" style="background-color:#D1F8AC;"><? $em->fields['subtitulo_3']->showFormField(null,80); ?></td>
	</tr>
	<tr>
		<td style="background-color:#D1F8AC;">Copete 3</td>
		<td colspan="5" style="background-color:#D1F8AC;"> <? $em->fields['copete_3']->showFormField(null,80); ?></td>
	</tr>
	<tr>
		<td style="background-color:#D1F8AC;">Imagen 3</td>
		<td colspan="5" style="background-color:#D1F8AC;"><img src="..<?=$em->fields['imagen_3']->valuesImages['image_full_file']?>" />
			<? $em->fields['imagen_3']->showFormFieldImage(null) ?><br/>
			<? $em->fields['imagen_3']->showFormFieldEpigraph(null) ?>
		</td>
	</tr>
	<tr>
		<td style="background-color:#D1F8AC;">Link 3</td>
		<td style="background-color:#D1F8AC;"><? $em->fields['link_3']->showFormField(null); ?></td>
		<td style="background-color:#D1F8AC;">Texto link</td>
		<td style="background-color:#D1F8AC;"><? $em->fields['texto_link_3']->showFormField(null); ?></td>
		<td style="background-color:#D1F8AC;">Abre en nueva ventana</td>
		<td style="background-color:#D1F8AC;"><? $em->fields['nueva_ventana_link_3']->showFormField(null); ?></td>
	</tr>

	<tr>
		<td colspan="6">
			<input name="submit" type="submit"/>
		</td>
	</tr>
</table>

</form>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>