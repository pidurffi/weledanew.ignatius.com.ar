<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="../css/backoffice.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WELLEDA | BackOffice</title>

<script src="../includes/external/ckeditor/ckeditor.js"></script>

</head>

<body>
<div id="encabezado"></div>
	<div id="contenedor">

        <div id="caja_cuerpo">
        	<div id="cuerpo">
            <div id="contenido_backoffice">
           	<? if (isset($_GET['module'])&&($_GET['module']!='login')) {?>

            <div class="menu">
                <ul>
					<? /* Se cambiaron todos los paths. antes era "/admin/index.php.
						se le puso ./index.php */ ?>
                    <li><a href="./index.php?module=regiones_lista" title="Administraci&oacute;n de regiones">Regiones</a> |</li>
                    <li><a href="./index.php?module=subregiones_lista" title="Administraci&oacute;n de subregiones">Subregiones</a> |</li>
                    <li><a href="./index.php?module=ptos_venta_lista" title="Administraci&oacute;n de puntos de venta">Puntos de Venta</a> |</li>
                    <li><a href="./index.php?module=home_edit" title="Administraci&oacute;n de la Home">Home</a> |</li>
                    <li><a href="./index.php?module=familias_lista" title="Administraci&oacute;n de las Familias">Familias</a> |</li>
                    <li><a href="./index.php?module=lineas_lista" title="Administraci&oacute;n de las l&iacute;neas">L&iacute;neas</a> |</li>
                    <li><a href="./index.php?module=productos_lista" title="Administraci&oacute;n de los productos">Productos</a> |</li>
                    <li><a href="./index.php?module=noticias_lista" title="Administraci&oacute;n de las noticias">Noticias</a> |</li>
                    <? /* <li><a href="./index.php?module=tipo_envio_lista" title="Administraci&oacute;n de los tipos de env&iacute;o">Tipos de Env&iacute;o</a> |</li> */ ?>
                    <li><a href="./index.php?module=pedido_lista" title="Administraci&oacute;n de los pedidos">Pedidos</a> |</li>
                    <li><a href="./index.php?module=newsletters_lista" title="Administraci&oacute;n de Newsletters">Newsletters</a> |</li>
                    <li><a href="./index.php?module=clientes_lista" title="Administraci&oacute;n de Newsletters">Clientes</a> |</li>
                    <li><a href="./index.php?module=maestro_import" title="Importaci&oacute;n de archivo Maestro">Maestro</a> |</li>
                    <li><a href="./index.php?module=clientes_import" title="Importaci&oacute;n de clientes mayorista y minoristas">Importar clientes</a> |</li>
                    <li><a href="./index.php?module=logout" title="Logout">Logout</a></li>
                </ul>
            </div>
            <? }?>
