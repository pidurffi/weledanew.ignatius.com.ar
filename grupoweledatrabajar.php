<?php
$title              = "Trabajar";
$seccion            = "grupoweleda";
//$archivoMenuIzq = $_SERVER['DOCUMENT_ROOT']."/inc/inc.columna_izquierda_$seccion.php";
$actual             = "noticias";
$destacado_col_izq  = "0";
$color = "";

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

                    <li><a href="grupoweledatrabajar.php" class='destacado' style='font-weight:bold;'>Trabajar con nosotros</a></li>

                    <li><a href="grupoweledainternacional.php">Weleda internacional</a></li>

                </ul>
            </div>
            <div class="title">
                <h3>Grupo Weleda - Trabajar con nosotros</h3>
            </div>

            <p>El compromiso, el talento y el entusiasmo de nuestro equipo humano explica el éxito mundial Weleda. Sin duda las personas son claves en nuestra organización.</p>

            <h4>Enviar curriculum vitae</h4>
            <p>Buscamos profesionales con iniciativa, capaces de aportar soluciones y asumir riesgos, interesados por los productos naturales, abiertos, entusiastas y amantes del trabajo en equipo.</p>
            <p>Si te identific&aacute;s con estos valores y quer&eacute;s formar parte de un grupo que est&aacute; presente en más de 50 países envíanos tu CV a <?=despam('rrhh@weleda.com.ar')?>.</p>


        </div>
    </div>

<? include("tpl/tpl.front_template_abajo_new.php"); ?>