<?php

$seccion = "clientes";

$archivoMenuIzq = "./inc/inc.columna_izquierda_$seccion.php";

$actual = "grupoweledaimagenes";

$title = "Sorteo";

$destacado_col_izq = "0";

$color = "";



$recorrido = array();

$recorrido[] = array("nombre"=>"Inicio","link"=>"index.php");

$recorrido[] = array("nombre"=>"Grupo Weleda","link"=>"grupoweledafilosofia.php");



include("tpl/tpl.front_template_arriba.php");?>


<object type="application/x-shockwave-flash" data="/imagenes/sorteo.swf" width="530" height="600">
<param name="movie" value="/imagenes/sorteo.swf" />
		</object>



    





<? include("./inc/inc.template_abajo.php");?>