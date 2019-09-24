<?php
$title = "Farmacia Belladonna Recoleta";
$seccion = "farmaciasbelladona";
$archivoMenuIzq = $_SERVER['DOCUMENT_ROOT']."/inc/inc.columna_izquierda_$seccion.php";
$actual = "noticias";
$destacado_col_izq = "0";
$color = "";
include("tpl/tpl.front_template_arriba.php");?>

	<div class="tit_seccion">
		<h3></h3>
    </div>
	<div class="tit_contenido <?=$actual;?>" >
    	<h4>Farmacias Belladona</h4>
    </div>
    <div class="bloque_texto_contenido clearfix">
    	<div class="imagen">
        	<img src="imagenes/estructura/farmacias/local_recoleta.jpg" />
            <div style="color:#0066CC; font-size:10px; font-family:Verdana, Arial, Helvetica, sans-serif;">
				<p>Rodríguez Peña 1541, Recoleta,<br />
Buenos Aires, Argentina.<br />
Tel 4816-9066,<br />
Fax 4816 - 9166
</p>
            </div>
        </div>
        <div class="texto">
            <p>Desde 1920 somos líderes mundiales en la preparación de Preparados Antroposóficos que impulsan la actividad del sistema inmunológico . Para garantizar la calidad de los preparados, utilizamos extractos de cultivos biodinámicos de nuestros campos en la localidad de Derqui, Buenos Aires y Villa Berna, en Córdoba.</p>

<p>Para la elaboración de fórmulas magistrales de Alopatía, Homeopatía, Antroposofía, florales, inyectables, colirios, contamos con un  laboratorio, recientemente reciclado con tecnología de última generación, con características únicas en su género. Contamos con un área estéril para la elaboración de inyectables.</p>

<p>También disponemos de las mejores líneas internacionales de dermocosméticas y cosmética natural, amplia variedad de libros sobre Educación y prevención de la Salud, productos Stockmar - importados en forma exclusiva - utilizados en Colegios de Pedagogía Waldorf.</p>
        </div>
    </div>
    <div class="bloque_texto_contenido clearfix">
        <div class="imagen">
        	<img src="imagenes/estructura/farmacias/farmacia_recoleta.jpg" />
        </div>
        <div class="texto">
        	<p>Es la primera cadena de farmacias en la Argentina especializada en Medicinas Complementarias y productos para el bienestar. El objetivo de las Farmacias Belladona es establecer un nexo entre el paciente y el médico, ofreciendo la mejor calidad en Preparados magistrales y atención personalizada.</p>
        </div>
    </div>
<? include($_SERVER['DOCUMENT_ROOT']."/inc/inc.template_abajo.php");?>