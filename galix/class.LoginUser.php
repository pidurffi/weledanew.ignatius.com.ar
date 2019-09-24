<?php
include_once(GALIX_FOLDER."/class.Logueo.php");

class LoginUser extends Logueo {
	var $userTable = "";
	var $userField = "";
	var $passField = "";
	var $passEnc = "";
	var $template = "";
	var $home = "";
	var $closePopup = false;

	function mandarAlLogin() {
		header("Location: index.php?module=login");
		die();
	}
	
	function LoginUser($params) {
		$this->userTable = $params['userTable'];
		$this->userField = $params['userField'];
		$this->passField = $params['passField'];
		$this->passEnc = $params['passEnc'];
		$this->template = $params['template'];
		$this->home = $params['home'];
		$this->closePopup = $params['closePopup'];
	}
	
	function login() {
		if(sizeof($_POST)>0) {
			switch($this->passEnc) {
				case "md5":		$pass = md5(postToDb('pass')); break;
				default:		$pass = postToDb('pass');
			}	
		
			$sql = "SELECT * FROM ".$this->userTable." ";
			$sql.= "WHERE ".$this->userField."='".postToDb('user')."' AND ".$this->passField."= '".$pass."' ";
			$res = $this->_db->execute($sql);
			if((!$res) || ($this->_db->count($res) <= 0)) {
				GlobalManager::getTplMng()->setTemplate($this->template);
				GlobalManager::getTplMng()->setValue('error',"Usuario o contrase&ntilde;a incorrecto");
				GlobalManager::getTplMng()->drawTemplate();
				die();
			}
			else {
				$user = $this->_db->getRow($res);
				SessionManager::setValue("LOGIN",$user);
				$modDesired = SessionManager::getValue("MODULE_DESIRED");
				if(!empty($modDesired)) $url = $modDesired;
				else $url = "module=".$this->home;
				header("Location: index.php?".$url);
				die();
			}
			return true;
		}
		else {
			$close = false;
			if((!empty($_GET["from"]))&&($_GET["from"]=="logout")&&($this->closePopup)) $close = true;
			GlobalManager::getTplMng()->setValue("close",$close);
			GlobalManager::getTplMng()->setTemplate($this->template);
			GlobalManager::getTplMng()->drawTemplate();
			die();
		}
	}
	
	function asegurarAcessoRestringido($module) {
		$user = SessionManager::getValue("LOGIN");
		if(empty($user)) {
			SessionManager::setValue("MODULE_DESIRED",$_SERVER['QUERY_STRING']);
			$this->mandarAlLogin();
		}
		return true;
	}

	function logout() {
		SessionManager::reset();
		header("Location: index.php?module=login&from=logout");			
	}	
	
	function getUserId() {
		$us = SessionManager::getValue("LOGIN");
		return $us['id'];	
	}
	
	function getUser() {
		$us = SessionManager::getValue("LOGIN");
		return $us;	
	}
	
	
};



?>