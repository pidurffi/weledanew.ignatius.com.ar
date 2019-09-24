<?php


include_once(GALIX_FOLDER."class.Field.php");



class FieldHTMLArea extends Field {

	var $name;

	var $visualName;

	var $tableName;

	var $required;

	

	function FieldHTMLArea($name,$params) {

		$this->name = $name;

		$this->visualName = $params['visualName'];

		$this->tableName = $params['tableName'];

		$this->required = $params['required'];		

	}

	
	/*
	function showFormField($params) {
		include_once(INCLUDE_FOLDER."external/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor($this->name) ;
		$oFCKeditor->BasePath = '../includes/external/fckeditor/' ;
		$oFCKeditor->Value = $this->value ;
		$oFCKeditor->ToolbarSet = 'Basic';
		$oFCKeditor->Create() ;
	}
	*/
	
	function showFormField($params) {
		//include_once(INCLUDE_FOLDER."external/ckeditor/ckeditor.js");
		/*
		$oFCKeditor = new FCKeditor($this->name);
		$oFCKeditor->BasePath = '../includes/external/ckeditor/' ;
		$oFCKeditor->Value = $this->value ;
		$oFCKeditor->ToolbarSet = 'Basic';
		$oFCKeditor->Create() ;
		*/
		
		echo "<textarea id='" . $this->name . "' name='" . $this->name . "'>" . utf8_encode($this->value) . "</textarea>";
		echo "<script>CKEDITOR.replace( '" . $this->name . "' );</script>";
		echo "<script>";
		echo "window.onload = function() {";
        echo "CKEDITOR.replace( '" . $this->name . "' );";
		echo "};";
		echo "</script>";
		return;
	}

	

	function validateFromPost(&$errors) {

		

	}

	

	function fillWithPost() {

		$this->value = $_POST[$this->name];	

	}

	

	function  hasDirectSave() {

		return true;	

	}	

	

	function getValueForDbFromPost(&$isNull=false) {

		return valueToDb($this->value);

	}



	function fillWithDb($reg) {

		$this->value = $reg[$this->name];

	}

	

	function getJoinSql($entityTableName,$uniqueExtraAlias) {

		return "";

	}

	

	function getFieldSqlDescription($entityTableName,$uniqueExtraAlias) {

		$sql = $entityTableName.".".$this->tableName." as ".$this->name;

		return $sql;

	}	

	// DEPRECADO, NO USAR. EL ORDEN SE PASA DIRECTAMENTE EL NOMBRE DE LA COLUMNA A ORDENAR, SIN IMPORTAR EL ATRIBUTO DEL QUE SE TRATE
	/*
	function getFieldSqlOrder($entityTableName,$uniqueExtraAlias,$fieldOrder="") {
		return $this->name;
	}
	*/
	
}


?>