<?php

class Field {
	var $value = "";
	
	// Constructor
	function Field($name,$params) {
	}

	// Devuelve la info del campo  
	function getValue() {
		return $this->value;
	}
	
	// Muesta el html
	function showFormField($params) {
	}
	
	// Funcion muy importante
	// Debe devolver true si anduvo ok y false si no (ademÃ¡s trae un vector con las descripciones de los errores)
	function validateFromPost(&$errors) {
	}
	
	// Le carga el value por un repost
	function fillWithPost() {
	}
	
	// Le carga el value directo de la base, pasandole un registro
	function fillWithDb($reg) {
	}
	
	// Funcion que indica si se graba directamente en la tabla de la entidad o no
	function  hasDirectSave() { 
	}
	
	// Funcion que indica si el valor es una funcion del motor de la base (para no agregar comillas)
	function isDBFunction() {
		return false;
	}
	
	// Para los que no se graban directamente -> graba en la base
	function doIndirectSaveFromPost($entityId,&$errors) {
	}
	
	// El nombre dice todo. Se aclara que es de post para hacerle, por ejemplo, el stripslashes
	function getValueForDbFromPost(&$isNull=false) {
	}

	// Devuelve la cadena con el join a hacer 
	function getJoinSql($entityTableName,$uniqueExtraAlias) {
		return "";
	}
	
	function getFieldSqlDescription($entityTableName,$uniqueExtraAlias) {
	}

	// Field order se usa para campos complejos, con varias tablas, que pueden tener varios ordenes
	// DEPRECADO, NO USAR. EL ORDEN SE PASA DIRECTAMENTE EL NOMBRE DE LA COLUMNA A ORDENAR, SIN IMPORTAR EL ATRIBUTO DEL QUE SE TRATE
	/*
	function getFieldSqlOrder($entityTableName,$uniqueExtraAlias,$fieldOrder="") {
		
	}*/
	
	function createJavascript() {
		echo "";
	}

}

?>