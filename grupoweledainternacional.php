<?php
$title      = "Internacional";
$seccion    = "grupoweleda";
$actual     = "noticias";

$destacado_col_izq  = "0";
$color              = "";

$recorrido = array();
$recorrido[] = array("nombre"=>"Inicio","link"=>"index.php");
$recorrido[] = array("nombre"=>"Grupo Weleda","link"=>"grupoweledafilosofia.php");

include("tpl/tpl.front_template_arriba_new.php");

function despam($email) {
    $partA = substr($email,0, strpos($email,'@'));
    $partB = substr($email,strpos($email,'@'));
    $linkText = (func_num_args() == 2) ? func_get_arg(1) : $email;
    $linkText = str_replace('@', '<span class="nospam" style="{margin-right: .1em; margin-left: .1em;}">&#64;</span>', $linkText);
    return '<a href="e-mail" onClick=\'a="'.$partA.'";this.href="mail"+"to:"+a+"'.$partB.'";\'>'.$linkText.'</a>';
}

?>

    <div class="w-content">
        <div class="container">
            <div class="nav-noticias">
                <ul>

                    <li><a href="grupoweledafilosofia.php">Filosofía</a></li>

                    <li><a href="grupoweledahistoria.php">Historia</a></li>

                    <li><a href="grupoweledacultivo.php">Cultivo biodinámico</a></li>

                    <li><a href="grupoweledaresponsabilidad.php">Responsabilidad social y ambiental</a></li>

                    <li><a href="grupoweledaimagenes.php">Weleda en imágenes</a></li>

                    <li><a href="grupoweledatrabajar.php">Trabajar con nosotros</a></li>

                    <li><a href="grupoweledainternacional.php" class='destacado' style='font-weight:bold;'>Weleda internacional</a></li>

                </ul>
            </div>
            <div class="title">
                <h3>Grupo Weleda - Weleda Internacional</h3>
            </div>

            <p>Cada empresa de Weleda en el mundo, cuenta con el apoyo y respaldo del Grupo Internacional, que a su vez, con su propia actividad, experiencia, iniciativa y responsabilidad, promueve la armonía con el ser humano y la naturaleza.</p>
            <p>Si querés conocer más acerca del Grupo Weleda, visitá <a href="http://www.weleda.com" target="_blank">www.weleda.com</a>.</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </div>
    </div>

<? include("tpl/tpl.front_template_abajo_new.php"); ?>