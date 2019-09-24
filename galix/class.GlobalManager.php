<?php

class GlobalManager {
	
	function setGlobal($key,$value) {
		$GLOBALS[$key]=$value;	
	}
	
	function getGlobal($key) {
		if(!isset($GLOBALS[$key])) return NULL;
		return $GLOBALS[$key];
	}
	
	function setTplMng($value) {
		GlobalManager::setGlobal('_templateManager',$value);
	}
	
	function getTplMng() {
		return GlobalManager::getGlobal('_templateManager');
	}
	
	function setDb($value) {
		GlobalManager::setGlobal('_db',$value);
	}
	
	function getDb() {
		return GlobalManager::getGlobal('_db');
	}

	function setMenu($menu) {
		GlobalManager::setGlobal('_menu',$menu);
	}
	
	function getMenu() {
		return GlobalManager::getGlobal('_menu');
	}
	
	function getLogin() {
		 return GlobalManager::getGlobal('_login');
	}
	
	function setLogin($login) {
		return GlobalManager::setGlobal("_login",$login);
	}

}


?>