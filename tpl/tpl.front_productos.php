<?php
include_once(GALIX_FOLDER."class.MenuSimpleLevel.php");
$leftMenu = new MenuSimpleLevel(array());

foreach($list as $familia) {
	$leftMenu->insertElement(htmlentities($familia["nombre"]),"index.php?module=fr_familia&id=".$familia["id"]);
}

/* $leftMenu->insertElement("Novedades","#"); */
/* $leftMenu->insertElement("Cuidados para mam&aacute; y el beb&eacute;","#"); */

$seccion = "productos";
$actual = "productos";
$title = "Productos";

$recorrido = array();
$recorrido[] = array("nombre" => "Inicio", "link" => "index.php");
$recorrido[] = array("nombre" => "Productos", "link" => "index.php?module=fr_productos");
//$class_breadcrumb_especial = 'listado_productos';

include(TPL_FOLDER."tpl.front_template_arriba_new.php"); ?>


    <div class="products-nav circle">
        <div class="container">
            <div class="title">
                <h3>Productos</h3>
            </div>

            <div class="row">
                <?php
                $total = count($list);
                foreach($list as $key => $familia) {
                ?>
                    <div class="col-sm-4">
                        <div class="item">
                            <div class="image">
                                <img src="imagenes/productos/<?=$familia["foto_listado"]?>" alt="<?=htmlentities($familia["nombre"])?>">
                            </div>
                            <div class="text">
                                <a href="index.php?module=fr_familia&id=<?=$familia["id"]?>" title="<?=htmlentities($familia["nombre"])?>"><?=htmlentities($familia["nombre"])?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                    if( (($key+1) % 3 == 0) && ($key < $total - 1) ){
                    ?>
                        </div><!-- cierra row1 <?php echo $key."-".$total."-".($key%4) ?>-->
                        <div class="row">
                    <?php
                    }
                    if($key == $total - 1){
                    ?>
                        </div><!-- cierra row2 -->
                    <?php
                    }
                }
                ?>
            </div>

        </div>
    </div>
	<!--
	<? /*
	<div class="item_menu_productos <?=(++$i+1%2)?"impar":""?>">
		<div class="texto">
			<a href="#">Cuidados para<br />mam&aacute; y beb&eacute;</a>
		</div>
		<div class="fdo_imagen"><a href="#"><img src="imagenes/contenido/img_cuidados_mamaybebe.jpg" /></a></div>
	</div>

	<div class="item_menu_productos <?=(++$i%2)?"impar":""?>">
		<div class="texto">
			<a href="/index.php?module=fr_noticias">Noticias</a>
		</div>
		<div class="fdo_imagen"><a href="/index.php?module=fr_noticias"><img src="imagenes/contenido/img_novedades.jpg" /></a></div>
	</div>
	*/ ?>
	-->
<? include(TPL_FOLDER."tpl.front_template_abajo_new.php"); ?>