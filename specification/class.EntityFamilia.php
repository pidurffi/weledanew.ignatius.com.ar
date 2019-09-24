<?php

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityFamilia extends Entity {

    var $directTable = "familia";
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
            'required' => true,
            'cardinality' => '1',
            'tableReference' => 'familia',
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
            'tableReference' => 'familia',
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
        "foto_nombre" => array(
            'visualName' => "Foto Listado",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'familia',
            'columnReference' => '',
            'imageTableName' => 'foto_nombre',
            'epigraphTableName' => 'epigrafe_foto_nombre',
            'imageStoreFolder' => '/imagenes/productos',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 180,
            'imageY' => 28,
            'resizeBehavior' => RESIZE_BEHAVIOR_LIMITY,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/productos',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
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
            'visualName' => "Color títulos productos",
            'tableName' => 'color_titulos_productos',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "foto_banner" => array(
            'visualName' => "Foto banner",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'familia',
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
            'visualName' => "T&iacute;tulo banner",
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
        "meta_keywords" => array(
            'visualName' => "meta_keywords",
            'tableName' => 'meta_keywords',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
		"meta_title" => array(
            'visualName' => "meta_title",
            'tableName' => 'meta_title',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
		"meta_description" => array(
            'visualName' => "meta_description",
            'tableName' => 'meta_description',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        )

    );

    function EntityFamilia() {
        
    }

}

?>