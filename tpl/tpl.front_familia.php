<?php
$seccion = "familia";
$actual = "familia";
$title = $entity["nombre"]; // nombre de la familia en el TITLE
$color = "";



include_once(GALIX_FOLDER."class.MenuSimpleLevel.php");

$leftMenu = new MenuSimpleLevel(array());



foreach($familias as $familia) {
	$leftMenu->insertElement(htmlentities($familia["nombre"]),"index.php?module=fr_familia&id=".$familia["id"],($familia["id"]==RequestHandler::getGetValue("id")));
}

$recorrido = array();
$recorrido[] = array("nombre"=>"Inicio","link"=>"index.php");
$recorrido[] = array("nombre"=>"Productos","link"=>"index.php?module=fr_productos");

include(TPL_FOLDER."tpl.front_template_arriba_new.php"); ?>


    <div class="products-nav circle">
        <div class="container">
            <div class="title">
                <h3><?= utf8_encode($entity["nombre"]) ?></h3>
            </div>

            <div class="row">
                <?php
                $total = count($lineas);
                foreach($lineas as $key => $linea) {
                ?>
                    <div class="col-sm-4">
                        <div class="item">
                            <div class="image">
                                <img src="imagenes/productos/<?=$linea["foto_listado"]?>" alt="<?=htmlentities($linea["nombre"])?>">
                            </div>
                            <div class="text">
                                <a href="index.php?module=fr_linea&id=<?=$linea["id"]?>" title="<?=htmlentities($linea["nombre"])?>"><?=htmlentities($linea["nombre"])?></a>
                                <span><?=htmlentities($linea["subtitulo"])?></span>
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

            <div class="row">
                <?php
                $totalProductos = count($productos_sueltos);
                foreach($productos_sueltos as $key => $producto_suelto) {
                ?>
                <div class="col-sm-4">
                    <div class="item">
                        <div class="image">
                            <img src="imagenes/productos/<?=$producto_suelto["foto_listado"]?>" alt="<?=htmlentities($producto_suelto["nombre"])?>">
                        </div>
                        <div class="text">
                            <a href="index.php?module=fr_producto_suelto&id=<?=$producto_suelto["id"]?>" title="<?=htmlentities($producto_suelto["nombre"])?>"><?=htmlentities($producto_suelto["nombre"])?></a>
                            <span><?=htmlentities($producto_suelto["subtitulo"])?></span>
                        </div>
                    </div>
                </div>
                <?php
                if( (($key+1) % 3 == 0) && ($key < $totalProductos - 1) ){
                ?>
            </div><!-- cierra row1 <?php echo $key."-".$totalProductos."-".($key%4) ?>-->
            <div class="row">
                <?php
                }
                if($key == $totalProductos - 1){
                ?>
            </div><!-- cierra row2 -->
            <?php
            }
            }
            ?>
        </div>

        </div>
    </div>

<? include(TPL_FOLDER."tpl.front_template_abajo_new.php"); ?>