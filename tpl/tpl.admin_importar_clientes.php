<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>
<h4>Importaci&oacute;n de clientes mayorista y minoristas</h4>

<h5>Los archivos se deben colocar en la carpeta ftp_folder/clientes.</h5>

<?php foreach($errores as $error) { ?>
<span style="color:red"><?php echo $error?></span><br/>
<?php } ?>

<?php if(empty($errores)) { ?>
	<h3>Elija el archivo</h3>
	<?php foreach($archivos as $archivo) { ?>
		<?php echo $archivo?> <a href="?module=<?php echo $_GET['module']?>&amp;task=import&file=<?php echo $archivo?>">IMPORTAR</a></a><br/>
	<?php } ?>
<?php } ?>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>