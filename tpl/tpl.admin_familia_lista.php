<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>
<script language="jscript" type="text/javascript">
<!--
function confirmDelete(id) {
    if (confirm("¿Está seguro?"))
    {
        document.location = 'index.php?module=familias_baja&id=' + id;
    }
}
-->
</script>
<h4>Administraci&oacute;n de Familias</h4>
<div class="enlace_nuevo"><span><a href="index.php?module=familias_alta">NUEVA FAMILIA</a></span></div>
<table>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Orden</th>

		<th>Editar</th>
		<th class="borrar"><span>Borrar</span></th>
	</tr>
	<? foreach($list as $familia) { ?>
	<tr>
		<td><?=$familia['id']?></td>
		<td><?=utf8_encode($familia['nombre'])?></td>
		<td><?=$familia['orden']?></td>
		<td><a href="index.php?module=familias_alta&id=<?=$familia['id']?>" ><img src="../admin/imagenes/icon-pencil.gif" title="Modificar" alt="Modificar" /></a></td>
		<td>
            <a href="javascript:confirmDelete(<?=$familia['id']?>)"><img src="../admin/imagenes/icon-delete.gif" title="Borrar" alt="Borrar" /></a>
        </td>
	</tr>
	<? } ?>
</table>
<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>