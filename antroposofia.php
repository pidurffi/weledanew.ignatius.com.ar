<?php
$title              = "Medicina Antropos&oacute;fica";
$seccion            = "medicina";
$actual             = "noticias";
$destacado_col_izq  = "0";
$color              = "";

$recorrido = array();
$recorrido[] = array("nombre"=>"Inicio","link"=>"index.php");
$recorrido[] = array("nombre"=>"Medicina antroposófica","link"=>"medicina.php");

include("tpl/tpl.front_template_arriba_new.php");?>

    <div class="w-content">
        <div class="container">
            <div class="nav-noticias">
                <ul>

                    <li><a href="antroposofia.php" class='destacado' style='font-weight:bold;'>Antroposofía y Homeopatía</a></li>

                    <li><a href="procesos.php">Procesos farmaceúticos</a></li>

                    <li><a href="salutogenesis.php">Salutogénesis</a></li>

                    <li><a href="medicina_faq.php">Preguntas frecuentes</a></li>

                </ul>
            </div>
            <div class="title">
                <h3>Antroposofía y homeopatía</h3>
            </div>
            <div class="r-img row">
                <div class="col-sm-8">
                    <p>Una gran parte de los medicamentos antroposóficos están elaborados conforme a métodos homeopáticos, de los cuales toma - de forma diferenciada- la técnica de la dinamización (potenciación) y la designación de las distintas diluciones en base decimal. Sin embargo, tanto la concepción de la "fórmula" y su aplicación terapéutica, así como los procesos farmacéuticos de transformación, se diferencian del resto de los métodos homeopáticos clásicos. </p>
                    <p>La medicina Antroposófica entiende al ser humano, como a un Ser en desarrollo interrelacionado íntimamente con toda la naturaleza de su entorno. Por lo tanto, además de los signos y síntomas físicos, también tiene en cuenta su vitalidad, su vida emocional y su biografía. A partir de allí, se puede profundizar en el conocimiento de las causas reales de los desequilibrios (dolencias) y actuar con medicamentos obtenidos de los reinos animal, vegetal y mineral. </p>
                    <p>Esta medicina también se apoya en los conocimientos y medios de diagnóstico y practica de la medicina tradicional. Con su visión del hombre: del sano y por ende, también del enfermo puede enriquecer los recursos diagnósticos y terapéuticos. Brinda de esta manera, basamentos serios y amplios, necesarios para poder fundamentar el mentado concepto de “humanizar el arte de curar”.</p>
                </div>
            </div>
        </div>
    </div>

<? include("tpl/tpl.front_template_abajo_new.php"); ?>