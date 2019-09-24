<?php
/* Creado por Adrián - 11/11/08 */
include_once(GALIX_FOLDER . "class.MenuSimpleLevel.php");

function despam($email) {
    $partA = substr($email, 0, strpos($email, '@'));
    $partB = substr($email, strpos($email, '@'));
    $linkText = (func_num_args() == 2) ? func_get_arg(1) : $email;
    $linkText = str_replace('@', '<span class="nospam" style="{margin-right: .1em; margin-left: .1em;}">&#64;</span>', $linkText);
    return '<a href="e-mail" onClick=\'a="' . $partA . '";this.href="mail"+"to:"+a+"' . $partB . '";\'>' . $linkText . '</a>';
}

$leftMenu = new MenuSimpleLevel(array());

if (CONSTANTE_PAIS == "Argentina") {
    $leftMenu->insertElement("Belladona Saavedra", "farmaciabelladonasaavedra.php");
    $leftMenu->insertElement("Otros puntos de venta", "index.php?module=fr_puntos_venta_ch", true);
    $leftMenu->insertElement("E-shop", "javascript:abrirCarrito()");
    $leftMenu->insertElement("Distribuidores mayoristas", "distribuidoresmayoristas.php");
} else {
// Chile
    $leftMenu->insertElement("Farmacia Weleda", "/farmaciaweledachile.php");
    $leftMenu->insertElement("<strong>Otros puntos de venta</strong>", "index.php?module=fr_puntos_venta_ch");
}

$seccion    = "puntos_venta";
$actual     = "noticias";

$regionGet = RequestHandler::getGetValue('id_region');

/*
  $recorrido = array();
  $recorrido[] = array("nombre"=>"Inicio","link"=>"index.php");
  $recorrido[] = array("nombre"=>"Puntos de venta","link"=>"index.php?module=fr_puntos_venta_1");
  $recorrido[] = array("nombre"=>$region['nombre'],"link"=>"http://ignatius03.com.ar/index.php?module=fr_puntos_venta_2&id=".$region['id']);
 */


include("tpl/tpl.front_template_arriba_new.php");
?>
<script type="text/javascript">
    function sendForm(region) {
        if(region)
            document.getElementById("subregion").value = 0;
        document.getElementById("form").submit();
    }
</script>


<div class="w-content">
    <div class="container">
        <div class="nav-noticias">
            <ul>

                <li><a href="farmaciabelladonasaavedra.php" title="Belladona Saavedra">Belladona Saavedra</a></li>
                <li><a href="index.php?module=fr_puntos_venta_ch" title="Otros puntos de venta" class='destacado' style='font-weight:bold;'>Otros puntos de venta</a></li>
                <li><a href="javascript:abrirCarrito()" title="E-shop">E-shop</a></li>
                <li><a href="distribuidoresmayoristas.php" title="Distribuidores mayoristas">Distribuidores mayoristas</a></li>
            </ul>
        </div>
        <div class="title">
            <h3>Puntos de venta</h3>
        </div>
        <div class="puntos-venta">
            <div class="result">
                <h4 class="subtitle">Puntos de Venta en <?=utf8_encode($region['nombre']) . " - "; ?><?=utf8_encode($subregion["nombre"]) ?></h4>
                <table>
                    <tbody>
                        <tr>
                            <td class="name"><?= utf8_encode($region['nombre']) ?></td>
                            <td class="address"><?= utf8_encode($subregion["nombre"]) ?></td>

                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="result">
                <h4 class="subtitle"><?= utf8_encode($farmacia['nombre']) ?></h4>
                <table>
                    <tbody>
                    <tr>
                        <?php if($farmacia['logo'] != ""){?>
                            <td class="name"><img width="100" src="/imagenes/estructura/farmacias/<?=$farmacia['logo']?>"/></td>
                        <?php } ?>

                        <td class="address"><?= utf8_encode($farmacia['direccion']) . "<br />"; ?>
                            <?= ($farmacia['mail'] == "" ? "" : despam($farmacia['mail']) . "<br />"); ?>
                            <?= ($farmacia['telefono'] == "" ? "" : "Tel.: " . $farmacia['telefono'] . "<br />"); ?>
                            <?= ($farmacia['fax'] == "" ? "" : "Fax: " . $farmacia['fax'] . "<br />"); ?>
                            <?
                            // Elimino "http://" de la URL de la farmacia, tanto para el texto que se muestra en pantalla,
                            // como para el link. Luego al link se le agrega "http://" adelante.
                            $farmacia['web'] = str_replace("http://", "", $farmacia['web']);
                            ?>
                            <?= ($farmacia['web'] == "" ? "" : "Web: <a href='http://" . $farmacia['web'] . "' target='_BLANK'>" . $farmacia['web'] . "</a>"); ?></td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<br />
<div style="width=100%; text-align:right;">
    <a href="javascript:history.back(1)" style="font-size:12px;">Volver</a>
</div>
<? include("tpl/tpl.front_template_abajo_new.php"); ?>
