<?php
$title              = "Cultivo";
$seccion            = "grupoweleda";
$actual             = "noticias";
$destacado_col_izq  = "0";
$color              = "";

$recorrido      = array();
$recorrido[]    = array("nombre"=>"Inicio","link"=>"index.php");
$recorrido[]    = array("nombre"=>"Grupo Weleda","link"=>"grupoweledafilosofia.php");


include("tpl/tpl.front_template_arriba_new.php");?>

    <div class="w-content">
        <div class="container">
            <div class="nav-noticias">
                <ul>

                    <li><a href="grupoweledafilosofia.php">Filosofía</a></li>

                    <li><a href="grupoweledahistoria.php">Historia</a></li>

                    <li><a href="grupoweledacultivo.php" class='destacado' style='font-weight:bold;'>Cultivo biodinámico</a></li>

                    <li><a href="grupoweledaresponsabilidad.php">Responsabilidad social y ambiental</a></li>

                    <li><a href="grupoweledaimagenes.php">Weleda en imágenes</a></li>

                    <li><a href="grupoweledatrabajar.php">Trabajar con nosotros</a></li>

                    <li><a href="grupoweledainternacional.php">Weleda internacional</a></li>

                </ul>
            </div>
            <div class="title">
                <h3>Grupo Weleda - Cultivo biodinámico</h3>
            </div>

            <p>Los campos de Weleda son cultivados a través del método biodinámico. Este método y los campos orgánicos tienen en común el enriquecimiento del suelo y el cultivo de plantas que no están cargadas con fertilizantes sintéticos, químicos y pesticidas. El método biodinámico va un paso adelante con la ayuda de las preparaciones a base de plantas medicinales. Estas incluyen preparaciones de compost hechas con hierbas como la camomila, la ortiga y el diente de león. Estos preparados especiales de sustancias relacionan el método de cultivo biodinámico con los ritmos cósmicos y lunares.</p>
            <p>¿Qué significa esto? En el transcurso del día, la tierra exhala por la mañana, y en la tarde inhala. Para Weleda, este ritmo diario significa que las plantas curativas se cosechan por la mañana, en el momento que la savia crece en la planta. Nosotros consideramos a la tierra como un organismo vivo. Plantas, animales y personas, todo lo que vive en la tierra, presenta una relación particular con este organismo y el cosmos.</p>
            <p>Weleda posee el huerto biodinámico más grande de Europa a pocos kilómetros de Schwäbsich Gmünd, al sur de Alemania, de donde proceden gran parte de las materias primas utilizadas en sus cosméticos y medicamentos.</p>
            <p>En 40 acres de extensión se cultivan más de 250 plantas medicinales libres de fertilizantes, pesticidas químicos y transgénicos. Los terrenos fueron adquiridos por Weleda hacia casi 90 años con el deseo de contar con materias primas de la más alta calidad para la elaboración de medicamentos homepáticos, antroposóficos y cosmética natural. Tanto el huerto como el cultivo están certificados bajo las directivas del cultivo biológico y el sello Demeter.</p>

        </div>
    </div>

<? include("tpl/tpl.front_template_abajo_new.php"); ?>