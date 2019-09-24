<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>
<script language="jscript" type="text/javascript">
</script>
<h4>Importaci&oacute;n de maestro de productos</h4>

<?php foreach($errores as $error) { ?>
<span style="color:red"><?php echo $error?></span><br/>
<?php } ?>

<strong>Productos actualizados correctamente:</strong> <?php echo $resultado['OK'] ?><br/>
<strong>Productos no actualizados :</strong> <?php echo $resultado['Faltan'] ?><br/>
<strong>Errores en el archivo:</strong> <?php echo sizeof($resultado['Error']) ?><br/>
<?php foreach($resultado['Error'] as $nroLinea=>$error) { ?>
L&iacute;nea <?php echo $nroLinea?>: <?php echo $error?><br/>
<?php } ?>


<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>