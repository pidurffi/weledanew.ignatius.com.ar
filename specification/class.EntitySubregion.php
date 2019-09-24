<?php

include_once(GALIX_FOLDER."class.Entity.php");

class EntitySubregion extends Entity {
	var $directTable = "subregion";
	var $attr = array(
					"nombre"=>array(
										'visualName' => "Nombre",
										'tableName' => 'nombre',
										'type' => 'varchar',
										'length' => 255,
										'required' => true
										),
					"region" =>	array(
										'visualName' => "Region",
										'tableName' => 'id_region',
										'type' => 'direct_reference',
										'entityRefired' => 'EntityRegion',
										'descriptionFieldName' => 'nombre',
										'required' => false
										)
				);
	
	function EntitySubregion() {
		
	}
	
}

?>