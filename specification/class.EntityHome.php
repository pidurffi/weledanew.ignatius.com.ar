<?php

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityHome extends Entity {

    var $directTable = "home";
    var $attr = array(
        "foto_grande" => array(
            'visualName' => "Fotos_",
            'type' => 'imageAndEpigraph',
            'required' => true,
            'cardinality' => '1',
            'tableReference' => 'home',
            'columnReference' => '',
            'imageTableName' => 'foto_grande',
            'epigraphTableName' => 'epigrafe_foto_grande',
            'imageStoreFolder' => '/imagenes/home',
            'epigraphLength' => 20,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 1600,
            'imageY' => 760,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            // Thumnbail = TRUE para que genere el thumbnail al subir la imagen
            // Si es FALSE, ignorar� los par�metros que siguen.
            'thumbnail' => true,
            // thumbnailX, thumbnailY = Tama�o del thumbail
            'thumbnailX' => 192,
            'thumbnailY' => 86,
            // thumbnailStoreFolder = Carpeta donde se guarda el thumbnail.
            // Debe ser diferente a la carpeta donde se guarda la imagen ya que se
            // guarda con el mismo nombre.
            'thumbnailStoreFolder' => '/imagenes/home/thumbnails',
            // thumbnailBehavior = Modo de generaci�n del thumbnail.
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "imagen_footer" => array(
            'visualName' => "Fotos_",
            'type' => 'imageAndEpigraph',
            'required' => true,
            'cardinality' => '1',
            'tableReference' => 'home',
            'columnReference' => '',
            'imageTableName' => 'imagen_footer',
            'epigraphTableName' => 'epigrafe_foto_grande',
            'imageStoreFolder' => '/imagenes/home',
            'epigraphLength' => 20,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 1920,
            'imageY' => 161,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            // Thumnbail = TRUE para que genere el thumbnail al subir la imagen
            // Si es FALSE, ignorar� los par�metros que siguen.
            'thumbnail' => true,
            // thumbnailX, thumbnailY = Tama�o del thumbail
            'thumbnailX' => 192,
            'thumbnailY' => 86,
            // thumbnailStoreFolder = Carpeta donde se guarda el thumbnail.
            // Debe ser diferente a la carpeta donde se guarda la imagen ya que se
            // guarda con el mismo nombre.
            'thumbnailStoreFolder' => '/imagenes/home/thumbnails',
            // thumbnailBehavior = Modo de generaci�n del thumbnail.
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "imagen_flotante" => array(
            'visualName' => "Fotos_",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'home',
            'columnReference' => '',
            'imageTableName' => 'imagen_flotante',
            'epigraphTableName' => 'epigrafe_foto_grande',
            'imageStoreFolder' => '/imagenes/home',
            'epigraphLength' => 20,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 115,
            'imageY' => 292,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            // Thumnbail = TRUE para que genere el thumbnail al subir la imagen
            // Si es FALSE, ignorar� los par�metros que siguen.
            'thumbnail' => true,
            // thumbnailX, thumbnailY = Tama�o del thumbail
            'thumbnailX' => 192,
            'thumbnailY' => 86,
            // thumbnailStoreFolder = Carpeta donde se guarda el thumbnail.
            // Debe ser diferente a la carpeta donde se guarda la imagen ya que se
            // guarda con el mismo nombre.
            'thumbnailStoreFolder' => '/imagenes/home/thumbnails',
            // thumbnailBehavior = Modo de generaci�n del thumbnail.
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "titulo_banner_1" => array(
            'visualName' => "Titulo banner",
            'tableName' => 'titulo_banner_1',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "copete_banner_1" => array(
            'visualName' => "Copete Banner 1",
            'tableName' => 'copete_banner_1',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "copete_banner_2" => array(
            'visualName' => "Copete Banner 2",
            'tableName' => 'copete_banner_2',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "link_botton_banner" => array(
            'visualName' => "Link Botton Banner",
            'tableName' => 'link_botton_banner',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "texto_link_botton_banner" => array(
            'visualName' => "Texto del Boton del Banner",
            'tableName' => 'texto_link_botton_banner',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "nueva_ventana_link_botton_banner" => array(
            'visualName' => "Abre en nueva ventana boton banner",
            'tableName' => 'nueva_ventana_link_botton_banner',
            'type' => 'boolean',
            'default' => 0,
            'required' => false
        ),

        "titulo_1" => array(
            'visualName' => "Fotos_",
            'type' => 'imageAndEpigraph',
            'required' => true,
            'cardinality' => '1',
            'tableReference' => 'home',
            'columnReference' => '',
            'imageTableName' => 'imagen_titulo_1',
            'epigraphTableName' => 'titulo_1',
            'imageStoreFolder' => '/imagenes/home',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 214,
            'imageY' => 15,
            'resizeBehavior' => RESIZE_BEHAVIOR_LIMITY,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/home',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "titulo_2" => array(
            'visualName' => "Fotos_",
            'type' => 'imageAndEpigraph',
            'required' => true,
            'cardinality' => '1',
            'tableReference' => 'home',
            'columnReference' => '',
            'imageTableName' => 'imagen_titulo_2',
            'epigraphTableName' => 'titulo_2',
            'imageStoreFolder' => '/imagenes/home',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 214,
            'imageY' => 15,
            'resizeBehavior' => RESIZE_BEHAVIOR_LIMITY,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/home',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "titulo_3" => array(
            'visualName' => "Fotos_",
            'type' => 'imageAndEpigraph',
            'required' => true,
            'cardinality' => '1',
            'tableReference' => 'home',
            'columnReference' => '',
            'imageTableName' => 'imagen_titulo_3',
            'epigraphTableName' => 'titulo_3',
            'imageStoreFolder' => '/imagenes/home',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 214,
            'imageY' => 15,
            'resizeBehavior' => RESIZE_BEHAVIOR_LIMITY,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/home',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "subtitulo_1" => array(
            'visualName' => "Subt&iacute;tulo",
            'tableName' => 'subtitulo_1',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "subtitulo_2" => array(
            'visualName' => "Subt&iacute;tulo",
            'tableName' => 'subtitulo_2',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "subtitulo_3" => array(
            'visualName' => "Subt&iacute;tulo",
            'tableName' => 'subtitulo_3',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "copete_1" => array(
            'visualName' => "Copete",
            'tableName' => 'copete_1',
            'type' => 'varchar',
            'length' => 500,
            'required' => false
        ),
        "copete_2" => array(
            'visualName' => "Copete",
            'tableName' => 'copete_2',
            'type' => 'varchar',
            'length' => 500,
            'required' => false
        ),
        "copete_3" => array(
            'visualName' => "Copete",
            'tableName' => 'copete_3',
            'type' => 'varchar',
            'length' => 500,
            'required' => false
        ),
        "imagen_1" => array(
            'visualName' => "Fotos_",
            'type' => 'imageAndEpigraph',
            'required' => true,
            'cardinality' => '1',
            'tableReference' => 'home',
            'columnReference' => '',
            'imageTableName' => 'imagen_1',
            'epigraphTableName' => 'texto_imagen_1',
            'imageStoreFolder' => '/imagenes/home',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 144,
            'imageY' => 116,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/home',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "imagen_2" => array(
            'visualName' => "Fotos_",
            'type' => 'imageAndEpigraph',
            'required' => true,
            'cardinality' => '1',
            'tableReference' => 'home',
            'columnReference' => '',
            'imageTableName' => 'imagen_2',
            'epigraphTableName' => 'texto_imagen_2',
            'imageStoreFolder' => '/imagenes/home',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 144,
            'imageY' => 116,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/home',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "imagen_3" => array(
            'visualName' => "Fotos_",
            'type' => 'imageAndEpigraph',
            'required' => true,
            'cardinality' => '1',
            'tableReference' => 'home',
            'columnReference' => '',
            'imageTableName' => 'imagen_3',
            'epigraphTableName' => 'texto_imagen_3',
            'imageStoreFolder' => '/imagenes/home',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 144,
            'imageY' => 116,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/home',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "link_1" => array(
            'visualName' => "Link",
            'tableName' => 'link_1',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "link_2" => array(
            'visualName' => "Link",
            'tableName' => 'link_2',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "link_3" => array(
            'visualName' => "Link",
            'tableName' => 'link_3',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "texto_link_1" => array(
            'visualName' => "Texto del link",
            'tableName' => 'texto_link_1',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "texto_link_2" => array(
            'visualName' => "Texto del link",
            'tableName' => 'texto_link_2',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "texto_link_3" => array(
            'visualName' => "Texto del link",
            'tableName' => 'texto_link_3',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "nueva_ventana_link_1" => array(
            'visualName' => "Abre en nueva ventana",
            'tableName' => 'nueva_ventana_link_1',
            'type' => 'boolean',
            'default' => 0,
            'required' => false
        ),
        "nueva_ventana_link_2" => array(
            'visualName' => "Abre en nueva ventana",
            'tableName' => 'nueva_ventana_link_2',
            'type' => 'boolean',
            'default' => 0,
            'required' => false
        ),
        "nueva_ventana_link_3" => array(
            'visualName' => "Abre en nueva ventana",
            'tableName' => 'nueva_ventana_link_3',
            'type' => 'boolean',
            'default' => 0,
            'required' => false
        )
    );

    function EntityHome() {
        
    }

}

?>