<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>
<script language="jscript" type="text/javascript">
</script>
<h4>Importaci&oacute;n de clientes mayoristas y minoristas</h4>

<?php foreach($errores as $error) { ?>
<span style="color:red"><?php echo $error?></span><br/>
<?php } ?>

<strong>Clientes actualizados e insertados:</strong> <?php echo $resultado['OK'] ?><br/>
<strong>Errores en el archivo:</strong> <?php echo sizeof($resultado['Error']) ?><br/>
<?php foreach($resultado['Error'] as $nroLinea=>$error) { ?>
L&iacute;nea <?php echo $nroLinea?>: <?php echo $error?><br/>
<?php } ?>

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>