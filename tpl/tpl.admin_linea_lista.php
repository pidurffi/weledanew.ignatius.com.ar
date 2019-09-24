<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>
<script language="jscript" type="text/javascript">
<!--
function confirmDelete(id) {
    if (confirm("¿Está seguro?"))
    {
        document.location = 'index.php?module=lineas_baja&id=' + id;
    }
}
-->
</script>
<h4>Administraci&oacute;n de L&iacute;neas</h4>
<div class="enlace_nuevo"><span><a href="index.php?module=lineas_alta">NUEVA L&Iacute;NEA</a></span></div>
<table>

	<tr>
		<th>ID</th>

		<th>Nombre</th>
		<th>Familia</th>
		<th>Orden</th>

		<th>Editar</th>
		<th class="borrar"><span>Borrar</span></th>
	</tr>
	<? foreach($list as $linea) { ?>
	<tr>
		<td><?=$linea['id']?></td>
		<td><?=utf8_encode($linea['nombre'])?></td>
		<td><?=utf8_encode($linea['familia'])?></td>
		<td><?=$linea['orden']?></td>
		<td><a href="index.php?module=lineas_alta&id=<?=$linea['id']?>" ><img src="../admin/imagenes/icon-pencil.gif" title="Modificar" alt="Modificar" /></a></td>
		<td>
            <a href="javascript:confirmDelete(<?=$linea['id']?>)"><img src="../admin/imagenes/icon-delete.gif" title="Borrar" alt="Borrar" /></a>
        </td>
	</tr>
	<? } ?>

</table>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>