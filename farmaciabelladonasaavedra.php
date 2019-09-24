<?php
$title              = "Farmacia Belladonna Saavedra";
$seccion            = "farmaciasbelladona";
$archivoMenuIzq     = $_SERVER['DOCUMENT_ROOT'] . "/inc/inc.columna_izquierda_$seccion.php";
$actual             = "noticias";
$destacado_col_izq  = "0";
$color              = "";

include("tpl/tpl.front_template_arriba_new.php");
?>
    <div class="w-content">
        <div class="container">
            <div class="nav-noticias">
                <ul>

                    <li><a href="farmaciabelladonasaavedra.php" title="Belladona Saavedra" class='destacado' style='font-weight:bold;'>Belladona Saavedra</a></li>
                    <li><a href="index.php?module=fr_puntos_venta_ch" title="Otros puntos de venta">Otros puntos de venta</a></li>
                    <li><a href="javascript:abrirCarrito()" title="E-shop">E-shop</a></li>
                    <li><a href="distribuidoresmayoristas.php" title="Distribuidores mayoristas">Distribuidores mayoristas</a></li>
                </ul>
            </div>
            <div class="title">
                <h3>Farmacia Belladona Saavedra</h3>
            </div>
            <div class="r-img row">
                <div class="col-sm-2">
                    <img src="imagenes/estructura/farmacias/farmacia_saavedra.jpg" />
                    <p>Ramallo 2568, Saavedra, Buenos Aires, Argentina.<br />
                        Tel. 4704 - 4700<br />
                        Fax 4702 - 1961
                    </p>
                </div>
                <div class="col-sm-10">
                    <p>Es la primera cadena de farmacias en la Argentina especializada en Medicinas Complementarias y productos para el bienestar. El objetivo de las Farmacias Belladona es establecer un nexo entre el paciente y el médico, ofreciendo la mejor calidad en Preparados magistrales y atención personalizada.</p>

                    <p>Desde 1920 somos líderes mundiales en la preparación de Preparados Antroposóficos que impulsan la actividad del sistema inmunológico . Para garantizar la calidad de los preparados, utilizamos extractos de cultivos biodinámicos de nuestros campos en la localidad de Derqui, Buenos Aires y Villa Berna, en Córdoba.</p>

                    <p>Para la elaboración de fórmulas magistrales de Alopatía, Homeopatía, Antroposofía, florales, inyectables, colirios, contamos con un  laboratorio, recientemente reciclado con tecnología de última generación, con características únicas en su género.<br />
                        Contamos con un área estéril para la elaboración de inyectables.</p>

                    <p>También disponemos de las mejores líneas internacionales de dermocosméticas y cosmética natural, amplia variedad de libros sobre Educación y prevención de la Salud, productos Stockmar - importados en forma exclusiva - utilizados en Colegios de Pedagogía Waldorf.</p>
                </div>
            </div>

            <div class="r-img row">
                <div class="col-sm-2">
                    <img src="imagenes/estructura/farmacias/local_saavedra.jpg" />
                </div>
                <div class="col-sm-10">
                    <p>El horario de atención es de<br />
                        Lunes a viernes 9 a 13 y 16 a 20 hs. De 13 a 16 hs atendemos por ventanilla.<br />
                        Sábados de 9 a 13.</p>
                </div>
            </div>
        </div>
    </div>
<? include("tpl/tpl.front_template_abajo_new.php"); ?>