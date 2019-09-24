<?php

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityProducto extends Entity {

    var $directTable = "producto";
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
            'tableReference' => 'producto',
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
            'tableReference' => 'producto',
            'columnReference' => '',
            'imageTableName' => 'foto',
            'epigraphTableName' => 'epigrafe_foto',
            'imageStoreFolder' => '/imagenes/productos',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 537,
            'imageY' => 565,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/productos',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "linea" => array(
            'visualName' => "Linea",
            'tableName' => 'id_linea',
            'type' => "ComplexDirectReference",
            'required' => false,
            'entitiesReferreds' => array(
                "familia" => array(
                    "entityReferred" => "EntityFamilia",
                    "descriptionFieldName" => "nombre",
                    "referenceFieldName" => ""
                ),
                "linea" => array(
                    "entityReferred" => "EntityLinea",
                    "descriptionFieldName" => "nombre",
                    "referenceFieldName" => "id_familia"
                )
            )
        ),
        "subtitulo" => array(
            'visualName' => "Subt&iacute;tulo",
            'tableName' => 'subtitulo',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "descripcion" => array(
            'visualName' => "Descripci&oacute;n",
            'tableName' => 'descripcion',
            'type' => 'htmlarea',
            'required' => false
        ),
        "foto_nombre" => array( //no se usa mas
            'visualName' => "Foto Listado",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'producto',
            'columnReference' => '',
            'imageTableName' => 'foto_nombre',
            'epigraphTableName' => 'epigrafe_foto_nombre',
            'imageStoreFolder' => '/imagenes/productos',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 180,
            'imageY' => 20,
            'resizeBehavior' => RESIZE_BEHAVIOR_LIMITY,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/productos',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "familia_directa" => array(
            'visualName' => "Familia",
            'tableName' => 'id_familia_directa',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityFamilia',
            'descriptionFieldName' => 'nombre',
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
        "foto_banner" => array( //estan hardcoded, hay que cambiarlas?
            'visualName' => "Foto banner",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'producto',
            'columnReference' => '',
            'imageTableName' => 'foto_banner',
            'epigraphTableName' => 'epigrafe_foto_banner',
            'imageStoreFolder' => '/imagenes/productos',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 170,
            'imageY' => 300,
            'resizeBehavior' => RESIZE_BEHAVIOR_LIMITMAX,
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
		/* Precio "web" (venta al p�blico)  */
        "precio" => array(
            'visualName' => "Precio al público",
            'tableName' => 'precio',
            'type' => 'number',
            'required' => false,
            'min' => 0,
            'max' => 10000
        ),
        "foto_top" => array(
            'visualName' => "Imagen superior (top)",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'producto',
            'columnReference' => '',
            'imageTableName' => 'foto_top',
            'epigraphTableName' => 'epigrafe_foto_top',
            'imageStoreFolder' => '/imagenes/productos',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 768,
            'imageY' => 204,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/productos',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "peso" => array(
            'visualName' => "Peso",
            'tableName' => 'peso',
            'type' => 'number',
            'required' => false,
            'min' => 0,
            'max' => 100000
        ),
        "codigo" => array(
            'visualName' => "Codigo",
            'tableName' => 'codigo',
            'type' => 'varchar',
            'length' => 20,
            'required' => false
        ),
        "en_maestro" => array(
            'visualName' => "En Maestro",
            'tableName' => 'en_maestro',
            'type' => 'boolean',
            'default' => false,
            'required' => false
        ),
        "nombreweleda" => array(
            'visualName' => "Nombre Weleda",
            'tableName' => 'nombreweleda',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
		/* Sin stock "web" (para venta al p�blico) */
        "sin_stock" => array(
            'visualName' => "Producto fuera de stock (venta al público)",
            'tableName' => 'sin_stock',
            'type' => 'boolean',
            'default' => false,
            'required' => false
        ),
	"precio_minorista" => array(
            'visualName' => "Precio minorista",
            'tableName' => 'precio_minorista',
            'type' => 'number',
            'required' => false,
            'min' => 0,
            'max' => 10000
        ),
	"precio_mayorista" => array(
            'visualName' => "Precio mayorista",
            'tableName' => 'precio_mayorista',
            'type' => 'number',
            'required' => false,
            'min' => 0,
            'max' => 10000
        ),
	"sin_stock_mayorista" => array(
            'visualName' => "Producto fuera de stock (venta mayorista)",
            'tableName' => 'sin_stock_mayorista',
            'type' => 'boolean',
            'default' => false,
            'required' => false
        ),
        "sin_stock_minorista" => array(
            'visualName' => "Producto fuera de stock (venta minorista)",
            'tableName' => 'sin_stock_minorista',
            'type' => 'boolean',
            'default' => false,
            'required' => false
        ),
        "solo_para_minoristas" => array(
            'visualName' => "Producto solo para venta minorista",
            'tableName' => 'solo_para_minoristas',
            'type' => 'boolean',
            'default' => false,
            'required' => false
        ),
	"orden_carrito" => array(
            'visualName' => "Orden carrito",
            'tableName' => 'orden_carrito',
            'type' => 'number',
            'required' => false,
            'min' => 0,
            'max' => 10000
        ),
        "mostrar_en_web" => array(
            'visualName' => "Mostrar en la web (si no, solo se mostrar� en carrito mayorista/minorista)",
            'tableName' => 'mostrar_en_web',
            'type' => 'boolean',
            'default' => true,
            'required' => false
        ),
		
    );

    function EntityProducto() {
        
    }

}

?>