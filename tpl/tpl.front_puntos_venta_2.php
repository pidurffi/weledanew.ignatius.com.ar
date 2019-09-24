<?php

/* Creado por Adrián - 11/11/08 */

include_once(GALIX_FOLDER."class.MenuSimpleLevel.php");

$leftMenu = new MenuSimpleLevel(array());

/*
$leftMenu->insertElement("Farmacia Belladona On Line","http://www.farmaciabelladona.com.ar");
$leftMenu->insertElement("Belladona Saavedra","farmaciabelladonasaavedra.php");
$leftMenu->insertElement("Belladona Recoleta","farmaciabelladonarecoleta.php");
$leftMenu->insertElement("Otros puntos de venta","index.php?module=fr_puntos_venta_1");
*/

foreach($regiones as $regionMenu) {
	$leftMenu->insertElement($regionMenu['nombre'],"index.php?module=fr_puntos_venta_2&id=".$regionMenu['id'],$regionMenu['id']==RequestHandler::getGetValue("id"));
}

$seccion = "puntos_venta";
$actual = "puntos_venta";
$title = "Otros puntos de venta - ".$region["nombre"];

$recorrido = array();
$recorrido[] = array("nombre"=>"Inicio","link"=>"index.php");
$recorrido[] = array("nombre"=>"Puntos de venta","link"=>"index.php?module=fr_puntos_venta_1");

include(TPL_FOLDER."tpl.front_template_arriba.php"); ?>

	<div class="tit_contenido <?=$actual;?>">

		<h4>Puntos de venta</h4>

	</div>

	<h3><?=$region["nombre"]?></h3>

	<ul class="puntos_venta">
	<?
	foreach($subregiones as $subregion)
	{
	?>
	<li>
		<a href="index.php?module=fr_puntos_venta_3&id=<?=$subregion['id']?>&id_region=<?=$region["id"]?>">
			<h4><?=$subregion["nombre"];?></h4>
		</a>
	</li>
	<?
	}
	?>
	</ul>
	<a href="javascript:history.back(1)">Volver</a>







<? include(TPL_FOLDER."tpl.front_template_abajo.php"); ?>

