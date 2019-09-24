<?php
$title              = "Puntos de venta";
$seccion            = "farmaciasbelladona";
//$archivoMenuIzq = $_SERVER['DOCUMENT_ROOT'] . "/inc/inc.columna_izquierda_$seccion.php";
$actual             = "noticias";
$destacado_col_izq  = "0";
$color              = "";

include("tpl/tpl.front_template_arriba_new.php");
?>
    <script type="text/javascript">
        function abrirCarritoMayorista() {
            ventana = window.open("index.php?module=login&tc=may", "carrito", "width=800,height=500,resizable=yes,scrollbars=yes");
            ventana.focus();
        }
    </script>
    <div class="w-content">
        <div class="container">
            
            <div class="title">
                <h3>Puntos de Venta</h3>
            </div>

            <div class="r-img row">
                <div class="col-sm-4">
                    <img src="imagenes/estructura/farmacias/foto_Belladona.jpg" alt="Farmacia Belladona">
                </div>
                <div class="col-sm-8">
                    <p><a href="farmaciabelladonasaavedra.php" title="Farmacia Belladona">Farmacia Belladona</a></p>
                </div>
            </div>

            <div class="r-img row">
                <div class="col-sm-4">
                    <img src="imagenes/estructura/farmacias/foto_otrospuntos.jpg" alt="Otros puntos de venta">
                </div>
                <div class="col-sm-8">
                    <p><a href="index.php?module=fr_puntos_venta_ch" title="Otros puntos de venta">Otros puntos de venta</a></p>
                </div>
            </div>

            <div class="r-img row">
                <div class="col-sm-4">
                    <img src="imagenes/estructura/farmacias/foto_eshop.jpg" alt="E-shop">
                </div>
                <div class="col-sm-8">
                    <p><a href="javascript:abrirCarrito()" title="E-shop">E-shop</a></p>
                </div>
            </div>

            <div class="r-img row">
                <div class="col-sm-4">
                    <img src="imagenes/estructura/farmacias/distribuidores_mayoristas.jpg" alt="Distribuidores mayoristas">
                </div>
                <div class="col-sm-8">
                    <p><a href="distribuidoresmayoristas.php" title="Distribuidores mayoristas">Distribuidores mayoristas</a></p>
                </div>
            </div>

        </div>
    </div>

<? include("tpl/tpl.front_template_abajo_new.php"); ?>