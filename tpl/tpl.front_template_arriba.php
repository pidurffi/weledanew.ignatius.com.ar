<!DOCTYPE html>
<? include_once("./specification/variables.php"); ?>

<html>

    <head>


	
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NR2RW7L');</script>
	<!-- End Google Tag Manager -->


        <?
        if (!isset($inicio)) {
            $inicio = 0;
        }
        ?>

        <?
        if (!isset($destacado_col_izq)) {
            $destacado_col_izq = 0;
        }
        ?>

<?
if (!isset($color)) {
    $color = 0;
}
?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        <link href="index.php?module=fr_css" type="text/css" charset="UTF-8" rel="stylesheet" />
        <link href="index.php?module=fr_css_dinamico&actual=<?= $actual; ?>&id=<?= (isset($_GET["id"]) ? $_GET["id"] : 0); ?>" type="text/css" charset="UTF-8" rel="stylesheet" />
        
        <title><?= (isset($title) ? utf8_encode('Weleda - ' . $title) : 'Weleda'); ?></title>
        <meta name="Nombre" content="Weleda" />
        <meta name="DC.Title" content="Weleda" />
        <meta http-equiv="title" content="Weleda" />
        <meta name="description" content="Weleda" />
        <meta name="abstract" content="Weleda" />
        <meta name="keywords" content="Weleda" />
        <meta name="distribution" content="Global" />
        <meta name="identifier-url" content="https://www.weleda.com.ar" />
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
if (isset($actual) AND ($actual == "producto" OR $actual == "producto_suelto")) {
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
            <link rel="image_src" href="https://www.weleda.com.ar/imagenes/productos/<?= $producto["foto_listado"] ?>" />
<?php
}

if (isset($actual) AND $actual == "noticias") {
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
            <link rel="image_src" href="https://www.weleda.com.ar/imagenes/noticias/<?= $noticia["fotito"] ?>" />
<?php } ?>



    </head>
    <body>
    
    	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NR2RW7L"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	
        <div id="contenedor" class="clearfix">

            <div id="encabezado<?php if ($inicio == "1") { ?>_inicio<?php }; ?>">
                <h1>Bienvenidos a Weleda Argentina</h1>
                <div id="encabezado_izq" style="position: relative;">
					<a href="./"></a>
					<? if($inicio != 1 AND isset($actual) AND ($actual=="productos" OR $actual=="familia" OR $actual=="linea" OR $actual=="producto" OR $actual=="producto_suelto" OR ($actual=="puntos_venta" AND $title != "Distribuidores") ) AND FALSE)
					{
						/* Busco si hay promociones vigentes. Solo traigo un registro. */
						$sql = "SELECT porcentaje_descuento, nombre FROM promociones WHERE DATE(NOW()) BETWEEN fecha_inicio AND fecha_fin LIMIT 1;";
						$res = GlobalManager::getDb()->execute($sql);
						$reg = GlobalManager::getDb()->getRow($res);
						$promocion = $reg;
						if ($promocion['porcentaje_descuento'] > 0 and $promocion['porcentaje_descuento'] < 100)
						{
							$descuento_porcentaje = $promocion['porcentaje_descuento'];
                                                        $nombre_promocion = $promocion['nombre'];
							/* Traigo la lista de provincia para las que se aplica el descuento del N %.
							Todas las provincias deben tener el mismo descuento para que las encuentre. */
							$sql = "SELECT PROVINCIA_ENVIOS.PROVINCIA FROM promociones JOIN PROVINCIA_ENVIOS
									ON promociones.provincia_id = PROVINCIA_ENVIOS.id
									WHERE (DATE(NOW()) BETWEEN fecha_inicio AND fecha_fin) and porcentaje_descuento=$descuento_porcentaje;";
							$res = GlobalManager::getDb()->execute($sql);
							?>
							<div style="width:190px; padding: 0 3px; height: 65px; position: absolute; bottom: 0px; left:0px; text-align: center; display: table; background-color: rgba(100, 100, 100, 0); font-size: 9px;">
								<div style="display: table-cell; vertical-align: middle; color: #404040;">
									<span style="color: #FFFFFF; background-image: url(imagenes/estructura/velo_promo.png); padding: 0 32px; background-repeat: no-repeat; background-size: 169px 12px;"><strong><?=$nombre_promocion;?></strong></span><br />
									<span style="font-size: 11px;"><?=$descuento_porcentaje;?>% de descuento</span><br />
                                                                        <span style="">en tu compra si vivís en</span><br />
									<?
									$provincias = "";
									while($reg = GlobalManager::getDb()->getRow($res))
									{
										$provincias .= $reg['PROVINCIA'] . ", ";
									}
									/* Imprimo la lista de provnicias quit�ndole la coma y el espacio del final. */
									print(htmlentities(rtrim($provincias, ", ")));
									?>
								</div>
							</div>
					<? } ?>
							<? /*
							<div style="width:190px; padding: 0 3px; height: 65px; position: absolute; bottom: 0px; left:0px; text-align: center; display: table; background-color: rgba(100, 100, 100, 0); font-size: 9px;">
								<div style="display: table-cell; vertical-align: middle; color: #404040;">
									<span style="color: #FFFFFF; background-image: url(imagenes/estructura/velo_promo.png); padding: 0 42px; background-repeat: no-repeat; background-size: 169px 12px;"><strong>Promo provincias</strong></span><br />
									<span style="">Si vivís en provincia de Buenos Aires,
									<br />llevate un Set de 6 Minis gratis
									<br />con tu compra.</span>&nbsp;<span style="font-size:8px;">(Válido hasta el 7/12)</span>
								</div>
							</div>
							*/ ?>
					
				<?	} ?>
				</div>
                <div id="encabezado_der">
                    <div id="menu_principal">
                        <ul>
                            <li><a href="./index.php?module=fr_productos">Productos</a> |</li>
                            <li><a href="medicina.php">Medicina</a> |</li>
                            <li><a href="grupoweledafilosofia.php">Grupo Weleda</a> |</li>
                            <li><a href="puntosdeventa.php">Puntos de Venta</a> |</li>
                            <li>
