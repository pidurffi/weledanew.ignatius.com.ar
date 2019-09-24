<?

if(!defined("APPLICATION_ROOT")) die("No está½ bien configurado el framework");

define("SPECIFICATION_FOLDER",APPLICATION_ROOT."specification/");
define("GALIX_FOLDER",APPLICATION_ROOT."galix/");
define("TPL_FOLDER",APPLICATION_ROOT."tpl/"); 
define("CSS_FOLDER",APPLICATION_ROOT."css/"); 
define("INCLUDE_FOLDER",APPLICATION_ROOT."includes/");
define("FTP_FOLDER",APPLICATION_ROOT."ftp_folder/");
define("FTP_BACKUP_FOLDER",FTP_FOLDER."BACKUP/");
define("FTP_INPUT_FOLDER",FTP_FOLDER."INPUT/");
define("FTP_MAESTRO_FOLDER",FTP_FOLDER."maestro/");
define("FTP_CLIENTES_FOLDER",FTP_FOLDER."clientes/");


/* Session y globales */
include_once(GALIX_FOLDER."class.SessionManager.php");
include_once(GALIX_FOLDER."class.GlobalManager.php");
include_once(GALIX_FOLDER."class.RequestHandler.php");

/* Errores */
include_once(GALIX_FOLDER."class.FatalErrorHandler.php");
include_once(SPECIFICATION_FOLDER."specification.php");
include_once(INCLUDE_FOLDER."functions.php");

/* Login */
include_once(GALIX_FOLDER."class.Logueo.php");
include_once(GALIX_FOLDER."class.Logueo_ModulosXRoles.php");
include_once(GALIX_FOLDER."class.LoginUser.php");
/* Db */
include_once(GALIX_FOLDER."class.Db.php");
if($_SPECIFICATION['DbClass']['classname']!="") {
	include_once(GALIX_FOLDER."class.".$_SPECIFICATION['DbClass']['classname'].".php");
	$str = '$_db = new '.$_SPECIFICATION['DbClass']['classname'].'($_SPECIFICATION["DbClass"]["params"]);';
	eval($str);
	GlobalManager::setDb($_db);
}

/* TemplateManager */
include_once(GALIX_FOLDER."class.TemplateManager.php");
$_templateManager = new TemplateManager();
GlobalManager::setTplMng($_templateManager);

/* Menu */
include_once(GALIX_FOLDER."class.MenuHarcodeadoXRoles.php");

/* Modulos */
include_once(GALIX_FOLDER."class.ModuleHome.php");
include_once(GALIX_FOLDER."class.ModuleABMSimple.php");
include_once(GALIX_FOLDER."class.ModuleEntityHome.php");
include_once(GALIX_FOLDER."class.ModuleDynamicCss.php");
include_once(GALIX_FOLDER."class.ModuleSessionCollection.php");
include_once(GALIX_FOLDER."class.ModuleNewsletterManager.php");
include_once(GALIX_FOLDER."class.ModuleRegistration.php");
include_once(GALIX_FOLDER."class.ModuleBuscador.php");

if(!empty($_SPECIFICATION['customModules'])) {
	foreach($_SPECIFICATION['customModules'] as $customModule) {
		$fileName = SPECIFICATION_FOLDER."class.".$customModule.".php";
		if(file_exists($fileName)) {
			include_once($fileName);
		} 
	}
}
?>