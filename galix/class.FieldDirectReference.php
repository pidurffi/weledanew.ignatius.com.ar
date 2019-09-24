<?php

include_once(GALIX_FOLDER."class.Field.php");
include_once(GALIX_FOLDER."class.EntityManager.php");

class FieldDirectReference extends Field {
	var $name;
	var $visualName;
	var $tableName;
	var $entityRefired;
	var $descriptionFieldName;
	var $required;

	var $visualValue;
	
	function FieldDirectReference($name,$params) {
		$this->name = $name;
		$this->visualName = $params['visualName'];
		$this->tableName = $params['tableName'];
		$this->entityRefired = $params['entityRefired'];
		$this->descriptionFieldName = $params['descriptionFieldName'];
		$this->required = $params['required'];		
	}
	
	function showFormField($params) {
		$referencedEntityManager = new EntityManager($this->entityRefired,array());
		$referencedEntityManager->prepareFields();
		$list = $referencedEntityManager->find();
		?><select name='<?=$this->name?>'>
			<? if(!$this->required) echo "<option value=''>Ninguno</option>" ?>
			<? foreach($list as $item) { ?>
			<option value="<?=$item['id']?>" <? if($this->value==$item['id']) echo "selected='selected'"; ?>><?=utf8_encode($item[$this->descriptionFieldName])?></option>
			<? } ?>	
		
		</select>	
		<?	
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
		if(empty($this->value)) $isNull = true;
		return valueToDb($this->value);
	}
	
	function fillWithDb($reg) {

		$this->visualValue = $reg[$this->name]; 

		$this->value = $reg[$this->tableName];
	}

	function getJoinSql($entityTableName,$uniqueExtraAlias) {
		$em = new EntityManager($this->entityRefired,array());
		$referenceTableName = $em->getEntityObject()->directTable;
		$sql = " JOIN ".$referenceTableName." ".$uniqueExtraAlias.$this->name." ";
		$sql.= " ON ".$entityTableName.".".$this->tableName." = ".$uniqueExtraAlias.$this->name.".id ";
		if(!$this->required) {
			$sql = " LEFT " . $sql;
		}
		return $sql;
	}
	
	function getFieldSqlDescription($entityTableName,$uniqueExtraAlias) {
		$sql = $uniqueExtraAlias.$this->name.".".$this->descriptionFieldName." AS ".$this->name.", ";

		$sql.= $entityTableName.".".$this->tableName." AS ".$this->tableName;
		return $sql;
	}

	function getValue() {
		return $this->value;
	}
	
	// DEPRECADO, NO USAR. EL ORDEN SE PASA DIRECTAMENTE EL NOMBRE DE LA COLUMNA A ORDENAR, SIN IMPORTAR EL ATRIBUTO DEL QUE SE TRATE
	/*
	function getFieldSqlOrder($entityTableName,$uniqueExtraAlias,$fieldOrder="") {
		return $this->name;
	}
	*/
}

?>