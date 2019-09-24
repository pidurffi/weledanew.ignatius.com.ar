<!DOCTYPE html>


<?php
$class_body = '';
include_once("./specification/variables.php");
?>

<html lang="en">

    <head>
        
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NR2RW7L');</script>
        <!-- End Google Tag Manager -->

<?php
        if (!isset($inicio)) {
            $inicio = 0;
        }

        if (!isset($destacado_col_izq)) {
            $destacado_col_izq = 0;
        }
        if (!isset($color)) {
            $color = 0;
        }
?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= (isset($title) ? utf8_encode('Weleda - ' . $title) : 'Weleda'); ?></title>
        <!-- CSS -->
        <link href="stylesheets/owl.carousel.min.css" media="screen, projection" rel="stylesheet" type="text/css" />
        <link href="stylesheets/owl.theme.default.min.css" media="screen, projection" rel="stylesheet" type="text/css" />
        <link href="stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <!--<link href="stylesheets/fonts.css" media="screen, projection" rel="stylesheet" type="text/css" />-->
        <!-- FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Titillium+Web:200,300,400,600,700" rel="stylesheet">
        <!-- JS -->
        <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
        <script src="https://use.fontawesome.com/ef0291fe49.js"></script>
        <meta name="Nombre" content="Weleda" />
        <meta name="abstract" content="Weleda" />
		
		<?php
		if (isset($actual))
		{
			switch ($actual) {
				case "producto":
				case "producto_suelto":
					echo '<meta name="keywords" content="'. utf8_encode($producto['meta_keywords']) .'" />';
					echo '<meta name="description" content="'. utf8_encode($producto['meta_description']) .'" />';
					echo '<meta name="title" content="'. utf8_encode($producto['meta_title']) .'" />';
					break;
				case "linea":
					echo '<meta name="keywords" content="'. utf8_encode($entity['meta_keywords']) .'" />';
					echo '<meta name="description" content="'. utf8_encode($entity['meta_description']) .'" />';
					echo '<meta name="title" content="'. utf8_encode($entity['meta_title']) .'" />';
					break;
				case "familia":
					echo '<meta name="keywords" content="'.utf8_encode( $entity['meta_keywords']) .'" />';
					echo '<meta name="description" content="'. utf8_encode($entity['meta_description']) .'" />';
					echo '<meta name="title" content="'. utf8_encode($entity['meta_title']) .'" />';
					break;
				default:
					echo '<meta name="keywords" content="Weleda" />';
					echo '<meta name="description" content="Weleda" />';
					echo '<meta name="title" content="Weleda" />';
			}
		}
		else
		{
			echo '<meta name="keywords" content="Weleda" />';
			echo '<meta name="description" content="Weleda" />';
			echo '<meta name="title" content="Weleda" />';
		}
		?>
		
		
        <meta name="distribution" content="Global" />
        <meta name="identifier-url" content="http://www.weleda.com.ar" />
        <meta name="rating" content="general" />
        <meta name="author" content="www.ignatius.com.ar" />
        <meta name="reply-to" content="info@weleda.com.ar" />
        <meta name="robots" content="all" />
        <meta name="revisit-after" content="15 day" />

        <script type="text/javascript">
            function abrirCarrito() {
                ventana = window.open("index.php?module=fr_carrito_list","carrito","width=800,height=500,resizable=yes,scrollbars=yes");
                ventana.focus();
            }
        </script>
<?php

if (isset($actual) AND ($actual == "producto" OR $actual == "producto_suelto" OR $actual == "productos" OR $actual=="linea" OR $actual=="familia")) {
    $class_body = 'class= "int" ';
    // Pego c�digo de Facebook si estoy en la p�gina de producto.
    // Con "link rel" se elige el thumbnail que mostrar� Facebook.
?>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <? if(isset($producto)){ ?><link rel="image_src" href="http://www.weleda.com.ar/imagenes/productos/<?= $producto["foto_listado"] ?>" /><? }?>
<?php
}

if (isset($actual) AND $actual == "noticias") {
    $class_body = 'class= "int" ';
    // Pego c�digo de Facebook si estoy en la p�gina de noticias. (Mismo c�digo para producto pero con una imagen diferente).
    // Con "link rel" se elige el thumbnail que mostrar� Facebook.
?>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <link rel="image_src" href="http://www.weleda.com.ar/imagenes/noticias/<?= $noticia["fotito"] ?>" />
<?php } ?>



    </head>
    <body class="fito-content int" <?= $class_body ?> >
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NR2RW7L"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <section class="intro">
            <header>
                <div class="container">
                    <div class="logo"></div>
                    <nav class="user-nav">
                        <ul>
                            <li>
                                <a href="/index.php?module=fr_clientes_alta" title="Suscríbete">Suscríbete</a>
                            </li>
                            <li>
                                <a href="javascript:abrirCarrito()" title="Iniciar sesión">Iniciar sesión</a>
                            </li>
                        </ul>
                    </nav>
                    <nav class="main-nav">
                        <ul>
                            <li>
                                <a href="./index.php?module=fr_productos" title="Productos">Productos</a>
                            </li>
                            <li>
                                <a href="puntosdeventa.php" title="Puntos de Venta">Puntos de Venta</a>
                            </li>
                            <li>
                                <a href="medicina.php" title="Medicina">Medicina</a>
                            </li>
                            <li>
                                <a href="grupoweledafilosofia.php" title="Grupo Weleda">Grupo Weleda</a>
                            </li>
                            <li>
                                <? if (CONSTANTE_PAIS == 'Argentina')
                                    print('<a href="/index.php?module=fr_noticias&seccion=1">Actualidad Weleda</a>');
                                ?>
                                <? if (CONSTANTE_PAIS == 'Chile')
                                    print('<a href="/noticias.php">Noticias</a>');
                                ?>
                            </li>
                        </ul>
                    </nav>