<? if (CONSTANTE_PAIS == 'Argentina')
    print('<a href="/index.php?module=fr_noticias&seccion=1">Actualidad Weleda</a>');
?>
<? if (CONSTANTE_PAIS == 'Chile')
    print('<a href="/noticias.php">Noticias</a>');
?>
                            </li>
                        </ul>
                    </div>

                    <div id="menu_iconos">
                        <ul>
                            <li><a class="inicio" href="./index.php" title="Inicio">Inicio</a></li>
                            <li><a class="mapa" href="./mapasitio.php" title="Mapa del sitio">Mapa del Sitio</a></li>
                            <li><a class="contacto" href="contacto.php" title="Contacto">Contacto</a></li>
                            <li><a class="carrito" href="javascript:abrirCarrito()" title="e-shop">e-shop</a></li>
                <? /*  oculto el link Buscar.
                  <li><a class="buscar" href="#">Buscar</a></li>
                 */ ?>
                        </ul>
                    </div>
                </div>
                
                <div style="position:absolute; margin-left: 594px; top: <?= ($inicio==1 ? '33px' : '33px' ) ?>; width:150px; height:22px; padding:0px; " >
                    <form style="" action="index.php" enctype="multipart/form-data" method="get" name="formBuscador">
                        <input type="hidden" value="fr_buscador" name="module">
                        <input type="text" style="line-height: 10px; position: absolute; background-color: rgba(255,255,255,0.7); border: 1px solid rgb(204, 204, 204); padding: 8px 32px 6px 6px; width: 111px; font-size: 10px; color: #686A6C; font-family: 'Neo Sans', 'Neo Sans Std', Arial, Helvetica, sans-serif;" value="Buscar..." onblur="if(this.value=='') this.value='Buscar...';" onfocus="if(this.value=='Buscar...') this.value='';" name="b" id="b">
                        <input type="image" style="width:20px; height:20px; position: absolute; right: 3px; top: 3px;" onclick="this.form.b.focus();" src="/imagenes/contenido/home/lupa_buscador.png" class="" >
                    </form>
                </div>
                
                
<? /* Esto pone un rectángulo con un link en la pantalla de inicicio (cuando $inicio == 1) */
if ($inicio == 1 ) {
    /* Lo quito por ahora */
    ?>
                    <a href="https://www.facebook.com/weledaargentina" target="_BLANK" style="display:block;position:relative;left:59px;top:287px;width:76px;height:23px;"></a>
                    <a href="https://www.instagram.com/weledaarg" target="_BLANK" style="display:block;position:relative;left:157px;top:267px;width:102px;height:23px;"></a>
<? } ?>
			</div><? /* cierra div encabezado */ ?>

                        <? if ((!empty($leftMenu)) || (!empty($archivoMenuIzq))) { ?>

                <div id="columna_izquierda" class="clearfix">

                    <div class="menu_columna_izquierda">
    <? if (!empty($leftMenu)) { ?>
                            <ul>
                            <? /// FIXME: Aca cada link (iris, mosqueta, almendra y classic tiene su propio class. Una locura  ?>
                            <? foreach ($leftMenu->getMenuElements() as $itemMenu) { ?>
                                    <li><a href="<?= $itemMenu["link"] ?>" <?= ($itemMenu["selected"]) ? "class='destacado' style='font-weight:bold;'" : ""; ?>><?= $itemMenu["name"] ?></a></li>
        <? } ?>
                            </ul>
        <?
    } else {
        if (file_exists($archivoMenuIzq)) {
            include($archivoMenuIzq);
        }
    } ?>

                    </div>

                    <div class="fdo_columna_izquierda clearfix <?= ($color == "" ? "" : $color); ?> ">

                    <? if ($destacado_col_izq == "1") { ?> <? include(TPL_FOLDER . "tpl.front_destacado_col_izq_linea.php"); ?> <?php }; ?>

                    </div>

                </div>

                    <? } ?>

            <div id="cuerpo<?php if ($inicio == "1") { ?>_inicio<?php }; ?>" class="clearfix">

                <? if ($inicio != "1") { ?>

                    <div id="recorrido_sitio">
    <? if (!empty($recorrido))
        foreach ($recorrido as $key => $miga) {
            ?>
                                <a href="<?= $miga['link'] ?>"><?=$miga['nombre']?></a>
            <? if ($key < sizeof($recorrido) - 1)
                echo " &gt; "
                ?>
        <? } ?>
                    </div>

<? } ?>

                <div id="contenido<?php if ($inicio == "1") { ?>_inicio<?php }; ?>" class="clearfix">