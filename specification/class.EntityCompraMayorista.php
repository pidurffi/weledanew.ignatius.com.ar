<?php

/* Compra Mayorista. Es similar a compra pero se eliminan las campos relacionados a otras tablas, como provincia.
 */

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityCompraMayorista extends Entity {

    var $directTable = "compra";
    var $attr = array("nombre" => array('visualName' => "Nombre", 'tableName' => 'nombre', 'type' => 'varchar', 'length' => 255, 'required' => true),
        "direccion" => array('visualName' => "Direcci&oacute;n", 'tableName' => 'direccion', 'type' => 'varchar', 'length' => 255, 'required' => true),
        "codigo_postal" => array('visualName' => "C&oacute;digo Postal", 'tableName' => 'codpostal', 'type' => 'varchar', 'length' => 255, 'required' => true),
        /* Nombre del cliente (sin apellido) */
        "cliente" => array('visualName' => "Cliente", 'tableName' => 'id_cliente', 'type' => 'direct_reference', 'entityRefired' => 'EntityCliente', 'descriptionFieldName' => 'nombre', 'required' => true),
        "costo_total" => array('visualName' => "Costo Total", 'tableName' => 'costo_total', 'type' => 'varchar', 'length' => 255, 'required' => false),
        "costo_envio" => array('visualName' => "Costo Envío", 'tableName' => 'costo_envio', 'type' => 'varchar', 'length' => 255, 'required' => false),
        "fecha" => array('tableName' => 'fecha', 'type' => "timestamp"),
        "dineromail_estado_operacion" => array('visualName' => "Estado operación DineroMail", 'tableName' => 'dineromail_estado_operacion', 'type' => 'number', 'min' => 0, 'max' => 100, 'required' => false),
        /* Compra válida. Se pone en 1 si es válida. */
        "valida" => array('visualName' => "Válida", 'tableName' => 'valida', 'type' => 'number', 'min' => 0, 'max' => 1, 'required' => false),
        "descuento_pesos" => array('visualName' => "descuento en pesos", 'tableName' => 'descuento_pesos', 'type' => 'number', 'min' => 0, 'required' => false),
        "descuento_porcentaje" => array('visualName' => "porcentaje de descuento", 'tableName' => 'descuento_porcentaje', 'type' => 'number', 'min' => 0, 'max' => 100, 'required' => false),
        "nombre_promocion" => array('visualName' => "nombre de la promoción", 'tableName' => 'nombre_promocion', 'type' => 'varchar', 'length' => 255, 'required' => false)
    );

    function EntityCompraMayorista() {
        
    }

}

?>