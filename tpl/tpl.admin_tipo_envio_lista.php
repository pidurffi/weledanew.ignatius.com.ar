<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>
<script language="jscript" type="text/javascript">
<!--
function confirmDelete(id) {
    if (confirm("¿Está seguro?"))
    {
        document.location = 'index.php?module=tipo_envio_baja&id=' + id;
    }
}
-->
</script>
<h4>Administraci&oacute;n de Tipos de Envío</h4>
<div class="enlace_nuevo"><span><a href="/admin/index.php?module=tipo_envio_alta">NUEVO TIPO DE ENVÍO</a></span></div>
<table>

	<tr>
		<th>ID</th>
		<th>Tipo de envío</th>
        <th>Costo</th>
		<th>Editar</th>
        <th class="borrar"><span>Borrar</span></th>
	</tr>
	<? foreach($list as $tipo_envio) { ?>
	<tr>
		<td><?=$tipo_envio['id']?></td>
		<td><?=$tipo_envio['tipo_envio']?></td>
        <td>$ <?=$tipo_envio['costo']?></td>
		<td><a href="index.php?module=tipo_envio_alta&id=<?=$tipo_envio['id']?>" ><img src="../admin/imagenes/icon-pencil.gif" title="Modificar" alt="Modificar" /></a></td>
		<td>
            <a href="javascript:confirmDelete(<?=$tipo_envio['id']?>)"><img src="../admin/imagenes/icon-delete.gif" title="Borrar" alt="Borrar" /></a>
        </td>
	</tr>
	<? } ?>

</table>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>