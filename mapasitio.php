<?php
$title              = "Mapa del Sitio";
$seccion            = "mapasitio";
//$archivoMenuIzq = $_SERVER['DOCUMENT_ROOT']."/inc/inc.columna_izquierda_$seccion.php";
$actual             = "noticias";
$destacado_col_izq  = "0";
$color = "";
include("tpl/tpl.front_template_arriba_new.php");?>

<div class="w-content">
    <div class="container">
        <div class="title">
            Mapa del sitio
            <div class="site-map">
                <ul>
                    <li class="first"><a href="/index.php?module=fr_productos">Productos</a>
                        <ul>
                            <li class="second"><a href="/index.php?module=fr_familia&id=2">Cuidados Faciales</a>
                                <ul>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=3">Línea Iris</a></li>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=1">Línea Rosa Mosqueta</a></li>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=2">Línea Almendra</a></li>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=4">Línea Classic</a></li>
                                </ul>
                            </li>
                            <li class="second"><a href="/index.php?module=fr_familia&id=1">Cuidados Corporales</a>
                                <ul>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=6">Aceites Corporales</a></li>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=7">Leches Corporales</a></li>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=8">Cuidados Específicos</a></li>
                                </ul>
                            </li>
                            <li class="second"><a href="/index.php?module=fr_familia&id=4">Línea de baño y ducha</a>
                                <ul>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=10">Geles de ducha cremosos</a></li>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=11">Jabones Vegetales</a></li>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=12">Baños de Escencia</a></li>
                                </ul>
                            </li>
                            <li class="second"><a href="/index.php?module=fr_familia&id=5">Cuidados Capilares</a>
                                <ul>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=13">FitoShampoos</a></li>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=14">FitoAcondicionadores</a></li>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=15">Shampoos Tratantes</a></li>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=16">Tratamientos Capilares</a></li>
                                </ul>
                            </li>
                            <li class="second"><a href="/index.php?module=fr_familia&id=3">Cuidados Bucodentales</a></li>
                            <li class="second"><a href="/index.php?module=fr_familia&id=6">Línea de Desodorantes</a></li>
                            <li class="second"><a href="/index.php?module=fr_familia&id=7">Línea para hombres</a></li>
                            <li class="second"><a href="/index.php?module=fr_familia&id=8">Cuidados para Mamá y Bebé</a>
                                <ul>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=17">Línea bebé y niños</a></li>
                                    <li class="third"><a href="/index.php?module=fr_linea&id=18">Cuidados para el Embarazo</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="first"><a href="/medicina.php">Medicina</a>
                        <ul>
                            <li class="second"><a href="/antroposofia.php">Antroposofía y Homeopatía</a></li>
                            <li class="second"><a href="/procesos.php">Procesos farmaceúticos</a></li>
                            <li class="second"><a href="/salutogenesis.php">Salutogénesis</a></li>
                            <li class="second"><a href="/medicina_faq.php">Preguntas frecuentes</a></li>
                        </ul>
                    </li>
                    <li class="first"><a href="">Grupo Weleda</a>
                        <ul>
                            <li class="second"><a href="/grupoweledafilosofia.php">Filosofía</a></li>
                            <li class="second"><a href="/grupoweledahistoria.php">Historia</a></li>
                            <li class="second"><a href="/grupoweledacultivo.php">Cultivo biodinámico</a></li>
                            <li class="second"><a href="/grupoweledaresponsabilidad.php">Responsabilidad social y ambiental</a></li>
                            <li class="second"><a href="/grupoweledaimagenes.php">Weleda en imágenes</a></li>
                            <li class="second"><a href="/grupoweledatrabajar.php">Trabajar con nosotros</a></li>
                            <li class="second"><a href="/grupoweledainternacional.php">Weleda internacional</a></li>
                        </ul>
                    </li>
                    <li class="first"><a href="/farmaciabelladonasaavedra.php">Puntos de venta</a>
                        <ul>
                            <li class="second"><a href="http://www.farmaciabelladona.com.ar">Farmacia Belladona On Line</a></li>
                            <li class="second"><a href="/farmaciabelladonasaavedra.php">Belladona Saavedra</a></li>
                            <li class="second"><a href="/index.php?module=fr_puntos_venta_1">Otros puntos de venta</a></li>
                        </ul>
                    </li>
                    <li class="first"><a href="/index.php?module=fr_noticias">Noticias</a></li>
                    <li class="first"><a href="/index.php?module=fr_clientes_alta">Suscripción al Newsletter</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<? include("tpl/tpl.front_template_abajo_new.php"); ?>