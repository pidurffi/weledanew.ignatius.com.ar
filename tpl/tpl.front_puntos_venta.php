<?php

/* Creado por Adrián - 11/11/08 */

include_once(GALIX_FOLDER."class.MenuSimpleLevel.php");

$leftMenu = new MenuSimpleLevel(array());



foreach($list as $puntos_venta) {

	$leftMenu->insertElement(htmlentities($puntos_venta["nombre"]),"index.php?module=fr_puntos_venta&id=".$puntos_venta["id"]);

}
/*
$leftMenu->insertElement("Novedades","#");

$leftMenu->insertElement("Cuidados para mam&aacute; y el beb&eacute;","#");
*/


$seccion = "puntos_venta";

$actual = "puntos_venta";



include(TPL_FOLDER."tpl.front_template_arriba.php"); ?>

	<div class="tit_contenido productos">

    	<h4>Puntos de venta</h4>

    </div>

    <? $i = 0; 

    foreach($list as $puntos_venta) {

    	$i++; 

    ?>

	    <div class="item_menu_productos <?=($i%2)?"impar":""?>">

	    	<div class="texto">

	        	<a href="index.php?module=fr_puntos_venta&id=<?=$puntos_venta["id"]?>"><?=htmlentities($puntos_venta["nombre"])?></a>

	        </div>

	    	<div class="fdo_imagen"><a href="index.php?module=fr_puntos_venta&id=<?=$puntos_venta["id"]?>"><img src="imagenes/productos/<?=$puntos_venta["foto_listado"]?>" /></a></div>

	    </div>

    <? } ?>


<? include(TPL_FOLDER."tpl.front_template_abajo.php"); ?>

