<?php

define("SPECIFICATION_NAME","WeledaFront");

//$_SPECIFICATION['login'] = 1; // 1 el admin requiere log | 0 no requiere
//$_SPECIFICATION['login_module'] = "Logueo_ModulosXRoles"; // Nombre del modulo que se encarga del logueo
$_SPECIFICATION['home'] = "fr_home";

$_SPECIFICATION['login']['required'] = 1;
$_SPECIFICATION['login']['module'] = "LoginUser";
$_SPECIFICATION['login']['params'] = array(
											"userTable"=>"cliente",
											"userField"=>"email",
											"passField"=>"password",
											"passEnc"=>"",
											"template"=>"front_login",
											"home"=>"fr_carrito_list",
											"closePopup"=>true
										  );


$_SPECIFICATION['DbClass']['classname'] = "Db_Mysql";
$_SPECIFICATION['DbClass']['params']['host'] = "localhost";
include_once(SPECIFICATION_FOLDER."database.php");
include_once(SPECIFICATION_FOLDER."variables.php");
$_SPECIFICATION['menu'] = "MenuHarcodeadoXRoles";

$_SPECIFICATION['customModules'] = array('ModuleCarrito');

/*************************************************************************************
 * FRONTEND **************************************************************************
*************************************************************************************/

$_SPECIFICATION['modules']['fr_home']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['fr_home']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_home']['params'] = array("entity"=>"EntityHome","template"=>"front_home","id"=>1);

$_SPECIFICATION['modules']['fr_css']['className'] = 'ModuleDynamicCss';
$_SPECIFICATION['modules']['fr_css']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_css']['params'] = array("cssFile"=>"weleda");

$_SPECIFICATION['modules']['fr_css_dinamico']['className'] = 'ModuleDynamicCss';
$_SPECIFICATION['modules']['fr_css_dinamico']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_css_dinamico']['params'] = array("cssFile"=>"dinamico");

$_SPECIFICATION['modules']['fr_productos']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['fr_productos']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_productos']['params'] = array("entity"=>"EntityFamilia","template"=>"front_productos","id"=>0,"orderBy"=>"orden,ASC");

$_SPECIFICATION['modules']['fr_familia']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['fr_familia']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_familia']['params'] = array("entity"=>"EntityFamilia","template"=>"front_familia","id"=>RequestHandler::getGetValue("id"),
														   "extras"=>array(
																			"lineas"=>array("entity"=>"EntityLinea","filterBy"=>"id_familia", "filterValue" => RequestHandler::getGetValue("id"),"orderBy"=>"orden,ASC"),
																			"familias"=>array("entity"=>"EntityFamilia","filterBy"=>"1","filterValue"=>"1","orderBy"=>"orden,ASC"),
																			"productos_sueltos"=>array("entity"=>"EntityProducto","filterBy"=>"id_familia_directa","filterValue"=>RequestHandler::getGetValue("id"))
																		  )
														   );

$_SPECIFICATION['modules']['fr_linea']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['fr_linea']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_linea']['params'] = array("entity"=>"EntityLinea","template"=>"front_linea","id"=>RequestHandler::getGetValue("id"),"name"=>"linea",
														   "extras"=>array(
																			"productos"=>array("entity"=>"EntityProducto","filterBy"=>"id_linea", "filterValue" => RequestHandler::getGetValue("id"),"orderBy"=>array("orden,ASC","nombre,ASC")),
																			"lineas"=>array("entity"=>"EntityLinea","filterBy"=>"id_familia", "filterValue" => "@mainEntity.id_familia"),
																			"familia"=>array("entity"=>"EntityFamilia","id"=>"@mainEntity.id_familia")
																		  )
														   );

$_SPECIFICATION['modules']['fr_producto']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['fr_producto']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_producto']['params'] = array("entity"=>"EntityProducto","template"=>"front_producto","id"=>RequestHandler::getGetValue("id"),"name"=>"producto",
														   "extras"=>array(
																			"lineas"=>array("entity"=>"EntityLinea","filterBy"=>"id_familia", "filterValue" => RequestHandler::getGetValue("id_familia")),
																			"productos"=>array("entity"=>"EntityProducto","filterBy"=>"id_linea", "filterValue" => "@mainEntity.id_linea"),
																			"familia"=>array("entity"=>"EntityFamilia","id"=>RequestHandler::getGetValue("id_familia")),
																			"linea"=>array("entity"=>"EntityLinea","id"=>RequestHandler::getGetValue("id_linea"))
																		  )
														   );

