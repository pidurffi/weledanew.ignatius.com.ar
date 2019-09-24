<?php

$inicio = "1";

include(TPL_FOLDER."tpl.front_template_arriba.php"); ?>

<? /*
	cambio de color para el menú en página de inicio porque mandaron una imagen con fondo blanco.
  <style type="text/css" >
		div#menu_principal ul li a { color:#888888; }
		div#menu_principal ul li { color:#888888; }
		div#menu_iconos { background-color: rgba(88,88,88,.25); }
	</style>
*/ ?>

	<div class="banner producto">

		<div class="tit_banner producto">
			<a href="<?=$entity["link_1"]?>">
				<? /* <h2><?=htmlentities($entity["titulo_1"])?></h2> */ ?>
				<img src="./imagenes/home/<?=$entity["imagen_titulo_1"]?>" border="0" />
			</a>
		</div>
		<h3><?=htmlentities($entity["subtitulo_1"])?></h3>
		<div class="texto">
			<p><?=htmlentities($entity["copete_1"])?></p>
		</div>
		<div class="foto_enlace">
			<div class="enlace">
				<a href="<?=$entity["link_1"]?>" <?=( $entity["nueva_ventana_link_1"] ? 'TARGET="_BLANK"' : '');?> ><?=htmlentities($entity["texto_link_1"])?></a>
			</div>
			<div class="imagen">
				<a href="<?=$entity["link_1"]?>">
					<img src="imagenes/home/<?=$entity["imagen_1"]?>" border="0" />
				</a>
			</div>
		</div>
	</div>

	<div class="banner sorteo">
		<div class="tit_banner sorteo">
			<a href="<?=$entity["link_2"]?>">
				<? /* <h2><?=htmlentities($entity["titulo_2"])?></h2> */ ?>
				<img src="imagenes/home/<?=$entity["imagen_titulo_2"]?>" border="0" />
			</a>
		</div>
            <h3><?=  utf8_encode($entity["subtitulo_2"])?></h3>
		<div class="texto">
			<p><?= utf8_encode($entity["copete_2"])?></p>
		</div>
		<div class="foto_enlace">
			<div class="enlace">
				<? if($entity["link_2"] != '') { ?>
					<a href="<?=$entity["link_2"]?>" <?=( $entity["nueva_ventana_link_2"] ? 'TARGET="_BLANK"' : '');?> ><?=htmlentities($entity["texto_link_2"])?></a>
				<? } ?>
			</div>
			<div class="imagen">
				<a href="<?=$entity["link_2"]?>" <?=( $entity["nueva_ventana_link_2"] ? 'TARGET="_BLANK"' : '');?> >
					<img src="imagenes/home/<?=$entity["imagen_2"]?>" border="0" />
				</a>
			</div>
		</div>
	</div>
	<div class="banner comprar">
		<div class="tit_banner comprar">
			<a href="<?=$entity["link_3"]?>" <?=( $entity["nueva_ventana_link_3"] ? 'TARGET="_BLANK"' : '');?> >
				<? /* <h2><?=htmlentities($entity["titulo_3"])?></h2> */ ?>
				<img src="imagenes/home/<?=$entity["imagen_titulo_3"]?>" border="0" />
			</a>
		</div>
		<h3><?=htmlentities($entity["subtitulo_3"]);?></h3>
		<div class="texto">
			<p><?=htmlentities($entity["copete_3"])?></p>
		</div>
		<div class="foto_enlace">
			<div class="enlace">
				<a href="<?=$entity["link_3"]?>" <?=( $entity["nueva_ventana_link_3"] ? 'TARGET="_BLANK"' : '');?> ><?=htmlentities($entity["texto_link_3"])?></a>
			</div>
			<div class="imagen">
				<a href="<?=$entity["link_3"]?>" <?=( $entity["nueva_ventana_link_3"] ? 'TARGET="_BLANK"' : '');?> >
					<img src="imagenes/home/<?=$entity["imagen_3"]?>" border="0" />
				</a>
			</div>
		</div>
	</div>

<?  include(TPL_FOLDER."tpl.front_template_abajo.php"); ?>