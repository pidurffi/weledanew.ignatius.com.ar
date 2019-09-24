<?php
include_once(GALIX_FOLDER."/class.Module.php");



class ModuleDynamicCss extends Module {

	protected $cssFile = "";

	

	function ModuleDynamicCss($params) {

		$this->cssFile = $params["cssFile"];

	}

	

	function exec($params) {

		GlobalManager::getTplMng()->setTemplate($this->cssFile);

		GlobalManager::getTplMng()->setType(TEMPLATE_TYPE_CSS);

		GlobalManager::getTplMng()->drawTemplate();

	}

}


?>