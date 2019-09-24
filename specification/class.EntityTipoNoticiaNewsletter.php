<?php

include_once(GALIX_FOLDER."class.Entity.php");
class EntityTipoNoticiaNewsletter extends Entity {
	
	var $directTable = "tipo_noticia_newsletter";	var $attr = array(
					"titulo"=>array(										'visualName' => "Nombre",										'tableName' => 'titulo',										'type' => 'varchar',										'length' => 255,										'required' => true
										),
					"imagen"=>array(										'visualName' => "Imagen",										'tableName' => 'imagen',										'type' => 'varchar',										'length' => 255,										'required' => true
										),
					);	
	function EntityTipoNoticiaNewsletter() {
		
	}
	
}

?>