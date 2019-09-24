<?

if (!empty($_POST))  {
	include_once("specification/database.php");
	$db_username = $_SPECIFICATION['DbClass']['params']['user'];
	$db_password = $_SPECIFICATION['DbClass']['params']['pass'];
	$db_dbname = $_SPECIFICATION['DbClass']['params']['dbname'];
	$conexion = mysql_connect("localhost", $db_username, $db_password) or die("Error de conexion");
	mysql_select_db($db_dbname, $conexion);
	$sql = "SELECT resultado FROM evaluador_de_piel where edad=".$_POST['Edad']." and aspecto=".$_POST['Aspecto'].
		" and sensibilidad=".$_POST['Sensibilidad']." and objetivo=".$_POST['Objetivo'];
	$Resultado = mysql_query($sql, $conexion) or die("Error en la ejecucion de la query de resultado.");
	header('Location: SelectorPielRes.php?R='.mysql_result($Resultado,0));
	mysql_close($conexion);
}else{?>
	<html>
		<head>
			<meta charset="UTF-8">
			<style type="text/css">
				@font-face {
					font-family: "neo-sans-normal";	
					src: local("?"),
						url("../fonts/neosansweleda-rg.ttf") format("truetype"),
					 	url("../fonts/neosansweleda-rg.eot");
					font-weight: normal;
					font-style: normal;
				}
				@font-face {
					font-family: "neo-sans-medium";
					src: local("?"),
						url("../fonts/neosansweleda-md.ttf") format("truetype"),
					 	url("../fonts/neosansweleda-md.eot");
					font-weight: normal;
					font-style: normal;
				}			
				body {
					font-family: 'neo-sans-medium', Arial, Helvetica, sans-serif; 
				}
				.Marco{
					width:520px; 
					margin-right: auto; 
					margin-left: auto;
				}
				.Contenedores{
					float:left; 
					width:250px;
				}
				.ContenedorA{
					padding-right:20px;
				}			
				.ContenedorC{
					padding-top:20px; 
					padding-right:20px;
				}
				.ContenedorD{
					padding-top:20px;
				}
				.Pregunta{
					font-family:'neo-sans-normal', Arial, Helvetica, sans-serif; 
					font-size:16px; 
					font-weight:bold; 
					height:50px; 
					color:rgb(110,85,106);
				}
				.Opciones{
					padding:5px;
					background-color:rgb(220,200,220);
					color:rgb(82,72,86);
				}
				.OpcionesAB{
					height:112px;				
				}
				.OpcionesCD{
					height:215px;
				}
				.BotonSubmit{
					width:520px; 
					text-align:center;
				}	
				table td{
					font-size:16px;
				}
			</style>			
		</head>
		<body>
			<div align="center">
				<img class="" src="http://weleda.com.ar/imagenes/SelectorPiel/Top_SelectorPiel.jpg" alt="" border="0" />
			</div>
			<form method="POST" action="SelectorPiel.php">
				<div class="Marco">
					<div class="Contenedores ContenedorA">
						<div class="Pregunta" style="vertical-align:bottom;">1. Seleccioná tu edad</div>
						<div class="Opciones OpcionesAB">
							<table>
								<tr><td valign="top"><input type="radio" name="Edad" value="1" checked></td><td style="margin-bottom:5px;">En mis 20</td></tr>
								<tr><td valign="top"><input type="radio" name="Edad" value="2"></td><td style="margin-bottom:5px;">Entre 30 y 40 años</td></tr>
								<tr><td valign="top"><input type="radio" name="Edad" value="3"></td><td style="margin-bottom:5px;">Entre 40 y 50 años</td></tr>
								<tr><td><input type="radio" name="Edad" value="4"></td><td>Más de 50 años</td></tr>
							</table>
						</div>
					</div>
					<div class="Contenedores">
						<div class="Pregunta">2. ¿Cómo describirías el aspecto de tu piel?</div>
						<div class="Opciones OpcionesAB">
							<table>
								<tr><td valign="top"><input type="radio" name="Aspecto" value="1" checked></td><td style="padding-bottom:5px;">Mixta: mi piel es ligeramente aceitosa y un poco seca</td></tr>
								<tr><td valign="top"><input type="radio" name="Aspecto" value="2"></td><td style="margin-bottom:5px;">Grasa</td></tr>
								<tr><td valign="top"><input type="radio" name="Aspecto" value="3"></td><td>Seca</td></tr>
							</table>
						</div>
					</div>
					<div class="Contenedores ContenedorC">
						<div class="Pregunta" style="vertical-align:bottom;">3. ¿Tenés la piel sensible?</div>
						<div class="Opciones OpcionesCD">
							<table>
								<tr><td valign="top"><input type="radio" name="Sensibilidad" value="1" checked></td><td style="margin-bottom:5px;">Sí, todo el tiempo con enrojecimiento y picazón</td></tr>
								<tr><td valign="top"><input type="radio" name="Sensibilidad" value="2"></td><td style="margin-bottom:5px;">A veces, durante los cambios de estación</td></tr>
								<tr><td valign="top"><input type="radio" name="Sensibilidad" value="3"></td><td>Nunca</td></tr>
							</table>
						</div>
					</div>
					<div class="Contenedores ContenedorD">
						<div class="Pregunta">4. ¿Qué es lo que más te preocupa de tu piel?</div>
						<div class="Opciones OpcionesCD">
							<table>
								<tr><td valign="top"><input type="radio" name="Objetivo" value="1" checked></td><td style="padding-bottom:5px;">Quiero mantenerla sana y en equilibrio</td></tr>
								<tr><td valign="top"><input type="radio" name="Objetivo" value="2"></td><td style="margin-bottom:5px;">Tengo algunas primeras líneas que me gustaría suavizar</td></tr>
								<tr><td valign="top"><input type="radio" name="Objetivo" value="3"></td><td style="margin-bottom:5px;">Quisiera disminuir las arrugas</td></tr>
								<tr><td valign="top"><input type="radio" name="Objetivo" value="4"></td><td>Mi piel es muy sensible y necesita cuidado calmante y tranquilizante</td></tr>
							</table>
						</div>
					</div>			
					<div class="BotonSubmit">
						<input type="submit" value="Obtener mi resultado" style="margin-top:20px; font-family: 'neo-sans-medium';">
					</div>				
				</div>			
			</form>	
		</body>
	</html>
<? } ?>