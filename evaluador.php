<?php
$seccion = "productos";
//$archivoMenuIzq = "./inc/inc.columna_izquierda_$seccion.php";
$actual = "productos";
$destacado_col_izq = "0";
$color = "";
include("tpl/tpl.front_template_arriba.php");?>

<form action="evaluador-res.php">



<div style="float:left; width:240px; padding-right:20px;">
	<div style="color:rgb(110,85,106); font-family:'neo sans medium', Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; height: 50px; vertical-align:bottom;">1. Seleccioná tu edad</div>
	<div style="background-color:rgb(220,200,220); height:110px; padding:5px; color:rgb(82,72,86); font-size:12px;">
		<table>
			<tr><td valign="top"><input type="radio" name="edad" value="20" checked></td><td style="margin-bottom:5px;">En mis 20</td></tr>
			<tr><td valign="top"><input type="radio" name="edad" value="30"></td><td style="margin-bottom:5px;">Entre 30 y 40 años</td></tr>
			<tr><td valign="top"><input type="radio" name="edad" value="40"></td><td style="margin-bottom:5px;">Entre 40 y 50 años</td></tr>
			<tr><td><input type="radio" name="edad" value="50"></td><td>Más de 50 años</td></tr>
		</table>
	</div>
</div>
<div style="float:left; width:240px; ">
	<div style="color:rgb(110,85,106); font-family:'neo sans medium', Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; height: 50px;">2. ¿Cómo describirías el aspecto de tu piel?</div>
	<div style="background-color:rgb(220,200,220); height:110px; padding:5px; color:rgb(82,72,86); font-size:12px;">
		<table>
			<tr><td valign="top"><input type="radio" name="aspecto" value="normal" checked></td><td style="padding-bottom:5px;">Normal: mi piel es ligeramente aceitosa y un poco seca</td></tr>
			<tr><td valign="top"><input type="radio" name="aspecto" value="grasa"></td><td style="margin-bottom:5px;">Mi piel es grasa con algunos brotes</td></tr>
			<tr><td valign="top"><input type="radio" name="aspecto" value="seca"></td><td>Mi piel es seca</td></tr>
		</table>
	</div>
</div>

<div style="float:left; width:240px; padding-top:20px; padding-right:20px;">
	<div style="color:rgb(110,85,106); font-family:'neo sans medium', Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; height: 50px; vertical-align:bottom;">3. ¿Tenés la piel sensible?</div>
	<div style="background-color:rgb(220,200,220); height:145px; padding:5px; color:rgb(82,72,86); font-size:12px;">
		<table>
			<tr><td valign="top"><input type="radio" name="sensible" value="si" checked></td><td style="margin-bottom:5px;">Sí, todo el tiempo con enrojecimiento y picazón</td></tr>
			<tr><td valign="top"><input type="radio" name="sensible" value="aveces"></td><td style="margin-bottom:5px;">A veces, durante los cambios de estación</td></tr>
			<tr><td valign="top"><input type="radio" name="sensible" value="nunca"></td><td>Nunca</td></tr>
		</table>
	</div>
</div>
<div style="float:left; width:240px; padding-top:20px;">
	<div style="color:rgb(110,85,106); font-family:'neo sans medium', Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; height: 50px;">4. ¿Qué es lo que más te preocupa de tu piel?</div>
	<div style="background-color:rgb(220,200,220); height:145px; padding:5px; color:rgb(82,72,86); font-size:12px;">
		<table>
			<tr><td valign="top"><input type="radio" name="preocupa" value="sana" checked></td><td style="padding-bottom:5px;">Quiero mantenerla sana y en equilibrio</td></tr>
			<tr><td valign="top"><input type="radio" name="preocupa" value="lineas"></td><td style="margin-bottom:5px;">Tengo algunas primeras líneas que me gustaría suavizar</td></tr>
			<tr><td valign="top"><input type="radio" name="preocupa" value="arrugas"></td><td style="margin-bottom:5px;">Quisiera disminuir las arrugas</td></tr>
			<tr><td valign="top"><input type="radio" name="preocupa" value="sensible"></td><td>Mi piel es muy sensible y necesita cuidado calmante y tranquilizante</td></tr>
		</table>
	</div>
</div>

	
</form>	

<? include("tpl/tpl.front_template_abajo.php"); ?>