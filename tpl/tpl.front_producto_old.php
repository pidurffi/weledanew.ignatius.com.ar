<?php
$seccion = "cuidados_faciales";
$actual = "producto";
$destacado_col_izq = "0";
// nombre de la familia, línea y producto en el TITLE
$title = $familia["nombre"] . " - " . (isset($linea) ? $linea["nombre"] . " - " : "") . $producto["nombre"];
$color = "";
include_once(GALIX_FOLDER . "class.MenuSimpleLevel.php");

$leftMenu = new MenuSimpleLevel(array());

$producto_suelto = false;
if ($_GET['module'] == "fr_producto_suelto") {
    /* Los productos sueltos no están asociados a una línea, sino directamente a una familia. */
    $producto_suelto = true;
    $actual = "producto_suelto";
    $color_titulo_producto = $familia["color_titulos_productos"];
    foreach ($familias as $key => $fam) {
        $leftMenu->insertElement(htmlentities($fam["nombre"]), "index.php?module=fr_familia&id=" . $fam["id"], $fam["id"] == $familia['id']);
    }
} else {
    /* El producto está asociado a una línea */
    $color_titulo_producto = $linea["color_titulos_productos"];
    foreach ($lineas as $lineaMenu) {
        $leftMenu->insertElement(htmlentities($lineaMenu["nombre"]), "index.php?module=fr_linea&id=" . $lineaMenu["id"], $lineaMenu["id"] == RequestHandler::getGetValue("id_linea"));
    }
}

if (!empty($producto['titulo_banner'])) {
// Si no est� vac�o el titulo_banner, debo mostrar el recuadro a la izquirda
// que suele contener los consejos de utilizaci�
    $destacado_col_izq = "1";
}

$recorrido = array();
$recorrido[] = array("nombre" => "Inicio", "link" => "index.php");
$recorrido[] = array("nombre" => "Productos", "link" => "index.php?module=fr_productos");
$recorrido[] = array("nombre" => utf8_encode($familia["nombre"]), "link" => "index.php?module=fr_familia&id=" . $familia['id']);
if ($_GET['module'] != "fr_producto_suelto") {
    $recorrido[] = array("nombre" => utf8_encode($linea["nombre"]), "link" => "index.php?module=fr_linea&id=" . $linea['id']);
}

include(TPL_FOLDER . "tpl.front_template_arriba.php");
?>

<script type="text/javascript">

    function agregarProducto(id) {

        ventana = window.open("index.php?module=fr_carrito_add&id=" + id, "carrito", "width=800,height=500,resizable=yes,scrollbars=yes");

        ventana.focus();

    }

</script>

<h3 style="font-size: 22px; font-family: 'neo sans medium', Arial, Helvetica, sans-serif; padding:0px; margin:0 0 10px 0; color: #<?= $color_titulo_producto ?>; margin-bottom:5px; margin-left:-2px;"><?= utf8_encode($producto["nombre"]) ?></h3>

<div class="contenido_producto">
    <? /*
      <div class="tit_seccion">
      <h3><?=(!$producto_suelto)?htmlentities($linea["nombre"]):""?></h3>
      </div>
     */ ?>

    <? /*
      <div class="tit_contenido producto">
      <h4><?= $producto["epigrafe_foto_nombre"] ?></h4>
      <h3 style="font-size: 22px; font-family: 'neo sans medium', Arial, Helvetica, sans-serif; color: #<?=$color_titulo_producto?>; font-weight: bold;"><?=$producto["nombre"]?></h3>
      <?
      // Si no se cargó la imagen con el nombre del producto, lo muestro con H3.
      if (!$producto_suelto AND $producto["foto_nombre"] == "") {
      print("<h3 style='font-size: 22px; font-family: \"Neo Sans\", Arial, Helvetica, sans-serif; color: #" . $color_titulo_producto . "; font-weight: bold;'>" . $producto["nombre"] . "</h3>");
      }
      ?>
      <? /* No sale el título del producto para los "productos sueltos" (porque se hace con CSS).
      Por eso, muestro la imagen con IMG cuando producto_suelto es true. */ ?>
    <?
    /*
      if ($producto_suelto) {
      if ($producto["foto_nombre"] != "") {
      print("<img src=\"imagenes/productos/" . $producto["foto_nombre"] . "\">");
      } else {
      // Si no se cargó la imagen con el nombre del producto, lo muestro con H3.
      print("<h3 style='font-size: 22px; font-family: \"Neo Sans\", Arial, Helvetica, sans-serif; color: #" . $color_titulo_producto . "; font-weight: bold;'>" . $producto["nombre"] . "</h3>");
      }
      }
     */
    ?>
    <? /*
      </div>
     */ ?>


    <div class="tit_seccion"><h3><?= htmlentities($producto["subtitulo"]) ?> </h3></div>

    <div class="texto_linea">

        <p>
            <?= $producto["descripcion"] ?>

            <?php
            /* Botón "Me gusta" de Facebook. El data-href se deja vacío para que Facebook lo complete con el link de la página.
              Además se debe incluir un script en el HEAD (tpl.front_template_arriba.php. */
            if (CONSTANTE_PAIS == 'Argentina') {
                ?>
            <div class="fb-like" data-href="" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="arial"></div>
        <?php } ?>
        </p>

    </div>



</div>

