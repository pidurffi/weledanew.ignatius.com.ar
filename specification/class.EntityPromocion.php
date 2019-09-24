<?php

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityPromocion extends Entity {

    var $directTable = "promociones";
    var $attr = array(
        "nombre" => array(
            'visualName' => "Nombre",
            'tableName' => 'nombre',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "fecha_inicio" => array(
            'tableName' => 'fecha_inicio',
            'type' => "timestamp"
        ),
        "fecha_fin" => array(
            'tableName' => 'fecha_fin',
            'type' => "timestamp"
        ),
        "porcentaje_descuento" => array(
                        'visualName' => "Porcentaje de descuento",
                        'tableName' => 'porcentaje_descuento',
                        'type' => 'number',
                        'required' => false,
                        'min' => 0,
                        'max' => 100
                        ),


    );

    function EntityPromocion() {

    }

}

?>