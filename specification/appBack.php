<?php
define("SPECIFICATION_NAME", "WeledaBack");

$_SPECIFICATION['home'] = "login";

/* $_SPECIFICATION['login'] = 1; // 1 el admin requiere log | 0 no requiere
  $_SPECIFICATION['login_module'] = "Logueo_ModulosXRoles"; // Nombre del modulo que se encarga del logueo */
$_SPECIFICATION['login']['required'] = 1;
$_SPECIFICATION['login']['module'] = "LoginUser";
$_SPECIFICATION['login']['params'] = array(
    "userTable" => "usuario",
    "userField" => "nombre",
    "passField" => "password",
    "passEnc" => "md5",
    "template" => "admin_logueo",
    "home" => "productos_lista",
    "closePopup" => false
);

$_SPECIFICATION['DbClass']['classname'] = "Db_Mysql";
$_SPECIFICATION['DbClass']['params']['host'] = "localhost";
include_once(SPECIFICATION_FOLDER . "database.php");
include_once(SPECIFICATION_FOLDER . "variables.php");
$_SPECIFICATION['menu'] = "MenuHarcodeadoXRoles";

$_SPECIFICATION['customModules'] = array('ModuleAvisoNewsletters', 'ModuleImportarMaestro', 'ModuleImportarClientes');

/* * ***********************************************************************************
 * BACKOFFICE ************************************************************************
 * *********************************************************************************** */
$_SPECIFICATION['modules']['home']['className'] = 'ModuleHome';
$_SPECIFICATION['modules']['home']['loginRequired'] = true;
$_SPECIFICATION['modules']['home']['params'] = array("template" => "admin_home");

/* GENERAL */
$_SPECIFICATION['modules']['combo_request']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['combo_request']['params'] = array("task" => "combo_xml");
$_SPECIFICATION['modules']['combo_request']['loginRequired'] = true;

/* REGIONES */
$_SPECIFICATION['modules']['regiones_lista']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['regiones_lista']['params'] = array("task" => "list", "entity" => "EntityRegion", "template" => "admin_region_lista", "finalModule" => "regiones_lista", "orderBy" => array("orden,ASC", "nombre,ASC"));
$_SPECIFICATION['modules']['regiones_lista']['loginRequired'] = true;

$_SPECIFICATION['modules']['regiones_alta']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['regiones_alta']['params'] = array("task" => "AM", "entity" => "EntityRegion", "template" => "admin_region_AM", "finalModule" => "regiones_lista");
$_SPECIFICATION['modules']['regiones_alta']['loginRequired'] = true;

$_SPECIFICATION['modules']['regiones_baja']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['regiones_baja']['params'] = array("task" => "delete", "entity" => "EntityRegion", "finalModule" => "regiones_lista");
$_SPECIFICATION['modules']['regiones_baja']['loginRequired'] = true;

/* SUBREGIONES */
$_SPECIFICATION['modules']['subregiones_lista']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['subregiones_lista']['params'] = array("task" => "list", "entity" => "EntitySubregion", "template" => "admin_subregion_lista", "finalModule" => "subregiones_lista", "orderBy" => array("region,ASC", "nombre,ASC"));
$_SPECIFICATION['modules']['subregiones_lista']['loginRequired'] = true;

$_SPECIFICATION['modules']['subregiones_alta']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['subregiones_alta']['params'] = array("task" => "AM", "entity" => "EntitySubregion", "template" => "admin_subregion_AM", "finalModule" => "subregiones_lista");
$_SPECIFICATION['modules']['subregiones_alta']['loginRequired'] = true;

$_SPECIFICATION['modules']['subregiones_baja']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['subregiones_baja']['params'] = array("task" => "delete", "entity" => "EntitySubregion", "finalModule" => "subregiones_lista");
$_SPECIFICATION['modules']['subregiones_baja']['loginRequired'] = true;

