<?php
$title = "Skin Food y vos";
$seccion = "clientes";
$archivoMenuIzq = $_SERVER['DOCUMENT_ROOT']."/inc/inc.columna_izquierda_$seccion.php";
$actual = "grupoweledaimagenes";
$destacado_col_izq = "0";
$color = "";
include("tpl/tpl.front_template_arriba.php");
?>

	<h3 style='font-size: 22px; font-family: "Neo Sans", Arial, Helvetica, sans-serif; color: #812A93; font-weight: bold; padding-bottom:0px;'>
					Skin Food y vos
	</h3>

	<? /*
	<iframe width="518" height="317" src="http://www.youtube.com/embed/DLMNaBECLbA?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
	*/ ?>
	
	<div id="player"></div>

    <script src="http://www.youtube.com/player_api"></script>

    <script>

        // create youtube player
        var player;
        function onYouTubePlayerAPIReady() {
            player = new YT.Player('player', {
              height: '317',
              width: '516',
              videoId: 'C13KN02wGww',
              events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
              }
            });
        }

        // autoplay video
        function onPlayerReady(event) {
            event.target.playVideo();
        }

        // when video ends
        function onPlayerStateChange(event) {        
            if(event.data === 0) {
				// Redirecciono  a otra p�gina.
                window.location = "index.php?module=fr_producto&id=137&id_linea=8&id_familia=1";
            }
        }

    </script>
  
  
<? include("tpl/tpl.front_template_abajo.php"); ?>