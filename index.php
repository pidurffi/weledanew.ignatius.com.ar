<?
/* Incluir symfony si es skinfood */
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       false);

// get the domain's parts
list($tld, $domain, $subdomain, $subdomain2) = array_reverse(explode('.', $_SERVER['HTTP_HOST']));

// determine which subdomain we're looking at
$app = ($subdomain == 'staging') ? $subdomain2 : $subdomain;
$app = (empty($app) || $app == 'www' || $app == 'weledanew' ) ? 'frontend' : $app;

// determine which app to load based on subdomain
if (!is_dir(SF_ROOT_DIR.'/apps/'.$app))
{
    define('SF_APP','frontend');
}
else
{
    define('SF_APP',$app);
}

if ($app == 'skinfood') {
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
$configuration = ProjectConfiguration::getApplicationConfiguration('skinfood', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
exit();
}
/* FIN Incluir symfony si es skinfood */

ob_start();
session_start();
error_reporting(E_ALL);

$configName = "appFront";


define("APPLICATION_ROOT","./");
include_once(APPLICATION_ROOT."galix.php");

include_once(GALIX_FOLDER."class.Image.php");

if(empty($_GET['module'])) {
	$module = $_SPECIFICATION['home'];
	//$module = "regiones_lista";
}
else {
	// TODO: Validar los modulos
	$module = $_GET['module'];
}

// Delego el trabajo, a menos que sea el login
if(($module!="login")&&($module!="logout")) {
	// Login
	if($_SPECIFICATION['modules'][$module]['loginRequired']) {
		if((!empty($_SPECIFICATION['login']))&&(!empty($_SPECIFICATION['login']['required']))&&($_SPECIFICATION['login']['required'])) {
		
			if(!class_exists($_SPECIFICATION['login']['module'])) {
				die("Imposible crear logueo");
			}
			$login = new $_SPECIFICATION['login']['module']($_SPECIFICATION['login']['params']);
			$login->setDb(GlobalManager::getDb());
			$login->asegurarAcessoRestringido($module);
			GlobalManager::setLogin($login);
		}
	}
	// Menu
	if($_SPECIFICATION['menu']) {
		$menu = new $_SPECIFICATION['menu']();
		GlobalManager::setMenu($menu);
	}
	
	// Delego el trabajo
	$className = $_SPECIFICATION['modules'][$module]['className'];
	$moduleParams = $_SPECIFICATION['modules'][$module]['params']; 
	if(!class_exists($className)) die("error, no se definio handler para el modulo $module");
	$modClass = new $className($moduleParams);
	$modClass->setDb(GlobalManager::getDb());
	$modClass->exec($moduleParams);
}
else {
	// La pagina del login, o del logout. La lógica queda en el login
	$login = new $_SPECIFICATION['login']['module']($_SPECIFICATION['login']['params']);
	$login->setDb(GlobalManager::getDb());
	GlobalManager::setLogin($login);

	if($module == "logout") {
		$login->logout();
	}
	else {
		$login->login();
	}
}
die();
?>

