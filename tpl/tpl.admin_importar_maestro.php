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
<h4>Importaci&oacute;n de maestro de productos</h4>

<h5>Los archivos se deben colocar en la carpeta ftp_folder/maestro.</h5>
<h5>Se aconseja hacer una copia de la tabla Productos antes de realizar la importaci&oacute;n.</h5>

<?php foreach($errores as $error) { ?>
<span style="color:red"><?php echo $error?></span><br/>
<?php } ?>

<?php if(empty($errores)) { ?>
	<h3>Elija el archivo</h3>
	<?php foreach($archivos as $archivo) { ?>
		<?php echo $archivo?> <a href="?module=<?php echo $_GET['module']?>&amp;task=import&file=<?php echo $archivo?>"> IMPORTAR </a></a><br/>
	<?php } ?>
<?php } ?>


<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>