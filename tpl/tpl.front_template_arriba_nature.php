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
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= (isset($title) ? utf8_encode('Weleda - ' . $title) : 'Weleda'); ?></title>
        
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"
		>
		<!-- styles -->
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
		<link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
		<link rel="stylesheet" href="../css/owl.theme.default.min.css" type="text/css">
		<!-- Fontawesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<!-- JS -->
		<script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>
		<script type="text/javascript" src="../js/owl.carousel.min.js"></script>
		<script type="text/javascript" src="../js/functions.js"></script>
		
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

		<!-- promo-top -->
	  <div class="promo-top">
		<a class="promo-top__link" href="">Free Face Trial Duo - Plus, Free Shipping With $50</a>
	  </div>
		
		<!-- header -->
  <header class="header">
    <a href="/" class="logo">
      <image src="images/weleda-logo.svg" width="130" height="24" alt="Logo"></image>
    </a>
    <nav class="nav">
      <ul class="nav__list">
        <li class="nav__list__item">
          <a class="nav__list__item__link --with-sub-nav" href="./index.php?module=fr_productos">Productos</a>
          <ul class="sub-nav">
			<?php	// Menú de familias
				$i = 0;
				if(isset($familias)) foreach($familias as $familia) {
					$i++;
			?>
				<li class="sub-nav__item">
					<a href="index.php?module=fr_familia&id=<?=$familia["id"]?>" class="sub-nav__item__link"><?=utf8_encode($familia["nombre"])?></a>
				</li>
			<?php }	// Fin menú familias ?>
          </ul>
        </li>
        <li class="nav__list__item">
          <a class="nav__list__item__link --with-sub-nav" href="puntosdeventa.php">Puntos de Venta</a>
          <ul class="sub-nav">
            <li class="sub-nav__item">
              <a href="" class="sub-nav__item__link">Farmacia Belladona</a>
            </li>
            <li class="sub-nav__item">
              <a href="" class="sub-nav__item__link">Otros puntos de venta</a>
            </li>
            <li class="sub-nav__item">
              <a href="javascript:abrirCarrito()" class="sub-nav__item__link">E-shop</a>
            </li>
            <li class="sub-nav__item">
              <a href="" class="sub-nav__item__link">Distribuidores mayoristas</a>
            </li>
          </ul>
        </li>
        <li class="nav__list__item">
          <a class="nav__list__item__link" href="medicina.php">Medicina</a>
        </li>
        <li class="nav__list__item">
          <a class="nav__list__item__link" href="grupoweledafilosofia.php">Grupo Weleda</a>
        </li>
        <li class="nav__list__item">
          <a class="nav__list__item__link" href="">Actualidad Weleda</a>
        </li>
      </ul>
    </nav>
  </header>
