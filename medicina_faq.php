<?php
$title              = "Preguntas Frecuentes";
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

                    <li><a href="salutogenesis.php">Salutogénesis</a></li>

                    <li><a href="medicina_faq.php" class='destacado' style='font-weight:bold;'>Preguntas frecuentes</a></li>

                </ul>
            </div>
            <div class="title">
                <h3>Preguntas frecuentes</h3>
            </div>

            <h4 class="subtitle">¿Por qué Weleda usa alcohol en sus medicamentos?</h4>
            <p>Tradicionalmente, la homeopatía y las tinturas vegetales se elaboraban utilizando agua y alcohol (etanol) mezclados. Esto proviene de una época en que los extractos se preparaban sumergiendo las plantas en vino o licores. Las mezclas de agua y etanol todavía son los métodos más comunes de extracción para tinturas, y se han establecido actualmente como una práctica farmacéutica estandarizada.</p>
            <p>Otra razón importante por la que se utiliza el etanol en los medicamentos de Weleda, es que el etanol es capaz de extraer más ingredientes activos  que otras sustancias usadas para extracción (glicerina o agua sola). Con un rango más amplio de ingredientes activos, la actividad terapéutica es también más amplia y el medicamento es por lo tanto más efectivo.</p>
            <p>Una segunda ventaja de usar alcohol para tinturas es que actúa como un conservante natural –bacterias, levaduras y mohos normalmente no crecen en una concentración de etanol a partir del 20%. Una tercera ventaja del alcohol es que, una vez que se ingiere, pierde su efecto conservante; por eso no daña la flora intestinal benigna.</p>
            <p>Las pequeñas cantidades de etanol que se ingieren en la homeopatía y en los productos vegetales son consideradas como inofensivas. Por ejemplo, el estándar de 10 gotas (0.5 ml) contiene dos gotas de etanol. La Academia Americana de Pediatría recomienda que un recién nacido de 3 kg, sólo debería tomar 3 ml de etanol en una dosis, esto es 30 veces más que la cantidad de una dosis de productos homeopáticos o vegetales. En comparación, una rebanada de pan contiene entre 100 mg y 200 mg de etanol.</p>

            <h4 class="subtitle">¿Qué tipo de alcohol es utilizado en la preparación de los medicamentos de Weleda?</h4>
            <p>En línea con todos los ingredientes de nuestros productos, los medicamentos están elaborados con alcohol etílico, procedente de de cultivo biológico, y están certificados como libres de gluten. Todas las fases del proceso de producción, incluyendo la fermentación, destilación, embalaje y transporte, están realizadas bajo estrictos criterios de control biológico.</p>

            <h4 class="subtitle">¿Por qué algunos medicamentos de Weleda precisan de prescripción médica para ser más eficaces y otros no?</h4>
            <p>Muchos medicamentos Weleda, por sus características, deben ser prescritos según un diagnóstico profesional para lograr un tratamiento personalizado y eficaz, adaptándose a las necesidades y el perfil de cada paciente. Otros muchos tienen unas indicaciones muy definidas que se adaptan a cuadros sintomatológicos muy comunes, como gripe o resfriados, pequeños traumatismos, insomnio leve, digestión débil, etcétera, los cuales pueden ser recomendados sin ningún problema por el farmacéutico.</p>

            <h4 class="subtitle">¿Por cuánto tiempo pueden conservarse los medicamentos Weleda?</h4>
            <p>Hasta la fecha de caducidad indicada en cada envase.</p>
        </div>
    </div>

<? include("tpl/tpl.front_template_abajo_new.php"); ?>