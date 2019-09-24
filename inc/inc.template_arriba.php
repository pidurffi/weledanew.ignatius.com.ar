<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <? if (!isset($inicio)) {
            $inicio = 0;
        } ?>

        <link href="/css/weleda.css.php" type="text/css" rel="stylesheet" />

        <link href="/css/dinamico.css.php?actual=<?= $actual; ?>" type="text/css" rel="stylesheet" />

        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <title>Weleda</title>

        <meta name="Nombre" content="Weleda" />

        <meta name="DC.Title" content="Weleda" />

        <meta http-equiv="title" content="Weleda" />

        <meta name="description" content="Weleda" />

        <meta name="abstract" content="Weleda" /> 

        <meta name="keywords" content="Weleda" />

        <meta name="distribution" content="Global" />

        <meta name="identifier-url" content="http://www.weleda.com.ar" />

        <meta name="rating" content="general" />

        <meta name="author" content="www.ignatius.com.ar" />

        <meta name="reply-to" content="info@weleda.com.ar" />

        <meta name="robots" content="all" />

        <meta name="revisit-after" content="15 day" />

        <?php /* Google Analytics */ ?>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-29628921-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>

    </head>

    <body>

        <div id="contenedor" class="clearfix">

            <div id="encabezado<?php if ($inicio == "1") { ?>_inicio<?php }; ?>">



                <h1>Bienvenidos a Weleda Argentina</h1>

                <div id="menu_principal">

                    <ul>

                        <li><a href="/index.php?module=fr_productos">Productos</a> |</li>

                        <li><a href="medicina.php">Medicina</a> |</li>

                        <li><a href="grupoweledafilosofia.php">Grupo Weleda</a> |</li>

                        <li><a href="farmaciabelladonasaavedra.php">Puntos de Venta</a></li>

                        <li><a href="index.php?module=fr_noticias&seccion=1">Actualidad Weleda</a></li>


                    </ul>

                </div>

                <div id="menu_iconos">

                    <ul>

                        <li><a class="inicio" href="/index.php">Inicio</a></li>

                        <li><a class="mapa" href="/mapasitio.php">Mapa del Sitio</a></li>

                        <li><a class="contacto" href="contacto.php">Contacto</a></li>

                        <? /*  oculto el Carrito y Buscar.
                          <li><a class="carrito" href="#">Carrito de Compras</a></li>
                          <li><a class="buscar" href="#">Buscar</a></li>
                         */ ?>

                    </ul>

                </div>

            </div>

<? if ($inicio != "1") { ?>

                <div id="columna_izquierda" class="clearfix">

                    <div class="menu_columna_izquierda">

    <? include("./inc/inc.columna_izquierda_$seccion.php"); ?>

                    </div>

                    <div class="fdo_columna_izquierda <?= $color; ?>"></div>

    <? if ($destacado_col_izq == "1") { ?> <? include("./inc/inc.destacado_col_izq_$actual.php"); ?> <?php }; ?>

                </div>

<? } ?>



            <div id="cuerpo<?php if ($inicio == "1") { ?>_inicio<?php }; ?>" class="clearfix">

<? if ($inicio != "1") { ?>

                    <div id="recorrido_sitio">

                    </div>

<? } ?>

                <div id="contenido<?php if ($inicio == "1") { ?>_inicio<?php }; ?>" class="clearfix">    