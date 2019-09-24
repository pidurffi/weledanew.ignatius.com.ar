<?php
error_reporting(E_ALL ^ E_STRICT);

define("DB_DATE_FORMAT_YMD",1);

class DB {
	function DB() {
	}
	
	function connect() {
	}
	
	/*
	 * Devuelve un resourse
	 */
	function execute($sql) {
	}
	
	/*
	 * Devuelve un vector asociativo o false si no hay mÃ¡s datos
	 */
	function getRow($resource) {
	}

	function getCouples($sql,$keyColumnName,$valueColumnName) {
		$res = $this->execute($sql);		
		if(!$res) return false;
		$result = array();
		while($row = $this->getRow($res)) {
			$result[$row[$keyColumnName]] = $row[$valueColumnName];
		}
		return $result;
	}

	/*
	 * Devuelve el Ãºltimo ID insertado
	 */
	function lastId() {
	}
	
	function count($resource) {
		
	}
	
	function dateFormat($format,$value) {
		
	}
	
}

?>