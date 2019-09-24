<?php

class Module {
	protected $_db;
	
	function Module($params) {
		
	}
	
	function exec($params) {
	}

	function setDb($db) {
		$this->_db = $db;
	}
	
}

?>