<?php
include_once(GALIX_FOLDER."class.Field.php");

define("ENCTYPE_NONE",1);
define("ENCTYPE_MD5",2);

class FieldPassword extends Field {
	var $name;
	var $visualName;
	var $tableName;
	var $length;
	var $required;
	var $valueValidation;
	var $encType;

	function FieldPassword($name,$params) {
		$this->name = $name;
		$this->visualName = $params['visualName'];
		$this->tableName = $params['tableName'];
		$this->length = (!empty($params['length']))?$params['length']:0;
		$this->required = $params['required'];
		$this->encType = $params['encType'];
	}

	function showFormField($params) {
		echo "<input type='password' name='".$this->name."' maxlength='".$this->length."' value='".$this->value."'/>";
		return;
	}

	function showFormFieldValidation($params) {
		echo "<input type='password' name='fp_validation_".$this->name."' maxlength='".$this->length."' value='".$this->valueValidation."'/>";
		return;
	}


	function validateFromPost(&$errors) {
		$value = $_POST[$this->name];
		if($this->required) {
			if(strlen(trim($value))==0) {
				$errors[] = "El campo ".$this->visualName." es obligatorio";
				return false;
			}
		}
		if(strlen($value)>$this->length) {
			$errors[] = "El campo ".$this->name." es demasiado largo (m&aacute;x: ".$this->length.")";
			return false;
		}
		if($_POST[$this->name] != $_POST['fp_validation_'.$this->name]) {
			$errors[] = "Verificaci&oacute;n de contrase&ntilde;a incorrecta";
			return false;
		}
		return true;
	}

	function fillWithPost() {
		$this->value = $_POST[$this->name];
		$this->valueValidation = $_POST['fp_validation_'.$this->name];
	}

	function  hasDirectSave() {
		return true;
	}

	function getValueForDbFromPost(&$isNull=false) {
		switch($this->encType) {
			case ENCTYPE_MD5:	return md5(valueToDb($this->value));break;
			default:	return valueToDb($this->value);
		}

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