<?php

include_once(GALIX_FOLDER."class.Entity.php");

class EntitySeccionNoticias extends Entity {

	var $directTable = "seccion_noticias";
	var $attr = array(
					"seccion"=>array(
										'visualName' => "Secci�n",
										'tableName' => 'seccion',
										'type' => 'varchar',
										'length' => 255,
										'required' => false
										)
     								);



	function EntityNoticias() {



	}



}



?>