<? header("Content-type: text/css; charset=UTF-8;"); ?>

<?
/// FIXME: Arreglar los find con "e_table.id"
?>

<?
$actual = $_GET['actual'];

switch ($actual) {

    case "productos":
        ?>div#encabezado {background-image:url('./imagenes/estructura/top_productos.jpg');}
        div#contenido div.item_menu_productos {background-image:url('./imagenes/contenido/fdo_item_menu_prod.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/fdo_col_izq_productos.jpg'); margin-top:15px;}
        div#contenido div.tit_contenido.productos {
            width:94px;
            height:21px;
            background-image:url('./imagenes/contenido/tit_productos.jpg');
        }

        <?
        break;



    case "familia":

        if ((empty($_GET["id"])) || (!isValidId($_GET["id"])))
            FatalErrorHandler::finalize("Familia de productos no encontrada");

        $entityManager = new EntityManager("EntityFamilia", array());

        $entityManager->prepareFields();

        $list = $entityManager->find(true, "e_table.id = '" . $_GET["id"] . "'");

        if (empty($list))
            FatalErrorHandler::finalize("Familia de productos no encontrada");

        $familia = $list[0];
        ?>div#encabezado {background-image:url('./imagenes/productos/<?= $familia["foto"] ?>');}
        /*
        div#contenido div.item_menu_productos {background-image:url('./imagenes/contenido/fdo_item_menu_prod.jpg');} 		*/

        div#contenido div.item_menu_productos {background-image:url('./imagenes/contenido/<?= $familia["fondo_productos"] ?>');}

        div#columna_izquierda div.fdo_columna_izquierda  {background-image:url('./imagenes/estructura/<?= ($familia["fondo_columna_izquierda"] == "" ? "fdo_col_izq_productos.jpg" : $familia["fondo_columna_izquierda"]) ?>'); margin-top:15px;}
        div#columna_izquierda div.menu_columna_izquierda a:hover {color:#<?= ($familia["color_titulos_productos"] == "" ? "cb89f1" : $familia["color_titulos_productos"]) ?>;}

        div#contenido div.item_menu_productos div.texto a {color:#<?= ($familia["color_titulos_productos"] == "" ? "7c0049" : $familia["color_titulos_productos"]) ?>;}

        div#contenido div.tit_contenido.familia {

        width:90%;

        height:25px;

        background-image:url('./imagenes/productos/<?= $familia["foto_nombre"] ?>');

        background-repeat:no-repeat;

        }

        }<?
        break;



    case "linea":

        if ((empty($_GET["id"])) || (!isValidId($_GET["id"])))
            FatalErrorHandler::finalize("Linea de productos no encontrada");

        $entityManager = new EntityManager("EntityLinea", array());

        $entityManager->prepareFields();

        $list = $entityManager->find(true, "e_table.id = '" . $_GET["id"] . "'");

        if (empty($list))
            FatalErrorHandler::finalize("Linea de productos no encontrada");

        $linea = $list[0];
        ?>div#encabezado {background-image:url('./imagenes/productos/<?= $linea["foto"] ?>');}

        div#columna_izquierda div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/<?= ($linea["fondo_columna_izquierda"] == "" ? "fdo_col_izq_productos.jpg" : $linea["fondo_columna_izquierda"]) ?>');}

        div#contenido div.item_menu_productos {background-image:url('./imagenes/contenido/<?= $linea["fondo_productos"] ?>');}

        div#columna_izquierda div.menu_columna_izquierda a.iris {color:#cb89f1;}

        div#columna_izquierda div.menu_columna_izquierda a:hover {color:#<?= ($linea["color_titulos_productos"] == "" ? "cb89f1" : $linea["color_titulos_productos"]) ?>;}

        div.otros_productos

        {background-image:url('./imagenes/contenido/linea_iris/fdo_otros_prod_iris.jpg');}

        div.otros_productos h4 {color:#5c3e6d;}

        div#contenido div.tit_contenido.linea {

        margin:0 0 0 1px;

        width:314px;

        height:25px;

        background-image:url('./imagenes/productos/<?= $linea["foto_nombre"] ?>');

        background-repeat:no-repeat;

        }

        div#contenido div.item_menu_productos div.texto a {color:#<?= ($linea["color_titulos_productos"] == "" ? "7c0049" : $linea["color_titulos_productos"]) ?>

        }<?
        break;



    case "producto":

        if ((empty($_GET["id"])) || (!isValidId($_GET["id"])))
            FatalErrorHandler::finalize("Producto no encontrada");

        $entityManager = new EntityManager("EntityProducto", array());

        $entityManager->prepareFields();

        $list = $entityManager->find(true, "e_table.id = '" . $_GET["id"] . "'");

        if (empty($list))
            FatalErrorHandler::finalize("Linea de productos no encontrada");

        $producto = $list[0];

        $entityManager = new EntityManager("EntityLinea", array());

        $entityManager->prepareFields();

        $list = $entityManager->find(true, "e_table.id = '" . $producto["id_linea"] . "'");

        if (empty($list))
            FatalErrorHandler::finalize("Linea de productos no encontrada");

        $linea = $list[0];

        // La foto del top (o banner) es la de la línea, a menos que el producto
        // tenga una imagen específica
        if ($producto["foto_top"] != "")
            $foto_top = $producto["foto_top"];
        else
            $foto_top = $linea["foto"];
        ?>
        div#encabezado {background-image:url('./imagenes/productos/<?= $foto_top; ?>');}

        div#columna_izquierda div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/<?= ($linea["fondo_columna_izquierda"] == "" ? "fdo_col_izq_productos.jpg" : $linea["fondo_columna_izquierda"]) ?>');}

        div#columna_izquierda div.menu_columna_izquierda a.iris {color:#cb89f1;}

        div#columna_izquierda div.menu_columna_izquierda a:hover {color:#<?= ($linea["color_titulos_productos"] == "" ? "cb89f1" : $linea["color_titulos_productos"]) ?>;}

        div.otros_productos

        { /* background-image:url('./imagenes/contenido/linea_iris/fdo_otros_prod_iris.jpg');  */}

        div.otros_productos h4 {color:#5c3e6d;}

        div#contenido div.tit_contenido.producto {

        margin:0 0 0 1px;

        width:100%;

        height:42px;

        background-image:url('./imagenes/productos/<?= $producto["foto_nombre"] ?>');

        background-repeat:no-repeat;

        }

        <?
        break;

    case "producto_suelto":

        if ((empty($_GET["id"])) || (!isValidId($_GET["id"])))
            FatalErrorHandler::finalize("Producto no encontrado");
        $entityManager = new EntityManager("EntityProducto", array());
        $entityManager->prepareFields();
        $list = $entityManager->find(true, "e_table.id = '" . $_GET["id"] . "'");
        if (empty($list))
            FatalErrorHandler::finalize("Linea de productos no encontrada");
        $producto = $list[0];
        $entityManager = new EntityManager("EntityFamilia", array());
        $entityManager->prepareFields();
        $list = $entityManager->find(true, "e_table.id = '" . $producto["id_familia_directa"] . "'");
        if (empty($list))
            FatalErrorHandler::finalize("Familia de productos no encontrada");
        $familia = $list[0];

        // La foto del top (o banner) es la de la familia, a menos que el producto
        // tenga una imagen específica
        if ($producto["foto_top"] != "")
            $foto_top = $producto["foto_top"];
        else
            $foto_top = $familia["foto"];
        ?>
        div#encabezado {background-image:url('./imagenes/productos/<?= $foto_top; ?>');}
        div#columna_izquierda div.fdo_columna_izquierda  {background-image:url('./imagenes/estructura/<?= ($familia["fondo_columna_izquierda"] == "" ? "fdo_col_izq_productos.jpg" : $familia["fondo_columna_izquierda"]) ?>'); margin-top:15px;}
        div#columna_izquierda div.menu_columna_izquierda a:hover {color:#<?= ($familia["color_titulos_productos"] == "" ? "cb89f1" : $familia["color_titulos_productos"]) ?>;}

        }<?
        break;
    case "medicina":
        ?>div#encabezado {background-image:url('./imagenes/estructura/medicina/top_medicina.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/medicina/fdo_col_izq_medicina.jpg');margin-top:15px;}
        div.tit_contenido.medicina {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/medicina/tit_medicina.jpg');
        }
        div.item_menu_productos div.texto a {color:#6E2E97;}

        }<?
        break;
    case "actualidad":
        ?>div#encabezado {background-image:url('./imagenes/estructura/actualidad/top_actualidad.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/fdo_col_izq_noticias.jpg');margin-top:15px;}
        div.tit_contenido.actualidad {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/actualidad/tit_actualidad.jpg');
        }
        div.item_menu_productos div.texto a {color:#6E2E97;}

        }<?
        break;
    case "antroposofia":
        ?>div#encabezado {background-image:url('./imagenes/estructura/medicina/top_antroposofia.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/medicina/fdo_col_izq_medicina.jpg');margin-top:15px;}
        div.tit_contenido.antroposofia {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/medicina/tit_antroposofia.jpg');

        }<?
        break;
    case "procesos":
        ?>div#encabezado {background-image:url('./imagenes/estructura/medicina/top_procesos.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/medicina/fdo_col_izq_medicina.jpg');margin-top:15px;}
        div.tit_contenido.procesos {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/medicina/tit_procesos.jpg');

        }<?
        break;
    case "salutogenesis":
        ?>div#encabezado {background-image:url('./imagenes/estructura/medicina/top_salutogenesis.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/medicina/fdo_col_izq_medicina.jpg');margin-top:15px;}
        div.tit_contenido.salutogenesis {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/medicina/tit_salutogenesis.jpg');

        }<?
        break;
    case "medicos":
        ?>div#encabezado {background-image:url('./imagenes/estructura/medicina/top_medicina.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/medicina/fdo_col_izq_medicina.jpg');margin-top:15px;}
        div.tit_contenido.medicos {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/medicina/tit_medicina.jpg');

        }<?
        break;
    case "medicina_faq":
        ?>div#encabezado {background-image:url('./imagenes/estructura/medicina/top_med_preguntas.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/medicina/fdo_col_izq_medicina.jpg');margin-top:15px;}
        div.tit_contenido.medicina_faq {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/medicina/tit_med_preguntas.jpg');

        }<?
        break;
    case "grupoweledafilosofia":
        ?>div#encabezado {background-image:url('./imagenes/estructura/grupoweleda/top_grupo.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/grupoweleda/fdo_col_izq_grupo.jpg');margin-top:15px;}
        div.tit_contenido.grupoweledafilosofia {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/grupoweleda/tit_filosofia.jpg');

        }<?
        break;
    case "grupoweledahistoria":
        ?>div#encabezado {background-image:url('./imagenes/estructura/grupoweleda/top_historia.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/grupoweleda/fdo_col_izq_grupo.jpg');margin-top:15px;}
        div.tit_contenido.grupoweledahistoria {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/grupoweleda/tit_historia.jpg');

        }<?
        break;
    case "grupoweledacultivo":
        ?>div#encabezado {background-image:url('./imagenes/estructura/grupoweleda/top_cultivo.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/grupoweleda/fdo_col_izq_grupo.jpg');margin-top:15px;}
        div.tit_contenido.grupoweledacultivo {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/grupoweleda/tit_cultivo.jpg');

        }<?
        break;
    case "noticias":
        ?>div#encabezado {background-image:url('./imagenes/estructura/top_actualidad3.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/fdo_col_izq_noticias.jpg');margin-top:15px;}
        div.tit_contenido.noticias {
        width:310px;
        height:28px;
        background-image:url('./imagenes/contenido/tit_noticias.jpg');

        }<?
        break;
    case "prensa":
        ?>div#encabezado {background-image:url('./imagenes/estructura/top_prensa.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/fdo_col_izq_noticias.jpg');margin-top:15px;}
        div.tit_contenido.noticias {
        width:310px;
        height:28px;
        background-image:url('./imagenes/contenido/tit_prensa.jpg');

        }<?
        break;
    case "grupoweledaresponsabilidad":
        ?>div#encabezado {background-image:url('./imagenes/estructura/grupoweleda/top_responsabilidad.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/grupoweleda/fdo_col_izq_grupo.jpg');margin-top:15px;}
        div.tit_contenido.grupoweledaresponsabilidad {
        width:360px;
        height:28px;
        background-image:url('./imagenes/estructura/grupoweleda/tit_responsabilidad.jpg');

        }<?
        break;
    case "grupoweledaimagenes":
        ?>div#encabezado {background-image:url('./imagenes/productos/0_0_WEL_Top_CuidEspec_ABR2012.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/contenido/weleda_imagenes/fdo_col_izq_grupo.jpg');margin-top:15px;}
        div.tit_contenido.grupoweledaimagenes {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/grupoweleda/tit_imagenes.jpg');}
        div.item_menu_productos div.texto {background-image:url('./imagenes/contenido/weleda_imagenes/fdo_item_menu_imagenes.jpg');}
        div#contenido div.item_menu_productos div.texto a {color:#0C2E82;}
        }<?
        break;
    case "grupoweledatrabajar":
        ?>div#encabezado {background-image:url('./imagenes/estructura/grupoweleda/top_trabajar.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/grupoweleda/fdo_col_izq_grupo.jpg');margin-top:15px;}
        div.tit_contenido.grupoweledatrabajar {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/grupoweleda/tit_trabajar.jpg');

        }<?
        break;
    case "grupoweledainternacional":
        ?>div#encabezado {background-image:url('./imagenes/estructura/grupoweleda/top_internacional.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/grupoweleda/fdo_col_izq_grupo.jpg');margin-top:15px;}
        div.tit_contenido.grupoweledainternacional {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/grupoweleda/tit_internacional.jpg');

        }<?
        break;

    case "farmaciasbelladonasaavedra":
        ?>div#encabezado {background-image:url('./imagenes/estructura/farmacias/top_Ptosdeventa.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/fdo_col_izq_puntos.jpg');margin-top:15px;}


        }<?
        break;
    case "farmaciasbelladonarecoleta":
        ?>div#encabezado {background-image:url('./imagenes/estructura/farmacias/top_belladona.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/fdo_col_izq_puntos.jpg');margin-top:15px;}
        div.tit_contenido.farmaciasbelladonarecoleta {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/farmacias/tit_farmacia_bella_reco.jpg');

        }<?
        break;


    case "puntos_venta":
        ?>div#encabezado {background-image:url('./imagenes/estructura/farmacias/top_Ptosdeventa.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/fdo_col_izq_puntos.jpg');margin-top:15px;}
        div.tit_contenido.puntos_venta {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/farmacias/tit_otros-puntos.jpg');
        div.tit_contenido.mayoristas {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/puntosventa/tit_distrib.jpg');
        }<?
        break;

    case "ingredientes":
        ?>div#encabezado {background-image:url('./imagenes/estructura/ingredientes/top_ingredientes.jpg');}
        div.tit_contenido.ingredientes {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/ingredientes/tit_ingredientes.jpg');

        }<?
        break;

    case "galeria":
        ?>div#encabezado {background-image:url('./imagenes/lightbox/Top_Galeria.jpg');}

        <?
        break;

    case "contacto":
        ?>div#encabezado {background-image:url('./imagenes/estructura/top_contacto.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/fdo_col_izq_grupo.jpg');margin-top:15px;}
        div.tit_contenido.contacto {
        width:310px;
        height:28px;
        background-image:url('./imagenes/contenido/tit_contacto.jpg');

        }<?
        break;

    case "clientes":
        ?>div#encabezado {background-image:url('./imagenes/estructura/top_clientes.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/fdo_col_izq_noticias.jpg');margin-top:15px;}
        div.tit_contenido.clientes {
        width:310px;
        height:28px;
        background-image:url('./imagenes/contenido/tit_suscripcion.jpg');

        }<?
        break;

    case "mapasitio":
        ?>div#encabezado {background-image:url('./imagenes/estructura/top_mapa_sitio.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/fdo_col_izq_noticias.jpg');margin-top:15px;}
        div.tit_contenido.mapasitio {
        width:310px;
        height:28px;
        background-image:url('./imagenes/contenido/tit_mapa_sitio.jpg');

        }<?
        break;

    case "farmaciaweledachile":
        ?>div#encabezado {background-image:url('./imagenes/estructura/farmacias/top_farmacia_chile.jpg');}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/fdo_col_izq_puntos.jpg');margin-top:15px;}
        div.tit_contenido.farmaciaweledachile {
        width:310px;
        height:28px;
        background-image:url('./imagenes/estructura/farmacias/tit_farmacia_chile.jpg');

        }<?
        break;
    case "sorteo2":
        ?>div#encabezado {background-image:url('./imagenes/productos/0_Top_Bebe.jpg');}
        div.item_menu_productos div.texto {background-image:url('./imagenes/contenido/weleda_imagenes/fdo_item_menu_imagenes.jpg');}
        div#contenido div.item_menu_productos div.texto a {color:#0C2E82;}
        }<?
		break;
    case "sorteo":
        ?>div#encabezado {background-image:url('./imagenes/productos/1_Top_Bebe.jpg');}
        div.item_menu_productos div.texto {background-image:url('./imagenes/contenido/weleda_imagenes/fdo_item_menu_imagenes.jpg');}
        div#contenido div.item_menu_productos div.texto a {color:#0C2E82;}
        }<?
		break;
    case "bancodebosques":
        ?>div#encabezado {background-image:url('./imagenes/estructura/grupoweleda/top_bancodebosques.jpg');}
        div.item_menu_productos div.texto {background-image:url('./imagenes/contenido/weleda_imagenes/fdo_item_menu_imagenes.jpg');}
        div#contenido div.item_menu_productos div.texto a {color:#0C2E82;}
        }<?
    		break;
    case "buscador":
        ?>div#encabezado {background-image:url('./imagenes/estructura/grupoweleda/top_buscador.jpg');}
        }<?
	   		break;
    case "veganos":
        ?>div#encabezado {background-image:url('./imagenes/productos/0_Top_CuidFaciales-Iris.jpg');}
        }<?
		break;
    case "carritomayorista":
        ?>div#encabezado {background-image:url('./imagenes/estructura/carrito/top_carrito_mayorista.jpg');}
        }<?
		break;
    case "nuevosproductos":
        ?>div#encabezado {background-image:url('./imagenes/productos/0_Top_CuidFaciales-Granada.jpg')}
        div.fdo_columna_izquierda {background-image:url('./imagenes/estructura/grupoweleda/fdo_col_izq_grupo.jpg');margin-top:15px;}
        }<?

	
}?>