$_SPECIFICATION['modules']['fr_producto_suelto']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['fr_producto_suelto']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_producto_suelto']['params'] = array("entity"=>"EntityProducto","template"=>"front_producto","id"=>RequestHandler::getGetValue("id"),"name"=>"producto",
																   "extras"=>array(
																			"productos"=>array("entity"=>"EntityProducto","filterBy"=>"id_familia_directa", "filterValue" => "@mainEntity.id_familia_directa"),
																			"familias"=>array("entity"=>"EntityFamilia","orderBy"=>"orden,ASC"),
																			"familia"=>array("entity"=>"EntityFamilia","id"=>"@mainEntity.id_familia_directa")
																		  )
														   );

$_SPECIFICATION['modules']['fr_carrito_add']['className'] = 'ModuleSessionCollection';
$_SPECIFICATION['modules']['fr_carrito_add']['loginRequired'] = true;
$_SPECIFICATION['modules']['fr_carrito_add']['params'] = array("sessionName"=>"carrito","task"=>"add","entity"=>"EntityProducto","finalModule"=>"fr_carrito_list");

$_SPECIFICATION['modules']['fr_carrito_list']['className'] = 'ModuleSessionCollection';
$_SPECIFICATION['modules']['fr_carrito_list']['loginRequired'] = true;
$_SPECIFICATION['modules']['fr_carrito_list']['params'] = array("sessionName"=>"carrito","task"=>"list","template"=>"front_carrito");

$_SPECIFICATION['modules']['fr_carrito_delete']['className'] = 'ModuleSessionCollection';
$_SPECIFICATION['modules']['fr_carrito_delete']['loginRequired'] = true;
$_SPECIFICATION['modules']['fr_carrito_delete']['params'] = array("sessionName"=>"carrito","task"=>"delete","finalModule"=>"fr_carrito_list");

/*$_SPECIFICATION['modules']['fr_carrito_dump']['className'] = 'ModuleSessionCollection';
$_SPECIFICATION['modules']['fr_carrito_dump']['loginRequired'] = true;
$_SPECIFICATION['modules']['fr_carrito_dump']['params'] = array(
																	"sessionName"=>"carrito",
																	"task"=>"dump",
																	"template"=>"front_carrito",
																	"finalModule"=>"fr_carrito_gracias",
																	"dumpTable" => "compra",
																	"dumpTimestampField" => "timestamp",
																	"dumpSaveUserField" => "id_cliente",
																	"dumpListTable" => "compra_producto",
																	"dumpListDumpField" => "id_compra",
																	"dumpListEntityField" => "id_producto"
																);
*/

$_SPECIFICATION['modules']['fr_carrito_end_1']['className'] = 'ModuleCarrito';
$_SPECIFICATION['modules']['fr_carrito_end_1']['loginRequired'] = true;
$_SPECIFICATION['modules']['fr_carrito_end_1']['params'] = array("step"=>1,"template"=>"front_carrito_end_1","finalModule"=>"fr_carrito_end_2","sessionName"=>"carrito");

$_SPECIFICATION['modules']['fr_carrito_end_2']['className'] = 'ModuleCarrito';
$_SPECIFICATION['modules']['fr_carrito_end_2']['loginRequired'] = true;
$_SPECIFICATION['modules']['fr_carrito_end_2']['params'] = array("step"=>2,"template"=>"front_carrito_end_2","finalModule"=>"fr_carrito_end_3","sessionName"=>"carrito");

$_SPECIFICATION['modules']['fr_carrito_end_3']['className'] = 'ModuleCarrito';
$_SPECIFICATION['modules']['fr_carrito_end_3']['loginRequired'] = true;
$_SPECIFICATION['modules']['fr_carrito_end_3']['params'] = array("step"=>3,"template"=>"front_carrito_end_3","finalModule"=>"","sessionName"=>"carrito","folderTxt"=>"ventas","mailTemplate"=>"front_mail_compra");


