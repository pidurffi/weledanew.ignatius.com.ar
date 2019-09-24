<?
/*
 *  P�gina para sorteo. Se creó para un sorteo particular.
 *  Debe usarse tpl.front_sorteoweb_AM o tpl.front_sorteo_clientes_AM
 */
$seccion = "clientes";
$actual = "sorteo";
$title = "Sorteo";
include_once(GALIX_FOLDER . "class.MenuSimpleLevel.php");
$leftMenu = new MenuSimpleLevel(array());
include(TPL_FOLDER . "tpl.front_template_arriba.php");
?>
<script type="text/javascript">
    <!--
    function cambio_pregunta1()
    {
        var t = ""
        for (i=0; i<document.myform.pregunta1.length; i++)
        {
            if (document.myform.pregunta1[i].checked==true)
            {
                t = t + document.myform.pregunta1[i].value
            }
        }
        document.getElementById("respuesta1").value = t
    }
    
    function cambio_pregunta2()
    {
        var t = ""
        for (i = 0; i < document.myform.pregunta2.length; i++)
        {
            if (document.myform.pregunta2[i].checked == true)
            {
                t = t + document.myform.pregunta2[i].value
            }
        }
        document.getElementById("respuesta2").value = t
    }
    
    function cambio_pregunta3()
    {
        var t = ""
        for (i = 0; i < document.myform.pregunta3.length; i++)
        {
            if (document.myform.pregunta3[i].checked == true)
            {
                t = t + document.myform.pregunta3[i].value
            }
        }
        document.getElementById("respuesta3").value = t
    }
    function cambio_pregunta4()
    {
        var t = ""
        for (i = 0; i < document.myform.pregunta4.length; i++)
        {
            if (document.myform.pregunta4[i].checked == true)
            {
                t = t + document.myform.pregunta4[i].value
            }
        }
        document.getElementById("respuesta4").value = t
    }

    
    
    function validate_form(thisform)
    {
        with (thisform)
        {
            if (validate_required(nombre,"Por favor complete su nombre.")==false)
            {nombre.focus();return false;}
            if (validate_required(apellido,"Por favor complete su apellido.")==false)
            {apellido.focus();return false;}
            /*
			if (validate_required(dni,"Por favor complete su DNI.")==false)
            {dni.focus();return false;}
			*/
            if (validate_required(email,"Por favor escriba su correo electrónico.")==false)
            {email.focus();return false;}
            if (validate_email(email,"La direcci&oacute;n de correo electrónico no es v&aacute;lida.")==false)
            {email.focus();return false;}
            if (validate_required(direccion, "Por favor complete su dirección.") == false)
            {
                direccion.focus();
                return false;
            }
            if (validate_required(localidad, "Por favor complete su localidad.") == false)
            {
                localidad.focus();
                return false;
            }
            if (validate_required(provincia, "Por favor complete su provincia.") == false)
            {
                provincia.focus();
                return false;
            }

            /*
			if (validate_required(comentarios, "Por favor responda la pregunta.") == false)
            {
                comentarios.focus();
                return false;
            }
			*/
            
            if (validate_required(fecha_nacimiento_d, "Por favor complete su fecha de nacimiento.") == false)
            {
                fecha_nacimiento_d.focus();
                return false;
            }
            if (validate_required(fecha_nacimiento_m, "Por favor complete su fecha de nacimiento.") == false)
            {
                fecha_nacimiento_m.focus();
                return false;
            }
            if (validate_required(fecha_nacimiento_y, "Por favor complete su fecha de nacimiento.") == false)
            {
                fecha_nacimiento_y.focus();
                return false;
            }
        }
        document.thisForm.grabar.value=1;
        document.thisForm.submit();
    }
    function grabar_form()
    {
        document.myForm.grabar.value=1;
        document.myForm.submit();
    }
    function validate_email(field,alerttxt)
    {
        with (field)
        {
            apos=value.indexOf("@");
            dotpos=value.lastIndexOf(".");
            if (value!=null && value!="")
            {
                if (apos<1 || dotpos-apos<2)
                {alert(alerttxt);return false;}
                else {return true;}
            }
            else {return true;}
        }
    }
    function validate_required(field,alerttxt)
    {
        with (field)
        {
            if (value==null || value=="")
            {
                alert(alerttxt);return false;
            }
            else
            {
                return true;
            }
        }
    }
    -->
