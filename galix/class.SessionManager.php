<?php
class SessionManager {
	
	static function reset() {
		unset($_SESSION['GALIX'][SPECIFICATION_NAME]);
	}
	
	static function setValue($key,$value) {
		$_SESSION['GALIX'][SPECIFICATION_NAME][$key]=$value;
	}
	
	static function getValue($key) {
		if((!isset($_SESSION)) || (empty($_SESSION)))
			return null;
		else {
			if(isset($_SESSION['GALIX'][SPECIFICATION_NAME][$key])) return $_SESSION['GALIX'][SPECIFICATION_NAME][$key];
			else return null;
		}
	}
	
	static function initializeArray($key) {
		if(empty($_SESSION['GALIX'][SPECIFICATION_NAME][$key])) {
			$_SESSION['GALIX'][SPECIFICATION_NAME][$key] = array();
		}
		return true;
	}
	
	static function insertInArray($arrayName,$value,$key="") {
		if($key == "") {
			$_SESSION['GALIX'][SPECIFICATION_NAME][$arrayName][] = $value;
		}
		else {
			$_SESSION['GALIX'][SPECIFICATION_NAME][$arrayName][$key] =  $value;
		}
	}
	
	static function removeInArray($arrayName,$key) {
		if(!is_array($_SESSION['GALIX'][SPECIFICATION_NAME][$arrayName])) return false;
		if(!isset($_SESSION['GALIX'][SPECIFICATION_NAME][$arrayName][$key])) return false;
		unset($_SESSION['GALIX'][SPECIFICATION_NAME][$arrayName][$key]);
	}
	
	
}

?>