/* PUNTOS DE VENTA */
$_SPECIFICATION['modules']['ptos_venta_lista']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['ptos_venta_lista']['params'] = array("task" => "list", "entity" => "EntityPuntoVenta", "template" => "admin_pto_venta_lista", "finalModule" => "ptos_venta_lista");
$_SPECIFICATION['modules']['ptos_venta_lista']['loginRequired'] = true;

$_SPECIFICATION['modules']['ptos_venta_alta']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['ptos_venta_alta']['params'] = array("task" => "AM", "entity" => "EntityPuntoVenta", "template" => "admin_pto_venta_AM", "finalModule" => "ptos_venta_lista");
$_SPECIFICATION['modules']['ptos_venta_alta']['loginRequired'] = true;

$_SPECIFICATION['modules']['ptos_venta_baja']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['ptos_venta_baja']['params'] = array("task" => "delete", "entity" => "EntityPuntoVenta", "finalModule" => "ptos_venta_lista");
$_SPECIFICATION['modules']['ptos_venta_baja']['loginRequired'] = true;

/* EDICION DE HOME */
$_SPECIFICATION['modules']['home_edit']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['home_edit']['params'] = array("task" => "edit_unique", "entity" => "EntityHome", "template" => "admin_home_edit", "finalModule" => "home");
$_SPECIFICATION['modules']['home_edit']['loginRequired'] = true;

/* FAMILIAS DE PRODUCTOS */
$_SPECIFICATION['modules']['familias_lista']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['familias_lista']['params'] = array("task" => "list", "entity" => "EntityFamilia", "template" => "admin_familia_lista", "finalModule" => "familias_lista", "orderBy" => "orden,ASC");
$_SPECIFICATION['modules']['familias_lista']['loginRequired'] = true;

$_SPECIFICATION['modules']['familias_alta']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['familias_alta']['params'] = array("task" => "AM", "entity" => "EntityFamilia", "template" => "admin_familia_AM", "finalModule" => "familias_lista");
$_SPECIFICATION['modules']['familias_alta']['loginRequired'] = true;

$_SPECIFICATION['modules']['familias_baja']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['familias_baja']['params'] = array("task" => "delete", "entity" => "EntityFamilia", "finalModule" => "familias_lista");
$_SPECIFICATION['modules']['familias_baja']['loginRequired'] = true;

/* LINEAS DE PRODUCTOS */
$_SPECIFICATION['modules']['lineas_lista']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['lineas_lista']['params'] = array("task" => "list", "entity" => "EntityLinea", "template" => "admin_linea_lista", "finalModule" => "lineas_lista", "orderBy" => array("familia,ASC", "orden,ASC"));
$_SPECIFICATION['modules']['lineas_lista']['loginRequired'] = true;

$_SPECIFICATION['modules']['lineas_alta']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['lineas_alta']['params'] = array("task" => "AM", "entity" => "EntityLinea", "template" => "admin_linea_AM", "finalModule" => "lineas_lista");
$_SPECIFICATION['modules']['lineas_alta']['loginRequired'] = true;

$_SPECIFICATION['modules']['lineas_baja']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['lineas_baja']['params'] = array("task" => "delete", "entity" => "EntityLinea", "finalModule" => "lineas_lista");
$_SPECIFICATION['modules']['lineas_baja']['loginRequired'] = true;

/* PRODUCTOS */
$_SPECIFICATION['modules']['productos_lista']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['productos_lista']['params'] = array("task" => "list", "entity" => "EntityProducto", "template" => "admin_producto_lista", "finalModule" => "productos_lista", "orderBy" => array("familia_directa,ASC", "familia,ASC", "linea,ASC", "orden,ASC", "nombre,ASC"));
$_SPECIFICATION['modules']['productos_lista']['loginRequired'] = true;

$_SPECIFICATION['modules']['productos_alta']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['productos_alta']['params'] = array("task" => "AM", "entity" => "EntityProducto", "template" => "admin_producto_AM", "finalModule" => "productos_lista");
$_SPECIFICATION['modules']['productos_alta']['loginRequired'] = true;

