<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>
<script language="jscript" type="text/javascript">
<!--
function confirmDelete(id) {
    if (confirm("¿Está seguro?"))
    {
        document.location = 'index.php?module=ptos_venta_baja&id=' + id;
    }
}
-->
</script>
<h4>Administraci&oacute;n de Puntos de Venta</h4>
<div class="enlace_nuevo"><span><a href="/admin/index.php?module=ptos_venta_alta">NUEVO PUNTO DE VENTA</a></span></div>

<table>

	<tr>
		<th>ID</th>
		<th>Nombre</th>

		<th>Regi&oacute;n</th>

		<th>Subrregi&oacute;n</th>
		<th>Editar</th>
		<th class="borrar"><span>Borrar</span></th>
	</tr>
	<? foreach($list as $pto_venta) { ?>
	<tr>
		<td><?=$pto_venta['id']?></td>
		<td><?=$pto_venta['nombre']?></td>
		<td><?=$pto_venta['region']?></td>

		<td><?=$pto_venta['subregion']?></td>

		<td><a href="index.php?module=ptos_venta_alta&id=<?=$pto_venta['id']?>" ><img src="../admin/imagenes/icon-pencil.gif" title="Modificar" alt="Modificar" /></a></td>
		<td>
            <a href="javascript:confirmDelete(<?=$pto_venta['id']?>)"><img src="../admin/imagenes/icon-delete.gif" title="Borrar" alt="Borrar" /></a>
        </td>
	</tr>
	<? } ?>

</table>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>