<?php
/* Creado por Adrián - 11/11/08 */
$title = 'Puntos de venta';
//include_once(GALIX_FOLDER . "class.MenuSimpleLevel.php");

function despam($email) {
    $partA = substr($email, 0, strpos($email, '@'));
    $partB = substr($email, strpos($email, '@'));
    $linkText = (func_num_args() == 2) ? func_get_arg(1) : $email;
    $linkText = str_replace('@', '<span class="nospam" style="{margin-right: .1em; margin-left: .1em;}">&#64;</span>', $linkText);
    return '<a href="e-mail" onClick=\'a="' . $partA . '";this.href="mail"+"to:"+a+"' . $partB . '";\'>' . $linkText . '</a>';
}

$seccion    = "puntos_venta";
$actual     = "noticias";

$regionGet = RequestHandler::getGetValue('id_region');

include("tpl/tpl.front_template_arriba_new.php");
?>
<script type="text/javascript">
    function sendForm(region) {
        if(region)
            document.getElementById("subregion").value = 0;
        document.getElementById("subregion").disabled = false;
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
            <form method="get" action="index.php" id="form">
                <input type="hidden" name="module" value="<?= $_GET['module'] ?>" />
                <div class="nav">
                    <div class="row">
                        <div class="col-sm-6">
                            <select  name="id_region" onchange="sendForm(true)">
                                <option value="0">Elija una provincia</option>
                                <?
                                foreach ($regiones as $regionMenu) {
                                    ?>
                                    <option value="<?= $regionMenu['id']; ?>" <?= ($regionMenu['id'] == $regionGet) ? "selected" : ""; ?>><?=utf8_encode($regionMenu['nombre']);?></option>
                                    <?
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select name="id" onchange="sendForm(false)" id="subregion" <?= (empty($subregiones) ? 'disabled' : '') ?>>
                                <option value="0">Elija una localidad</option>
                                <?
                                if (!empty($subregiones))
                                    foreach ($subregiones as $subregionMenu) {
                                        ?>
                                        <option value="<?= $subregionMenu['id']; ?>" <?= ($subregionMenu['id'] == $_GET['id']) ? "selected" : ""; ?>><?=utf8_encode($subregionMenu['nombre'])?></option>
                                        <?
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <? if (!empty($farmacias)) { ?>
                <div class="result">
                    <h4 class="subtitle">Puntos de Venta en <?=utf8_encode($region['nombre']) . " - "; ?><?=utf8_encode($subregion["nombre"]) ?></h4>
                    <table>
                        <tbody>
                        <? foreach ($farmacias as $farmacia) { ?>
                        <tr>
                            <td class="name"><?=utf8_encode($farmacia['nombre'])?></td>
                            <td class="address"><?=utf8_encode($farmacia['direccion']); ?></td>
                            <td class="detail">
                                <?=utf8_encode($farmacia['direccion']) . "<br />"; ?>
                                <?php
                                /* Solo muestro el link VER DETALLES si la farmacia tiene mail, teléfono, fax o web. */
                                if ($farmacia['mail'] != '' OR $farmacia['telefono'] != '' OR $farmacia['fax'] != '' OR $farmacia['web'] != '') {
                                    ?>
                                    <a href="index.php?module=fr_puntos_venta_chd&id=<?= $farmacia['id'] ?>&idr=<?= $region['id'] ?>&idsr=<?= $subregion['id'] ?>">Detalle</a>
                                <?php } ?>
                            </td>
                            <td></td>
                        </tr>
                        <? }?>
                        </tbody>
                    </table>
                </div>
            <? }?>
        </div>
    </div>
</div>
<? include("tpl/tpl.front_template_abajo_new.php"); ?>