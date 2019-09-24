<?php



include_once(GALIX_FOLDER."class.Entity.php");



class EntityRegion extends Entity {

	var $directTable = "region";

	var $attr = array(
					"nombre"=>array(
										'visualName' => "Nombre",
										'tableName' => 'nombre',
										'type' => 'varchar',
										'length' => 255,
										'required' => true
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



	function EntityRegion() {



	}



}



?>