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
				<p>Rodr�guez Pe�a 1541, Recoleta,<br />
Buenos Aires, Argentina.<br />
Tel 4816-9066,<br />
Fax 4816 - 9166
</p>
            </div>
        </div>
        <div class="texto">
            <p>Desde 1920 somos l�deres mundiales en la preparaci�n de Preparados Antropos�ficos que impulsan la actividad del sistema inmunol�gico . Para garantizar la calidad de los preparados, utilizamos extractos de cultivos biodin�micos de nuestros campos en la localidad de Derqui, Buenos Aires y Villa Berna, en C�rdoba.</p>

<p>Para la elaboraci�n de f�rmulas magistrales de Alopat�a, Homeopat�a, Antroposof�a, florales, inyectables, colirios, contamos con un  laboratorio, recientemente reciclado con tecnolog�a de �ltima generaci�n, con caracter�sticas �nicas en su g�nero. Contamos con un �rea est�ril para la elaboraci�n de inyectables.</p>

<p>Tambi�n disponemos de las mejores l�neas internacionales de dermocosm�ticas y cosm�tica natural, amplia variedad de libros sobre Educaci�n y prevenci�n de la Salud, productos Stockmar - importados en forma exclusiva - utilizados en Colegios de Pedagog�a Waldorf.</p>
        </div>
    </div>
    <div class="bloque_texto_contenido clearfix">
        <div class="imagen">
        	<img src="imagenes/estructura/farmacias/farmacia_recoleta.jpg" />
        </div>
        <div class="texto">
        	<p>Es la primera cadena de farmacias en la Argentina especializada en Medicinas Complementarias y productos para el bienestar. El objetivo de las Farmacias Belladona es establecer un nexo entre el paciente y el m�dico, ofreciendo la mejor calidad en Preparados magistrales y atenci�n personalizada.</p>
        </div>
    </div>
<? include($_SERVER['DOCUMENT_ROOT']."/inc/inc.template_abajo.php");?>