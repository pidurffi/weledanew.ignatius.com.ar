<?php
$title = "Nuevos productos";
//$seccion = "grupoweleda";
//$archivoMenuIzq = $_SERVER['DOCUMENT_ROOT']."/inc/inc.columna_izquierda_$seccion.php";
$actual = "nuevosproductos";
$destacado_col_izq = "0";
$color = "";

/*
$recorrido = array();
$recorrido[] = array("nombre"=>"Inicio","link"=>"index.php");
$recorrido[] = array("nombre"=>"Grupo Weleda","link"=>"grupoweledafilosofia.php");
*/

include("tpl/tpl.front_template_arriba.php");?>

<h3 style="font-size: 22px; font-family: 'neo sans medium', Arial, Helvetica, sans-serif; padding:0px; margin:0 0 10px 0; color: #3e0b0e; margin-bottom:5px; margin-left:-2px;">Cuidado para uñas</h3>

<br />

   <div class="item_menu_productos impar  " style="background-image:url('/imagenes/contenido/fdo-cui-corporales.jpg');">
			<div class="texto">
                            <a href="index.php?module=fr_producto&amp;id=165&amp;id_linea=8&amp;id_familia=1">Lápiz para suavizar cutículas</a>
				<p>Suaviza y ayuda a eliminar suavemente las cutículas sobrantes</p>
			</div>
			<div class="fdo_imagen"><a href="index.php?module=fr_producto&amp;id=165&amp;id_linea=8&amp;id_familia=1"><img src="imagenes/productos/1_lapiz_cuticulas.jpg"></a></div>
		</div>
				
		<div class="item_menu_productos" style="background-image:url('/imagenes/contenido/fdo-cui-corporales.jpg');">
			<div class="texto">
                            <a href="index.php?module=fr_producto&amp;id=166&amp;id_linea=8&amp;id_familia=1">Pincel para el Cuidado de Uñas</a>
				<p>Protege y cuida intensivamente uñas y cutículas</p>
			</div>
			<div class="fdo_imagen"><a href="index.php?module=fr_producto&amp;id=166&amp;id_linea=8&amp;id_familia=1"><img src="imagenes/productos/1_pincel_unas.jpg"></a></div>
		</div>
		
		<? /*
		<div class="item_menu_productos impar" style="background-image:url('/imagenes/contenido/fdo-cui-corporales.jpg');">
			<div class="texto">
                            <a href="index.php?module=fr_producto&amp;id=110&amp;id_linea=8&amp;id_familia=1">Crema de manos regeneradora de Granada</a>
				<p>Cuidado antioxidante</p>
			</div>
			<div class="fdo_imagen"><a href="index.php?module=fr_producto&amp;id=110&amp;id_linea=8&amp;id_familia=1"><img src="imagenes/productos/0_crema_regeneradora_granada.jpg"></a></div>
		</div>
	   */ ?>
    
  
<? include("tpl/tpl.front_template_abajo.php"); ?>