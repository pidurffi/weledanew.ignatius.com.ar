<?php

if(empty($configName)) {
	die("Inclusi&oacute;n incorrecta");
}

if(!file_exists(SPECIFICATION_FOLDER.$configName.".php")) {
	die("No existe la aplicaci&oacute;n $configName");
}

/* Entidades */
include_once(SPECIFICATION_FOLDER."class.EntityRegion.php");
include_once(SPECIFICATION_FOLDER."class.EntitySubregion.php");
include_once(SPECIFICATION_FOLDER."class.EntityPuntoVenta.php");
include_once(SPECIFICATION_FOLDER."class.EntityHome.php");
include_once(SPECIFICATION_FOLDER."class.EntityFamilia.php");
include_once(SPECIFICATION_FOLDER."class.EntityLinea.php");
include_once(SPECIFICATION_FOLDER."class.EntityProducto.php");
include_once(SPECIFICATION_FOLDER."class.EntityNewsletter.php");
include_once(SPECIFICATION_FOLDER."class.EntityNoticias.php");
include_once(SPECIFICATION_FOLDER."class.EntityClientes.php");
include_once(SPECIFICATION_FOLDER."class.EntityTipoEnvio.php");
include_once(SPECIFICATION_FOLDER."class.EntityCompra.php");
include_once(SPECIFICATION_FOLDER."class.EntitySorteo.php");

include_once(SPECIFICATION_FOLDER.$configName.".php");

?>
