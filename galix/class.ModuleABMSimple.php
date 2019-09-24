<?php

include_once(GALIX_FOLDER."/class.Module.php");
include_once(GALIX_FOLDER."/class.EntityManager.php");




class ModuleABMSimple extends Module {
	var $params;
	function Module($params) {
		$this->params = $params;
	}
	
	function exec($params) {
		$this->params = $params;
		$task = $params['task'];
		if(!isset($task)) return false;
		switch($task) {
			case 'list':	return $this->execList($params);break;
			case 'AM':		return $this->execAM($params);break;
			case 'delete':	return $this->execDelete($params);break;

			case 'combo_xml': return $this->execComboXML($params);break;

			case 'edit_unique': return $this->execEditUnique($params);break;

		}
	}
	
	function  execList($params) {
		if(isset($_GET['action'])) if($_GET['action']=='end') {
			header("Location: index.php?module=".$this->params['finalModule']);
		}
		$entityManager = new EntityManager($params['entity'],array());
		$entityManager->prepareFields();
                // Se fija si hay filtros. [ADRIÁN]
                if(isset($params["filterValue"])) {
                                $mainFilterValue = $params["filterValue"];  // Valor
				$mainFilterBy = $params["filterBy"];        // Campo
			}
                else {
                    $mainFilterValue = '1';
                    $mainFilterBy = '1';
                }
		if(!empty($params['orderBy'])) {
			//$list = $entityManager->find(false,"1=1",$params['orderBy']);
                        // Agrego los filtros. [ADRIÁN]
                        $list = $entityManager->find(false,$mainFilterBy."='".$mainFilterValue."'",$params['orderBy']);
		}
		else {
			$list = $entityManager->find();
		}
	
		GlobalManager::getTplMng()->setTemplate($params['template']);			
		GlobalManager::getTplMng()->setValue("list",$list);
		//GlobalManager::getTplMng()->setValue("user_modules",SessionManager::getValue('modulos_accesibles'));

		GlobalManager::getTplMng()->setValue("menu",GlobalManager::getMenu()->getMenuElements());
		GlobalManager::getTplMng()->drawTemplate();		
	}

	function  execAM($params) {
		$entityManager = new EntityManager($params['entity'],array());
		$entityManager->prepareFields();

		$errors = array();
		if(isset($_POST['submit'])) {
			$entityManager->fillFieldsWithPost();
			/* Validate */
			foreach($entityManager->fields as $key=>$field) {
				$entityManager->fields[$key]->validateFromPost($errors);
			}
			/* Try to save */
			if(empty($errors)) {
                            /* ADRIAN: agrego AND !empty($_GET['id'] porque dejó de andar la inserción
                             * de nuevos registros. */
				if(isset($_GET['id']) AND !empty($_GET['id']) )
				{
					// Se recibió el ID en la URL (usado en el backoffice)
					if(!empty($_GET['id']))
                                        {
                                        	if(!isValidId($_GET['id'])) $errors[] = "Objecto a modificar no encontrado";
						else $entityManager->saveFromPost($errors,$_GET['id']);
                                        }
				}
				elseif(isset($params['id']))
				{
					// Se recibió un parámetro ID, configurado en specification/appfront.php (se usa para modificar sin ver el ID en la URL).
					if(!empty($params['id']))
						if(!isValidId($params['id'])) $errors[] = "Objecto a modificar no encontrado";
						else $entityManager->saveFromPost($errors,$params['id']);
				}
				else
                                        $entityManager->saveFromPost($errors);
			}
			
			/* OK or not? */
			if(empty($errors)) {
				header("Location: index.php?module=".$this->params['finalModule']);
			}
		}
		// Si algo anduvo mal o no hay repost
		if((isset($_GET['id']))&&(!empty($_GET['id']))&&(isValidId($_GET['id']))&&(empty($_POST)))
		{
			// Se recibió el ID en la URL
			$entityManager->loadFromDb($errors,$_GET['id']);
		}
		elseif((isset($params['id']))&&(!empty($params['id']))&&(isValidId($params['id']))&&(empty($_POST)))
		{
			// Se recibió un parámetro ID, configurado en specification/appfront.php
			$entityManager->loadFromDb($errors,$params['id']);
		}
		GlobalManager::getTplMng()->setTemplate($params['template']);			
		GlobalManager::getTplMng()->setValue("em",$entityManager);
		GlobalManager::getTplMng()->setValue("errores",$errors);

		GlobalManager::getTplMng()->setValue("menu",GlobalManager::getMenu()->getMenuElements());
		GlobalManager::getTplMng()->drawTemplate();
	}
	

	function execDelete($params) {
		$entityManager = new EntityManager($params['entity'],array());
		$entityManager->prepareFields();
		$errors = array();
		if(isset($_GET['id'])) if(!empty($_GET['id'])) {
			if(!isValidId($_GET['id'])) $errors[] = "Objecto a modificar no encontrado";
			$entityManager->delete($_GET['id'],$errors);
		}
		else {
			$errors[] = "Objecto a modificar no encontrado";
		}

		if(sizeof($errors) > 0) {
			printr($errors);die();
		}
		header("Location: index.php?module=".$this->params['finalModule']."&result=".sizeof($errors));
	}


	/* Llamada ajax, sin template ni nada */

	function execComboXML($params) {

		header('Content-Type: text/xml');

 		header ('Cache-Control: no-cache');

 		header ('Cache-Control: no-store' , false); 

		$entityManager = new EntityManager($_GET['entity'],array());

		$entityManager->prepareFields();

		$list = $entityManager->find();

		?><elemento><?

		foreach($list as $l) { 

			if(!empty($_GET['filterBy'])) {

				if($l[$_GET['filterBy']] != $_GET['filterValue']) continue;

			}	

			?><item value="<?=$l['id']?>"><?=htmlentities(htmlentities($l[$_GET['descField']]))?></item><? 

		}

		?></elemento><?

	}

	

	function execEditUnique($params) {

		$_GET['id'] = 1;

		return $this->execAM($params);

	}

	
} 

?>