<?php
if (isset($actual) AND ($actual == "producto" OR $actual == "producto_suelto" OR $actual == "productos" or $actual=="noticias")) {
    //var_dump($familias);
    $i = 0;
?>
                    <nav class="sub-nav">
                        <ul>
<?php
    if(isset($familias)) foreach($familias as $familia) {
        $i++;
?>
        <li><a href="index.php?module=fr_familia&id=<?=$familia["id"]?>"><?=htmlentities($familia["nombre"])?></a></li>
<?php
    }
?>
                        </ul>
                    </nav>
<?php
}
?>

                    <div class="search">
                        <form style="" action="index.php" enctype="multipart/form-data" method="get" name="formBuscador">
                            <input type="hidden" value="fr_buscador" name="module">
                            <input type="text" placeholder="Buscar"  name="b" id="b">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </form>
                    </div>
                    <i class="fas fa-bars mobile-nav-button"></i>
                </div>
            </header>
<?php if($inicio == 1) {
//    var_dump($entity);
    ?>
            <div class="item-intro one">
                <img src="images/home/slider/intro-001.jpg">
                <footer style="background-image: url(/imagenes/home/<?=$entity['imagen_footer']?>);">
                    <div class="container">
                        <div class="product-wrapper">
                            <div class="product-item">
                                <?php if(!empty($entity['imagen_flotante'])){ ?>
                                <img src="imagenes/home/<?= $entity['imagen_flotante']?>" alt="">
                                <span></span>
                                <?php }?>
                            </div>
<!--                            <a href="https://www.weledaglobalgarden.com/arg" class="more">Inscribite Acá</a>-->
                            <?php if(!empty($entity['link_botton_banner'])){?>
                                <a href="<?=$entity['link_botton_banner']?>" class="more" <? if($entity['nueva_ventana_link_botton_banner']) echo 'target=_blank'?>><?=utf8_encode($entity['texto_link_botton_banner'])?></a>
                            <?php }?>
                        </div>
                        <div class="product-name">
                            <?php if(!empty($entity['titulo_banner_1'])){?>
                                <span class="name"><?=html_entity_decode($entity['copete_banner_1'])?></span>
                            <?php }else{?>
                                <span class="name">&nbsp;</span>
                            <?php }?>


                                <span class="description">
                                    <?php if(!empty($entity['copete_banner_1'])){?><?=html_entity_decode($entity['copete_banner_1'])?><?php }else{?>&nbsp;<?php }?>
                                    <?php if(!empty($entity['copete_banner_2'])){?><br/><?=html_entity_decode($entity['copete_banner_2'])?><?php }else{?>&nbsp;<?php }?>
                                </span>


                        </div>
                        <nav class="social-nav">
                            <span>Siguenos en</span>
                            <ul>
                                <li>
                                    <a href="http://www.facebook.com/weledaargentina" title="facebook"><i
                                            class="fa fa-facebook"></i></a>
                                </li>
<!--                                <li>-->
<!--                                    <a href="https://twitter.com/weleda?lang=es" title="twitter"><i class="fa fa-twitter"></i></a>-->
<!--                                </li>-->
                                <li>
                                    <a href="https://www.instagram.com/weledaarg" title="instagram"><i
                                            class="fa fa-instagram"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="slider-controls">
                        <ul>
                            <li><span class="active"></span></li>
                            <li><span></span></li>
                            <li><span></span></li>
                            <li><span></span></li>
                            <li><span></span></li>
                        </ul>
                    </div>
                </footer>
                <div class="fito-footer">
                    <p>&iexcl;Probá nuestros nuevos Cuidados Capilares! Elaborados para el consumidor consciente, reestablecen la salud y belleza del cuero cabelludo y cabello con la mejor calidad natural certificada.</p>
                </div>
            </div>
<?php
}
?>


<?php

if ($inicio != "1") {
    if(isset($actual)){
        switch ($actual){
            case "producto":
                break;
            case "producto_suelto":
                break;
            case "noticias":
            case "productos": ?>
                <div class="banner-interna">
                    <img src="images/banner-interna/001.jpg" alt="">
                </div>
<?php           break;
            case "familia":
            case "linea": ?>
                <div class="banner-interna">
                    <img src="imagenes/productos/<?=$entity["foto"]?>" alt="<?= utf8_encode($entity["nombre"]) ?>">
                </div>
<?php           break;
        }
    }
?>
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <? if (!empty($recorrido))
                        foreach ($recorrido as $key => $miga) {
                    ?>
                        <li>
                            <a href="<?= $miga['link'] ?>"><?=$miga['nombre']?>
                                <?      if ($key < sizeof($recorrido) - 1) echo " &gt; "; ?>
                            </a>
                        </li>
                    <? } ?>
                </ul>
            </div>
        </div>
<?php
}
?>
</section>




