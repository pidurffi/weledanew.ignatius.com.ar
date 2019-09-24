<?php
include_once(GALIX_FOLDER."class.MenuSimpleLevel.php");

$leftMenu   = new MenuSimpleLevel(array());
$seccion    = "noticias";
$actual     = "noticias";
$title      = "Actualidad Weleda";

if(isset($_GET['seccion']))
{
	$seccion_noticias = $_GET['seccion'];
	if($seccion_noticias == 1)
	{
		$actual = "noticias";
		$title.=" - Noticias";
	}
	elseif($seccion_noticias == 2)
	{
		$actual = "prensa";
		$title.=" - Prensa";
	}
}
else
{
	$seccion_noticias = 0;
}

$recorrido      = array();
$recorrido[]    = array("nombre"=>"Inicio","link"=>"index.php");

if(CONSTANTE_PAIS=="Chile")
{
    $recorrido[] = array("nombre"=>"Actualidad Weleda","link"=>"actualidad_weleda.php");
}
elseif(CONSTANTE_PAIS=="Argentina")
{
    $recorrido[] = array("nombre"=>"Noticias","link"=>"index.php?module=fr_noticias");
}

include(TPL_FOLDER."tpl.front_template_arriba_new.php"); ?>

    <div class="products-nav">
        <div class="container">
            <div class="title">
                <h3>Noticias</h3>
            </div>

            <div class="grid grid--2">
                <?php
                
                foreach($list as $key => $noticia) {
                    
                    ?>
                        
                            <div class="item">
                                <div class="image">
                                    <img src="imagenes/noticias/<?= $noticia["foto"] ?>"
                                         alt="<?= htmlentities($noticia["titulo"]) ?>">
                                </div>
                                <div class="text">
                                    <a href="index.php?module=fr_noticia&id=<?=$noticia["id"]?>&seccion=<?=$seccion_noticias;?>"
                                       title="<?= htmlentities($noticia["titulo"]) ?>"><?= htmlentities($noticia["titulo"]) ?></a>
                                    <span><?=htmlentities($noticia["copete"])?></span>
                                    <span><?=$noticia["resumen"]?></span>
                                </div>
                            </div>
                        
                        <?php
                    
                }
                ?>
            </div>

        </div>
    </div>

<? include(TPL_FOLDER."tpl.front_template_abajo.php"); ?>