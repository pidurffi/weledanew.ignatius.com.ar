<?
$seccion = "clientes";
$actual = "grupoweledaimagenes";
$title = "Skin Food y vos";
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

    function validate_form(thisform)
    {
        with (thisform)
        {
            if (validate_required(nombre,"Por favor complete su nombre.")==false)
            {nombre.focus();return false;}

            if (validate_required(apellido,"Por favor complete su apellido.")==false)
            {apellido.focus();return false;}
			
			if (validate_required(dni,"Por favor complete su DNI.")==false)
            {dni.focus();return false;}
			
			if (validate_required(email,"Por favor complete su correo electrónico.")==false)
            {email.focus();return false;}
			
			if (validate_email(email,"La dirección de correo electrónico no es válida.")==false)
            {email.focus();return false;}
			
			if (validate_required(fecha_nacimiento_d,"Por favor complete su fecha de nacimiento.")==false)
            {fecha_nacimiento_d.focus();return false;}
			if (validate_required(fecha_nacimiento_m,"Por favor complete su fecha de nacimiento.")==false)
            {fecha_nacimiento_m.focus();return false;}
			if (validate_required(fecha_nacimiento_y,"Por favor complete su fecha de nacimiento.")==false)
            {fecha_nacimiento_y.focus();return false;}

            if (validate_required(direccion,"Por favor complete su dirección.")==false)
            {direccion.focus();return false;}

            if (validate_required(ciudad,"Por favor complete su ciudad.")==false)
            {ciudad.focus();return false;}

            if (validate_required(provincia,"Por favor complete su provincia.")==false)
            {provincia.focus();return false;}

            if (validate_required(codigo_postal,"Por favor complete su código postal.")==false)
            {codigo_postal.focus();return false;}
			
			if (validate_required_checkbox(terminosycondiciones,"Por favor acepte los términos y condiciones.")==false)
            {terminosycondiciones.focus();return false;}

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
	
	function validate_required_checkbox(field,alerttxt)
    {
        with (field)
        {
            if (!checked)
            {
                alert(alerttxt);return false;
            }
            else
            {
                return true;
            }
        }
    }
	
	function abrirTyC() {
		ventana = window.open("TyC_skinfood.php","TyC","width=800,height=500,resizable=yes,scrollbars=yes");
		ventana.focus();
	}
    -->

</script>


<form name="myform" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data" action="index.php?module=skinfoodyvos&id=<?= (isset($_GET['id'])) ? $_GET['id'] : ''; ?>" >
    <input type="hidden" name="grabar" value="0" />
	
	<p style='font-size: 22px; font-family: "Neo Sans", Arial, Helvetica, sans-serif; color: #812A93; font-weight: bold; padding-bottom:0px; margin:0px;'>Skin Food y vos</p>

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

        <table>
		
		<tr>
            <td colspan="2" style="font-weight:bold; font-size:12px; line-height: 18px;">
                <p>Algunos de los ingredientes que componen el nuevo Skin Food son:</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                <input type="radio" value="1" name="pregunta1" onchange="cambio_pregunta1()" checked />
                a) Aceite de maní, aceite de rosa mosqueta y extracto de girasol<br />
                <input type="radio" value="2" name="pregunta1" onchange="cambio_pregunta1()" />
                b) Aceite de semillas de granada, almendra dulce y aceite de jojoba<br />
                <input type="radio" value="3" name="pregunta1" onchange="cambio_pregunta1()" />
                c) Extracto de Pensamiento silvestre, manzanilla y caléndula<br />
            </td>
        </tr>
		<tr><td colspan="2">&nbsp;</td></tr>

            <tr>
                <td>Nombre</td>
                <td><? $em->fields['nombre']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
            </tr>

            <tr>
                <td>Apellido</td>
                <td><? $em->fields['apellido']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
            </tr>

            <tr>
                <td>DNI</td>
                <td><? $em->fields['dni']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
            </tr>
			<tr>
                <td>Correo electr&oacute;nico</td>
                <td><? $em->fields['email']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
            </tr>
			<tr>
                <td>Fecha de nacimiento</td>
                <td><? $em->fields['fecha_nacimiento']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
            </tr>
			<tr>
                <td>Dirección</td>
                <td><? $em->fields['direccion']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
            </tr>
            <tr>
                <td>Ciudad/Localidad</td>
                <td><? $em->fields['ciudad']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
            </tr>
            <tr>
                <td>Provincia</td>
                <td><? $em->fields['provincia']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
            </tr>
            <tr>
                <td>Código postal</td>
                <td><? $em->fields['codigo_postal']->showFormField(null) ?> <span style="color:#FF0000;">*</span></td>
            </tr>
   
            <tr>
                <td>Subscribirse a newsletters</td>
                <td><? $em->fields['recibe_newsletter']->showFormField(null) ?></td>
            </tr>
			
			
		
		<tr>
            <td style="height:40px;">Acepto los <a href="javascript:abrirTyC()" title="Ver términos y condiciones">términos y condiciones</a></td>
            <td><? $em->fields['terminosycondiciones']->showFormField(null) ?></td>
        </tr>
            

            <tr>
                <td></td>
                <td>
                    <input name="submit" type="submit" value="Enviar" />
                </td>

            </tr>

        </table>

    <? /* <input type="hidden" name="respuesta1" id="respuesta1" value="<?=$_GET["rta"]?>" /> */ ?>
    <? /* <input type="hidden" name="respuesta1" id="respuesta1" value="" /> */ ?>
                    <input type="hidden" name="respuesta1" id="respuesta1" value="1" />
					<input type="hidden" name="identificacion" id="identificacion" value="SKIN FOOD Y VOS" />


                </form>



                <p>



                </p>

                <p>

                    Weleda Argentina garantiza la protección y confidencialidad de los datos personales, domiciliarios y de cualquier otro tipo que nos proporcionen nuestros clientes.

                </p>



<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>