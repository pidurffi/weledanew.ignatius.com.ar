<?php

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityCompraProducto extends Entity {

    var $directTable = "compra_producto";
    var $attr = array("id_compra" => array(
            'visualName' => "Pedido nro.",
            'tableName' => 'id_compra',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityCompra',
            'descriptionFieldName' => 'id',
            'required' => false
        ),
        "nombre_producto" => array(
            'visualName' => "Producto",
            'tableName' => 'id_producto',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityProducto',
            'descriptionFieldName' => 'nombreweleda',
            'required' => false
        ),
        "codigo_producto" => array(
            'visualName' => "Producto",
            'tableName' => 'id_producto',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityProducto',
            'descriptionFieldName' => 'codigo',
            'required' => false
        ),
        "cantidad" => array(
            'visualName' => "Cantidad",
            'tableName' => 'cantidad',
            'type' => 'number',
            'required' => true,
            'min' => 0,
            'max' => 10000
        ),
        "sin_stock" => array(
            'visualName' => "sin_stock",
            'tableName' => 'id_producto',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityProducto',
            'descriptionFieldName' => 'sin_stock',
            'required' => false
        ),
    );

    function EntityCompraProducto() {
        
    }

}

?>