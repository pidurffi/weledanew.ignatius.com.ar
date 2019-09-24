<?php
$seccion = "noticias";
$actual = "noticias";
$title = "Actualidad Weleda";
include_once(GALIX_FOLDER."class.MenuSimpleLevel.php");

if(isset($_GET['seccion']))
{
	$seccion_noticias = $_GET['seccion'];
	if($seccion_noticias == 1)
	{
		$actual = "noticias";
		$title.=" - Noticias - ".$noticia["titulo"];
	}
	elseif($seccion_noticias == 2)
	{
		$actual = "prensa";
		$title.=" - Prensa - ".$noticia["titulo"];
	}
}
else
{
	$seccion_noticias = 0;
}

$leftMenu = new MenuSimpleLevel(array());
foreach($noticias as $noticiaMenu) {
		$leftMenu->insertElement(htmlentities($noticiaMenu["titulo"]),"index.php?module=fr_noticia&id=".$noticiaMenu["id"]."&seccion=".$seccion_noticias,($noticiaMenu["id"]==RequestHandler::getGetValue("id")));
}

$recorrido = array();
$recorrido[] = array("nombre"=>"Inicio","link"=>"index.php");

if(CONSTANTE_PAIS=="Chile")
{
    $recorrido[] = array("nombre"=>"Actualidad Weleda","link"=>"actualidad_weleda.php");
    if($seccion_noticias == 1)
    {
        // noticias
        $recorrido[] = array("nombre"=>"Noticias","link"=>"index.php?module=fr_noticias&seccion=1");
    }
    elseif($seccion_noticias == 2)
    {
        //prensa
        $recorrido[] = array("nombre"=>"Prensa","link"=>"index.php?module=fr_noticias&seccion=2");
    }
}
elseif(CONSTANTE_PAIS=="Argentina")
{
    $recorrido[] = array("nombre"=>"Noticias","link"=>"index.php?module=fr_noticias");
}

include(TPL_FOLDER."tpl.front_template_arriba_new.php"); ?>
    <div class="w-content">
        <div class="container">
<?
$total_menu = 10;
$i          = 1;
if ( !empty($leftMenu) ) { ?>
            <div class="nav-noticias">
                <ul>
                    <? foreach ($leftMenu->getMenuElements() as $itemMenu) {

                     ?>
                        <li><a href="<?= $itemMenu["link"] ?>" <?= ($itemMenu["selected"]) ? "class='destacado' style='font-weight:bold;'" : ""; ?>><?= $itemMenu["name"] ?></a></li>
                    <?
                        if($total_menu < $i ) break;
                        $i++;
                    } ?>
                    <li><a href="index.php?module=fr_noticias">Ver Más</a></li>
                </ul>
            </div>
<? } ?>


            <div class="title">
                <h3>Noticias</h3>
            </div>
            <?
            if (is_file("imagenes/noticias/" . $noticia['foto']))
            {
                $size = getimagesize("imagenes/noticias/" . $noticia['foto']);
                $ancho_imagen = $size[0];
            }
            ?>

            <div class="r-img row">
                
                <p><?=htmlentities($noticia["copete"])?></p>
                <?
                if (is_file("imagenes/noticias/" . $noticia['foto']))
                { ?>
                    <div class="col-sm-4">
                        <h4 class="subtitle"><?=htmlentities($noticia["titulo"])?></h4>
                        <img src="imagenes/noticias/<?=$noticia["foto"]?>" style="width: 100%;" />
                    </div>
                    <?
                }
                ?>
                <div class="col-sm-8">
                    <p><?=$noticia["texto"]?></p>
                    <p>
                        <?php
                        /* Botón "Me gusta" de Facebook. El data-href se deja vacío para que Facebook lo complete con el link de la página.
                          Además se debe incluir un script en el HEAD (tpl.front_template_arriba.php. */
                        if (CONSTANTE_PAIS == 'Argentina') {
                        ?>
                            <div class="fb-like" data-href="" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="arial"></div>
                        <?php } ?>
                    </p>
                </div>
            </div>

            <div class="r-img row">

            </div>
        </div>
    </div>


	
<? include(TPL_FOLDER."tpl.front_template_abajo_new.php"); ?>