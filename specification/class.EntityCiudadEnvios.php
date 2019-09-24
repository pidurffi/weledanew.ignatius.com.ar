<?php

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityCiudadEnvios extends Entity {

    var $directTable = "LOCALIDAD_ENVIOS";
    var $attr = array(
        "LOCALIDAD" => array('visualName' => "Ciudad", 'tableName' => 'LOCALIDAD', 'type' => 'varchar', 'length' => 255, 'required' => true),
        "provincia" => array('visualName' => "Provincia", 'tableName' => 'id_provincia', 'type' => 'direct_reference', 'entityRefired' => 'EntityProvinciaEnvios', 'descriptionFieldName' => 'provincia', 'required' => true),
    );

    function EntityCompra() {
        
    }

}

?>