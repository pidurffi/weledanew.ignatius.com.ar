<?php
include_once(GALIX_FOLDER."/class.Module.php");

class ModuleHome extends Module {

	var $template = "";
	
	function ModuleHome($params) {
		$this->template = $params['template'];
	}

	function exec($params) {
		GlobalManager::getTplMng()->setTemplate($this->template);
		GlobalManager::getTplMng()->setValue("menu",GlobalManager::getMenu()->getMenuElements());
		GlobalManager::getTplMng()->drawTemplate();
	}
}

?>