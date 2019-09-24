<?
$seccion = "clientes";
$actual = "grupoweledaimagenes";
$title = "Encuesta Newsletter";
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
        document.getElementById("p1").value = t
    }


    function cambio_pregunta2()
    {
        var t = ""
        for (i=0; i<document.myform.pregunta2.length; i++)
        {
            if (document.myform.pregunta2[i].checked==true)
            {
                t = t + document.myform.pregunta2[i].value
            }
        }
        document.getElementById("p2").value = t
    }

    function cambio_pregunta3()
    {
        var t = ""
        for (i=0; i<document.myform.pregunta3.length; i++)
        {
            if (document.myform.pregunta3[i].checked==true)
            {
                t = t + document.myform.pregunta3[i].value
            }
        }
        document.getElementById("p3").value = t
    }

    function cambio_pregunta4()
    {
        var t = ""
        for (i=0; i<document.myform.pregunta4.length; i++)
        {
            if (document.myform.pregunta4[i].checked==true)
            {
                t = t + document.myform.pregunta4[i].value
            }
        }
        document.getElementById("p4").value = t
    }


    function validate_form(thisform)
    {
        with (thisform)
        {
            if (validate_required(nombre,"Por favor complete su nombre.")==false)
            {nombre.focus();return false;}
            if (validate_required(apellido,"Por favor complete su apellido.")==false)
            {apellido.focus();return false;}
            if (validate_required(email,"Por favor escriba su correo electrónico.")==false)
            {email.focus();return false;}
            if (validate_email(email,"La dirección de correo electrónico no es válida.")==false)
            {email.focus();return false;}
			if (validate_required(ocupacion,"Por favor complete su empresa.")==false)
            {ocupacion.focus();return false;}
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

<form name="myform" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data" action="index.php?module=fr_encuesta1_alta&id=<?= (isset($_GET['id'])) ? $_GET['id'] : ''; ?>" >
    <input type="hidden" name="grabar" value="0" />

    <h3 style='font-size: 22px; font-family: "Neo Sans", Arial, Helvetica, sans-serif; color: sandybrown; font-weight: bold;'>
        Encuesta de opini&oacute;n
    </h3>
	
    <table border="0" align="center" width="100%">
        <tr>
            <td colspan="2" style="padding-bottom:5px;">
                <?
                foreach ($errores as $error) {
                    // Si respuesta1 es menos a 1, es porque no se eligió un radio button.
                    $error = str_replace("El campo respuesta1 debe ser mayor a 1", "Por favor elija una respuesta", $error);
                ?>
                    <span style="color:#FF0000"><?= $error ?></span><br/>
                <? } ?>
            </td>
        </tr>
    </table>

    <table border="0" align="center" width="100%">

        <tr>
            <td colspan="2" style="font-weight:bold; font-size:12px; line-height: 18px;">
                <p style="text-align: justify;">
                    Para nosotros es sumamente importante su opinión para poder crecer día a día. Hace un par de semanas ha recibido un mail donde le informamos nuestra nueva herramienta para poder hacer pedidos de productos online, agilizando el proceso y sin tener que comunicarse telefónicamente. Por tal motivo, necesitaríamos de su ayuda contestando las siguientes 5 preguntas, haya utilizado la herramienta o no.
                </p>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                <br />
                1 - ¿Le resultó útil la nueva herramienta para hacer pedidos online? <br />
                <input type="radio" value="1" name="pregunta1" onchange="cambio_pregunta1()" checked /> Mucho <br />
                <input type="radio" value="2" name="pregunta1" onchange="cambio_pregunta1()" /> Poco  <br />
                <input type="radio" value="3" name="pregunta1" onchange="cambio_pregunta1()" /> Nada <br />
                <input type="radio" value="4" name="pregunta1" onchange="cambio_pregunta1()" /> Aún no la utilicé
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                <br />
                2 - ¿Cómo le pareció la usabilidad de la misma?<br />
                <input type="radio" value="1" name="pregunta2" onchange="cambio_pregunta2()" checked /> Muy buena <br />
                <input type="radio" value="2" name="pregunta2" onchange="cambio_pregunta2()" /> Buena <br />
				<input type="radio" value="3" name="pregunta2" onchange="cambio_pregunta2()" /> Mala <br />
				<input type="radio" value="4" name="pregunta2" onchange="cambio_pregunta2()" /> No logré comprender cómo utilizarlo
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                <br />
                3 - ¿Pudo encontrar todos los productos con facilidad?<br />
                <input type="radio" value="1" name="pregunta3" onchange="cambio_pregunta3()" checked /> Sí <br />
                <input type="radio" value="2" name="pregunta3" onchange="cambio_pregunta3()" /> No <br />
				Comentario <? $em->fields['p3t1']->showFormField(null,40) ?>
                
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                <br />
                4 - ¿La utilizaría en lugar del llamado teléfonico?<br />
                <input type="radio" value="1" name="pregunta4" onchange="cambio_pregunta4()" checked /> Sí <br />
                <input type="radio" value="2" name="pregunta4" onchange="cambio_pregunta4()" /> No <br />
                ¿Por qué? <? $em->fields['p4t1']->showFormField(null,40) ?>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                <br />
                5 - ¿Alguna recomendación que le gustaría que tengamos en cuenta?<br />
                <? $em->fields['p5t1']->showFormField(null,40) ?>
            </td>
        </tr>
        
    </table >

    <br />
    <h3 style='font-size: 14px; font-family: "Neo Sans", Arial, Helvetica, sans-serif; color: sandybrown; font-weight: bold;'>
        Datos personales
    </h3>

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
		<tr>
            <td>Empresa</td>
            <td><? $em->fields['ocupacion']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
        </tr>
        <tr>
            <td style="padding-top:20px;" valign="top">Comentarios</td>
            <td style="padding-top:5px;">
                <textarea rows="3" cols="20" name="comentarios"></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input name="submit" type="submit" value="Enviar" />
            </td>

        </tr>

    </table>



    <input type="hidden" name="p1" id="p1" value="1" />
	<input type="hidden" name="p2" id="p2" value="1" />
    <input type="hidden" name="p3" id="p3" value="1" />
    <input type="hidden" name="p4" id="p4" value="1" />
    <!--
    Estas tres líneas se deben poner cuando oculto el campo fecha_nacimiento,
    ya que como es un campo obligatorio, da error.
    <input type="hidden" name="fecha_nacimiento_d" id="fecha_nacimiento_d" value="" />
    <input type="hidden" name="fecha_nacimiento_m" id="fecha_nacimiento_m" value="" />
    <input type="hidden" name="fecha_nacimiento_y" id="fecha_nacimiento_y" value="" />
    -->
    <!-- <input type="hidden" name="ocupacion" id="ocupacion" value="1" /> -->
    <input type="hidden" name="telefono" id="telefono" value="" />

</form>


<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>