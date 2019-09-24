<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>

<h4>Administraci&oacute;n de Newsletters</h4>
<div class="enlace_nuevo"><span><a href="index.php?module=newsletters_alta">NUEVO NEWSLETTER</a></span></div>
<table>

	<tr>
		<th>ID</th>
		<th>T&iacute;tulo</th>
		<th>Editar</th>
		<th class="borrar"><span>Borrar</span></th>
                <th>Ver</th>
		<th>Env&iacute;os</th>
		<th>Pruebas</th>
	</tr>
	<? foreach($list as $newsletter) { ?>
	<tr>
		<td><?=$newsletter['id']?></td>
		<td><?=utf8_encode($newsletter['titulo'])?></td>
		<td><a href="index.php?module=newsletters_alta&id=<?=$newsletter['id']?>" ><img src="../admin/imagenes/icon-pencil.gif" title="Modificar" alt="Modificar" /></a></td>
		<td>
			<? /*
			<a href="index.php?module=newsletters_baja&id=<?=$newsletter['id']?>" ><img src="../admin/imagenes/icon-delete.gif"title="Borrar" alt="Borrar" /></a>
			*/ ?>
		</td>
        <td>
			<a href="index.php?module=newsletters_preview&id=<?=$newsletter['id']?>" target="_BLANK">Ver</a>
		</td>
		<td>
			<? /*
			<a href="index.php?module=newsletters_envio&id=<?=$newsletter['id']?>" >Envios</a>
			*/ ?>
		</td>
		<td><a href="index.php?module=newsletters_envio_prueba&id=<?=$newsletter['id']?>" >Pruebas</a></td>
	</tr>
	<? } ?>
    
</table>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>