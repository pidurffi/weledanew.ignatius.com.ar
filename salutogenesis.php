<?php
$title              = "Salutog&eacute;nesis";
$seccion            = "medicina";
$actual             = "noticias";
$destacado_col_izq  = "0";
$color              = "";

$recorrido      = array();
$recorrido[]    = array("nombre"=>"Inicio","link"=>"index.php");
$recorrido[]    = array("nombre"=>"Medicina antropos&oacute;fica","link"=>"medicina.php");

include("tpl/tpl.front_template_arriba_new.php");?>

    <div class="w-content">
        <div class="container">
            <div class="nav-noticias">
                <ul>

                    <li><a href="antroposofia.php">Antroposofía y Homeopatía</a></li>

                    <li><a href="procesos.php">Procesos farmaceúticos</a></li>

                    <li><a href="salutogenesis.php" class='destacado' style='font-weight:bold;'>Salutogénesis</a></li>

                    <li><a href="medicina_faq.php">Preguntas frecuentes</a></li>

                </ul>
            </div>
            <div class="title">
                <h3>Salutogénesis</h3>
            </div>
            <h4 class="subtitle">¿Qué es la Salutogénesis?</h4>
            <p>La Salutogénesis es un enfoque diferente en la medicina, que investiga las fuerzas de autocuración del organismo humano. Por ejemplo, en el caso de una enfermedad infecciosa, más que preguntarse por la causa de la enfermedad, se pregunta ¿Por qué uno se contagió pero el otro no? ¿Qué lo mantuvo sano? Más allá de la prevención convencional, la Salutogénesis concibe la salud como un estado de integración físico, anímico y mental, basado en la activación de las propias defensas del cuerpo, el desarrollo de la resistencia y la capacidad de adaptación al cambio. Se ocupa no sólo de acabar con la enfermedad sino más bien de encontrar los medios para mantener la salud.</p>

            <h4 class="subtitle">El enfoque atroposófico de la salud</h4>
            <p>La salud evoluciona de un constante balance entre polaridades tales como sueño y vigilia, reposo y movimiento, alegría y pena. Dado que el bienestar depende de la actitud personal ante la vida y las decisiones tomadas en el camino, existen tantos estados de salud como personas.</p>
        </div>
    </div>

<? include("tpl/tpl.front_template_abajo_new.php"); ?>
