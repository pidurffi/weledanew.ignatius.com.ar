<?php
/* Entidad Obsoleta */
include_once(GALIX_FOLDER."class.Entity.php");

class EntityTarifaEnvio extends Entity {

	var $directTable = "TARIFA_ENVIO";
	var $attr = array(
					
     				"tarifa" => array(
                                    'visualName' => "Tarifa",
                                    'tableName' => 'tarifa',
                                    'type' => 'number',
                                    'required' => true,
                                    'min' => 0,
                                    'max' => 10000
                            ),
                    "codigoweleda" => array(
                                    'visualName' => "codigoweleda",
                                    'tableName' => 'codigoweleda',
                                    'type' => 'number',
                                    'required' => false,
                                    'min' => 0,
                                    'max' => 100000
                                    )
					);



	function EntityTarifaEnvio() {



	}



}



?>