</script>
<? /* para mostrar el video de la rosa mosqueta
  include_once("./video.html"); ?>
  <? /* formulario para el sorteo */ ?>
<form name="myform" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data" action="index.php?module=fr_sorteo_alta&id=<?= (isset($_GET['id'])) ? $_GET['id'] : ''; ?>" >
    <input type="hidden" name="grabar" value="0" />
    <h3 style='font-size: 22px; font-family: "Neo Sans", Arial, Helvetica, sans-serif; color:#c06b1d; font-weight: bold; margin-bottom:0px;'>
        ¡Weleda y Go Green se unen para tu bebé!
    </h3>
    <table cellpadding="10" cellspacing="0" style="margin-top:15px;">
        <tr>
            <td valign="top">
                <img src="/imagenes/contenido/diaderlnino2015.png" />
            </td>            
        </tr>
		<tr>            
            <td>
                <h3>
				   Si tenés un bebé o estás por ser mamá no podés dejar de participar. Regalamos productos de la línea Weleda y un pañal de tela de Go Green. Sólo tenés que completar el formulario.
                </h3>
            </td>
        </tr>
    </table> 
    <table border="0" align="center" width="100%">
        <tr>
            <td colspan="2" style="padding-bottom:5px;">
                <?
                foreach ($errores as $error) {
                    // Si respuesta1 es menos a 1, es porque no se eligi&oacute; un radio button.
                    $error = str_replace("El campo respuesta1 debe ser mayor a 1", "Por favor elija una respuesta", $error);
                    ?>
                    <span style="color:#FF0000"><?= $error ?></span><br/>
                <? } ?>
            </td>
        </tr>
    </table>
		
		<?
	  /*
      <table border="0" align="center" width="100%">
      <tr>
      <td colspan="2" style="font-weight:bold; font-size:12px; line-height: 18px;">

      <p>El Abedul es un árbol que debe su vitalidad al gran consumo de agua y su capacidad para movilizar líquidos, por ello lo elegimos como ingrediente principal de nuestros productos para combatir la celulitis.<br />¿Cuántos litros de agua puede llegar a evaporar por día un sólo árbol de Abedul?"</p>
      </td>
      </tr>
      <tr>
      <td colspan="2" style="font-size:12px; line-height: 18px;">
      <input type="radio" value="1" name="pregunta1" onchange="cambio_pregunta1()" checked />
      5 litros<br />
      <input type="radio" value="2" name="pregunta1" onchange="cambio_pregunta1()" />
      50 litros<br />
      <input type="radio" value="3" name="pregunta1" onchange="cambio_pregunta1()" />
      500 litros<br />
      <input type="radio" value="4" name="pregunta1" onchange="cambio_pregunta1()" />
      5000 litros<br />
      </td>
      </tr>
      </table >
	  */ ?>
     
    <? /* <h3 style="margin:0 0 6px 0;">Particip&aacute; del sorteo:</h3> */ ?>
    <table style="font-size:12px;"> <? /*
		<tr>
			<td style="padding-top:20px;" valign="top">
				¿Qué le regalarías a la naturaleza en esta navidad?
			</td>
			<td style="padding-top:5px; padding-bottom:10px;">
				<textarea rows="3" cols="20" name="comentarios"></textarea>
			</td>
		</tr> */ ?>
        <tr>
            <td>Nombre</td>
            <td><? $em->fields['nombre']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
        </tr>
        <tr>
            <td>Apellido</td>
            <td><? $em->fields['apellido']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
        </tr>
        
        <? /*
		<tr>
            <td>DNI</td>
            <td><? $em->fields['dni']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
        </tr>
		*/ ?>
       <tr style="white-space:nowrap;">
            <td>Fecha de nacimiento</td>
            <td><? $em->fields['fecha_nacimiento']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
        </tr>
		
        <tr>
            <td>Correo electr&oacute;nico</td>
            <td><? $em->fields['email']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
        </tr>
		<tr>
            <td>Direcci&oacute;n</td>
            <td><? $em->fields['direccion']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
        </tr>
	     <tr>
            <td>
                <?
                if (CONSTANTE_PAIS == "Argentina")
                    print('Localidad');
                elseif (CONSTANTE_PAIS == "Chile")
                    print('Ciudad');
                ?>        
            </td>
            <td><? $em->fields['localidad']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
        </tr>
        <tr>
            <td>Provincia</td>
            <td><? $em->fields['provincia']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
        </tr>	
		<tr>
			<td style="vertical-align:top; padding-top:10px;">
				¿Estás embarazada?		
			</td>
			<td style="vertical-align:top; padding-top:10px;">
				<input type="radio" value="1" name="pregunta1" onchange="cambio_pregunta1()" checked />Sí<br />
				<input type="radio" value="2" name="pregunta1" onchange="cambio_pregunta1()" />No
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top; padding-top:10px;">
				¿Tenés un bebé?
			</td>
			<td style="vertical-align:top; padding-top:10px;">
				<input type="radio" value="Sí" name="pregunta2" onchange="cambio_pregunta2()" checked />Sí&nbsp;&nbsp;&nbsp;
				¿De cuántos meses? 
				<? $em->fields['comentarios']->showFormField(null,3) ?>
				<br />
				<input type="radio" value="No" name="pregunta2" onchange="cambio_pregunta2()" />No
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top; padding-top:10px;">
				¿Participás para regalarle<br />a una embarazada?
			</td>
			
			<td style="vertical-align:top; padding-top:10px;">
				<input type="radio" value="Sí" name="pregunta3" onchange="cambio_pregunta3()" checked />Sí<br />
				<input type="radio" value="No" name="pregunta3" onchange="cambio_pregunta3()" />No
			</td>
		</tr>
		
        <? /*
        <tr>
            <td>Tel&eacute;fono</td>
            <td><? $em->fields['telefono']->showFormField(null) ?></td>
        </tr>
         */ ?>



        <? /*
          <tr>
          <td>Ocupaci&oacute;n</td>
          <td><? $em->fields['ocupacion']->showFormField(null) ?></td>
          </tr>
          <tr>
          <td align="left" colspan="2"><span style="color:#FF0000;">* Campo obligatorio</span></td>
          </tr>
         */ ?>
		 
        <tr>
            <td style="vertical-align:top; padding-top:10px;">Subscribirse a newsletters</td>
            <td style="vertical-align:top; padding-top:10px;">
				<? $em->fields['recibe_newsletter']->showFormField(null) ?>
			</td>
        </tr>
        <? /*
          <tr>
          <td>Hijos menores a 3 a�os</td>
          <td><? $em->fields['hijos_menores_a_3_anios']->showFormField(null) ?></td>
          </tr>
         */ ?>
	</table>
    <? /*
    <table border="0" align="center" width="100%" style="font-size:14px; padding-bottom: 10px; padding-top:5px;">
            <tr><td>¿Cuál es la edad de tu hijo?</td></tr>
            <tr><td><input type="radio" value="0 - 6 meses" name="pregunta1" onchange="cambio_pregunta1()" checked />0 - 6 meses</td></tr>
            <tr><td><input type="radio" value="6 meses - 2 años" name="pregunta1" onchange="cambio_pregunta1()" />6 meses - 2 años</td></tr>
            <tr><td><input type="radio" value="+ 3 años" name="pregunta1" onchange="cambio_pregunta1()" />+ 3 años</td></tr>
    </table>
      
      <table border="0" align="center" width="100%" style="font-size:14px; padding-bottom: 10px;">
            <tr><td>¿Estás embarazada?</td></tr>
            <tr><td><input type="radio" value="Sí" name="pregunta2" onchange="cambio_pregunta2()" checked />Sí</td></tr>
            <tr><td><input type="radio" value="No" name="pregunta2" onchange="cambio_pregunta2()" />No</td></tr>
    </table>
      
      
    <table border="0" align="center" width="100%" style="font-size:14px;padding-bottom: 10px;">
            <tr><td>¿Sos consumidora de la Línea Weleda Bebé?</td></tr>
            <tr><td><input type="radio" value="Sí" name="pregunta3" onchange="cambio_pregunta3()" checked />Sí</td></tr>
            <tr><td><input type="radio" value="No" name="pregunta3" onchange="cambio_pregunta3()" />No</td></tr>
    </table>
      
     <table border="0" align="center" width="100%" style="font-size:14px;padding-bottom: 10px;">
            <tr><td>¿Cuál es tu producto favorito?</td></tr>
            <tr><td><input type="radio" value="Crema Facial de Caléndula" name="pregunta4" onchange="cambio_pregunta4()" checked />Crema Facial de Caléndula</td></tr>
            <tr><td><input type="radio" value="Crema Pañal de Caléndula" name="pregunta4" onchange="cambio_pregunta4()" />Crema Pañal de Caléndula</td></tr>
            <tr><td><input type="radio" value="Aceite de Caléndula" name="pregunta4" onchange="cambio_pregunta4()" />Aceite de Caléndula</td></tr>
            <tr><td><input type="radio" value="Leche Corporal de Caléndula" name="pregunta4" onchange="cambio_pregunta4()" />Leche Corporal de Caléndula</td></tr>
            <tr><td><input type="radio" value="Champú & Gel de Ducha de Caléndula" name="pregunta4" onchange="cambio_pregunta4()" />Champú & Gel de Ducha de Caléndula</td></tr>
            <tr><td><input type="radio" value="Baño de Crema de Caléndula" name="pregunta4" onchange="cambio_pregunta4()" />Baño de Crema de Caléndula</td></tr>
            <tr><td><input type="radio" value="Gel Dentífrico para Niños" name="pregunta4" onchange="cambio_pregunta4()" />Gel Dentífrico para Niños</td></tr>
    </table>
    */ ?>
    
	<h3 style="margin:10px 0 6px 0;">Enviar concurso a una amiga:</h3>
	<table>
		<tr>
			<td>Nombre</td>
			<td><? $em->fields['nombre_amigo_1']->showFormField(null) ?> <span style="color:#FF0000;"></span></td>
		</tr>
		<tr>
			<td>Apellido</td>
			<td><? $em->fields['apellido_amigo_1']->showFormField(null) ?> <span style="color:#FF0000;"></span></td>
		</tr>
		<tr>
			<td>Correo electr&oacute;nico</td>
			<td><? $em->fields['email_amigo_1']->showFormField(null) ?> <span style="color:#FF0000;"></span></td>
		</tr>
	</table>
    <table width="100%">
        <tr>
            <td align="left" colspan="1" style="vertical-align:top; padding-top:10px;">
                <input name="submit" type="submit" value="Enviar" disabled />  El sorteo ha finalizado.
            </td>
            <td align="right" colspan="1">
                <span style="color:#FF0000;">* Campo obligatorio</span>
            </td>
        </tr>
    </table>


    <? /* <input type="hidden" name="respuesta1" id="respuesta1" value="<?=$_GET["rta"]?>" /> */ ?>
    <? /* <input type="hidden" name="respuesta1" id="respuesta1" value="" /> */ ?>
    <input type="hidden" name="identificador_sorteo" id="identificador_sorteo" value="DíaDelNiño2015" />
    <input type="hidden" name="respuesta1" id="respuesta1" value="1" />
    <input type="hidden" name="respuesta2" id="respuesta2" value="1" />
    <input type="hidden" name="respuesta3" id="respuesta3" value="1" />
    <? /* <input type="hidden" name="respuesta4" id="respuesta4" value="-" /> */ ?>
    <? /* <input type="hidden" name="comentarios" id="comentarios" value="-" /> */ ?>
    <input type="hidden" name="comentario2" id="comentario2" value="" />
    <input type="hidden" name="rut" id="rut" value="-" />
    <input type="hidden" name="fecha_nacimiento_amigo_1_d" id="fecha_nacimiento_amigo_1_d" value="" />
    <input type="hidden" name="fecha_nacimiento_amigo_1_m" id="fecha_nacimiento_amigo_1_m" value="" />
    <input type="hidden" name="fecha_nacimiento_amigo_1_y" id="fecha_nacimiento_amigo_1_y" value="" />
    <input type="hidden" name="fecha_nacimiento_amigo_2_d" id="fecha_nacimiento_amigo_2_d" value="" />
    <input type="hidden" name="fecha_nacimiento_amigo_2_m" id="fecha_nacimiento_amigo_2_m" value="" />
    <input type="hidden" name="fecha_nacimiento_amigo_2_y" id="fecha_nacimiento_amigo_2_y" value="" />
    <input type="hidden" name="direccion_amigo_1" id="direccion_amigo_1" value="" />
    <input type="hidden" name="cp_amigo_1" id="cp_amigo_1" value="" />
    <input type="hidden" name="localidad_amigo_1" id="localidad_amigo_1" value="" />
    <input type="hidden" name="provincia_amigo_1" id="provincia_amigo_1" value="" />
    <input type="hidden" name="direccion_amigo_2" id="direccion_amigo_2" value="" />
    <input type="hidden" name="cp_amigo_2" id="cp_amigo_2" value="" />
    <input type="hidden" name="localidad_amigo_2" id="localidad_amigo_2" value="" />
    <input type="hidden" name="provincia_amigo_2" id="provincia_amigo_2" value="" />
    
    <? /* <input type="hidden" name="nombre_amigo_1" id="nombre_amigo_1" value=" " /> */ ?>
    <input type="hidden" name="nombre_amigo_2" id="nombre_amigo_2" value=" " />
    <? /* <input type="hidden" name="email_amigo_1" id="email_amigo_1" value=" " /> */ ?>
    <input type="hidden" name="email_amigo_2" id="email_amigo_2" value=" " />
    <? /* <input type="hidden" name="apellido_amigo_1" id="apellido_amigo_1" value="" />  */ ?>
    <input type="hidden" name="apellido_amigo_2" id="apellido_amigo_2" value="" />
    <input type="hidden" name="nombre_amigo_3" id="nombre_amigo_3" value="" />
    <input type="hidden" name="apellido_amigo_3" id="apellido_amigo_3" value="" />
    <input type="hidden" name="email_amigo_3" id="apellido_amigo_3" value="" />
       
    <!--
    Estas tres l&iacute;neas se deben poner cuando oculto el campo fecha_nacimiento,
    ya que como es un campo obligatorio, da error.
    <input type="hidden" name="fecha_nacimiento_d" id="fecha_nacimiento_d" value="" />
    <input type="hidden" name="fecha_nacimiento_m" id="fecha_nacimiento_m" value="" />
    <input type="hidden" name="fecha_nacimiento_y" id="fecha_nacimiento_y" value="" />
    -->
    <input type="hidden" name="ocupacion" id="ocupacion" value="1" />
    <input type="hidden" name="telefono" id="telefono" value="" />
    <input type="hidden" name="password" id="password" value="" />
    <input type="hidden" name="fp_validation_password" id="fp_validation_password" value="" />
    <? /* <input type="hidden" name="direccion" id="direccion" value="" /> */ ?>
    <? /* <input type="hidden" name="rut" id="rut" value="" /> */ ?>
    <input type="hidden" name="cp" id="cp" value="" /> 
    
    <input type="hidden" name="dni" id="dni" value="-" />
</form>
<p>
    * Las direcciones de correo electr&oacute;nico deben ser v&aacute;lidas para poder participar en el sorteo.
</p>
<p>
    Weleda Argentina garantiza la protecci&oacute;n y confidencialidad de los datos personales, domiciliarios y de cualquier otro tipo que nos proporcionen nuestros clientes.
</p>
<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>