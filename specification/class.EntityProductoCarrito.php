<?php

/* Clase de productos para el carrito mayorista. */
include_once(GALIX_FOLDER . "class.Entity.php");

class EntityProductoCarrito extends Entity {

    var $directTable = "producto";
    var $attr = array(
        "nombre" => array(
            'visualName' => "Nombre",
            'tableName' => 'nombre',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
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
        /* Precio "web" (venta al p�blico)  */
        "precio" => array(
            'visualName' => "Precio al p�blico",
            'tableName' => 'precio',
            'type' => 'number',
            'required' => false,
            'min' => 0,
            'max' => 10000
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
            'visualName' => "Producto fuera de stock (venta al p�blico)",
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
            'visualName' => "Producto fuera de stock (venta minorista/mayorista)",
            'tableName' => 'sin_stock_mayorista',
            'type' => 'boolean',
            'default' => false,
            'required' => false
        )
    );

    function EntityProducto() {
        
    }

}

?>