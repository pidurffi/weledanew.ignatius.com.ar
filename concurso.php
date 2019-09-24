<?php
$title = "Concurso";
$seccion = "clientes";
$actual = "grupoweledaimagenes";
$destacado_col_izq = "0";
$color = "";

$recorrido = array();
$recorrido[] = array("nombre"=>"Inicio","link"=>"index.php");


include("tpl/tpl.front_template_arriba.php");?>

	
	<object type="application/x-shockwave-flash" data="/imagenes/contenido/juegoOctubre2010_V2.swf" width="530" height="589">

		<param name="movie" value="/imagenes/contenido/juegoOctubre2010_V2.swf" />
		<param name="width" value="530" />
		<param name="height" value="589 />

	</object>
	
  
<? include($_SERVER['DOCUMENT_ROOT']."/inc/inc.template_abajo.php");?>