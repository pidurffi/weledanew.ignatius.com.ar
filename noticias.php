<?php
$title = "Noticias";
$seccion = "ingredientes";
$archivoMenuIzq = $_SERVER['DOCUMENT_ROOT']."/inc/inc.columna_izquierda_$seccion.php";
$actual = "ingredientes";
$destacado_col_izq = "0";
$color = "";
include("tpl/tpl.front_template_arriba.php");?>

	<div class="tit_seccion">
		<h3></h3>
    </div>
	<div class="tit_contenido <?=$actual;?>" >
    	<h4>Noticias</h4>
    </div>
    <p>NOTICIAS NOTICIAS NOTICIAS</p>
    <br /><br />
    <div class="bloque_texto_contenido ingredientes">
        <div class="imagen" style="width:90px; height:90px;">
        	<img src="imagenes/estructura/ingredientes/abedul.jpg" />
        </div>
        <div class="texto ingredientes">
        	<h4>Acerca del Abedul de las Noticias</h4>
            <p>Encontraron en la ciudad de Weledalandia un Abedul que tienen escritas noticias en sus hojas...</p>
        </div>
    </div>
<? include("tpl/tpl.front_template_abajo.php");?>
