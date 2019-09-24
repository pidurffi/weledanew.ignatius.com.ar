<?php
$title              = "Im&aacute;genes";
$seccion            = "grupoweleda";
$actual             = "noticias";
$destacado_col_izq  = "0";
$color              = "";

$recorrido      = array();
$recorrido[]    = array("nombre"=>"Inicio","link"=>"index.php");
$recorrido[]    = array("nombre"=>"Grupo Weleda","link"=>"grupoweledafilosofia.php");

include("tpl/tpl.front_template_arriba_new.php");?>

    <div class="products-nav">
        <div class="container">
            <div class="nav-noticias">
                <ul>

                    <li><a href="grupoweledafilosofia.php">Filosofía</a></li>

                    <li><a href="grupoweledahistoria.php">Historia</a></li>

                    <li><a href="grupoweledacultivo.php">Cultivo biodinámico</a></li>

                    <li><a href="grupoweledaresponsabilidad.php">Responsabilidad social y ambiental</a></li>

                    <li><a href="grupoweledaimagenes.php" class='destacado' style='font-weight:bold;'>Weleda en imágenes</a></li>

                    <li><a href="grupoweledatrabajar.php">Trabajar con nosotros</a></li>

                    <li><a href="grupoweledainternacional.php">Weleda internacional</a></li>

                </ul>
            </div>
            <div class="title">
                <h3>Grupo Weleda - Weleda en imágenes</h3>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="item">
                        <div class="image">
                            <img src="imagenes/contenido/weleda_imagenes/icono_video1.jpg" />
                        </div>
                        <div class="text">
                            <a href="imagenes/contenido/weleda_imagenes/videos/rudolf.avi" target="_blank">Los orígenes de Weleda</a>
                            <span>Conoce como nació Weleda</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="item">
                        <div class="image">
                            <img src="imagenes/contenido/weleda_imagenes/icono_video2.jpg" />
                        </div>
                        <div class="text">
                            <a href="imagenes/contenido/weleda_imagenes/videos/Capitulo6BIEN.avi" target="_blank">El huerto biodinámico</a>
                            <span>Descubre el huerto diodinámico más grande de Europa</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="item">
                        <div class="image">
                            <img src="imagenes/contenido/weleda_imagenes/icono_video3.jpg" />
                        </div>
                        <div class="text">
                            <a href="imagenes/contenido/weleda_imagenes/videos/Capitulo4BIEN.avi" target="_blank">Materias primas</a>
                            <span>Materias primas de la más alta calidad</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="item">
                        <div class="image">
                            <img src="imagenes/contenido/weleda_imagenes/icono_video4.jpg" />
                        </div>
                        <div class="text">
                            <a href="imagenes/contenido/weleda_imagenes/videos/Capitulo5BIEN.avi" target="_blank">Comercio justo</a>
                            <span>En armonía con el ser humano</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="item">
                        <div class="image">
                            <img src="imagenes/contenido/weleda_imagenes/icono_video5.jpg" />
                        </div>
                        <div class="text">
                            <a href="imagenes/contenido/weleda_imagenes/videos/Capitulo9BIEN.avi" target="_blank">Crema facial de Caléndula</a>
                            <span>Los mejores ingredientes para tu bebé</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="item">
                        <div class="image">
                            <img src="imagenes/contenido/weleda_imagenes/icono_video6.jpg" />
                        </div>
                        <div class="text">
                            <a href="imagenes/contenido/weleda_imagenes/videos/Capitulo10BIEN.avi" target="_blank">Medicamento antroposófico</a>
                            <span>Conoce los procesos farmacéuticos de Weleda a través de la malaquita</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

<? include("tpl/tpl.front_template_abajo_new.php"); ?>