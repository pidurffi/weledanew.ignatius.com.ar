<?
	include_once("specification/database.php");
	$db_username = $_SPECIFICATION['DbClass']['params']['user'];
	$db_password = $_SPECIFICATION['DbClass']['params']['pass'];
	$db_dbname = $_SPECIFICATION['DbClass']['params']['dbname'];
	$conexion = mysql_connect("localhost", $db_username, $db_password) or die("Error de conexión");
	mysql_select_db($db_dbname, $conexion);	
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/StylesSelectorPiel.css">
		<meta charset="UTF-8">
		<script type="text/javascript">
			function agregarProducto(id) {
				ventana = window.open("http://weleda.com.ar/index.php?module=fr_carrito_add&id=" + id, "carrito", "width=800,height=500,resizable=yes,scrollbars=yes");
				ventana.focus();
			}		
		</script>
	</head>
	<body>
		<div align="center">
			<? switch ($_GET['R']){
				case 1:
					$sql = "select precio from producto where id in (129,130,133) order by id";					
					$Resultado = mysql_query($sql, $conexion) or die("Error en la ejecución de la query");
					$body_Productos =
					'<div style="margin-bottom:8px;">
						<img width="700" class="" src="http://weleda.com.ar/imagenes/SelectorPiel/Top_Resultados_SelectorPiel_Almendra.jpg" alt="" border="0" />
					</div>
					<table class="Productos" cellspacing="0">
						<tr>
							<td class="Raya">
								<h4>PASO 1</h4>
								<h1>Leche Limpiadora Armonizante</h1>
							</td>
							<td class="Raya">
								<h4>PASO 2</h4>
								<h1>Fluido Armonizante</h1>
							</td>
							<td>
								<h4>PASO 3</h4>
								<h1>Aceite Facial Armonizante</h1>
							</td>
						</tr>
						<tr>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=129&id_linea=2&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Leche_Limp_Armoniz_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=130&id_linea=2&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Fluido_Armon_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td>
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=133&id_linea=2&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/1_Aceite_Facial_Armoniz_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
						</tr>
						<tr>
							<td class="Raya EspacioSuperior">
								<h2>Limpia suavemente sin resecar</h2>
								<p>Esta suave y cremosa emulsión remueve delicadamente las impurezas y el maquillaje sin irritar.</p>
								<p>Pomo 75ml</p>
								<h3>$ '.mysql_result($Resultado,0).'</h3>
							</td>
							<td class="Raya EspacioSuperior">
								<h2>Calma e hidrata</h2>
								<p>Alivia irritaciones y sensación de tirantez, dejando la piel agradablemente suave y aterciopelada.</p>
								<p>Pomo 30ml</p>
								<h3>$ '.mysql_result($Resultado,1).'</h3>
							</td>
							<td class="EspacioSuperior">
								<h2>Calma de forma intensiva</h2>
								<p>Especialmente desarrollado para pieles sensibles, este aceite hipoalergénico cuida la piel y regula su equilibrio hidrolipídico de forma duradera.</p>
								<p>Envase de vidrio 50ml</p>
								<h3>$ '.mysql_result($Resultado,2).'</h3>
							</td>
						</tr>';						
						$body_result = $body_Productos.						
						'<tr>
							<td class="Raya">
								<a href="javascript:agregarProducto(129)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td class="Raya">
								<a href="javascript:agregarProducto(130)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
				            	</a>
							</td>
							<td>
								<a href="javascript:agregarProducto(133)">
				                	<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
				            	</a>
							</td>
						</tr>
					</table>';
					echo $body_result;
					$html_email = '<body><div align="center">'.$body_Productos.'</table></div></body>';					
				break;
				case 2:
					$sql = "select precio from producto where id in (129,131,133) order by id";
					$Resultado = mysql_query($sql, $conexion) or die("Error en la ejecución de la query");
					$body_Productos =
					'<div style="margin-bottom:8px;">
						<img width="700" class="" src="http://weleda.com.ar/imagenes/SelectorPiel/Top_Resultados_SelectorPiel_Almendra.jpg" alt="" border="0" />
					</div>
					<table class="Productos" cellspacing="0">
						<tr>
							<td class="Raya">
								<h4>PASO 1</h4>
								<h1>Leche Limpiadora Armonizante</h1>
							</td>
							<td class="Raya">
								<h4>PASO 2</h4>
								<h1>Crema Facial Armonizante</h1>
							</td>
							<td>
								<h4>PASO 3</h4>
								<h1>Aceite Facial Armonizante</h1>
							</td>
						</tr>
						<tr>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=129&id_linea=2&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Leche_Limp_Armoniz_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=131&id_linea=2&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Crema_Facial_Armoniz_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td>
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=133&id_linea=2&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/1_Aceite_Facial_Armoniz_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
						</tr>
						<tr>
							<td class="Raya EspacioSuperior">
								<h2>Limpia suavemente sin resecar</h2>
								<p>Esta suave y cremosa emulsión remueve delicadamente las impurezas y el maquillaje sin irritar.</p>
								<p>Pomo 75ml</p>
								<h3>$ '.mysql_result($Resultado,0).'</h3>
							</td>
							<td class="Raya EspacioSuperior">
								<h2>Calma y protege</h2>
								<p>Crema hipoalergénica para día y noche, especialmente desarrollada para pieles sensibles con tendencia seca.</p>
								<p>Pomo 30ml</p>
								<h3>$ '.mysql_result($Resultado,1).'</h3>
							</td>
							<td class="EspacioSuperior">
								<h2>Calma de forma intensiva</h2>
								<p>Especialmente desarrollado para pieles sensibles, este aceite hipoalergénico cuida la piel y regula su equilibrio hidrolipídico de forma duradera.</p>
								<p>Envase de vidrio 50ml</p>
								<h3>$ '.mysql_result($Resultado,2).'</h3>									
							</td>
						</tr>';
						$body_result = $body_Productos.
						'<tr>
							<td class="Raya">
								<a href="javascript:agregarProducto(129)">
				                	<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
				            	</a>
							</td>
							<td class="Raya">
								<a href="javascript:agregarProducto(131)">
				                	<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
				            	</a>
							</td>
							<td>
								<a href="javascript:agregarProducto(133)">
				                	<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
				            	</a>
							</td>
						</tr>
					</table>';
					echo $body_result;
					$html_email = '<body><div align="center">'.$body_Productos.'</table></div></body>';
				break;
				case 3:
					$sql = "select precio from producto where id in (117,118,120,123) order by id";
					$Resultado = mysql_query($sql, $conexion) or die("Error en la ejecución de la query");
					$body_Productos =
					'<div style="margin-bottom:8px;">
						<img width="700" class="" src="http://www.weleda.com.ar/imagenes/SelectorPiel/Top_Resultados_SelectorPiel_Iris.jpg" alt="" border="0" />
					</div>
					<table class="Productos" cellspacing="0">
						<tr>
							<td class="Raya">
								<h4>PASO 1</h4>
								<h1>Leche Limpiadora Suave</h1>
							</td>
							<td class="Raya">
								<h4>PASO 1</h4>
								<h1>Loción Tónica Vivificante</h1>
							</td>
							<td class="Raya">
								<h4>PASO 2</h4>
								<h1>Fluido Hidratante</h1>
							</td>
							<td>
								<h4>PASO 3</h4>
								<h1>Crema de Noche Hidratante</h1>
							</td>
						</tr>
						<tr>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=117&id_linea=20&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Leche_limp_Suave_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=118&id_linea=20&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Locion_tonica_vivificante_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=120&id_linea=3&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Fluido_Hidrat_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td>
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=123&id_linea=3&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Crema_Noche_Hidrat_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
						</tr>
						<tr>
							<td class="Raya EspacioSuperior">
								<h2>Limpia profundamente sin resecar</h2>
								<p>Para pieles normales y secas, esta suave emulsión limpia profundamente, eliminando impurezas y maquillaje.</p>
								<p>Envase de vidrio 100ml</p>
								<h3>$ '.mysql_result($Resultado,0).'</h3>
							</td>
							<td class="Raya EspacioSuperior">
								<h2>Purifica y afina los poros</h2>
								<p>El suave tónico es adecuado para todo tipo de piel.</p>
								<p>Envase de vidrio 100ml</p>
								<h3>$ '.mysql_result($Resultado,1).'</h3>
							</td>
							<td class="Raya EspacioSuperior">
								<h2>Pieles normales y mixtas</h2>
								<p>Esta ligera crema para día y noche aporta hidratación y protege la piel de las agresiones externas.</p>
								<p>Pomo 30ml</p>
								<h3>$ '.mysql_result($Resultado,2).'</h3>
							</td>
							<td class="EspacioSuperior">
								<h2>Reequilibra y regenera</h2>
								<p>Con aceite de almendra dulce y manteca de karité, esta crema nutritiva apoya el proceso natural de regeneración nocturna.</p>
								<p>Pomo 30ml</p>
								<h3>$ '.mysql_result($Resultado,3).'</h3>									
							</td>
						</tr>';
						$body_result = $body_Productos.
						'<tr>
							<td class="Raya">
								<a href="javascript:agregarProducto(117)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td class="Raya">
								<a href="javascript:agregarProducto(118)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td class="Raya">
								<a href="javascript:agregarProducto(120)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td>
								<a href="javascript:agregarProducto(123)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
						</tr>
					</table>';
					echo $body_result;
					$html_email = '<body><div align="center">'.$body_Productos.'</table></div></body>';
				break;
				case 4:
					$sql = "select precio from producto where id in (117,118,122,123) order by id";
					$Resultado = mysql_query($sql, $conexion) or die("Error en la ejecución de la query"); 
					$body_Productos =
					'<div style="margin-bottom:8px;">
						<img width="700" class="" src="http://weleda.com.ar/imagenes/SelectorPiel/Top_Resultados_SelectorPiel_Iris.jpg" alt="" border="0" />
					</div>
					<table class="Productos" cellspacing="0">
						<tr>
							<td class="Raya">
								<h4>PASO 1</h4>
								<h1>Leche Limpiadora Suave</h1>
							</td>
							<td class="Raya">
								<h4>PASO 1</h4>
								<h1>Loción Tónica Vivificante</h1>
							</td>
							<td class="Raya">
								<h4>PASO 2</h4>
								<h1>Crema de Día Hidratante</h1>
							</td>
							<td>
								<h4>PASO 3</h4>
								<h1>Crema de Noche Hidratante</h1>
							</td>
						</tr>
						<tr>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=117&id_linea=20&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Leche_limp_Suave_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=118&id_linea=20&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Locion_tonica_vivificante_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=122&id_linea=3&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/2_Crema_Dia_Hidrat_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td>
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=123&id_linea=3&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Crema_Noche_Hidrat_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>					
						</tr>
						<tr>							
							<td class="Raya EspacioSuperior">
								<h2>Limpia profundamente sin resecar</h2>
								<p>Para pieles normales y secas, esta suave emulsión limpia profundamente, eliminando impurezas y maquillaje.</p>
								<p>Envase de vidrio 100ml</p>
								<h3>$ '.mysql_result($Resultado,0).'</h3>
							</td>
							<td class="Raya EspacioSuperior">
								<h2>Purifica y afina los poros</h2>
								<p>El suave tónico es adecuado para todo tipo de piel.</p>
								<p>Envase de vidrio 100ml</p>
								<h3>$ '.mysql_result($Resultado,1).'</h3>
							</td>
							<td class="Raya EspacioSuperior">
								<h2>Pieles secas y muy secas</h2>
								<p>La crema nutritiva regula el equilibrio hidrolipídico y aporta hidratación.</p>
								<p>Pomo 30ml</p>
								<h3>$ '.mysql_result($Resultado,2).'</h3>
							</td>
							<td class="EspacioSuperior">
								<h2>Reequilibra y regenera</h2>
								<p>Con aceite de almendra dulce y manteca de karité, esta crema nutritiva apoya el proceso natural de regeneración nocturna.</p>
								<p>Pomo 30ml</p>
								<h3>$ '.mysql_result($Resultado,3).'</h3>									
							</td>
						</tr>';
						$body_result = $body_Productos.
						'<tr>
							<td class="Raya">
								<a href="javascript:agregarProducto(117)">
								<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td class="Raya">
								<a href="javascript:agregarProducto(118)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td class="Raya">
								<a href="javascript:agregarProducto(122)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td>
								<a href="javascript:agregarProducto(123)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
						</tr>
					</table>';
					echo $body_result;
					$html_email = '<body><div align="center">'.$body_Productos.'</table></div></body>';
				break;
				case 5:
					$sql = "select precio from producto where id in (117,118,124,126,127) order by id";
					$Resultado = mysql_query($sql, $conexion) or die("Error en la ejecución de la query");
					$body_Productos = 
					'<div style="margin-bottom:8px;">
						<img width="700" class="" src="http://weleda.com.ar/imagenes/SelectorPiel/Top_Resultados_SelectorPiel_RosaMosqueta.jpg" alt="" border="0" />
					</div>
					<table class="Productos" cellspacing="0">
						<tr>
							<td class="Raya">
								<h4>PASO 1</h4>
								<h1>Leche Limpiadora Suave</h1>
							</td>
							<td class="">
								<h4>PASO 1</h4>
								<h1>Loción Tónica Vivificante</h1>
							</td>
						</tr>
						<tr>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=117&id_linea=20&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Leche_limp_Suave_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=118&id_linea=20&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Locion_tonica_vivificante_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>							
						</tr>
						<tr>							
							<td class="Raya EspacioSuperior">
								<h2>Limpia profundamente sin resecar</h2>
								<p>Para pieles normales y secas, esta suave emulsión limpia profundamente, eliminando impurezas y maquillaje.</p>
								<p>Envase de vidrio 100ml</p>
								<h3>$ '.mysql_result($Resultado,0).'</h3>
							</td>
							<td class="EspacioSuperior">
								<h2>Purifica y afina los poros</h2>
								<p>El suave tónico es adecuado para todo tipo de piel.</p>
								<p>Envase de vidrio 100ml</p>
								<h3>$ '.mysql_result($Resultado,1).'</h3>
							</td>							
						</tr>';
						$body_result = $body_Productos.
						'<tr>
							<td class="Raya">
								<a href="javascript:agregarProducto(117)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>							
							<td>
								<a href="javascript:agregarProducto(118)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
						</tr>
					</table><br />';
					$body_Productos2 = '</table>'.
					'<br />
					<table class="Productos" cellspacing="0">
						<tr>							
							<td class="Raya">
								<h4>PASO 2</h4>
								<h1>Fluido Alisante</h1>
							</td>
							<td class="Raya">
								<h4>PASO 2</h4>
								<h1>Crema de Noche Alisante</h1>
							</td>
							<td>
								<h4>PASO 3</h4>
								<h1>Contorno de Ojos Alisante</h1>
							</td>
						</tr>
						<tr>							
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=124&id_linea=1&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Fluido_alisante_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=126&id_linea=1&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Crema_Noche_Alisante_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td>
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=127&id_linea=1&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Contorno_Ojos_Alis_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
						</tr>
						<tr>
							<td class="Raya EspacioSuperior">
								<h2>Pieles normales y mixtas</h2>
								<p>Crema ligera para día y noche. Con aceite de rosa mosqueta biológico, estimula los procesos de renovación cutánea.</p>
								<p>Pomo 30ml</p>
								<h3>$ '.mysql_result($Resultado,2).'</h3>
							</td>
							<td class="Raya EspacioSuperior">
								<h2>Preserva la juventud de la piel</h2>
								<p>La suave crema nutre y estimula los procesos de renovación cutánea durante la fase regeneradora nocturna, atenuando las primeras arrugas.</p>
								<p>Pomo 30ml</p>
								<h3>$ '.mysql_result($Resultado,3).'</h3>
							</td>
							<td class="EspacioSuperior">
								<h2>Alisante</h2>
								<p>Formulada sin perfume, esta ligera crema atenúa las primeras arrugas, descongestiona y vivifica la piel del contorno de ojos.</p>
								<p>Pomo 10ml</p>
								<h3>$ '.mysql_result($Resultado,4).'</h3>
							</td>
						</tr>';
						$body_result = $body_result.$body_Productos2.
						'<tr>
							<td class="Raya">
								<a href="javascript:agregarProducto(124)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td class="Raya">
								<a href="javascript:agregarProducto(126)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>							
							<td>
								<a href="javascript:agregarProducto(127)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
						</tr>
					</table>';
					echo $body_result;
					$html_email = '<body><div align="center">'.$body_Productos.$body_Productos2.'</table></div></body>';
				break;
				case 6:
					$sql = "select precio from producto where id in (117,118,125,126,127) order by id";
					$Resultado = mysql_query($sql, $conexion) or die("Error en la ejecución de la query");
					$body_Productos =
					'<div style="margin-bottom:8px;">
						<img width="700" class="" src="http://weleda.com.ar/imagenes/SelectorPiel/Top_Resultados_SelectorPiel_RosaMosqueta.jpg" alt="" border="0" />
					</div>
					<table class="Productos" cellspacing="0">
						<tr>
							<td class="Raya">
								<h4>PASO 1</h4>
								<h1>Leche Limpiadora Suave</h1>
							</td>
							<td class="">
								<h4>PASO 1</h4>
								<h1>Loción Tónica Vivificante</h1>
							</td>
						</tr>
						<tr>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=117&id_linea=20&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Leche_limp_Suave_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=118&id_linea=20&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Locion_tonica_vivificante_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
						</tr>
						<tr>							
							<td class="Raya EspacioSuperior">
								<h2>Limpia profundamente sin resecar</h2>
								<p>Para pieles normales y secas, esta suave emulsión limpia profundamente, eliminando impurezas y maquillaje.</p>
								<p>Envase de vidrio 100ml</p>
								<h3>$ '.mysql_result($Resultado,0).'</h3>
							</td>
							<td class="EspacioSuperior">
								<h2>Purifica y afina los poros</h2>
								<p>El suave tónico es adecuado para todo tipo de piel.</p>
								<p>Envase de vidrio 100ml</p>
								<h3>$ '.mysql_result($Resultado,1).'</h3>
							</td>
						</tr>';
						$body_result = $body_Productos.
						'<tr>
							<td class="Raya">
								<a href="javascript:agregarProducto(117)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>							
							<td>
								<a href="javascript:agregarProducto(118)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
						</tr>
					</table><br />';
					$body_Productos2 = '</table>'.
					'<table class="Productos" cellspacing="0">
						<tr>
							<td class="Raya">
								<h4>PASO 2</h4>
								<h1>Crema de Día Alisante</h1>
							</td>
							<td class="Raya">
								<h4>PASO 2</h4>
								<h1>Crema de Noche Alisante</h1>
							</td>
							<td>
								<h4>PASO 3</h4>
								<h1>Contorno de Ojos Alisante</h1>
							</td>
						</tr>
						<tr>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=125&id_linea=1&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Crema_Dia_alisante_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=126&id_linea=1&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Crema_Noche_Alisante_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td >
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=127&id_linea=1&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Contorno_Ojos_Alis_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
						</tr>
						<tr>
							<td class="Raya EspacioSuperior">
								<h2>Pieles secas</h2>
								<p>La crema nutritiva estimula los procesos de renovación cutánea. Atenúa las primeras arrugas, hidrata y suaviza la piel.</p>
								<p>Pomo 30ml</p>
								<h3>$ '.mysql_result($Resultado,2).'</h3>
							</td>
							<td class="Raya EspacioSuperior">
								<h2>Preserva la juventud de la piel</h2>
								<p>La suave crema nutre y estimula los procesos de renovación cutánea durante la fase regeneradora nocturna, atenuando las primeras arrugas.</p>
								<p>Pomo 30ml</p>
								<h3>$ '.mysql_result($Resultado,3).'</h3>
							</td>
							<td class="EspacioSuperior">
								<h2>Alisante</h2>
								<p>Formulada sin perfume, esta ligera crema atenúa las primeras arrugas, descongestiona y vivifica la piel del contorno de ojos.</p>
								<p>Pomo 10ml</p>
								<h3>$ '.mysql_result($Resultado,4).'</h3>
							</td>
						</tr>';
						$body_result = $body_result.$body_Productos2.
						'<tr>
							<td class="Raya">
								<a href="javascript:agregarProducto(125)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td class="Raya">
								<a href="javascript:agregarProducto(126)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td>
								<a href="javascript:agregarProducto(127)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
						</tr>
					</table>';
					echo $body_result;
					$html_email = '<body><div align="center">'.$body_Productos.$body_Productos2.'</table></div></body>';
				break;
				case 7:
					$sql = "select precio from producto where id in (117,118,113,114,115,116) order by id";
					$Resultado = mysql_query($sql, $conexion) or die("Error en la ejecución de la query"); 
					$body_Productos =
					'<div style="margin-bottom:8px;">
						<img width="700" class="" src="http://weleda.com.ar/imagenes/SelectorPiel/Top_Resultados_SelectorPiel_Granada.jpg" alt="" border="0" />
					</div>
					<table class="Productos" cellspacing="0">
						<tr>
							<td class="Raya">
								<h4>PASO 1</h4>
								<h1>Leche Limpiadora Suave</h1>
							</td>
							<td class="">
								<h4>PASO 1</h4>
								<h1>Loción Tónica Vivificante</h1>
							</td>							
						</tr>
						<tr>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=117&id_linea=20&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Leche_limp_Suave_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=118&id_linea=20&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Locion_tonica_vivificante_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>							
						</tr>
						<tr>							
							<td class="Raya EspacioSuperior">
								<h2>Limpia profundamente sin resecar</h2>
								<p>Para pieles normales y secas, esta suave emulsión limpia profundamente, eliminando impurezas y maquillaje.</p>
								<p>Envase de vidrio 100ml</p>
								<h3>$ '.mysql_result($Resultado,4).'</h3>
							</td>
							<td class="EspacioSuperior">
								<h2>Purifica y afina los poros</h2>
								<p>El suave tónico es adecuado para todo tipo de piel.</p>
								<p>Envase de vidrio 100ml</p>
								<h3>$ '.mysql_result($Resultado,5).'</h3>
							</td>							
						</tr>';
						$body_result = $body_Productos.
						'<tr>
							<td class="Raya">
								<a href="javascript:agregarProducto(117)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td class="">
								<a href="javascript:agregarProducto(118)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>							
						</tr>					
					</table><br />';
					$body_Productos2 = '</table>'.
					'<table class="Productos" cellspacing="0">
						<tr>
							<td class="Raya">
								<h4>PASO 2</h4>
								<h1>Serum Reafirmante</h1>
							</td>
							<td class="Raya">
								<h4>PASO 2</h4>
								<h1>Crema de Día Reafirmante</h1>
							</td>
							<td class="Raya">
								<h4>PASO 3</h4>
								<h1>Crema de Noche Reafirmante</h1>
							</td>
							<td>
								<h4>PASO 3</h4>
								<h1>Contorno de Ojos Reafirmante</h1>
							</td>
						</tr>
						<tr>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=113&id_linea=19&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Serum_Reaf_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=114&id_linea=19&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Crema_Dia_Reaf_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=115&id_linea=19&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Crema_Noche_Reaf_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td>
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=116&id_linea=19&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Contorno_Ojos_Reaf_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
						</tr>
						<tr>
							<td class="Raya EspacioSuperior">
								<h2>Concentrado antioxidante</h2>
								<p>De textura no grasa, aporta al instante una hidratación intensiva y duradera, además de atenuar arrugas y reafirmar la piel.</p>
								<p>Dispenser 30 ml</p>
								<h3>$ '.mysql_result($Resultado,0).'</h3>
							</td>
							<td class="Raya EspacioSuperior">
								<h2>Atenúa los signos de la edad</h2>
								<p>La suave crema atenúa arrugas y reafirma la piel gracias a los valiosos aceites biológicos de granada, macadamia y argán.</p>
								<p>Pomo 30 ml</p>
								<h3>$ '.mysql_result($Resultado,1).'</h3>
							</td>
							<td class="Raya EspacioSuperior">
								<h2>Atenúa los signos de la edad</h2>
								<p>Con valiosos nutrientes procedentes del aceite de germen de trigo, esta crema apoya el proceso natural de regeneración nocturna, atenuando arrugas y reafirmando la piel.</p>
								<p>Pomo 30 ml</p>
								<h3>$ '.mysql_result($Resultado,2).'</h3>
							</td>
							<td class="EspacioSuperior">
								<h2>Reafirmante</h2>
								<p>La ligera crema sin perfume atenúa arrugas y reafirma la piel en la zona del contorno de ojos.</p>
								<p>Pomo 10 ml</p>
								<h3>$ '.mysql_result($Resultado,3).'</h3>
							</td>
						</tr>';
						$body_result = $body_result.$body_Productos2.
						'<tr>
							<td class="Raya">
								<a href="javascript:agregarProducto(113)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td class="Raya">
								<a href="javascript:agregarProducto(114)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td class="Raya">
								<a href="javascript:agregarProducto(115)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td>
								<a href="javascript:agregarProducto(116)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
						</tr>
					</table>';
					echo $body_result;
					$html_email = '<body><div align="center">'.$body_Productos.$body_Productos2.'</table></div></body>';
				break;
				case 8:
					$sql = "select precio from producto where id in (117,118,154,155,156) order by id";
					$Resultado = mysql_query($sql, $conexion) or die("Error en la ejecución de la query");
					$body_Productos =
					'<div style="margin-bottom:8px;">
						<img width="700" class="" src="http://weleda.com.ar/imagenes/SelectorPiel/Top_Resultados_SelectorPiel_Onagra.jpg" alt="" border="0" />
					</div>
					<table class="Productos" cellspacing="0">
						<tr>
							<td class="Raya">
								<h4>PASO 1</h4>
								<h1>Leche Limpiadora Suave</h1>
							</td>
							<td class="">
								<h4>PASO 1</h4>
								<h1>Loción Tónica Vivificante</h1>
							</td>							
						</tr>
						<tr>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=117&id_linea=20&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Leche_limp_Suave_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=118&id_linea=20&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_Locion_tonica_vivificante_GR.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
						</tr>
						<tr>							
							<td class="Raya EspacioSuperior">
								<h2>Limpia profundamente sin resecar</h2>
								<p>Para pieles normales y secas, esta suave emulsión limpia profundamente, eliminando impurezas y maquillaje.</p>
								<p>Envase de vidrio 100ml</p>
								<h3>$ '.mysql_result($Resultado,0).'</h3>
							</td>
							<td class="EspacioSuperior">
								<h2>Purifica y afina los poros</h2>
								<p>El suave tónico es adecuado para todo tipo de piel.</p>
								<p>Envase de vidrio 100ml</p>
								<h3>$ '.mysql_result($Resultado,1).'</h3>
							</td>
						</tr>';
						$body_result = $body_Productos.
						'<tr>
							<td class="Raya">
								<a href="javascript:agregarProducto(117)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td>
								<a href="javascript:agregarProducto(118)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
						</tr>
					</table><br />';
					$body_Productos2 = '</table>'.
					'<table class="Productos" cellspacing="0">
						<tr>
							<td class="Raya">
								<h4>PASO 2</h4>
								<h1>Crema de Día Redensificante</h1>
							</td>
							<td class="Raya">
								<h4>PASO 3</h4>
								<h1>Crema de Noche Redensificante</h1>
							</td>
							<td>
								<h4>PASO 3</h4>
								<h1>Contorno de Ojos y Labios</h1>
							</td>
						</tr>
						<tr>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=154&id_linea=21&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/1_Evening%20Primrose_Age%20Revitalizing_day%20cream_armado.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td class="Raya">
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=155&id_linea=21&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/0_cremadenocheonagra-aleman.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
							<td>
								<a href="http://weleda.com.ar/index.php?module=fr_producto&id=156&id_linea=21&id_familia=2" target="_blank">
									<div align="center">
										<img style="height:110px; width:67px;" class="ImagenProducto" src="http://weleda.com.ar/imagenes/productos/8_Evening%20Primrose_Age%20Revitalizing_Eye%20and%20Lip%20cream_armado.jpg" alt="" border="0" />
									</div>
								</a>
							</td>
						</tr>
						<tr>
							<td class="Raya EspacioSuperior">
								<h2>Fortalece la piel</h2>
								<p>A base de ingredientes antioxidantes,ayuda a reducir las arrugas profundas.Hidrata intensamente,reafirma y fortalece la piel del rostro y define su contorno. El aceite de onagra crea una barrera protectora en la piel,centella asiática y aceite de macadamia que ayuda a suavizar y regenerar.</p>
								<p>Pomo 30ml</p>
								<h3>$ '.mysql_result($Resultado,2).'</h3>
							</td>
							<td class="Raya EspacioSuperior">
								<h2>Reactiva las funciones vitales de la piel</h2>
								<p>Nutre intensamente y revitaliza.Mejora la barrera protectora de piel gracias al aceite de onagra,mejora su estructura y la rellena.La piel rejuvenece.</p>
								<p>Pomo 30ml</p>
								<h3>$ '.mysql_result($Resultado,3).'</h3>
							</td>
							<td class="EspacioSuperior">
								<h2>Reduce lí­neas y arrugas</h2>
								<p>Descongestiona y reduce la hinchazón alrededor de los ojos.Ayuda a redefinir el contorno de ojos y labios y los deja más suaves.Sin perfume.</p>
								<p>Pomo 10 ml</p>
								<h3>$ '.mysql_result($Resultado,4).'</h3>
							</td>
						</tr>';
						$body_result = $body_result.$body_Productos2.
						'<tr>
							<td class="Raya">
								<a href="javascript:agregarProducto(154)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td class="Raya">
								<a href="javascript:agregarProducto(155)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
							<td>
								<a href="javascript:agregarProducto(156)">
									<img src="imagenes/estructura/carrito/boton_comprar.jpg" border="0" />
								</a>
							</td>
						</tr>
					</table>';
					echo $body_result;
					$html_email = '<body><div align="center">'.$body_Productos.$body_Productos2.'</table></div></body>';
				break;
				default:
					?>Opción inválida, por favor tome el test nuevamente.<br />
					<div style="width:700px;">						
						<div align="right" style="float:right;"><br />
							<a href="SelectorPiel.php">
								<h3>Volver</h3>
							</a>
						</div>
					</div>

					<?
				break;
			}
			mysql_close($conexion); 
			if ($_GET['R']>0 and $_GET['R']<9){ ?>
			<div style="width:700px; margin-top:20px;">
				<div align="left" style="float:left;">
					Quiero recibir estas recomendaciones en mi mail<br />
					<form action="EnvioResultadoSelectorPiel.php" method="POST">
						<input style="font-family:'neo-sans-medium'; width:250px;" type="text" name="email">
						<input type="submit" value="Enviar mi resultado" style="font-family: 'neo-sans-medium';">
						<input type="hidden" name="html_body" value='<?php echo $html_email; ?>'>
					</form>
				</div>
				<div align="right" style="float:right;"><br />
					<a href="javascript:history.back(1)">
						<h3>Volver</h3>
					</a>
				</div>
			</div>
			<? } ?>	
		</div>
	</body>
</html>