<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>
<script language="jscript" type="text/javascript">
<!--
function confirmDelete(id) {
    if (confirm("�Est� seguro?"))
    {
        document.location = 'index.php?module=noticias_baja&id=' + id;
    }
}
-->
</script>
<h4>Administraci&oacute;n de Noticias</h4>
<div class="enlace_nuevo"><span><a href="index.php?module=noticias_alta">NUEVA NOTICIA</a></span></div>
<table>

	<tr>
		<th>ID</th>
		<th>T&iacute;tulo</th>
		<th>Copete</th>
        <th>Secci�n</th>
		<th>Orden</th>
		<th>Editar</th>
		<th class="borrar"><span>Borrar</span></th>

	</tr>
	<? foreach($list as $noticia) { ?>
	<tr>
		<td><?=$noticia['id']?></td>
		<td><?=utf8_encode($noticia['titulo'])?></td>
		<td><?=$noticia['copete']?></td>
        <td><?=$noticia['seccion']?></td>
		<td><?=$noticia['orden']?></td>
		<td><a href="index.php?module=noticias_alta&id=<?=$noticia['id']?>" ><img src="../admin/imagenes/icon-pencil.gif" title="Modificar" alt="Modificar" /></a></td>
		<td>
            <a href="javascript:confirmDelete(<?=$noticia['id']?>)"><img src="../admin/imagenes/icon-delete.gif" title="Borrar" alt="Borrar" /></a>
        </td>
	</tr>
	<? } ?>

</table>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>