<div class="imagen_producto" style="text-align: center; margin-top:0;">
    <img src="imagenes/productos/<?= $producto["foto"] ?>" >
    <? /* */ ?>

    <?
    if ($producto["en_maestro"] AND $producto['precio'] > 0 /* AND CONSTANTE_PAIS == 'Argentina' */) {
        // Muestro el precio y el botón para agregar al carrito.
        ?>
        <div style="text-align:center; color:#<?= $color_titulo_producto; ?>; font-size:16px; font-family: Arial, Helvetica, Verdana, sans-serif; font-weight:bold; padding-bottom:5px;">
            <?
            if (CONSTANTE_PAIS == 'Argentina') {
                // En Argentina imprimo el precio con decimales ($ 1 234,54).
                print("$ " . number_format($producto['precio'], 2, ',', '.'));
            } else {
                // En Chile imprimo el precio sin decimales y con separador de miles ($ 1 234).
                print("$ " . number_format($producto['precio'], 0, ',', '.'));
            }
            ?>
        </div>

        <? if (!$producto['sin_stock']) { /* Hay stock del producto */ ?>
            <a href="javascript:agregarProducto(<?= $producto['id'] ?>)">
                <img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
            </a>
        <? } else { /* No hay stock del producto */ ?>
            <h4 style="color:#<?= $color_titulo_producto; ?>;">Moment&aacute;neamente fuera de stock</h4>
            <?
        }
    } elseif ($producto["en_maestro"]) {
        // Si el pa�s no es Argentina o Chile, no imprimo nada.
        ?>

        <?
    }
    ?>
    <? if (CONSTANTE_PAIS == 'Argentina' OR CONSTANTE_PAIS == 'Chile') { ?>
        <a href="javascript:abrirCarrito()" title="e-shop">
            <img src="imagenes/estructura/carrito/BOTON_VERMICOMPRA.jpg" style="padding-top:20px;" border="0" alt="e-shop" title="e-shop" />
        </a>
        <?
        $total_items_en_carrito = 0;
        $importe_total_de_carrito = 0;
        // Para leer los datos del carrito...
        if (isset($_SESSION['GALIX']['WeledaFront']['carrito'])) {
            foreach ($_SESSION['GALIX']['WeledaFront']['carrito'] as $key => $val) {
                foreach ($_SESSION['GALIX']['WeledaFront']['carrito'][$key] as $key2 => $val2) {
                    if ($key2 == 'count') {
                        $cantidad = $_SESSION['GALIX']['WeledaFront']['carrito'][$key][$key2];
                        $total_items_en_carrito += $cantidad;
                        $precio = $_SESSION['GALIX']['WeledaFront']['carrito'][$key]['object']['precio'];
                        $importe_total_de_carrito += $cantidad * $precio;
                    }
                }
            }
        }
        ?>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align:center; color:#<?= $color_titulo_producto; ?>; font-size:12px; font-family: Arial, Helvetica, Verdana, sans-serif; font-weight:bold; padding-top:10px;">
            <tr>
                <td align="center">Cant. artículos:
                    <?= $total_items_en_carrito; ?></td>
            </tr>
            <tr>
                <td align="center">
                    <? if ($total_items_en_carrito >= 1) { ?>
                        Total: $
                        <?
                        if (CONSTANTE_PAIS == 'Argentina') {
                            // En Argentina imprimo el monto con decimales ($ 1.234,54).
                            print(number_format($importe_total_de_carrito, 2, ',', '.'));
                        } else {
                            // En Chile imprimo el monto sin decimales y con separador de miles ($ 1.234).
                            print(number_format($importe_total_de_carrito, 0, ',', '.'));
                        }
                        ?>
                    <? } ?>
                </td>
            </tr>
        </table>
    <? } ?>
</div>

<?
/* Solo muestra el DIV de "otros productos" si la línea tiene más de uno. */
if (count($productos) > 1) {
    ?>
    <div class="otros_productos">
        <h4>Otros productos de la <?= ($producto_suelto) ? "línea " . htmlentities(str_replace("Línea", "", $familia["nombre"])) : "l&iacute;nea " . htmlentities(str_replace("Línea", "", $linea["nombre"])); ?>
        </h4>
        <div>
        </div>
        <?
        $i = 0;
        foreach ($productos as $prod) {
            if ($prod["id"] == $producto["id"])
                continue;
            $i++;
            if ($i == 8)
                break;

            $prod["nombre"] = str_replace("FitoAcondicionador", "Fito-<br />Acondi-<br />cionador", $prod["nombre"]);
            $prod["nombre"] = str_replace("Acondicionador", "Acondi-<br />cionador", $prod["nombre"]);
            $prod["nombre"] = str_replace("Desodorante", "Deso-<br />dorante", $prod["nombre"]);
            $prod["nombre"] = str_replace("Fitoshampoo", "Fito-<br />shampoo", $prod["nombre"]);
            ?>
            <div class="otro_producto">
                <div class="img_otro_producto">
                    <?
                    if ($producto_suelto) {
                        $link = "index.php?module=fr_producto_suelto&id=" . $prod['id'];
                    } else {
                        $link = "index.php?module=fr_producto&id=" . $prod["id"] . "&id_linea=" . $linea["id"] . "&id_familia=" . $familia["id"];
                    }
                    ?>
                    <a href="<?= $link ?>"><img src="imagenes/productos/<?= $prod["foto_listado"] ?>" /></a>
                </div>
                <div class="texto_otro_producto">
                    <a href="<?= $link ?>" style="color:#<?= $color_titulo_producto; ?>">
                        <?= utf8_encode($prod["nombre"]) ?>
                    </a>
                </div>
            </div>
        <? } ?>
    </div>
<? } ?>

<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>