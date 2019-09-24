<?php

/* Creado por Adrián - 11/11/08 */
include_once(GALIX_FOLDER."class.MenuSimpleLevel.php");

function despam($email) {
  $partA = substr($email,0, strpos($email,'@'));
  $partB = substr($email,strpos($email,'@'));
  $linkText = (func_num_args() == 2) ? func_get_arg(1) : $email;
  $linkText = str_replace('@', '<span class="nospam" style="{margin-right: .1em; margin-left: .1em;}">&#64;</span>', $linkText);
  return '<a href="e-mail" onClick=\'a="'.$partA.'";this.href="mail"+"to:"+a+"'.$partB.'";\'>'.$linkText.'</a>';
}

$leftMenu = new MenuSimpleLevel(array());

foreach($subregiones as $subregionMenu) {
	$leftMenu->insertElement($subregionMenu['nombre'],"index.php?module=fr_puntos_venta_3&id=".$subregionMenu['id']."&id_region=".$region["id"],$subregionMenu['id']==RequestHandler::getGetValue("id"));
}

$seccion = "puntos_venta";
$actual = "puntos_venta";
$title = "Otros puntos de venta - ".$region["nombre"]." - ".$subregion["nombre"];

$recorrido = array();
$recorrido[] = array("nombre"=>"Inicio","link"=>"index.php");
$recorrido[] = array("nombre"=>"Puntos de venta","link"=>"index.php?module=fr_puntos_venta_1");
$recorrido[] = array("nombre"=>$region['nombre'],"link"=>"index.php?module=fr_puntos_venta_2&id=".$region['id']);

include(TPL_FOLDER."tpl.front_template_arriba.php"); ?>

	<div class="tit_contenido <?=$actual;?>">

		<h4>Puntos de venta</h4>

	</div>

	<h3>
		<?=$region["nombre"]?>
		&nbsp;&nbsp;<img src="imagenes/estructura/dot.jpg"/>
		&nbsp;<?=$subregion["nombre"]?>
	</h3>

	<table border="0" cellpadding="2" cellspacing="0" style="font-size:12px;">
		<thead>
		</thead>
		<tbody>
	<? foreach($farmacias as $farmacia) { ?>
		<tr>
			<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal; padding-right:15px;padding-top:10px;"><img src="imagenes/estructura/dot.jpg"/><?=$farmacia['nombre'] ?></td>
			<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#939598; text-align:left;padding-top:10px;"><?=$farmacia['direccion'] ?></td>
			<?=($farmacia['mail']==""?"":"<tr><td></td><td style=\"padding-bottom:5px; font-size:10px;\">".despam($farmacia['mail'])."</td></tr>");?>
			<?=($farmacia['telefono']==""?"":"<tr><td></td><td style=\"padding-bottom:5px; font-size:10px;\">Tel.: ".$farmacia['telefono']."</td></tr>");?>
			<?=($farmacia['fax']==""?"":"<tr><td></td><td style=\"padding-bottom:5px; font-size:10px;\">Fax: ".$farmacia['fax']."</td></tr>");?>
			<?
				// Elimino "http://" de la URL de la farmacia, tanto para el texto que se muestra en pantalla, como para el link.
				// Luego al link se le agrega "http://" adelante.
			   $farmacia['web'] = str_replace("http://","",$farmacia['web']);
			?>
			<?=($farmacia['web']==""?"":"<tr><td></td><td style=\"padding-bottom:5px; font-size:10px;\">Web: <a href='http://".$farmacia['web']."' target='_BLANK'>".$farmacia['web']."</a></td></tr>");?>
		</tr>
	<? } ?>
	</tbody>
	<? /*
		<tfoot>
			<tr>
				<th colspan="4" align="left">Total: <?=sizeof($farmacias) ?></th>
			</tr>
		</tfoot>
	*/ ?>
	</table>
	<br />
	<a href="javascript:history.back(1)">Volver</a>
<? include(TPL_FOLDER."tpl.front_template_abajo.php"); ?>

