<?php


include_once(GALIX_FOLDER."/class.Logueo.php");



class Logueo_ModulosXRoles extends Logueo {

	function mandarAlLogin($module) {

		header("Location: index.php?module=".$module);

	}

	

	function asegurarAcessoRestringido($module) {

		global $_SPECIFICATION;

		if ( (isset($_SPECIFICATION['modules'][$module]['loginRequired']))

			 && ($_SPECIFICATION['modules'][$module]['loginRequired'] == false) ) return true;

		// Si estÃ¡ tratando de loguearse lo dejo

		if($module=="login") {

			if(sizeof($_POST)>0) {

				$modulos_accesibles = $this->obtenerModulos(postToDb('user'),postToDb('pass'));

				if($modulos_accesibles == 0) {

					GlobalManager::getTplMng()->setTemplate("admin_logueo");

					GlobalManager::getTplMng()->setValue('error',"Usuario o contrase&ntilde;a incorrecto");

					GlobalManager::getTplMng()->drawTemplate();

				}

				else {

					SessionManager::setValue('USERNAME',$_POST['user']);

					SessionManager::setValue('modulos_accesibles',$modulos_accesibles);

					//header("Location: index.php?module=".array_shift($modulos_accesibles));

					header("Location: index.php?module=home");

				}

			}

			else {

				GlobalManager::getTplMng()->setTemplate("admin_logueo");

				GlobalManager::getTplMng()->drawTemplate();

			}

		}

		// Si esta tratando de otra cosa, verifico permisos

		// TODO: implementar 

		else {

			if(empty($_SESSION['GALIX'][SPECIFICATION_NAME]['USERNAME'])) {

				$this->mandarAlLogin("login");

			}

		}

		

	return false;

	}

	

	/*

	 * Devuelve un array con los modulos accesibles

	 * o 0 si no es un usuario valido

	 */

	function obtenerModulos($user,$pass) {

		$sql = "SELECT * FROM usuario WHERE nombre = '".addslashes($user)."'";

		// $sql.= " AND password = '".md5(addslashes($pass))."' ";
		
		$sql.= " AND ( password = '".md5(addslashes($pass))."' OR  password = '".addslashes($pass)."' ) ";

		$res = GlobalManager::getDb()->getCouples($sql,'id','nombre');

		if(!$res) return 0;

		return $res;

	}

	

	/*

	 * Devuelve un array con los perfiles

	 */

	function obtenerPerfilesUsuario($user,$pass) {

		return array();

	}

	

	function logout() {

		session_destroy();

		header("Location: index.php");	

	}

		

	

}


?>