<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>

<? function dibujar_item($item) { 
	if(!empty($item['link'])) { ?>
		<a href="<?=$item['link']?>">
	<? } ?>
	<?=$item['name'];
	if(!empty($item['link'])) { ?>
		</a> 
	<? } ?>

<? } ?>


Home principal 
<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>