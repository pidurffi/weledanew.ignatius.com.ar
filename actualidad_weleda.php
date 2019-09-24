<?php
$seccion = "actualidad";
$archivoMenuIzq = "./inc/inc.columna_izquierda_$seccion.php";
$actual = "actualidad";
$destacado_col_izq = "0";
$color = "";
include("tpl/tpl.front_template_arriba.php");?>

	<div class="contenido_actualidad clearfix">

	<div class="tit_seccion">
		<h3></h3>
    </div>
	<div class="tit_contenido <?=$actual;?>" >
    	<h4>Medicina Antroposófica</h4>
    </div>
    <h5></h5>
       
    <div class="item_menu_productos impar">
    
    	<div class="texto">
        	<a href="/index.php?module=fr_noticias&seccion=1">Noticias</a>
        </div>
        
        <div class="fdo_imagen">
        	<a href="/index.php?module=fr_noticias&seccion=1"><img src="imagenes/estructura/actualidad/icono_noticias.jpg" /></a>
        </div>
    
    </div>
    
    <div class="item_menu_productos">
    
    	<div class="texto">
        	<a href="/index.php?module=fr_noticias&seccion=2">Prensa</a>
        </div>
        
        <div class="fdo_imagen">
        	<a href="/index.php?module=fr_noticias&seccion=2"><img src="imagenes/estructura/actualidad/icono_prensa.jpg" /></a>
        </div>
    
    </div>
    
    </div>
    
<? include("tpl/tpl.front_template_abajo.php"); ?>