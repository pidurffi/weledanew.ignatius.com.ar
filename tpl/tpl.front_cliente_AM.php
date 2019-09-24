<?
$seccion = "clientes";
$actual = "clientes";
include_once(GALIX_FOLDER . "class.MenuSimpleLevel.php");
$leftMenu = new MenuSimpleLevel(array());
include(TPL_FOLDER . "tpl.front_template_arriba.php");
?>

<script type="text/javascript">
    function abrirTyC() {
        ventana = window.open("TyC.php","TyC","width=800,height=500,resizable=yes,scrollbars=yes");
        ventana.focus();
    }
    
    function validate_form(thisform)
    {
        with (thisform)
        {
            
            var fecha_de_nacimiento = new Date();
            fecha_de_nacimiento.setFullYear(fecha_nacimiento_y.value);
            fecha_de_nacimiento.setMonth(fecha_nacimiento_m.value - 1); // El primer mes es 0.
            fecha_de_nacimiento.setDate(fecha_nacimiento_d.value);
            //alert(fecha_de_nacimiento);
            //alert(fecha_nacimiento_y.value);
            //alert(fecha_nacimiento_m.value);
            //alert(fecha_nacimiento_d.value);
            //return false;
            
            if (validate_required(nombre,"Por favor complete su nombre.")==false)
            {nombre.focus();return false;}
            if (validate_required(apellido,"Por favor complete su apellido.")==false)
            {apellido.focus();return false;}
            if (validate_required(dni,"Por favor complete su DNI.")==false)
            {dni.focus();return false;}
            if (validate_required(email,"Por favor escriba su correo electrónico.")==false)
            {email.focus();return false;}
            if (validate_email(email,"La direcci&oacute;n de correo electrónico no es v&aacute;lida.")==false)
            {email.focus();return false;}

            if (validate_required(provincia, "Por favor complete su provincia.") == false)
            {
                provincia.focus();
                return false;
            }
            
            if (validate_birth_date(fecha_de_nacimiento, "Por favor ingrese su fecha de nacimiento.")==false)
            {return false;}
           
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
    
    /* La fecha de nacimiento no puede ser posterior al día de hoy. */
    function validate_birth_date(date,alerttxt)
    {
        var todaysDate = new Date();
        if (date.setHours(0,0,0,0) > todaysDate.setHours(0,0,0,0))
        {
            alert(alerttxt);
            return false;
        }
        else
        {
            return true;
        }
    }
   
    
</script>


<p>Ingrese sus datos para recibir nuestro newsletter o adquirir nuestros productos.</p>
<br/>
<? foreach ($errores as $error) {
    ?>
    <p style="color:#FF0000; text-align:left; font-weight:bold; font-size:12px;"><?= $error ?></p>
<? } ?>

<?
// Me fijo si es una modificación o un alta, viendo si el campo NOMBRE tiene valor o si existe el campo oculto "modificacion".
if (isset($em->entityObject->values['nombre']) OR isset($_POST["modificacion"]))
    $modificacion = TRUE;
else
    $modificacion = FALSE;
?>

<?
if ($modificacion) {
    $action = "index.php?module=fr_clientes_modificacion";
} else {
    $action = "index.php?module=fr_clientes_alta" . (isset($_GET['id']) ? "&id=" . $_GET['id'] : '');
}
?>

<form method="post" enctype="multipart/form-data" action="<?= $action ?>" onsubmit="return validate_form(this)">
    <input type="hidden" name="grabar" value="0" />
    
    <table border="0" align="center" width="100%">
        <tr>
            <td>Nombre</td>
            <td><? $em->fields['nombre']->showFormField(null) ?>&nbsp;<span style="color:#FF0000;">*</span></td>
        </tr>
        <tr>
            <td>Apellido</td>
            <td><? $em->fields['apellido']->showFormField(null) ?>&nbsp;<span style="color:#FF0000;">*</span></td>
        </tr>
        <tr>
            <td>Correo electr&oacute;nico</td>
            <td><? $em->fields['email']->showFormField(null) ?>&nbsp;<span style="color:#FF0000;">*</span></td>
        </tr>

        <tr>
            <td>Correo electr&oacute;nico nuevamente</td>
            <td><? $em->fields['email']->showFormFieldValidation(null) ?></td>
        </tr>



        <tr>
            <td>Fecha de nacimiento</td>
            <td><? $em->fields['fecha_nacimiento']->showFormField(null) ?></td>
        </tr>
        <tr>
            <td>Contrase&ntilde;a</td>
            <td><? $em->fields['password']->showFormField(null) ?>&nbsp;<span style="color:#FF0000;">*</span></td>
        </tr>
        <tr>
            <td>Contrase&ntilde;a nuevamente</td>
            <td><? $em->fields['password']->showFormFieldValidation(null) ?></td>
        </tr>
        <tr>
            <td>Subscribirse a newsletters</td>
            <td><? $em->fields['recibe_newsletter']->showFormField(null) ?></td>
        </tr>
        <? if (CONSTANTE_PAIS == "Chile") {
            ?>
            <tr>
                <td>RUT</td>
                <td><? $em->fields['rut']->showFormField(null) ?></td>
            </tr>
        <? } ?>
        <? if (CONSTANTE_PAIS == "Argentina") {
            ?>
            <tr>
                <td>DNI</td>
                <td><? $em->fields['dni']->showFormField(null) ?>&nbsp;<span style="color:#FF0000;">*</span></td>
            </tr>
        <? } ?>
		<?php /*
        <tr>
            <td>Dirección</td>
            <td><? $em->fields['direccion']->showFormField(null) ?>&nbsp;<span style="color:#FF0000;">*</span></td>
        </tr>
		<tr>
            <td>Localidad</td>
            <td><? $em->fields['localidad']->showFormField(null) ?>&nbsp;<span style="color:#FF0000;">*</span></td>
        </tr>
		*/ ?>
		<tr>
            <td>Provincia</td>
            <td><? $em->fields['provincia']->showFormField(null) ?>&nbsp;<span style="color:#FF0000;">*</span></td>
        </tr>
		<?php /*
        <tr>
            <td>Teléfono</td>
            <td>
                <? $em->fields['telefono']->showFormField(null) ?>&nbsp;<span style="color:#FF0000;">*</span>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td style="font-size:9px;">(Weleda solo lo contactar&aacute; en caso de alg&uacute;n inconveniente<br />con sus pedidos.)</td>
        </tr>
		*/ ?>
        <? /*
          <tr>
          <td>Hijos menos a 3 a&ntilde;os</td>
          <td><? $em->fields['hijos_menores_a_3_anios']->showFormField(null) ?></td>
          </tr>
         */ ?>
        <? if (CONSTANTE_PAIS == 'Argentina') { ?>
            <tr>
                <td style="height:40px;">Acepto los <a href="javascript:abrirTyC()" title="Ver términos y condiciones">términos y condiciones</a></td>
                <td><? $em->fields['terminosycondiciones']->showFormField(null) ?></td>
            </tr>
        <? } ?>
        <tr>
            <td style="text-align:left;">
                <input name="submit" type="submit" value="Enviar datos" />
            </td>
            <td style="text-align:right;">
                <span style="color:#FF0000;">* Campos obligatorios</span>
            </td>
        </tr>

        <? if (CONSTANTE_PAIS == 'Argentina') { ?>
            <tr>
                <td colspan="2" style="text-align:justify; font-size:9px; padding-top:15px;" >
                    El titular de los datos personales podrá en cualquier momento solicitar el retiro o bloqueo de su nombre de los bancos de datos de Weleda S.A. a los que se refiere el artículo 27 inc. 3 de la Ley 25.326. Para ello deberá hacer conocer su deseo a Weleda S.A. remitiendo un email a unsubscribe@weleda.com.ar.
                    En toda comunicación con fines de publicidad que se realice por correo, teléfono, correo electrónico, Internet u otro medio a distancia a conocer, se deberá indicar, en forma expresa y destacada, la posibilidad del titular del dato de solicitar el retiro o bloqueo, total o parcial, de su nombre de la base de datos. A pedido del interesado, se deberá informar el nombre del responsable o usuario del banco de datos que proveyó la información.
                </td>
            </tr>
        <? } ?>

    </table>

    <? if (CONSTANTE_PAIS != "Chile") {
        ?>
        <input type="hidden" id="rut" name="rut" value="" />
		<input type="hidden" id="ocupacion" name="ocupacion" value="" />
		<input type="hidden" id="comentarios" name="comentarios" value="" />
    <? } ?>
    <? if (CONSTANTE_PAIS != "Argentina") { ?>
        <input type="hidden" id="dni" name="dni" value="" />
		<input type="hidden" id="telefono" name="telefono" value="" />
		<input type="hidden" id="direccion" name="direccion" value="" />
		<input type="hidden" id="localidad" name="localidad" value="" />
        <input type="hidden" id="terminosycondiciones" name="terminosycondiciones" value="1" />
        <?
    }

    if ($modificacion) {
        ?>
        <input type="hidden" id="modificacion" name="modificacion" value="<?= $modificacion ?>" />
    <? } ?>


</form>




<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>