<?
/*
 *      Esta página se usa para sorteos. Requiere que el usuario esté logueado.
 */
$seccion = "clientes";
$actual = "grupoweledaimagenes";
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
    function validate_form(thisform)
    {
        with (thisform)
        {
            if (validate_required(nombre,"Por favor complete su nombre.")==false)
            {nombre.focus();return false;}
            if (validate_required(apellido,"Por favor complete su apellido.")==false)
            {apellido.focus();return false;}
            if (validate_required(email,"Por favor escriba su correo electr&oacute;nico.")==false)
            {email.focus();return false;}
            if (validate_email(email,"La direcci&oacute;n de correo electr&oacute;nico no es v&aacute;lida.")==false)
            {email.focus();return false;}
            if (validate_required(dni,"Por favor complete su DNI.")==false)
            {dni.focus();return false;}
            if (validate_required(comentarios,"Por favor responda la pregunta.")==false)
            {comentarios.focus();return false;}
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
<form name="myform" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data" action="index.php?module=fr_sorteo_web_c" >
    <input type="hidden" name="grabar" value="0" />
    <h3 style='font-size: 22px; font-family: "Neo Sans", Arial, Helvetica, sans-serif; color: rgb(247,156,76); font-weight: bold;'>
        Sorteo <strong>&middot;</strong> Set de Espino Amarillo
    </h3>

    <table cellpadding="10" cellspacing="0" style="margin-top:15px;">
        <tr>
            <td valign="top">
                <img src="/imagenes/contenido/sorteo_espino_amarillo_grande.jpg"  />
            </td>
            <td valign="top">
                <h3 style="font-weight:normal; font-size:12px;">
                    Con rayos de sol en abundancia, un suelo rico en nutrientes y temperaturas ideales, el Espino Amarillo, para Weleda es la fuente m&aacute;s importante de vitamina C, se cultiva en las monta&ntilde;as del sur de la Toscana, Italia, y bajo los principios de la ecolog&iacute;a biodin&aacute;mica.
                </h3>
            </td>
        </tr>
    </table>


    <p style="font-weight:bold; font-size:12px;">
        ¿Por qu&eacute; recomendamos la L&iacute;nea de Espino Amarillo como post solar?
    </p>
    <p>
        En primer lugar los productos de la l&iacute;nea contienen una combinaci&oacute;n de las bayas de Espino Amarillo, que es s&uacute;per rico en vitaminas A y E y &aacute;cidos grasos insaturados, disminuye la creaci&oacute;n de radicales libres, calma la piel en caso de irritaciones, ejerce un efecto suavizante y ayuda a retener su humedad. Entonces la L&iacute;nea de Espino amarillo restablece el equilibrio de tu piel, la mantiene hidratada y se comprob&oacute; la reducci&oacute;n de su envejecimiento prematuro causado por los rayos UV.
    </p>


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

    <?php /*
      OCULTO LA PREGUNTA 1

      <table border="0" align="center" width="100%">
      <tr>
      <td colspan="2" style="font-weight:bold; font-size:12px; line-height: 18px;">
      <p>Particip&aacute;s con s&oacute;lo contestar esta pregunta:</p>
      <p>&iquest;Cu&aacute;l es tu l&iacute;nea facial Weleda preferida?</p>
      </td>
      </tr>
      <tr>
      <td colspan="2" style="font-size:12px; line-height: 18px;">
      <input type="radio" value="1" name="pregunta1" onchange="cambio_pregunta1()" checked />
      L&iacute;nea hidratante de Iris<br />
      <input type="radio" value="2" name="pregunta1" onchange="cambio_pregunta1()" />
      L&iacute;nea alisante de Rosa Mosqueta<br />
      <input type="radio" value="3" name="pregunta1" onchange="cambio_pregunta1()" />
      L&iacute;nea alisante de Rosa Mosqueta<br />
      <input type="radio" value="4" name="pregunta1" onchange="cambio_pregunta1()" />
      L&iacute;nea armonizante de Almendra<br />
      <input type="radio" value="5" name="pregunta1" onchange="cambio_pregunta1()" />
      Ninguna<br />
      </td>
      </tr>
      </table>
     */ ?>

    <? /* <h3 style="margin:0 0 6px 0;">Particip&aacute; del sorteo:</h3> */ ?>
    <table cellpadding="2">
        <tr>
            <td style="font-weight:bold;">Nombre:</td>
            <td>
                <? echo $cliente['nombre']; ?>
                <input type="hidden" name="nombre" id="nombre" value="<? echo $cliente['nombre']; ?>" />
            </td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Apellido:</td>
            <td>
                <? echo $cliente['apellido']; ?>
                <input type="hidden" name="apellido" id="apellido" value="<? echo $cliente['apellido']; ?>" />
            </td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Correo electr&oacute;nico:</td>
            <td>
                <? echo $cliente['email']; ?>
                <input type="hidden" name="email" id="email" value="<? echo $cliente['email']; ?>" />
            </td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Tel&eacute;fono:</td>
            <td>
                <? echo $cliente['telefono']; ?>
                <input type="hidden" name="telefono" id="telefono" value="<? echo $cliente['telefono']; ?>" />
            </td>
        </tr>
        <tr>
            <td style="font-weight:bold;">DNI:</td>
            <td>
                <? echo $cliente['dni']; ?>
                <input type="hidden" name="dni" id="dni" value="<? echo $cliente['dni']; ?>" />
            </td>
        </tr>
    </table>
    
    <table width="100%" style="padding-bottom: 20px;">
        <tr>
            <td style="text-align:right;">
                Por favor <a href="index.php?module=fr_clientes_modificacion">actualice sus datos</a><br />antes de participar si no son correctos.
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td style="padding-top:20px;" valign="top">
                &iquest;C&oacute;mo hidrat&aacute;s tu piel luego de exponerte al sol? <span style="color:#FF0000;">*</span>
            </td>
            <td style="padding-top:5px;">
                <textarea rows="3" cols="20" name="comentarios"></textarea>
            </td>
        </tr>
        <tr>
            <td style="padding-top:20px;" valign="top">Dejanos tu comentario</td>
            <td style="padding-top:5px;">
                <textarea rows="3" cols="20" name="comentario2"></textarea> 
            </td>
        </tr>
        <tr>
            <td>Subscribirse a newsletters</td>
            <td><? $em->fields['recibe_newsletter']->showFormField(null) ?></td>
        </tr>


        <tr>
            <td></td>
            <td>
                <input name="submit" type="submit" value="Enviar" />
            </td>
        </tr>

        <tr>
            <td align="left" colspan="2"><span style="color:#FF0000;">* Campo obligatorio</span></td>
        </tr>
    </table>
    <? /* <input type="hidden" name="respuesta1" id="respuesta1" value="<?=$_GET["rta"]?>" /> */ ?>
    <input type="hidden" name="respuesta1" id="respuesta1" value="1" />
    <!--
    Estas tres l&iacute;neas se deben poner cuando oculto el campo fecha_nacimiento,
    ya que como es un campo obligatorio, da error.
    -->
    <input type="hidden" name="fecha_nacimiento_d" id="fecha_nacimiento_d" value="" />
    <input type="hidden" name="fecha_nacimiento_m" id="fecha_nacimiento_m" value="" />
    <input type="hidden" name="fecha_nacimiento_y" id="fecha_nacimiento_y" value="" />

    <input type="hidden" name="identificador_sorteo" id="identificador_sorteo" value="ESPINO 01/2012" />
    <!-- <input type="hidden" name="telefono" id="telefono" value="" /> -->
    <input type="hidden" name="password" id="password" value="-" />
    <input type="hidden" name="fp_validation_password" id="fp_validation_password" value="-" />
    <input type="hidden" name="ocupacion" id="ocupacion" value="" />
    <!--
        <input type="hidden" name="terminosycondiciones" id="terminosycondiciones" value="1" />
    -->
    <input type="hidden" name="direccion" id="direccion" value="" />
    <input type="hidden" name="rut" id="rut" value="" />
</form>
<p>
    Las direcciones de correo electr&oacute;nico deben ser v&aacute;lidas para poder participar en el sorteo.
</p>
<p>
    Weleda Argentina garantiza la protecci&oacute;n y confidencialidad de los datos personales, domiciliarios y de cualquier otro tipo que nos proporcionen nuestros clientes.
</p>
<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>