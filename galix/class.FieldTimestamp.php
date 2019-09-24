<?php
include_once(GALIX_FOLDER."class.Field.php");


class FieldTimestamp extends Field {
	var $name;
	var $tableName;

	function FieldTimestamp($name,$params) {
		$this->name = $name;
		$this->tableName = $params['tableName'];
	}

	function showFormField($params) {
		return;
	}

	function validateFromPost(&$errors) {
		return true;
	}

	function fillWithPost() {
		$this->value = "";
	}

	function  hasDirectSave() {
		return true;
	}

	function getValueForDbFromPost(&$isNull=false) {
		return "NOW()";
	}
	
	function isDBFunction() {
		return true;
	}

	function fillWithDb($reg) {
		$this->value = $reg[$this->name];
	}

	function getJoinSql($entityTableName,$uniqueExtraAlias) {
		return "";
	}

	function getFieldSqlDescription($entityTableName,$uniqueExtraAlias) {
		$sql = $entityTableName.".".$this->tableName." AS ".$this->name;
		return $sql;
	}

}

?>