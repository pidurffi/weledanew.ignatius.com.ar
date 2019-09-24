<?

$tipoNoticia = array(

					1=>'foco.jpg',2=>'profundidad.jpg',3=>'tips.jpg'

					);



function mostrarTexto($texto) {

	global $global_fn,$global_ln;

	$texto = str_replace('@nombre',GlobalManager::getTplMng()->getValue('firstName'),$texto);
	$texto = str_replace('@apellido',GlobalManager::getTplMng()->getValue('lastName'),$texto);
	return $texto;

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Weleda Argentina</title>

</head>



<body style = "margin:0; padding:20px 0 0 0;">

<div style = "width:584px; margin:auto;">

	
		<map name="mapita">
			<area shape="rect" coords="330,492,472,503" href="http://www.weleda.com.ar">
		</map>
		
		<img src = "http://www.ignatius01.com.ar/imagenes/newsletter/nueva_linea_granada_01.jpg" usemap="#mapita" border="0" >
		

	
	

	<div style = "padding:20px;width:544px;background-color:#2aa7df;">

		<p style = "font-family:Arial; margin:0; padding:0; color:#ffffff; font-size:12px;">Por consultas, sugerencias o inconvenientes técnicos escribanos a <a style = "text-decoration:none; font-family:Arial; font-size:13px; color:#96d7eb;" href="mailto:info@weleda.com.ar">info@weleda.com.ar</a></p>

		<p style = "font-family:Arial; margin:20px 0 0 0; padding:0; color:#ffffff; font-size:12px;">Este mensaje y la lista de suscriptores a que es enviado cumple con lo establecido en la Ley Nº 25.326 Art. 27 Inc. 3 (Ley de "Habeas Data") de la República Argentina. Si ud. no desea recibir más comunicaciones de Weleda, por favor envíe un mensaje a <a style = "text-decoration:none; font-family:Arial; font-size:13px; color:#96d7eb;" href="mailto:unsubscribe@weleda.com.ar">unsubscribe@weleda.com.ar</a> </p>

		<p style = "font-family:Arial; margin:20px 0 0 0; padding:0; color:#ffffff; font-size:12px;">Copyright 2008 Weleda S.A | Todos los derechos reservados</p>

	</div>



</div>





</body>

</html>