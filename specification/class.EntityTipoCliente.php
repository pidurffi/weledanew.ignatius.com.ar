<?php

include_once(GALIX_FOLDER."class.Entity.php");
class EntityTipoCliente extends Entity {
	
	var $directTable = "tipo_cliente";	var $attr = array(
					"nombre"=>array(										'visualName' => "Nombre",										'tableName' => 'nombre',										'type' => 'varchar',										'length' => 255,										'required' => true
										)
					);	
	function EntityTipoNoticiaNewsletter() {
		
	}
	
}

?>