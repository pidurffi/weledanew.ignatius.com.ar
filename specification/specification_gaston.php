<?if(empty($configName)) {	die("Inclusi&oacute;n incorrecta");}if(!file_exists(SPECIFICATION_FOLDER.$configName.".php")) {	die("No existe la aplicaci&oacute;n $configName");}/* Entidades */include_once(SPECIFICATION_FOLDER."class.EntityRegion.php");include_once(SPECIFICATION_FOLDER."class.EntitySubregion.php");include_once(SPECIFICATION_FOLDER."class.EntityPuntoVenta.php");include_once(SPECIFICATION_FOLDER."class.EntityHome.php");include_once(SPECIFICATION_FOLDER."class.EntityFamilia.php");include_once(SPECIFICATION_FOLDER."class.EntityLinea.php");include_once(SPECIFICATION_FOLDER."class.EntityProducto.php");include_once(SPECIFICATION_FOLDER."class.EntityProductoCarrito.php");include_once(SPECIFICATION_FOLDER."class.EntityNewsletter.php");include_once(SPECIFICATION_FOLDER."class.EntityTipoNoticiaNewsletter.php");include_once(SPECIFICATION_FOLDER."class.EntityNoticias.php");include_once(SPECIFICATION_FOLDER."class.EntitySeccionNoticias.php");include_once(SPECIFICATION_FOLDER."class.EntityClientes.php");include_once(SPECIFICATION_FOLDER."class.EntityClienteMayorista.php");include_once(SPECIFICATION_FOLDER."class.EntityClienteMayorista2.php");include_once(SPECIFICATION_FOLDER."class.EntityTipoCliente.php");include_once(SPECIFICATION_FOLDER."class.EntityTipoEnvio.php");include_once(SPECIFICATION_FOLDER."class.EntityCompra.php");include_once(SPECIFICATION_FOLDER."class.EntityCompraMayorista.php");include_once(SPECIFICATION_FOLDER."class.EntityCompraProducto.php");include_once(SPECIFICATION_FOLDER."class.EntityProvinciaEnvios.php");include_once(SPECIFICATION_FOLDER."class.EntityCiudadEnvios.php"); include_once(SPECIFICATION_FOLDER."class.EntitySorteo.php"); include_once(SPECIFICATION_FOLDER."class.EntityCatalogo.php");// include_once(SPECIFICATION_FOLDER."class.EntityPromocion.php");include_once(SPECIFICATION_FOLDER."class.EntityEncuesta1.php");include_once(SPECIFICATION_FOLDER."class.EntityEncuesta2.php");include_once(SPECIFICATION_FOLDER."class.EntityEncuesta3.php");include_once(SPECIFICATION_FOLDER."class.ModuleAvisoNewsletters.php");include_once(SPECIFICATION_FOLDER.$configName.".php");?>