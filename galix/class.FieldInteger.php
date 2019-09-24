<?php

include_once(GALIX_FOLDER."class.FieldVarchar.php");

class FieldInteger extends FieldVarchar {
	var $min;
	var $max;
	
	function FieldInteger($name,$params) {
		$params['length'] = 10;
		$this->FieldVarchar($name,$params);
		$this->min = (!empty($params['min']))?$params['min']:"0";
		$this->max = (!empty($params['max']))?$params['max']:"";
	}

	function validateFromPost(&$errors) {
		$value = $_POST[$this->name];
		if($this->required) {
			if(strlen(trim($value))==0) {
				$errors[] = "El campo ".$this->name." es obligatorio";
				return false; 
			}
		}
		if($value < $this->min) {
			$errors[] = "El campo ".$this->name." debe ser mayor a ".$this->min;
			return false;
		}
		
		if((!empty($this->max))&&($value > $this->max))
		if(strlen($value)>$this->length) {
			$errors[] = "El campo ".$this->name." debe ser menor a ".$this->max;
			return false;
		}
		return true;
	}	
	
}

?>