$_SPECIFICATION['modules']['productos_baja']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['productos_baja']['params'] = array("task" => "delete", "entity" => "EntityProducto", "finalModule" => "productos_lista");
$_SPECIFICATION['modules']['productos_baja']['loginRequired'] = true;

/* NEWSLETTERS */
$_SPECIFICATION['modules']['newsletters_lista']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['newsletters_lista']['params'] = array("task" => "list", "entity" => "EntityNewsletter", "template" => "admin_newsletter_lista", "finalModule" => "newsletters_lista");
$_SPECIFICATION['modules']['newsletters_lista']['loginRequired'] = true;

$_SPECIFICATION['modules']['newsletters_alta']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['newsletters_alta']['params'] = array("task" => "AM", "entity" => "EntityNewsletter", "template" => "admin_newsletter_AM", "finalModule" => "newsletters_lista");
$_SPECIFICATION['modules']['newsletters_alta']['loginRequired'] = true;

$_SPECIFICATION['modules']['newsletters_baja']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['newsletters_baja']['params'] = array("task" => "delete", "entity" => "EntityNewsletter", "finalModule" => "newsletters_lista");
$_SPECIFICATION['modules']['newsletters_baja']['loginRequired'] = true;

$_SPECIFICATION['modules']['newsletters_aviso']['className'] = 'ModuleAvisoNewsletters';
$_SPECIFICATION['modules']['newsletters_aviso']['loginRequired'] = true;
$_SPECIFICATION['modules']['newsletters_aviso']['params'] = array(
    'emailAviso' => "gabryel@gmail.com",
    'template' => "admin_mail_aviso"
);

$_SPECIFICATION['modules']['newsletters_envio']['className'] = 'ModuleNewsletterManager';
$_SPECIFICATION['modules']['newsletters_envio']['loginRequired'] = true;
$_SPECIFICATION['modules']['newsletters_envio']['params'] = array(
    "newsEntity" => "EntityNewsletter", // Entidad que se manda
    "mailsTable" => "mails_newsletter", // Tabla donde de donde sacar los mails
    "mailsLastNameColumn" => "apellido", // Columna del apellido
    "mailsFirstNameColumn" => "nombre", // Columna del nombre
    "mailsEmailColumn" => "email", // Columna del mail
    "mailsFilterColumn" => "recibe_newsletter", // Columna para decir a cuï¿½les mandar y cuï¿½les no
    "sendingTable" => "newsletter_envio", // Tabla de los envios
    "sendingNewsletterFKColumn" => "id_newsletter", // Referencia del newsletter enviado
    "sendingTimestampColumn" => "fecha", // Campo de fecha
    "sendingNewsMailTable" => "newsletter_envio_cliente", // Tabla de seguimiento de los envios
    "sendingNewsMailUserFKColumn" => "id_cliente", // Columna referencia a la tabla de personas
    "sendingNewsMailSendingFKColumn" => "id_envio", // Columna de referencia a la tabla de envios
    "sendingNewsMailResultColumn" => "resultado", // Columna con el seguimiento del envio a esa persona
    "limitControlTable" => "envio_mails", // Tabla de control de mails por tiempo
    "limitControlTimestampColumn" => "fecha", // Columna del timestamp de los envios
    "mailSelectionTemplate" => "admin_newsletter_mail_selection",
    "mailSendingsListTemplate" => "admin_newsletter_mail_sendings_list",
    "mailSendingTemplate" => "admin_newsletter_mail_sending",
    "mailTemplate" => "admin_newsletter_template",
    "mailTextTemplate" => "admin_newsletter_txt_template",
    "mailSubjectColumn" => "titulo",
    "mailsLimit" => 500 // Max cantidad de mails a mandar por hora
);

