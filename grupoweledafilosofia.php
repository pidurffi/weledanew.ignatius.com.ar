<?php
$title              = "Filosof&iacute;a";
$seccion            = "grupoweleda";
$actual             = "noticias";
$destacado_col_izq  = "0";
$color              = "";

$recorrido = array();
$recorrido[] = array("nombre"=>"Inicio","link"=>"index.php");
$recorrido[] = array("nombre"=>"Grupo Weleda","link"=>"grupoweledafilosofia.php");

include("tpl/tpl.front_template_arriba_new.php");?>

    <div class="w-content">
        <div class="container">
            <div class="nav-noticias">
                <ul>

                    <li><a href="grupoweledafilosofia.php" class='destacado' style='font-weight:bold;'>Filosofía</a></li>

                    <li><a href="grupoweledahistoria.php">Historia</a></li>

                    <li><a href="grupoweledacultivo.php">Cultivo biodinámico</a></li>

                    <li><a href="grupoweledaresponsabilidad.php">Responsabilidad social y ambiental</a></li>

                    <li><a href="grupoweledaimagenes.php">Weleda en imágenes</a></li>

                    <li><a href="grupoweledatrabajar.php">Trabajar con nosotros</a></li>

                    <li><a href="grupoweledainternacional.php">Weleda internacional</a></li>

                </ul>
            </div>
            <div class="title">
                <h3>Grupo Weleda - Filosofía</h3>
            </div>

            <p>Los productos Weleda han sido desarrollados para complementar el tratamiento de la persona como un todo, preservando la fuerza original de las sustancias naturales y apoyando las fuerzas sanadoras presentes en todo organismo.</p>
            <p>En Weleda creemos que cuanto mejor lleguemos a conocer a la naturaleza, mejor podremos conocernos a nosotros mismos y relacionarnos con el entorno. Bajo este concepto y basándonos en las principales enseñanzas de Rudolf Steiner, hemos desarrollado una línea verdaderamente innovadora de productos para el cuidado de la salud en armonía con el ser humano y la naturaleza.</p>
            <p>Los valores que Weleda aplica a sus métodos de producción se extienden a través de toda su estructura y en el día a día de la compañía. Una responsabilidad consciente hacia el medio ambiente se manifiesta en cada detalle de la operación, desde el cultivo orgánico de las plantas hasta el envasado final de los productos. En este sentido, los principios fundamentales en los que se basa la filosofía y acción de Weleda se concentran en:</p>

            <h4 class="subtitle">Ingredientes en armonía con el ser humano:</h4>
            <ul>
                <li>Principios activos vegetales en su mayoría de cultivos orgánicos, biodinámicos o de recolección silvestre controlada</li>
                <li>Sin conservantes sintéticos como los parabenos </li>
                <li>Sin colorantes o perfumes sintéticos </li>
                <li>Sin aceites minerales derivados del petróleo como las parafinas</li>
                <li>Sin sustancias procedentes de animales muertos </li>
                <li>No testado en animales </li>
                <li>Emulgentes provenientes de materias primas vegetales</li>
            </ul>

            <h4 class="subtitle">Procesos de producción en armonía con la naturaleza:</h4>

            <ul>
                <li>Conocimiento farmacéutico desde hace más de 85 años</li>
                <li>Procesos de fabricación de tradición farmacéutica sin sustancias desnaturalizantes</li>
                <li>Empresa certificada ISO 14001 y EMAS (en sucursales de Europa) por el respeto del medio ambiente</li>
                <li>Estrictos controles de calidad</li>
            </ul>

        </div>
    </div>

<? include("tpl/tpl.front_template_abajo_new.php"); ?>