$_SPECIFICATION['modules']['fr_carrito_change_count']['className'] = 'ModuleSessionCollection';
$_SPECIFICATION['modules']['fr_carrito_change_count']['loginRequired'] = true;
$_SPECIFICATION['modules']['fr_carrito_change_count']['params'] = array("sessionName"=>"carrito","task"=>"changeCount","finalModule"=>"fr_carrito_list","nameCountFields"=>"count");

$_SPECIFICATION['modules']['fr_carrito_reset']['className'] = 'ModuleSessionCollection';
$_SPECIFICATION['modules']['fr_carrito_reset']['loginRequired'] = true;
$_SPECIFICATION['modules']['fr_carrito_reset']['params'] = array("sessionName"=>"carrito","task"=>"reset","finalModule"=>"fr_carrito_list");


$_SPECIFICATION['modules']['fr_carrito_gracias']['className'] = 'ModuleHome';
$_SPECIFICATION['modules']['fr_carrito_gracias']['loginRequired'] = true;
$_SPECIFICATION['modules']['fr_carrito_gracias']['params'] = array("template"=>"front_carrito_compra_gracias");

/* puntos de venta - Adri�n - 11/11/08 */
$_SPECIFICATION['modules']['fr_puntos_venta_1']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['fr_puntos_venta_1']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_puntos_venta_1']['params'] = array("entity"=>"EntityRegion","template"=>"front_puntos_venta_1","id"=>0,"orderBy"=>array("ID,ASC"));

$_SPECIFICATION['modules']['fr_puntos_venta_2']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['fr_puntos_venta_2']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_puntos_venta_2']['params'] = array("entity"=>"EntityRegion","template"=>"front_puntos_venta_2","id"=>RequestHandler::getGetValue('id'),"name"=>"region",
																  "extras"=>array(
																					"subregiones"=>array("entity"=>"EntitySubregion","filterBy"=>"id_region", "filterValue"=>"@mainEntity.id","orderBy"=>array("nombre,ASC")),
																					"regiones"=>array("entity"=>"EntityRegion")
																				)
																 );

$_SPECIFICATION['modules']['fr_puntos_venta_3']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['fr_puntos_venta_3']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_puntos_venta_3']['params'] = array("entity"=>"EntitySubregion","template"=>"front_puntos_venta_3","id"=>RequestHandler::getGetValue('id'),"name"=>"subregion",
																  "extras"=>array(
																			"farmacias"=>array("entity"=>"EntityPuntoVenta","filterBy"=>"id_subregion","filterValue"=>"@mainEntity.id"),
																			"subregiones"=>array("entity"=>"EntitySubregion","filterBy"=>"id_region","filterValue"=>"@mainEntity.id_region","orderBy"=>array("nombre,ASC")),
																			"region"=>array("entity"=>"EntityRegion","id"=>RequestHandler::getGetValue("id_region"))
																				)
																 );


/* Plantilla de puntos de venta para Chile con otro dise�o */
$_SPECIFICATION['modules']['fr_puntos_venta_ch']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['fr_puntos_venta_ch']['loginRequired'] = false;
if(!empty($_GET['id'])) {
	$_SPECIFICATION['modules']['fr_puntos_venta_ch']['params'] = array("entity"=>"EntitySubregion","template"=>"front_puntos_venta_ch","finalModule"=>"front_puntos_venta_ch","id"=>RequestHandler::getGetValue('id'),"name"=>"subregion",
																	"extras"=>array(
																					"farmacias"=>array("entity"=>"EntityPuntoVenta","filterBy"=>"id_subregion","filterValue"=>"@mainEntity.id"),
																					"subregiones"=>array("entity"=>"EntitySubregion","filterBy"=>"id_region","filterValue"=>"@mainEntity.id_region","orderBy"=>"nombre,ASC"),
																					"regiones"=>array("entity"=>"EntityRegion", "orderBy"=>array("orden,ASC","nombre,ASC")),
																					"region"=>array("entity"=>"EntityRegion","id"=>"@mainEntity.id_region")
																				)
																	);
}
else {
	if(!empty($_GET['id_region'])) {
		$_SPECIFICATION['modules']['fr_puntos_venta_ch']['params'] = array("entity"=>"EntityRegion","template"=>"front_puntos_venta_ch","finalModule"=>"front_puntos_venta_ch","id"=>RequestHandler::getGetValue('id_region'),"name"=>"region",
																		"extras"=>array(
																						"subregiones"=>array("entity"=>"EntitySubregion","filterBy"=>"id_region","filterValue"=>"@mainEntity.id","orderBy"=>"nombre,ASC"),
																						"regiones"=>array("entity"=>"EntityRegion","orderBy"=>array("orden,ASC","nombre,ASC"))
																					)
																		);
	}
	else {
		$_SPECIFICATION['modules']['fr_puntos_venta_ch']['params'] = array("entity"=>"EntityRegion","template"=>"front_puntos_venta_ch","finalModule"=>"front_puntos_venta_ch","id"=>0,"name"=>"regiones","orderBy"=>array("orden,ASC","nombre,ASC"),
																			"extras"=>array(
																					)
																		);
	}
}


