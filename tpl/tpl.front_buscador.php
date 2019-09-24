<?php
//$leftMenu   = new MenuSimpleLevel(array());

$seccion    = "buscador";
$actual     = "buscador";
$title      = "B&uacute;squeda";

include("tpl/tpl.front_template_arriba_new.php");
?>
<div class="w-content">
    <div class="container">
        <div class="title">
            <h3>Buscador</h3>
        </div>
        <p>Ud. buscó "<?= $searchString ?>".</p>
<?
if (!empty($productos)) {
?>
        <h4 class="subtitle">Productos</h4>
    <?
    $i = 0;
    foreach ($productos as $producto) {
        $i++;
        $link           = 'index.php?module=fr_producto&id=' . $producto["id"] . '&id_linea=' . $producto["id_linea"] . '&id_familia=' . $producto["id_familia"];
        $link_nombre    = htmlentities($producto["nombre"]);
        $carpeta        = "imagenes/productos/";
        if (file_exists($carpeta . $producto["foto_listado"])) {
            $foto = $carpeta . $producto["foto_listado"];
        } else {
            $foto = $carpeta . "weleda_logo.jpg";
        }
     ?>
        <div class="r-img row">
            <div class="col-sm-2">
                <img src="<?= $foto?>" alt="<?= $link_nombre?>">
            </div>
            <div class="col-sm-10">
                <a href="<?= $link?>" title="<?= $link_nombre?>"><?= $link_nombre?></a>
                <p><?= htmlentities($producto["subtitulo"]) ?></p>
            </div>
        </div>
     <?php
        }
     ?>

<? }

// Imprimo una línea horizontal que separe productos de noticias.
if(!empty($productos) and !empty($noticias))
{
    print("<hr />");

}
if (!empty($noticias)) {
?>
    <?
    $i = 0;
    foreach ($noticias as $noticia) {
        $i++;
        $link           = 'index.php?module=fr_noticia&id=' . $noticia["id"] . '&seccion=' . $noticia["id_seccion"];
        $link_nombre    = htmlentities($noticia["titulo"]);
        $carpeta        = "imagenes/noticias/";
        if (file_exists($carpeta . $noticia["fotito"])) {
            $foto = $carpeta . $noticia["fotito"];
        } else {
            $foto = $carpeta . "weleda_logo.jpg";
        }
    ?>
        <div class="r-img row">
            <div class="col-sm-2">
                <img src="<?= $foto?>" alt="<?= $link_nombre?>">
            </div>
            <div class="col-sm-10">
                <a href="<?= $link?>" title="<?= $link_nombre?>"><?= $link_nombre?></a>
                <p><?= htmlentities($noticia["copete"]) ?></p>
                <p><?= $noticia["resumen"] ?></p>
            </div>
        </div>
    <?php }?>
<?php }?>

        <?
        if (empty($productos) AND empty($productos)) {
            ?>
            <p>No se encontraron resultados.</p>
        <? }
        ?>


    </div>
</div>
<? include(TPL_FOLDER."tpl.front_template_abajo_new.php"); ?>