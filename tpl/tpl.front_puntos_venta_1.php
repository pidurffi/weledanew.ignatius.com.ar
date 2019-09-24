<?php

/* Creado por Adrián - 11/11/08 */

include_once(GALIX_FOLDER."class.MenuSimpleLevel.php");

$leftMenu = new MenuSimpleLevel(array());

$leftMenu->insertElement("Belladona Saavedra","farmaciabelladonasaavedra.php");
$leftMenu->insertElement("Otros puntos de venta","index.php?module=fr_puntos_venta_1",true);
$leftMenu->insertElement("E-shop","javascript:abrirCarrito()");


$seccion = "puntos_venta";
$actual = "puntos_venta";
$title = "Otros puntos de venta";

include(TPL_FOLDER."tpl.front_template_arriba.php"); ?>

	<div class="tit_contenido <?=$actual;?>">
		<h4>Puntos de venta</h4>
	</div>

	<?
	/*
	$ultima_region = "";
	$regiones = array();
	foreach($list as $subregion) {
		if($ultima_region != $subregion["region"]) {
			$ultima_region = $subregion["region"];
		}
		$regiones[$ultima_region][] = $subregion;
	}
	*/

	?>
	<ul class="puntos_venta">
	<?
	foreach($list as $region)
	{
	?>
	<li>

			<h4><a href="index.php?module=fr_puntos_venta_2&id=<?=$region['id']?>"><?=$region["nombre"];?></a></h4>

	</li>
	<?
	}
	?>
	<br />
		<a href="distribuidoresmayoristas.php" style="font-size:11px; font-weight:bold;color:#0066FF;text-decoration:none;">
			Distribuidores Mayoristas
		</a>
	<br />
	<br />
	</ul><a href="javascript:history.back(1)">Volver</a>


	<? /*

	$i = 0;
	foreach($regiones as $key=>$region) {
		$i++;
	?>
		<a href="index.php?module=fr_puntos_venta_2&id=<?=$key['id']?>">
			<h4><?=$key ?></h4>
		</a>

		<ul class="puntos_venta">
		<? foreach($region as $subregion) { ?>
			<li><a href="index.php?module=fr_puntos_venta_3&id=<?=$subregion['id']?>"><?=$subregion["nombre"] ?></a></li>
		<? } ?>
		</ul>

	<? } ?>

	*/ ?>

<? include(TPL_FOLDER."tpl.front_template_abajo.php"); ?>