$_SPECIFICATION['modules']['newsletters_envio_prueba']['className'] = 'ModuleNewsletterManager';
$_SPECIFICATION['modules']['newsletters_envio_prueba']['loginRequired'] = true;
$_SPECIFICATION['modules']['newsletters_envio_prueba']['params'] = array(
    "newsEntity" => "EntityNewsletter", // Entidad que se manda
    "mailsTable" => "cliente_newsletterprueba", // Tabla donde de donde sacar los mails
    "mailsLastNameColumn" => "apellido", // Columna del apellido
    "mailsFirstNameColumn" => "nombre", // Columna del nombre
    "mailsEmailColumn" => "email", // Columna del mail
    "mailsFilterColumn" => "recibe", // Columna para decir a cuï¿½les mandar y cuï¿½les no
    "sendingTable" => "newsletterprueba_envio", // Tabla de los envios
    "sendingNewsletterFKColumn" => "id_newsletter", // Referencia del newsletter enviado
    "sendingTimestampColumn" => "fecha", // Campo de fecha
    "sendingNewsMailTable" => "newsletterprueba_envio_cliente", // Tabla de seguimiento de los envios
    "sendingNewsMailUserFKColumn" => "id_cliente", // Columna referencia a la tabla de personas
    "sendingNewsMailSendingFKColumn" => "id_envio", // Columna de referencia a la tabla de envios
    "sendingNewsMailResultColumn" => "resultado", // Columna con el seguimiento del envio a esa persona
    "limitControlTable" => "envio_mails", // Tabla de control de mails por tiempo
    "limitControlTimestampColumn" => "fecha", // Columna del timestamp de los envios
    "mailSelectionTemplate" => "admin_newsletter_mail_selection",
    "mailSendingsListTemplate" => "admin_newsletterprueba_mail_sendings_list", // listado de envios hechos
    "mailSendingTemplate" => "admin_newsletter_mail_sending",
    "mailTemplate" => "admin_newsletter_template",
    "mailSubjectColumn" => "titulo",
    "mailsLimit" => 50 // Max cantidad de mails a mandar por hora
);

/* NOTICIAS */
$_SPECIFICATION['modules']['noticias_lista']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['noticias_lista']['params'] = array("task" => "list", "entity" => "EntityNoticias", "template" => "admin_noticias_lista", "finalModule" => "noticias_lista", "orderBy" => array("seccion,ASC", "orden,ASC"));
$_SPECIFICATION['modules']['noticias_lista']['loginRequired'] = true;

$_SPECIFICATION['modules']['noticias_alta']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['noticias_alta']['params'] = array("task" => "AM", "entity" => "EntityNoticias", "template" => "admin_noticias_AM", "finalModule" => "noticias_lista");
$_SPECIFICATION['modules']['noticias_alta']['loginRequired'] = true;

$_SPECIFICATION['modules']['noticias_baja']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['noticias_baja']['params'] = array("task" => "delete", "entity" => "EntityNoticias", "finalModule" => "noticias_lista");
$_SPECIFICATION['modules']['noticias_baja']['loginRequired'] = true;


/* TIPOS DE ENVï¿½O */
$_SPECIFICATION['modules']['tipo_envio_lista']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['tipo_envio_lista']['params'] = array("task" => "list", "entity" => "EntityTipoEnvio", "template" => "admin_tipo_envio_lista", "finalModule" => "tipo_envio_lista", "orderBy" => array("orden,ASC"));
$_SPECIFICATION['modules']['tipo_envio_lista']['loginRequired'] = true;

$_SPECIFICATION['modules']['tipo_envio_alta']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['tipo_envio_alta']['params'] = array("task" => "AM", "entity" => "EntityTipoEnvio", "template" => "admin_tipo_envio_AM", "finalModule" => "tipo_envio_lista");
$_SPECIFICATION['modules']['tipo_envio_alta']['loginRequired'] = true;

$_SPECIFICATION['modules']['tipo_envio_baja']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['tipo_envio_baja']['params'] = array("task" => "delete", "entity" => "EntityTipoEnvio", "finalModule" => "tipo_envio_lista");
$_SPECIFICATION['modules']['tipo_envio_baja']['loginRequired'] = true;

