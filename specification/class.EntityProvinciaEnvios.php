<?php

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityProvinciaEnvios extends Entity {

    var $directTable = "PROVINCIA_ENVIOS";
    var $attr = array(
        "provincia" => array(
            'visualName' => "Provincia",
            'tableName' => 'PROVINCIA',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        )
    );

    function EntityCompra() {
        
    }

}

?>