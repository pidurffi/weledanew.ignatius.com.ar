<?php
$seccion = "linea";
$actual = "linea";
$destacado_col_izq = "0";
$title = $familia["nombre"]." - ".$linea["nombre"]; // nombre de familia y l�nea en el TITLE
$color = "";

include_once(GALIX_FOLDER."class.MenuSimpleLevel.php");

$leftMenu = new MenuSimpleLevel(array());

//var_dump($cliente);

foreach($lineas as $lineaMenu) {
	$leftMenu->insertElement(htmlentities($lineaMenu["nombre"]),"index.php?module=fr_linea&id=".$lineaMenu["id"],($lineaMenu["id"]==RequestHandler::getGetValue("id")));
}

if(!empty($entity['titulo_banner'])) {
	// Si no est� vac�o el titulo_banner, debo mostrar el recuadro a la izquirda
	// que suele contener los consejos de utilizaci�n
	$destacado_col_izq = "1";
}


$recorrido = array();
$recorrido[] = array("nombre"=>"Inicio","link"=>"index.php");
$recorrido[] = array("nombre"=>"Productos","link"=>"index.php?module=fr_productos");
$recorrido[] = array("nombre"=>utf8_encode($familia["nombre"]),"link"=>"index.php?module=fr_familia&id=".$familia['id']);
//$class_breadcrumb_especial = 'listado_familia';

include(TPL_FOLDER."tpl.front_template_arriba_new.php"); ?>




    <div class="products-nav circle">
        <div class="container">

            <div class="title">
                <h3><?= utf8_encode($entity["nombre"]) ?></h3>
            </div>
            <div class="row">
                    <div class="item">
                        <p><?=htmlentities($entity["copete"])?></p>
                        <p><?=$entity["descripcion"]?></p>
                    </div>
            </div>


            <div class="row">
                    <?php
                    $total  = count($productos);
                    $i      = 0;

//                    var_dump($productos);
//foreach($productos as $key => $producto) {
//    if ($producto['mostrar_en_web'] != 1) {
//        $total = $total - 1;
//    }
//}
                    foreach($productos as $key => $producto) {
                        if($producto['mostrar_en_web'] != 1)
                        {
                            $total = $total - 1;
                            continue;
                        }
                    ?>
                    <div class="col-sm-4">
                        <div class="item">
                            <div class="image">
                                <img src="imagenes/productos/<?=$producto["foto_listado"]?>" alt="<?=htmlentities($producto["nombre"])?>">
                            </div>
                            <div class="text">
                                <a href="index.php?module=fr_producto&id=<?=$producto["id"]?>&id_linea=<?=$entity["id"]?>&id_familia=<?=$familia["id"]?>" title="<?=htmlentities($producto["nombre"])?>"><?=htmlentities($producto["nombre"])?></a>
                                <span><?=htmlentities($producto["subtitulo"])?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                    if( (($i+1) % 3 == 0) && ($i < ($total - 1)) ){
                    ?>
                        </div><!-- cierra row1 <?php echo $i."-".$total."-".($i%4) ?>-->
                        <div class="row">
                    <?php
                    }
                    if($i == ($total - 1)){
                    ?>
                        </div><!-- cierra row2 -->
                    <?php
                    }
                    $i++;
                }
                ?>
            </div>

        </div>
    </div>


<? include(TPL_FOLDER."tpl.front_template_abajo_new.php"); ?>