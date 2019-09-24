<?php
include_once(GALIX_FOLDER."class.Field.php");


class FieldBoolean extends Field {
	var $name;
	var $visualName;
	var $tableName;
	var $default;
        var $required;

	function FieldBoolean($name,$params) {
		$this->name = $name;
		$this->visualName = $params['visualName'];
		$this->tableName = $params['tableName'];
		$this->default = $params['default'];
		$this->value = $this->default;
                $this->required = $params['required'];
	}

	function showFormField($params) {
		echo "<input type='checkbox' name='".$this->name."' ";
		if($this->value) echo "checked='checked'";
		echo " />";
		return;
	}

        /*
	function validateFromPost(&$errors) {
		return true;
	}
         */

      	function validateFromPost(&$errors) {
            // Si existe el POST, el checkbox está activado y Value es True.
            // Si no, Value es False.
            if(!empty($_POST[$this->name])) $value = true;
		else $value = false;
            if($this->required) {
			if($value == false) {
                                if($this->name == "terminosycondiciones") $errors[] = "Debe aceptar los términos y condiciones";
                                    else $errors[] = "El campo ".$this->visualName." es obligatorio";
				return false;
			}
		}
	}


	function fillWithPost() {
		if(!empty($_POST[$this->name])) $this->value = true;
		else $this->value = false;
	}

	function  hasDirectSave() {
		return true;
	}

	function getValueForDbFromPost(&$isNull=false) {
		if($this->value) return "1";
		else return "0";
	}

	function fillWithDb($reg) {
		if($reg[$this->name]) $this->value = true;
		else $this->value = false;
	}

	function getJoinSql($entityTableName,$uniqueExtraAlias) {
		return "";
	}

	function getFieldSqlDescription($entityTableName,$uniqueExtraAlias) {
		$sql = $entityTableName.".".$this->tableName." AS ".$this->name;
		return $sql;
	}

	// DEPRECADO, NO USAR. EL ORDEN SE PASA DIRECTAMENTE EL NOMBRE DE LA COLUMNA A ORDENAR, SIN IMPORTAR EL ATRIBUTO DEL QUE SE TRATE
	/*
	function getFieldSqlOrder($entityTableName,$uniqueExtraAlias,$fieldOrder="") {
		return 	$this->name;
	}
	*/
}

?>