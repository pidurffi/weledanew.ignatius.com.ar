<?php
include_once(GALIX_FOLDER."class.FieldVarchar.php");
include_once(GALIX_FOLDER."class.FieldDirectReference.php");
include_once(GALIX_FOLDER."class.FieldHTMLArea.php");
include_once(GALIX_FOLDER."class.FieldImageEpigraph.php");
include_once(GALIX_FOLDER."class.FieldNumber.php");
include_once(GALIX_FOLDER."class.FieldFile.php");
include_once(GALIX_FOLDER."class.FieldComplexDirectReference.php");
include_once(GALIX_FOLDER."class.FieldPassword.php");
include_once(GALIX_FOLDER."class.FieldBoolean.php");
include_once(GALIX_FOLDER."class.FieldDate.php");
include_once(GALIX_FOLDER."class.FieldTimestamp.php");

class EntityManager {
	var $tableNameAliasForSql = "e_table";
	var $entityObject;
	var $fields = array();
	var $fieldsMapping = array(
						'varchar'=>'FieldVarchar',
						'htmlarea'=>'FieldHTMLArea',
						'direct_reference'=>"FieldDirectReference",
						'imageAndEpigraph'=>"FieldImageEpigraph",
						'number'=>'FieldNumber',
						'file'=>'FieldFile',
						'ComplexDirectReference'=>'FieldComplexDirectReference',
						'password' => 'FieldPassword',
						'boolean' => 'FieldBoolean',
						'date' => 'FieldDate',
						'timestamp' => 'FieldTimestamp'
							);
							
	function EntityManager($entityName, $params) {
		$this->entityObject = new $entityName();
	}
	
	function prepareFields() {
		foreach($this->entityObject->attr as $key=>$attr) {
			$type = $attr['type'];
			$className = $this->fieldsMapping[$type];
			// FIXME: cambiar a un die
			if(!class_exists($className)) {
				echo ("No existe $className");
				continue;
			}
			$field = new $className($key,$attr);
			$this->fields[$key] = $field; 			
		}
	}
	
	function fillFieldsWithPost() {
		foreach($this->fields as $field) {
			$field->fillWithPost();
		}
	}
	
	// sin updateId es nuevo
	function saveFromPost(&$errors,$updateId=0) {
		$directSaveFields = array();
		$noDirectSaveFields = array();
		$columnsName = array();
		$values = array();
		foreach($this->fields as $key=>$field) {
			$isNull = false;
			if($field->hasDirectSave()) {
				$directSaveFields[$field->tableName]=$field;
				$columnsName[] = $field->tableName;
				$value = $field->getValueForDbFromPost($isNull);
				if($isNull) {
					$values[] = "NULL";
				}
				else {
					if($field->isDBFunction()) {
						$values[] = $value;
					}
					else {
						$values[] = "'".$value."'";
					}
				}
			}
			else {
				$noDirectSaveFields[] = $this->fields[$key];
			}
		}
		
		if($updateId == 0) {
			$sql = "INSERT INTO ".$this->entityObject->directTable;
			$sql.= " (" . implode(',',$columnsName) . " ) ";
			$sql.= " VALUES (" . utf8_decode(implode(',', $values)) . " )";
		}
		else {
			$sql = "UPDATE ".$this->entityObject->directTable." SET ";
			foreach($columnsName as $key=>$column) {
				$sql.= $column . " = " . utf8_decode($values[$key]) . ", ";
			}
			$sql.= " id = '$updateId' ";
			$sql.= " WHERE id = '$updateId'";
		}
		$res = GlobalManager::getDb()->execute($sql);
		$entityId = ($updateId == 0)? GlobalManager::getDb()->lastId():$updateId;
		
		if(!$res) {
			$errores[] = "Error de base de datos"; 
		}

		foreach($noDirectSaveFields as $field) {
			$field->doIndirectSaveFromPost($entityId,$errores);
		}

		return $entityId;
	}
	
	function loadFromDb(&$errors,$id) {
		if(!isValidId($id)) {
			$errors[] = 'Objeto inexistente';
			return false;
		}

		$items = $this->find(true,$this->tableNameAliasForSql.".id = $id");
		if(sizeof($items)!=1) {
			$errors[] = 'Objeto inexistente';
			return false;
		}
		
		foreach($this->fields as $key=>$value) {
			$this->entityObject->values[$key] = $value->getValue();
		}
		
		return true;

	}
	
	private function findFieldOrder($fieldName) {
		$i = 0;
		foreach($this->fields as $key=>$value) {
			if($fieldName == $key) {
				return $i; 
			}
			$i++;
		}
	}
	
	// deeply dice si entrar en profundidad a traer de todos los campos
	// filter es el sql a filtar
	// order = nombreCampo
	// TODO: implementar ordenado
	function find($deeply=false,$filter="1=1",$order=null) {
		$tableName = $this->tableNameAliasForSql;
		$filter = str_replace("@entity_id",$tableName.".id",$filter);
		
		$sql = " SELECT ".$tableName.".id, ".$tableName.".id AS entity_id ";
		$i=0;
		foreach($this->fields as $field) {
			$sql.= ",".$field->getFieldSqlDescription($tableName,"r_".$i++."_");
		}
		$sql.= " FROM ".$this->entityObject->directTable." ".$tableName. " ";
		$i=0;
		foreach($this->fields as $field) {
			$joinSql = $field->getJoinSql($tableName,"r_".$i++."_");
			if($joinSql != "") $sql.=" ".$joinSql." ";
		}
		$sql.= " WHERE $filter ";
			
		if(!empty($order)) {
			if(!is_array($order)) {
				$order = array($order);
			}
			$sql.= " ORDER BY ";
			$orders = array();
			foreach($order as $oneOrder) {
				list($orderField,$orderType) = explode(",",$oneOrder);
				$orders[] = $orderField." ".$orderType;
				/* DEPRECADO 
				$orders[] = $this->fields[$orderField]->getFieldSqlOrder($tableName,$this->findFieldOrder($orderField),$orderSubField) . " " . $orderType . " ";
				*/
			}
			$sql.= implode(",",$orders);
		}
		
		$res = GlobalManager::getDb()->execute($sql);
		$list = array();
		while($reg = GlobalManager::getDb()->getRow($res)) {
			$list[] = $reg;
			if($deeply) {
				foreach($this->fields as $key=>$field) {
					$this->fields[$key]->fillWithDb($reg);
				}
			}
		}
		return $list;
	}
	
	function createJavascripts() {
		$js = "";
		foreach($this->fields as $field) {
			$js.= $field->createJavascript();
		}
		return true;
	}
	
	function getEntityObject() {
		return $this->entityObject;
	}

	function delete($entityId,&$errors) {
		$directSaveFields = array();
		$noDirectSaveFields = array();
		foreach($this->fields as $key=>$field) {
			if($field->hasDirectSave()) {
				$directSaveFields[$field->tableName]=$field;
			}
			else {
				$noDirectSaveFields[] = $this->fields[$key];
			}
		}
		$sql = "DELETE FROM ".$this->entityObject->directTable." WHERE id = '".$entityId."'";
		GlobalManager::getDb()->execute($sql);
		foreach($noDirectSaveFields as $key=>$field) {
			$field->delete($entityId,$errors);
		}
		
	}
}

?>