/* puntos de venta para Chile, detalle (de un punto de venta) */
$_SPECIFICATION['modules']['fr_puntos_venta_chd']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['fr_puntos_venta_chd']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_puntos_venta_chd']['params'] = array("entity"=>"EntityPuntoVenta","template"=>"front_puntos_venta_chd", "id"=>RequestHandler::getGetValue("id"),"name"=>"farmacia",
																			"extras"=>array(
																							"region"=>array("entity"=>"EntityRegion","id"=>RequestHandler::getGetValue("idr")),
																							"subregion"=>array("entity"=>"EntitySubregion","id"=>RequestHandler::getGetValue("idsr"))
																						)
																			);


$_SPECIFICATION['modules']['fr_noticias']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['fr_noticias']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_noticias']['params'] = array("entity"=>"EntityNoticias","template"=>"front_noticias","id"=>0,"orderBy"=>"orden,ASC","filterBy"=>"id_seccion","filterValue"=>RequestHandler::getGetValue('seccion'));

$_SPECIFICATION['modules']['fr_noticia']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['fr_noticia']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_noticia']['params'] = array("entity"=>"EntityNoticias","template"=>"front_noticia","id"=>RequestHandler::getGetValue("id"),"name"=>"noticia",
												"extras"=>array(
																/* Pongo un comentario en la l�nea siguiente para eliminar el filtro. */
																"noticias"=>array("entity"=>"EntityNoticias"/*,"filterBy"=>"id_seccion","filterValue"=>RequestHandler::getGetValue('seccion')*/)
																/* Hay que corregirlo para que filtre solo si id_seccion no es cero */
																)
															);

$_SPECIFICATION['modules']['fr_clientes_alta']['className'] = 'ModuleRegistration';
$_SPECIFICATION['modules']['fr_clientes_alta']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_clientes_alta']['params'] = array(
																"entity"=>"EntityCliente",
																"template"=>"front_cliente_AM",
																"finalModule"=>"fr_clientes_gracias",
																"uniqueFields"=>array("email")
																);

$_SPECIFICATION['modules']['fr_clientes_gracias']['className'] = 'ModuleHome';
$_SPECIFICATION['modules']['fr_clientes_gracias']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_clientes_gracias']['params'] = array("template"=>"front_clientes_gracias");

$_SPECIFICATION['modules']['fr_sorteo_alta']['className'] = 'ModuleRegistration';
$_SPECIFICATION['modules']['fr_sorteo_alta']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_sorteo_alta']['params'] = array(
																"entity"=>"EntitySorteo",
																"template"=>"front_sorteo_AM",
																"finalModule"=>"fr_sorteo_gracias",
																"uniqueFields"=>array()
																);

$_SPECIFICATION['modules']['fr_sorteo_gracias']['className'] = 'ModuleHome';
$_SPECIFICATION['modules']['fr_sorteo_gracias']['loginRequired'] = false;
$_SPECIFICATION['modules']['fr_sorteo_gracias']['params'] = array("template"=>"front_sorteo_gracias");


?>