<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>
<script language="jscript" type="text/javascript">
<!--
function confirmDelete(id) {
    if (confirm("�Est� seguro?"))
    {
        document.location = 'index.php?module=subregiones_baja&id=' + id;
    }
}
-->
</script>
<h4>Administraci&oacute;n de Subrregiones</h4>
<div class="enlace_nuevo"><span><a href="index.php?module=subregiones_alta">NUEVA SUBRREGI&Oacute;N</a></span></div>
<table>
	<tr>
		<th>ID</th>
		<th>Nombre</th>

		<th>Regi&oacute;n</th>
		<th>Editar</th>
		<th class="borrar"><span>Borrar</span></th>
	</tr>
	<? foreach($list as $subregion) { ?>

	<tr>
		<td><?=$subregion['id']?></td>
		<td><?=$subregion['nombre']?></td>

		<td><?=$subregion['region']?></td>

		<td><a href="index.php?module=subregiones_alta&id=<?=$subregion['id']?>" ><img src="../admin/imagenes/icon-pencil.gif" title="Modificar" alt="Modificar" /></a></td>
		<td>
            <a href="javascript:confirmDelete(<?=$subregion['id']?>)"><img src="../admin/imagenes/icon-delete.gif" title="Borrar" alt="Borrar" /></a>
        </td>
	</tr>
	<? } ?>

</table>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>