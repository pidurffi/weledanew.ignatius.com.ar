<?
/*
 * Página para sorteo sin estar logueado.
 * Debe usarse tpl.front_sorteo_clientes_AM para que el usuario deba loguearse para participar.
 */
$seccion = "clientes";
$actual = "sorteo2";
$title = "Concurso";
include_once(GALIX_FOLDER . "class.MenuSimpleLevel.php");
$leftMenu = new MenuSimpleLevel(array());
include(TPL_FOLDER . "tpl.front_template_arriba.php");
?>
<script type="text/javascript">
    function cambio_pregunta1()
    {
        var t = ""
        for (i = 0; i < document.myform.pregunta1.length; i++)
        {
            if (document.myform.pregunta1[i].checked == true)
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
            if (validate_required(nombre, "Por favor complete su nombre.") == false)
            {
                nombre.focus();
                return false;
            }
            if (validate_required(apellido, "Por favor complete su apellido.") == false)
            {
                apellido.focus();
                return false;
            }
            if (validate_required(email, "Por favor escriba su correo electrónico.") == false)
            {
                email.focus();
                return false;
            }
			if (validate_email(email, "La dirección de correo electrónico no es válida.") == false)
            {
                email.focus();
                return false;
            }
            /*
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
            if (validate_required(dni, "Por favor complete su DNI.") == false)
            {
                dni.focus();
                return false;
            }
            if (validate_required(telefono, "Por favor complete su teléfono.") == false)
            {
                telefono.focus();
                return false;
            }
			
            if (validate_required(direccion, "Por favor complete su dirección.") == false)
            {
                direccion.focus();
                return false;
            }
            /*
            if (validate_required(cp, "Por favor complete su código postal.") == false)
            {
                cp.focus();
                return false;
            }
			
            if (validate_required(localidad, "Por favor complete su localidad.") == false)
            {
                localidad.focus();
                return false;
            }
			/*
            if (validate_required(provincia, "Por favor complete su provincia.") == false)
            {
                provincia.focus();
                return false;
            }
            */
           
            if (validate_required(comentarios, "Por favor responda la pregunta.") == false)
            {
                comentarios.focus();
                return false;
            }
           
/*
            /* Validación Amigo 1 */
            /*
             if (validate_required(nombre_amigo_1, "Por favor complete el nombre del primer amigo.") == false)
             {
             nombre_amigo_1.focus();
             return false;
             }
             if (validate_required(apellido_amigo_1, "Por favor complete el apellido del primer amigo.") == false)
             {
             apellido_amigo_1.focus();
             return false;
             }
             if (validate_required(email_amigo_1, "Por favor escriba el correo electrónico del primer amigo.") == false)
             {
             email_amigo_1.focus();
             return false;
             }
			 
             if (validate_required(fecha_nacimiento_amigo_1_d, "Por favor complete la fecha de nacimiento de su bebé.") == false)
             {
				 fecha_nacimiento_amigo_1_d.focus();
				 return false;
             }
             if (validate_required(fecha_nacimiento_amigo_1_m, "Por favor complete la fecha de nacimiento de su bebé.") == false)
             {
				 fecha_nacimiento_amigo_1_m.focus();
				 return false;
             }
             if (validate_required(fecha_nacimiento_amigo_1_y, "Por favor complete la fecha de nacimiento de su bebé.") == false)
             {
				 fecha_nacimiento_amigo_1_y.focus();
				 return false;
             }
			 
             if (validate_email(email_amigo_1, "La dirección de correo electrónico del primer amigo no es válida.") == false)
             {
             email_amigo_1.focus();
             return false;
             }
             if (validate_required(direccion_amigo_1, "Por favor complete la dirección del primer amigo.") == false)
             {
             direccion_amigo_1.focus();
             return false;
             }
             if (validate_required(cp_amigo_1, "Por favor complete el código postal del primer amigo.") == false)
             {
             cp_amigo_1.focus();
             return false;
             }
             if (validate_required(localidad_amigo_1, "Por favor complete la localidad del primer amigo.") == false)
             {
             localidad_amigo_1.focus();
             return false;
             }
             if (validate_required(provincia_amigo_1, "Por favor complete la provincia del primer amigo.") == false)
             {
             provincia_amigo_1.focus();
             return false;
             }
             */

            /* Validación Amigo 2*/
            /*
             if (validate_required(nombre_amigo_2, "Por favor complete el nombre del segundo amigo.") == false)
             {
             nombre_amigo_2.focus();
             return false;
             }
             if (validate_required(apellido_amigo_2, "Por favor complete el apellido del segundo amigo.") == false)
             {
             apellido_amigo_2.focus();
             return false;
             }
             if (validate_required(email_amigo_2, "Por favor escriba el correo electrónico del segundo amigo.") == false)
             {
             email_amigo_2.focus();
             return false;
             }
             if (validate_required(fecha_nacimiento_amigo_2_d, "Por complete la fecha de nacimiento del segundo amigo.") == false)
             {
             fecha_nacimiento_amigo_2.focus();
             return false;
             }
             if (validate_required(fecha_nacimiento_amigo_2_m, "Por complete la fecha de nacimiento del segundo amigo.") == false)
             {
             fecha_nacimiento_amigo_2.focus();
             return false;
             }
             if (validate_required(fecha_nacimiento_amigo_2_y, "Por complete la fecha de nacimiento del segundo amigo.") == false)
             {
             fecha_nacimiento_amigo_2.focus();
             return false;
             }
             if (validate_email(email_amigo_2, "La dirección de correo electrónico del segundo amigo no es válida.") == false)
             {
             email_amigo_2.focus();
             return false;
             }
             if (validate_required(direccion_amigo_2, "Por favor complete la dirección del segundo amigo.") == false)
             {
             direccion_amigo_2.focus();
             return false;
             }
             if (validate_required(cp_amigo_2, "Por favor complete el código postal del segundo amigo.") == false)
             {
             cp_amigo_2.focus();
             return false;
             }
             if (validate_required(localidad_amigo_2, "Por favor complete la localidad del segundo amigo.") == false)
             {
             localidad_amigo_2.focus();
             return false;
             }
             if (validate_required(provincia_amigo_2, "Por favor complete la provincia del segundo amigo.") == false)
             {
             provincia_amigo_2.focus();
             return false;
             }
             */
        }
        document.thisForm.grabar.value = 1;
        document.thisForm.submit();
    }
    function grabar_form()
    {
        document.myForm.grabar.value = 1;
        document.myForm.submit();
    }
    function validate_email(field, alerttxt)
    {
        with (field)
        {
            apos = value.indexOf("@");
            dotpos = value.lastIndexOf(".");
            if (value != null && value != "")
            {
                if (apos < 1 || dotpos - apos < 2)
                {
                    alert(alerttxt);
                    return false;
                }
                else {
                    return true;
                }
            }
            else {
                return true;
            }
        }
    }
    function validate_required(field, alerttxt)
    {
        with (field)
        {
            if (value == null || value == "")
            {
                alert(alerttxt);
                return false;
            }
            else
            {
                return true;
            }
        }
    }
