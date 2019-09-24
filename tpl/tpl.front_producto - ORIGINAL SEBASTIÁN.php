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

include(TPL_FOLDER . "tpl.front_template_arriba_new.php");
?>

<script type="text/javascript">
    function agregarProducto(id) {

        ventana = window.open("index.php?module=fr_carrito_add&id=" + id, "carrito", "width=800,height=500,resizable=yes,scrollbars=yes");

        ventana.focus();

    }
</script>

    <section class="detail">
        <div class="container">
            <div class="row">
<!--                <div class="col-sm-2">-->
<!--                    <img src="images/detail/titles/01.jpg" alt="--><?//= utf8_encode($producto["nombre"]) ?><!--">-->
<!--                </div>-->
                <div class="col-sm-12">
                    <div class="row">
                        <div class="container">
                            
                            <div class="col-sm-7">
                                <img src="imagenes/productos/<?= $producto["foto"] ?>" alt="<?= utf8_encode($producto["nombre"]) ?>">
                            </div>
                            <div class="col-sm-5">
                                <div class="description">
                                    <h3><?= utf8_encode($producto["nombre"]) ?></h3>
                                    <span><?= htmlentities($producto["subtitulo"]) ?></span>
                                    <p>
                                        <?php
                                            /* Botón "Me gusta" de Facebook. El data-href se deja vacío para que Facebook lo complete con el link de la página.
                                          Además se debe incluir un script en el HEAD (tpl.front_template_arriba.php. */
                                            if (CONSTANTE_PAIS == 'Argentina') {
                                        ?>
                                            <div class="fb-like" data-href="" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="arial"></div>
                                        <?php } ?>
                                        <?= $producto["descripcion"] ?>
                                    </p>
    
                                    <div class="actions precios">
                                        <?
                                        if ($producto["en_maestro"] AND $producto['precio'] > 0 /* AND CONSTANTE_PAIS == 'Argentina' */) {
                                            // Muestro el precio y el botón para agregar al carrito.
                                         ?>
                                            <h4>
                                         <?
                                                if (CONSTANTE_PAIS == 'Argentina') {
                                                    // En Argentina imprimo el precio con decimales ($ 1 234,54).
                                                    print("$ " . number_format($producto['precio'], 2, ',', '.'));
                                                } else {
                                                    // En Chile imprimo el precio sin decimales y con separador de miles ($ 1 234).
                                                    print("$ " . number_format($producto['precio'], 0, ',', '.'));
                                                }
                                         ?>
                                            </h4>
    
                                         <? if (!$producto['sin_stock']) { /* Hay stock del producto */ ?>
                                                <a href="javascript:agregarProducto(<?= $producto['id'] ?>)">Comprar</a>
                                         <? } else { /* No hay stock del producto */ ?>
                                                <h4>Moment&aacute;neamente fuera de stock</h4>
                                                <?
                                            }
                                        } elseif ($producto["en_maestro"]) {
                                            // Si el pa�s no es Argentina o Chile, no imprimo nada.
    
                                        }
                                        ?>
    
    
                                        <? if (CONSTANTE_PAIS == 'Argentina' OR CONSTANTE_PAIS == 'Chile') { ?>
                                            <a href="javascript:abrirCarrito()" title="e-shop">Ver carrito</a>
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
                                            <h4>Cant. artículos: <?= $total_items_en_carrito; ?></h4>
                                            <h4>
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
                                        }
                                        ?>
                                            </h4>
                                        <? } ?>
                                    </div>
                                    <div class="ingrediente-principal">
                                        <div class="ingrediente-principal__image">
                                            <img src="images/ingredientes/aloe-vera.png">
                                        </div>
                                        <div class="ingrediente-principal__description">
                                            <h4>Aloe Vera</h4>
                                            <span>Aloe Barbadensis</span>
                                            <p>Emoliente, ingrediente añadido en el Fitoshampoo de Aloe</p>
                                        </div>
                                    </div>
                                    <div class="iconos-producto">
                                        <img src="images/icons/icon-no-animals.png">
                                        <img src="images/icons/icon-vegan.png">
                                        <img src="images/icons/icon-oil.png">
                                        <img src="images/icons/icon-natural.png">
                                        <img src="images/icons/icon-bio.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!--                    <div class="row mt">-->
<!--                        <div class="col-sm-6">-->
<!--                            <div class="tips">-->
<!--                                <h4>Consejos de uso</h4>-->
<!--                                <p>Aplicar en cara, cuello y escote mañana y noche con un algodón húmedo, evitando la zona del contorno de ojos. Repetir este paso hasta que el algodón quede limpio. A continuación aclarar con agua.</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-sm-6">-->
<!--                            <img src="images/detail/title-images/01.jpg" alt="">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="row mt">-->
<!--                        <div class="col-sm-6">-->
<!--                            <div class="comp">-->
<!--                                <h4>Composición</h4>-->
<!--                                <p>Agua, aceites esenciales naturales, jabón de aceite de oliva, extracto de raíz de iris, agua destilada de hamamelis, cera de lana, alcohol.</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-sm-6">-->
<!--                            <div class="about">-->
<!--                                <h4>Acerca de Hamammelis</h4>-->
<!--                                <p>Originario de Norte América, posee una acción astringente, fiebotónica y antiinflamatoria.<br>Se cosechan las cortezas en Otoño</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <?
                    /* Solo muestra el DIV de "otros productos" si la línea tiene más de uno. */
                    if (count($productos) > 1) {
                    ?>

                    <div class="other-products mt">
                        <h4>Otros productos</h4>
                        <div class="container">
                            
                            <div class="row">
                                <?
                                $i = 0;
                                foreach ($productos as $prod) {
                                    if ($prod["id"] == $producto["id"])
                                        continue;
    								if($prod['mostrar_en_web'] != 1)
    									continue;
                                    $i++;
                                    if ($i > 9)
                                        break;
    
                                    $prod["nombre"] = str_replace("FitoAcondicionador", "Fito-<br />Acondi-<br />cionador", $prod["nombre"]);
                                    $prod["nombre"] = str_replace("Acondicionador", "Acondi-<br />cionador", $prod["nombre"]);
                                    $prod["nombre"] = str_replace("Desodorante", "Deso-<br />dorante", $prod["nombre"]);
                                    $prod["nombre"] = str_replace("Fitoshampoo", "Fito-<br />shampoo", $prod["nombre"]);
    
                                    if ($producto_suelto) {
                                        $link = "index.php?module=fr_producto_suelto&id=" . $prod['id'];
                                    } else {
                                        $link = "index.php?module=fr_producto&id=" . $prod["id"] . "&id_linea=" . $linea["id"] . "&id_familia=" . $familia["id"];
                                    }
                                ?>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img src="imagenes/productos/<?= $prod["foto_listado"] ?>" alt="<?= utf8_encode($prod["nombre"]) ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <h5><?= utf8_encode($prod["nombre"]) ?></h5>
                                                <p><?= utf8_encode($prod["subtitulo"]) ?></p>
                                                <div class="actions">
                                                    <a href="<?= $link ?>" title="<?= utf8_encode($prod["nombre"]) ?>">Más info</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <? } ?>
    
                            </div>
                        </div>
                    </div>
                 <? } ?>
                </div>
            </div>
        </div>
    </section>



<? include(TPL_FOLDER . "tpl.front_template_abajo_new.php"); ?>