/* PEDIDOS */
$_SPECIFICATION['modules']['pedido_lista']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['pedido_lista']['params'] = array("task" => "list", "entity" => "EntityCompra", "template" => "admin_compra_lista", "finalModule" => "tipo_envio_lista", "filterBy" => "valida", "filterValue" => "1", "orderBy" => array("ID,DESC"));
$_SPECIFICATION['modules']['pedido_lista']['loginRequired'] = true;

$_SPECIFICATION['modules']['pedido_detalle']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['pedido_detalle']['loginRequired'] = false;
$_SPECIFICATION['modules']['pedido_detalle']['params'] = array("entity" => "EntityCompra", "template" => "admin_pedido_detalle", "id" => RequestHandler::getGetValue("id"), "name" => "compra",
    "extras" => array(
        //"tipo_envio"=>array("entity"=>"EntityTipoEnvio","id"=>"@mainEntity.id_tipo_envio"),
        "cliente" => array("entity" => "EntityCliente", "id" => "@mainEntity.id_cliente")
    //"lineas"=>array("entity"=>"EntityLinea","filterBy"=>"id_familia", "filterValue" => RequestHandler::getGetValue("id"),"orderBy"=>"orden,ASC"),
    //"familias"=>array("entity"=>"EntityFamilia","filterBy"=>"1","filterValue"=>"1","orderBy"=>"orden,ASC"),
    //"productos_sueltos"=>array("entity"=>"EntityProducto","filterBy"=>"id_familia_directa","filterValue"=>RequestHandler::getGetValue("id"))
    ),
    "hardExtras" => array(
        "productos" => array(
            "query" => "SELECT *,cp.precio as subtotal FROM compra_producto cp JOIN producto p ON p.id = cp.id_producto WHERE cp.id_compra = '#1#'",
            "params" => array(RequestHandler::getGetValue("id"))
        )
    )
);

/* Importar el maestro */
$_SPECIFICATION['modules']['maestro_import']['className'] = 'ModuleImportarMaestro';
$_SPECIFICATION['modules']['maestro_import']['params'] = array("template_list" => "admin_importar_maestro", "template_result" => "admin_importar_maestro_resultado");
$_SPECIFICATION['modules']['maestro_import']['loginRequired'] = true;


// ADRIÁN - 9/3/2011 - Preview de newsletter
$_SPECIFICATION['modules']['newsletters_preview']['className'] = 'ModuleEntityHome';
$_SPECIFICATION['modules']['newsletters_preview']['params'] = array("entity" => "EntityNewsletter", "template" => "admin_newsletter_preview", "finalModule" => "newsletters_lista", "id" => RequestHandler::getGetValue("id"));
$_SPECIFICATION['modules']['newsletters_preview']['loginRequired'] = false;


/* CLIENTES */
$_SPECIFICATION['modules']['clientes_lista']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['clientes_lista']['params'] = array("task" => "list", "entity" => "EntityClienteMayorista", "template" => "admin_cliente_lista", "finalModule" => "clientes_lista", "orderBy" => array("nombre,ASC"));
$_SPECIFICATION['modules']['clientes_lista']['loginRequired'] = true;

$_SPECIFICATION['modules']['clientes_alta']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['clientes_alta']['params'] = array("task" => "AM", "entity" => "EntityClienteMayorista", "template" => "admin_cliente_AM", "finalModule" => "clientes_lista");
$_SPECIFICATION['modules']['clientes_alta']['loginRequired'] = true;

$_SPECIFICATION['modules']['clientes_baja']['className'] = 'ModuleABMSimple';
$_SPECIFICATION['modules']['clientes_baja']['params'] = array("task" => "delete", "entity" => "EntityClienteMayorista", "finalModule" => "clientes_lista");
$_SPECIFICATION['modules']['clientes_baja']['loginRequired'] = true;

/* Importar clientes mayoristas y minoristas. */
$_SPECIFICATION['modules']['clientes_import']['className'] = 'ModuleImportarClientes';
$_SPECIFICATION['modules']['clientes_import']['params'] = array("template_list" => "admin_importar_clientes", "template_result" => "admin_importar_clientes_resultado");
$_SPECIFICATION['modules']['clientes_import']['loginRequired'] = true;


?>