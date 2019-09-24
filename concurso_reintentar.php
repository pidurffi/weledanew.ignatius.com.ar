<?php
$title = "Concurso";
$seccion = "clientes";
$actual = "grupoweledaimagenes";
$destacado_col_izq = "0";
$color = "";

$recorrido = array();
$recorrido[] = array("nombre"=>"Inicio","link"=>"index.php");


include("tpl/tpl.front_template_arriba.php");?>

	
<h3>Tus respuestas no son correctas. <a href="concurso.php">Volver a intentar</a>.</h3>	

<br />

<h3><a href="index.php">Volver al inicio</a>.</h3>

  
<? include($_SERVER['DOCUMENT_ROOT']."/inc/inc.template_abajo.php");?>