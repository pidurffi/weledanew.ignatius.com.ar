<? include(TPL_FOLDER . "tpl.admin_global_arriba.php"); ?>
<script language="jscript" type="text/javascript">
    <!--
    function confirmDelete(id) {
        if (confirm("¿Está seguro?"))
        {
            document.location = 'index.php?module=productos_baja&id=' + id;
        }
    }
    -->
</script>
<h4>Administraci&oacute;n de L&iacute;neas</h4>
<div class="enlace_nuevo"><span><a href="/admin/index.php?module=productos_alta">NUEVO PRODUCTO</a></span></div>
<table>

    <tr>
        <th>ID</th>

        <th>Nombre<br />Weleda</th>
        <th>L&iacute;nea</th>
        <th>Familia</th>
        <th>Orden</th>
        <th>Producto Minorista</th>
        <th>Precio<br />web</th>
		<th>Precio<br />min.</th>
		<th>Precio<br />may.</th>
        <th>C&oacute;d.</th>
        <th>Editar</th>
        <th class="borrar"><span>Borrar</span></th>
    </tr>
    <? foreach ($list as $producto) { ?>
        <tr>
            <td><?= $producto['id'] ?></td>
            <td>
                <?
                if (isset($producto['id_familia_directa'])) {
                    ?>
                    <a href="/index.php?module=fr_producto_suelto&id=<?= $producto['id'] ?>" target="_BLANK">
                        <?
							if($producto['nombreweleda'] == '' or $producto['nombreweleda'] == '-')
								{ echo utf8_encode($producto['nombre']); }
							else
								{ echo utf8_encode($producto['nombreweleda']); }
						?>
                    </a>
                    <?
                } else {
                    ?>
                    <a href="/index.php?module=fr_producto&id=<?= $producto['id'] ?>&id_linea=<?= $producto['id_linea'] ?>&id_familia=<?= $producto['id_familia'] ?>" target="_BLANK">
                        <?
							if($producto['nombreweleda'] == '' or $producto['nombreweleda'] == '-')
								{ echo utf8_encode($producto['nombre']); }
							else
								{ echo utf8_encode($producto['nombreweleda']); }
						?>
                    </a>
                <? } ?>
            </td>
            <td>
                <a href="/index.php?module=fr_linea&id=<?= $producto['id_linea'] ?>" target="_BLANK">
                    <?= utf8_encode($producto['linea']); ?>
                </a>
            </td>
            <td>
                <a href="/index.php?module=fr_familia&id=<?= $producto['id_familia'] ?>" target="_BLANK">
                    <?= utf8_encode($producto['familia']); ?>
                </a>
                <a href="/index.php?module=fr_familia&id=<?= $producto['id_familia_directa'] ?>" target="_BLANK">
                    <?= utf8_encode($producto['familia_directa']); ?>
                </a>
            </td>
            <td><?= $producto['orden'] ?></td>
            <td>
                <?php if($producto['solo_para_minoristas']){?>
                    Sí
                <?php }else{?>
                    No
                <?php }?>
            </td>
            <td style="white-space: nowrap;">
                <?
                if ($producto['precio'] != 0)
                    if ($producto['sin_stock']) {
                        print('<span style="color:#FFFFFF;background-color:#cc3300;">');
                    } else {
                        print ("<span>");
                    }
                if (CONSTANTE_PAIS == 'Argentina') {
                    // En Argentina imprimo el precio con decimales ($ 1 234,54).
                    print("$ " . number_format($producto['precio'], 2, ',', '.'));
                } else {
                    // En Chile imprimo el precio sin decimales y con separador de miles ($ 1 234).
                    print("$ " . number_format($producto['precio'], 0, ',', '.'));
                }

                print ("</span>");
                ?>
            </td>
			<td style="white-space: nowrap;">
                <?
                if ($producto['precio_minorista'] != 0)
                    if ($producto['sin_stock_minorista']) {
                        print('<span style="color:#FFFFFF;background-color:#cc3300;">');
                    } else {
                        print ("<span>");
                    }
                if (CONSTANTE_PAIS == 'Argentina') {
                    // En Argentina imprimo el precio con decimales ($ 1 234,54).
                    print("$ " . number_format($producto['precio_minorista'], 2, ',', '.'));
                } else {
                    // En Chile imprimo el precio sin decimales y con separador de miles ($ 1 234).
                    print("$ " . number_format($producto['precio_minorista'], 0, ',', '.'));
                }
                print ("</span>");
                ?>
            </td>
			<td style="white-space: nowrap;">
                <?
                if ($producto['precio_mayorista'] != 0)
                    if ($producto['sin_stock_mayorista']) {
                        print('<span style="color:#FFFFFF;background-color:#cc3300;">');
                    } else {
                        print ("<span>");
                    }
                if (CONSTANTE_PAIS == 'Argentina') {
                    // En Argentina imprimo el precio con decimales ($ 1 234,54).
                    print("$ " . number_format($producto['precio_mayorista'], 2, ',', '.'));
                } else {
                    // En Chile imprimo el precio sin decimales y con separador de miles ($ 1 234).
                    print("$ " . number_format($producto['precio_mayorista'], 0, ',', '.'));
                }
                print ("</span>");
                ?>
            </td>
            <td><?= $producto['codigo'] ?></td>
            <td><a href="index.php?module=productos_alta&id=<?= $producto['id'] ?>" ><img src="../admin/imagenes/icon-pencil.gif" title="Modificar" alt="Modificar" /></a></td>
            <td>
                <a href="javascript:confirmDelete(<?= $producto['id'] ?>)"><img src="../admin/imagenes/icon-delete.gif" title="Borrar" alt="Borrar" /></a>
            </td>
        </tr>
    <? } ?>

</table>

<? include(TPL_FOLDER . "tpl.admin_global_abajo.php"); ?>