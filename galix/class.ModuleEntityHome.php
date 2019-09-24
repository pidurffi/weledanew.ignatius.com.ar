<?php
include_once(GALIX_FOLDER."/class.Module.php");

class ModuleEntityHome extends Module {
	protected $template = "";
	protected $entity = "";
	protected $id = 0;
	protected $name = "";
	protected $extras = array();
	protected $hardExtras = array();
	
	function ModuleEntityHome($params) {
		$this->template = $params["template"];
		$this->entity = $params["entity"];
		$this->id = $params["id"];
		if(!empty($params["extras"])) $this->extras = $params["extras"];
		if(!empty($params["hardExtras"])) $this->hardExtras = $params["hardExtras"];
		if(!empty($params["name"])) $this->name = $params["name"];
	}
	
	function exec($params) {		
		$errors = array();
		GlobalManager::getTplMng()->setTemplate($this->template);
		$entityManager = new EntityManager($this->entity,array());
		$entityManager->prepareFields();
		$entity = array();
		$mainFilterBy = "1";
		$mainFilterValue = "1";
		if(!empty($this->id)) {
			if(!isValidId($this->id)) FatalErrorHandler::finalize("Identificador incorrecto");
			$list = $entityManager->find(true,"e_table.id = '".$this->id."'");
			if(empty($list)) FatalErrorHandler::finalize("Identificador incorrecto");
			GlobalManager::getTplMng()->setValue("entity",$list[0]);
			if(!empty($this->name)) GlobalManager::getTplMng()->setValue($this->name,$list[0]);
			$entity = $list[0];
		}
		else {
			if(isset($params["filterValue"])) {
				$mainFilterValue = $params["filterValue"];
				$mainFilterBy = $params["filterBy"];
			}
			if(!empty($params['orderBy'])) {
				$list = $entityManager->find(false,$mainFilterBy."='".$mainFilterValue."'",$params['orderBy']);
			}
			else {
				$list = $entityManager->find(false,$mainFilterBy."='".$mainFilterValue."'");
			}
			GlobalManager::getTplMng()->setValue("list",$list);
			if(!empty($this->name)) GlobalManager::getTplMng()->setValue($this->name,$list); 
		}
		
		foreach($this->extras as $name=>$extra) {
			$entityManager = new EntityManager($extra["entity"],array());
			$entityManager->prepareFields();
			$uniqueResult = false;
			$order = "";
			if(isset($extra["id"])) {
				$filterValue = $extra["id"];
				$filterBy = "e_table.id";
				$uniqueResult = true;
			}
			else {
				if(isset($extra["filterValue"])) {
					$filterValue = $extra["filterValue"];
					$filterBy = $extra["filterBy"];
				}
				else {
					$filterValue = "1";
					$filterBy = "1";					
				}
				if(!empty($extra["orderBy"])) {
					$order = $extra["orderBy"];
				}
			}
			if(!(strstr($filterValue,"@mainEntity") === false)) {
				list($entityReference,$entityField) = explode(".",$filterValue);
				if((empty($entity))||(!isset($entity[$entityField]))) FatalErrorHandler::finalize("Configuration Error");
				$filterValue = $entity[$entityField];
			}
			$list = $entityManager->find(true,$filterBy." = '".addslashes($filterValue)."'",$order);
			if($uniqueResult) {
				if(empty($list)) $list[0] = array();
				GlobalManager::getTplMng()->setValue($name,$list[0]);
			}
			else {
				GlobalManager::getTplMng()->setValue($name,$list);
			}
		}
		foreach($this->hardExtras as $name=>$extra) {
			$elements = array();
			$sql = $extra['query'];
			foreach($extra['params'] as $key=>$par) {
				$sql = str_replace("#".($key+1)."#",valueToDb($par),$sql);
			}
			$res = $this->_db->execute($sql);
			if(!$res) FatalErrorHandler::finalize("Error con la consulta hardExtra $name");
			while($reg = $this->_db->getRow($res)) $elements[] = $reg;
			GlobalManager::getTplMng()->setValue($name,$elements);
		}
		
		GlobalManager::getTplMng()->drawTemplate();
	}
}
?>