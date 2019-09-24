<?php

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityLinea extends Entity {

    var $directTable = "linea";
    var $attr = array(
        "nombre" => array(
            'visualName' => "Nombre",
            'tableName' => 'nombre',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "foto_listado" => array(
            'visualName' => "Foto Listado",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'linea',
            'columnReference' => '',
            'imageTableName' => 'foto_listado',
            'epigraphTableName' => 'epigrafe_foto_listado',
            'imageStoreFolder' => '/imagenes/productos',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 110,
            'imageY' => 110,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/productos',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "foto" => array(
            'visualName' => "Foto",
            'type' => 'imageAndEpigraph',
            'required' => true,
            'cardinality' => '1',
            'tableReference' => 'linea',
            'columnReference' => '',
            'imageTableName' => 'foto',
            'epigraphTableName' => 'epigrafe_foto',
            'imageStoreFolder' => '/imagenes/productos',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 1600,
            'imageY' => 383,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/productos',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "familia" => array(
            'visualName' => "Familia",
            'tableName' => 'id_familia',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityFamilia',
            'descriptionFieldName' => 'nombre',
            'required' => true
        ),
        "subtitulo" => array(
            'visualName' => "Subt&iacute;tulo",
            'tableName' => 'subtitulo',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "copete" => array(
            'visualName' => "Copete",
            'tableName' => 'copete',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "descripcion" => array(
            'visualName' => "Descripci&oacute;n",
            'tableName' => 'descripcion',
            'type' => 'htmlarea',
            'required' => false
        ),
        "foto_nombre" => array(
            'visualName' => "Foto Listado",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'linea',
            'columnReference' => '',
            'imageTableName' => 'foto_nombre',
            'epigraphTableName' => 'epigrafe_foto_nombre',
            'imageStoreFolder' => '/imagenes/productos',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 180,
            'imageY' => 25,
            'resizeBehavior' => RESIZE_BEHAVIOR_LIMITY,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/productos',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "foto_banner" => array(
            'visualName' => "Foto Listado",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'linea',
            'columnReference' => '',
            'imageTableName' => 'foto_banner',
            'epigraphTableName' => 'epigrafe_foto_banner',
            'imageStoreFolder' => '/imagenes/productos',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 72,
            'imageY' => 69,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/productos',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "titulo_banner" => array(
            'visualName' => "T&iacute;tulo",
            'tableName' => 'titulo_banner',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "descripcion_banner" => array(
            'visualName' => "Descripci&oacute;n",
            'tableName' => 'descripcion_banner',
            'type' => 'htmlarea',
            'required' => false
        ),
        "link_banner" => array(
            'visualName' => "Link",
            'tableName' => 'link_banner',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "orden" => array(
            'visualName' => "Orden",
            'tableName' => 'orden',
            'type' => 'number',
            'required' => false,
            'min' => 0,
            'max' => 10000
        ),
        "fondo_productos" => array(
            'visualName' => "Fondo productos",
            'tableName' => 'fondo_productos',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "fondo_columna_izquierda" => array(
            'visualName' => "Fondo columna izquierda",
            'tableName' => 'fondo_columna_izquierda',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "color_titulos_productos" => array(
            'visualName' => "Color t�tulos productos",
            'tableName' => 'color_titulos_productos',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "foto_enlace" => array(
            'visualName' => "Foto enlace izquierda",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'linea',
            'columnReference' => '',
            'imageTableName' => 'foto_enlace',
            'epigraphTableName' => 'epigrafe_foto_enlace',
            'imageStoreFolder' => '/imagenes/productos',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 170,
            'imageY' => 300,
            'resizeBehavior' => RESIZE_BEHAVIOR_LIMITX,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/productos',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "link_foto_enlace" => array(
            'visualName' => "Foto enlace izquieda (URL))",
            'tableName' => 'link_foto_enlace',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "nueva_ventana_foto_enlace" => array(
            'visualName' => "Enlace izquieda abre en nueva ventana",
            'tableName' => 'nueva_ventana_foto_enlace',
            'type' => 'boolean',
            'default' => 0,
            'required' => false
        )
    );

    function EntityLinea() {
        
    }

}

?>