</script>
<? /* para mostrar el video de la rosa mosqueta
  include_once("./video.html"); ?>
  <? /* formulario para el sorteo */ ?>
<form name="myform" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data" action="index.php?module=fr_sorteo_web&id=<?= (isset($_GET['id'])) ? $_GET['id'] : ''; ?>" >
    <input type="hidden" name="grabar" value="0" />
    <h3 style='font-size: 22px; font-family: "Neo Sans", Arial, Helvetica, sans-serif; color:#f08624; font-weight: bold; padding:0px; margin:0px; padding-bottom:5px;'>
        Concurso Maminia
    </h3>
		<? /*
      <h3 style='font-size: 18px; font-family: "Neo Sans", Arial, Helvetica, sans-serif; color:#990099; font-weight: bold; padding:0px; margin:0px;'>
      ¡Sorteamos una entrada!
      </h3>
	  */ ?>
	  <div style="width:100%; background-repeat:no-repeat; background-position:right; font-size:14px;">
		<div style="">
			El contacto piel con piel así como tu calor y lenguaje corporal refuerzan el vínculo íntimo entre vos y tu bebé, haciendo que se sienta seguro en un mundo todavía nuevo. Al ser tocados por otra piel, la de la mamá, que les sirve de límite y de marco de contención, los bebés se desarrollan en forma sana y feliz.
        	</div>
	  </div>
	  <? /*
	  <table>
		<td>
			<img src="/imagenes/estructura/packgranada.jpg" />
		</td>
		<td style="font-size:14px; padding-left:5px;" valign="top">
			<p>Tenemos 3 Pack Faciales de Granada para regalar y uno puede ser tuyo. Respondé la pregunta y dejanos tus datos:</p>
    		</td>
		</tr>
	  </table>
	  */ ?>


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
    <? /*
      <p style="font-size:12px;">Para participar debés ser fan de <a href="http://facebook.com/WeledaArgentina" target="_BLANK">Weleda Argentina</a>.</p>
     */ ?>
    <h3 style="margin:10px 0 6px 0;">Datos personales:</h3>
    <table>
        <tr>
            <td>Nombre</td>
            <td><? $em->fields['nombre']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
        </tr>
        <tr>
            <td>Apellido</td>
            <td><? $em->fields['apellido']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
        </tr>
        <tr>
            <td>Correo electr&oacute;nico</td>
            <td><? $em->fields['email']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
        </tr>
        <?php /*
        <tr>
            <td>Fecha de nacimiento</td>
            <td><? $em->fields['fecha_nacimiento']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
        </tr>
        
        <tr>
            <td>
                <?
                if (CONSTANTE_PAIS == "Argentina")
                    print('DNI');
                elseif (CONSTANTE_PAIS == "Chile")
                    print('RUT');
                ?>
            </td>
            <td><? $em->fields['dni']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
        </tr>
        <tr>
            <td>Direcci&oacute;n</td>
            <td><? $em->fields['direccion']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
        </tr>
	
        <tr>
            <td>CP</td>
            <td><? $em->fields['cp']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
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
            <td>
                <?
                if (CONSTANTE_PAIS == "Argentina")
                    print('Provincia');
                elseif (CONSTANTE_PAIS == "Chile")
                    print('Regi&oacute;n');
                ?>
            </td>
            <td><? $em->fields['provincia']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
        </tr>
		
          <tr>
          <td>Tel&eacute;fono</td>
          <td><? $em->fields['telefono']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
          </tr>
		 
		<tr>
      <td>Fecha de nacimiento de tu bebé</td>
      <td><? $em->fields['fecha_nacimiento_amigo_1']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
      </tr>
      */ ?>
    </table>
        
        <h3 style="font-weight:normal; font-size:14px;">
      ¿Cuál es el mimo preferido de tu bebé?</h3>
      <textarea id="comentarios" name="comentarios" maxlength="1000" rows="2" cols="42"></textarea> <span style="color:#FF0000;">*</span>
        
    <table border="0" align="center" width="100%" style="font-size:14px; padding-bottom: 10px; padding-top:5px;">
            <tr><td>¿Cuál es la edad de tu bebé?</td></tr>
            <tr><td><input type="radio" value="1" name="pregunta1" onchange="cambio_pregunta1()" checked />0 - 6 meses</td></tr>
            <tr><td><input type="radio" value="2" name="pregunta1" onchange="cambio_pregunta1()" />6 meses - 1 año</td></tr>
            <tr><td><input type="radio" value="3" name="pregunta1" onchange="cambio_pregunta1()" />1 año - 2 años</td></tr>
            <tr><td><input type="radio" value="4" name="pregunta1" onchange="cambio_pregunta1()" />2 años - 3 años</td></tr>
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
        

        <tr>
            <td>Subscribirse a newsletters</td>
            <td><? $em->fields['recibe_newsletter']->showFormField(null) ?></td>
        </tr>
    </table>

    <? /*
      <table border="0" align="center" width="100%">
      <tr>
      <td colspan="2" style="font-weight:bold; font-size:12px; line-height: 18px;">
      <p>¿Cuál de las nuevas Leches Corporales de Weleda te gustaría que te regalen en este Día de los Enamorados?</p>
      </td>
      </tr>
      <tr>
      <td colspan="2" style="font-size:12px; line-height: 18px;">
      <input type="radio" value="1" name="pregunta1" onchange="cambio_pregunta1()" checked />
      Leche Corporal Regeneradora de Granada<br />
      <input type="radio" value="2" name="pregunta1" onchange="cambio_pregunta1()" />
      Leche Corporal Suavizante de Rosa Mosqueta<br />
      <input type="radio" value="3" name="pregunta1" onchange="cambio_pregunta1()" />
      Leche Corporal Nutritiva de Espino Amarillo<br />
      <input type="radio" value="4" name="pregunta1" onchange="cambio_pregunta1()" />
      Leche Corporal Hidratante de Citrus<br />
      </td>
      </tr>
      </table>
     */ ?>

    <? /*
      <table>
      <tr>
      <td style="padding-top:00px;" valign="top" colspan="2">
      <?
      if (CONSTANTE_PAIS == "Argentina") {
      print('<p style="font-size:11px; font-weight:bold;">¿Cuál es tu must Weleda para primavera-verano, el infaltable en tu bolso?</p>');
      } elseif (CONSTANTE_PAIS == "Chile") {
      print('<p style="font-size:11px; font-weight:bold;"></p>');
      }
      ?>
      </td>
      </tr>
      <tr>
      <td style="padding-top:5px;" >
      <textarea rows="3"  name="comentarios" style="width:95%;"></textarea>
      </td>
      <td style="vertical-align: top; padding-top:10px;">
      <span style="color:#FF0000;">*</span>
      </td>
      </tr>
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
	  <? /*
      <tr>
      <td>Fecha de nacimiento</td>
      <td><? $em->fields['fecha_nacimiento_amigo_1']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
      </tr>
      <tr>
      <td>Direcci&oacute;n</td>
      <td><? $em->fields['direccion_amigo_1']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
      </tr>
      <tr>
      <td>CP</td>
      <td><? $em->fields['cp_amigo_1']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
      </tr>
      <tr>
      <td>Localidad</td>
      <td><? $em->fields['localidad_amigo_1']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
      </tr>
      <tr>
      <td>Provincia</td>
      <td><? $em->fields['provincia_amigo_1']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
      </tr>
	  */ ?>
      </table>
		<? /*
      <h3 style="margin:10px 0 6px 0;">Amiga 2</h3>
      <table>
      <tr>
      <td>Nombre</td>
      <td><? $em->fields['nombre_amigo_2']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
      </tr>
      <tr>
      <td>Apellido</td>
      <td><? $em->fields['apellido_amigo_2']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
      </tr>
      <tr>
      <td>Correo electr&oacute;nico</td>
      <td><? $em->fields['email_amigo_2']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
      </tr>
      <tr>
      <td>Fecha de nacimiento</td>
      <td><? $em->fields['fecha_nacimiento_amigo_2']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
      </tr>
      <tr>
      <td>Direcci&oacute;n</td>
      <td><? $em->fields['direccion_amigo_2']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
      </tr>
      <tr>
      <td>CP</td>
      <td><? $em->fields['cp_amigo_2']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
      </tr>
      <tr>
      <td>Localidad</td>
      <td><? $em->fields['localidad_amigo_2']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
      </tr>
      <tr>
      <td>Provincia</td>
      <td><? $em->fields['provincia_amigo_2']->showFormField(null) ?>  <span style="color:#FF0000;">*</span></td>
      </tr>
      </table>
     */ ?>


    <table width="100%">
        <tr>
            <td align="left" colspan="1">
                <input name="submit" type="submit" value="Enviar" /> <? /* disabled El sorteo ha finalizado */ ?>
            </td>
            <td align="right" colspan="1">
                <span style="color:#FF0000;">* Campo obligatorio</span>
            </td>
        </tr>
    </table>
    <? /* <input type="hidden" name="respuesta1" id="respuesta1" value="<?= $_GET["rta"] ?>" /> */ ?>
    <input type="hidden" name="respuesta1" id="respuesta1" value="1" />
    <input type="hidden" name="respuesta2" id="respuesta2" value="-" />
    <input type="hidden" name="respuesta3" id="respuesta3" value="-" />
    <input type="hidden" name="respuesta4" id="respuesta4" value="-" />
    <? /*
      Estas tres líneas se deben poner cuando oculto el campo fecha_nacimiento,
      ya que como es un campo obligatorio, da error. 
      */ ?>
     
    <input type="hidden" name="fecha_nacimiento_d" id="fecha_nacimiento_d" value="" />
    <input type="hidden" name="fecha_nacimiento_m" id="fecha_nacimiento_m" value="" />
    <input type="hidden" name="fecha_nacimiento_y" id="fecha_nacimiento_y" value="" />
    
    <input type="hidden" name="identificador_sorteo" id="identificador_sorteo" value="Maminia" />
    <input type="hidden" name="ocupacion" id="ocupacion" value="" />
    <? /* <input type="hidden" name="telefono" id="ocupacion" value="" /> 
    <input type="hidden" name="comentarios" id="comentarios" value="" /> */ ?>
    <input type="hidden" name="comentario2" id="comentario2" value="" />
    
    <input type="hidden" name="rut" id="rut" value="" />
    
    <input type="hidden" name="dni" id="dni" value="-" />
     
	 <? /* <input type="hidden" name="direccion" id="direccion" value="" /> */ ?>
	 <input type="hidden" name="cp" id="cp" value="" />
	 <input type="hidden" name="provincia" id="provincia" value="" />

    <? /* <input type="hidden" name="nombre_amigo_1" id="nombre_amigo_1" value=" " /> */ ?>
    <input type="hidden" name="nombre_amigo_2" id="nombre_amigo_2" value=" " />
    <? /* <input type="hidden" name="email_amigo_1" id="email_amigo_1" value=" " /> */ ?>
    <input type="hidden" name="email_amigo_2" id="email_amigo_2" value=" " />
    <? /* <input type="hidden" name="apellido_amigo_1" id="apellido_amigo_1" value="" />  */ ?>
    <input type="hidden" name="apellido_amigo_2" id="apellido_amigo_2" value="" />

    <input type="hidden" name="nombre_amigo_3" id="nombre_amigo_3" value="" />
    <input type="hidden" name="apellido_amigo_3" id="apellido_amigo_3" value="" />
    <input type="hidden" name="email_amigo_3" id="apellido_amigo_3" value="" />

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

</form>
<? /*
  <p>
  Weleda se encarga del envío del premio al domicilio ingresado, no al transporte hacia el lugar.</p>
 */ ?>

<p>
    Las direcciones de correo electr&oacute;nico deben ser v&aacute;lidas para poder participar en el sorteo.
</p>
<p>
    Weleda garantiza la protecci&oacute;n y confidencialidad de los datos personales, domiciliarios y de cualquier otro tipo que nos proporcionen nuestros clientes.
    <br />
    Es un concurso de Weleda S.A. dejando sin responsabilidad a Facebook.
</p>
<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>