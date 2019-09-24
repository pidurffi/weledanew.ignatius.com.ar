<?php
/* Entidad Obsoleta */
include_once(GALIX_FOLDER."class.Entity.php");

class EntityTipoEnvio extends Entity {

	var $directTable = "tipo_envio";
	var $attr = array(
					"tipo_envio"=>array(
										'visualName' => "Tipo de env�o",
										'tableName' => 'tipo_envio',
										'type' => 'varchar',
										'length' => 255,
										'required' => true
										),
     				"costo" => array(
                            'visualName' => "Costo",
                            'tableName' => 'costo',
                            'type' => 'number',
                            'required' => true,
                            'min' => 0,
                            'max' => 10000
                            ),
                    "orden" => array(
                                    'visualName' => "Orden",
                                    'tableName' => 'orden',
                                    'type' => 'number',
                                    'required' => false,
                                    'min' => 0,
                                    'max' => 10000
                                    )
					);



	function EntityTipoEnvio() {



	}



}



?>