<?
$seccion = "clientes";
$actual = "sorteo2";
$title = "Sorteo - &iexcl;Gracias!";
include_once(GALIX_FOLDER."class.MenuSimpleLevel.php");
$leftMenu = new MenuSimpleLevel(array());
include(TPL_FOLDER."tpl.front_template_arriba.php"); ?>


<p style="font-size:14px;">
<strong>Gracias por participar. &iexcl;Mucha suerte!</strong>
</p>
<p><a href="index.php">Volver a la p&aacute;gina de inicio</a></p>
		<br />

<? include(TPL_FOLDER."tpl.front_template_abajo.php"); ?>