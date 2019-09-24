<? include(TPL_FOLDER . "tpl.admin_global_arriba.php"); ?>
<script language="jscript" type="text/javascript">
    <!--
    function confirmDelete(id) {
        if (confirm("¿Está seguro?"))
        {
            document.location = 'index.php?module=clientes_baja&id=' + id;
        }
    }
    -->
</script>
<h4>Administraci&oacute;n de clientes</h4>
<div class="enlace_nuevo"><span><a href="/admin/index.php?module=clientes_alta">NUEVO CLIENTE</a></span></div>
<table>

    <tr>
        <th>ID</th>
		<th>C&oacute;digo</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Editar</th>
        <th class="borrar"><span>Borrar</span></th>
    </tr>
    <? foreach ($list as $cliente) { ?>
        <tr>
            <td><?= $cliente['id'] ?></td>
			<td><?= $cliente['codigo'] ?></td>
            <td><?= $cliente['nombre'] . ' ' . $cliente['apellido']; ?></td>
			<td><?= $cliente['tipo_cliente'] ?></td>
            <td>
				<a href="index.php?module=clientes_alta&id=<?= $cliente['id'] ?>" ><img src="../admin/imagenes/icon-pencil.gif" title="Modificar" alt="Modificar" /></a>
			</td>
            <td>
                <a href="javascript:confirmDelete(<?= $cliente['id'] ?>)"><img src="../admin/imagenes/icon-delete.gif" title="Borrar" alt="Borrar" /></a>
            </td>
        </tr>
    <? } ?>

</table>

<? include(TPL_FOLDER . "tpl.admin_global_abajo.php"); ?>