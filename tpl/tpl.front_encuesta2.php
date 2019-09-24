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

    function cambio_pregunta5()
    {
        var t = ""
        for (i=0; i<document.myform.pregunta5.length; i++)
        {
            if (document.myform.pregunta5[i].checked==true)
            {
                t = t + document.myform.pregunta5[i].value
            }
        }
        document.getElementById("p5").value = t
    }

    function cambio_pregunta6()
    {
        var t = ""
        for (i=0; i<document.myform.pregunta6.length; i++)
        {
            if (document.myform.pregunta6[i].checked==true)
            {
                t = t + document.myform.pregunta6[i].value
            }
        }
        document.getElementById("p6").value = t
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

<form name="myform" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data" action="index.php?module=fr_encuesta2_alta&id=<?= (isset($_GET['id'])) ? $_GET['id'] : ''; ?>" >
    <input type="hidden" name="grabar" value="0" />

    <h3 style='font-size: 22px; font-family: "Neo Sans", Arial, Helvetica, sans-serif; color: sandybrown; font-weight: bold;'>
        Contanos tu opini&oacute;n
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
                    Para poder seguir acompa&ntilde;ándote en el aprendizaje diario de ser mamá, queremos conocer tu opinión sobre el Set de viaje que recibió tu bebé. Contanos qué pensás hasta el 5/4 y participá del sorteo a realizarse el 8/4 por un Set de Limpieza, compuesto por: 1 Leche Limpiadora suave de 100 ml y 1 Loción Tónica vivificante de 100 ml. La nueva línea de limpieza facial es compatible con todas las líneas faciales Weleda y dejan la piel perfectamente preparada para los tratamientos posteriores.
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                <br />
                1 - &iquest;Ya conocías la marca?<br />
                <input type="radio" value="1" name="pregunta1" onchange="cambio_pregunta1()" checked /> Sí. &nbsp;&nbsp&iquest;Cómo?<br />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? $em->fields['p1o1']->showFormField(null) ?> Recomendación por amiga <br />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? $em->fields['p1o2']->showFormField(null) ?> Recomendación por médico/pediatra <br />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? $em->fields['p1o3']->showFormField(null) ?> Recomendación en el punto de venta <br />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? $em->fields['p1o4']->showFormField(null) ?> Por publicidad <br />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? $em->fields['p1o5']->showFormField(null) ?> Por la web <br />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? $em->fields['p1o6']->showFormField(null) ?> Otros <? $em->fields['p1t1']->showFormField(null, 40) ?>
                <br /><input type="radio" value="2" name="pregunta1" onchange="cambio_pregunta1()" /> No.
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                <br />
                2 - &iquest;Te gustó el Set de viaje para tu bebé?<br />
                <input type="radio" value="1" name="pregunta2" onchange="cambio_pregunta2()" checked /> Sí. <br />
                <input type="radio" value="2" name="pregunta2" onchange="cambio_pregunta2()" /> No. &iquest;Por qué? <? $em->fields['p2t1']->showFormField(null,40) ?>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                <br />
                3 - &iquest;La combinación de productos en el Set fue útil?<br />
                <input type="radio" value="1" name="pregunta3" onchange="cambio_pregunta3()" checked /> Sí. <br />
                <input type="radio" value="2" name="pregunta3" onchange="cambio_pregunta3()" /> No. &iquest;Por qué? <? $em->fields['p3t1']->showFormField(null,40) ?>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                <br />
                4 - &iquest;Las explicaciones fueron suficientes?<br />
                <input type="radio" value="1" name="pregunta4" onchange="cambio_pregunta4()" checked /> Sí. <br />
                <input type="radio" value="2" name="pregunta4" onchange="cambio_pregunta4()" /> No. &iquest;Por qué? <? $em->fields['p4t1']->showFormField(null,40) ?>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                <br />
                5 - En comparación con otros productos que conocés, &iquest;cómo evaluarías la calidad de la Línea Weleda Bebé?<br />
                <input type="radio" value="1" name="pregunta5" onchange="cambio_pregunta5()" checked /> Excelente <br />
                <input type="radio" value="2" name="pregunta5" onchange="cambio_pregunta5()" /> Buena <br />
                <input type="radio" value="3" name="pregunta5" onchange="cambio_pregunta5()" /> Indiferente <br />
                <input type="radio" value="4" name="pregunta5" onchange="cambio_pregunta5()" /> Mala
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                <br />
                6 - &iquest;Recomendarías la Línea Weleda Bebé a una amiga?<br />
                <input type="radio" value="1" name="pregunta6" onchange="cambio_pregunta6()" checked /> Sí <br />
                <input type="radio" value="2" name="pregunta6" onchange="cambio_pregunta6()" /> No. &iquest;Por qué? <? $em->fields['p6t1']->showFormField(null,40) ?>
            </td>
        </tr>

         <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                <br />
                7 - &iquest;Cómo definirías Weleda en dos palabras?<br />
                <? $em->fields['p7t1']->showFormField(null,40) ?>
        </tr>

    </table >

    <br />
    <h3 style='font-size: 14px; font-family: "Neo Sans", Arial, Helvetica, sans-serif; color: sandybrown; font-weight: bold;'>
        Dejanos tus datos y empezá a participar del sorteo.
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
            <td>Fecha de nacimiento</td>
            <td><? $em->fields['fecha_nacimiento']->showFormField(null) ?></td>
        </tr>
        <tr>
            <td>Subscribirse a newsletters</td>
            <td><? $em->fields['recibe_newsletter']->showFormField(null) ?></td>
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
    <input type="hidden" name="p5" id="p5" value="1" />
    <input type="hidden" name="p6" id="p6" value="1" />
    <!--
    Estas tres líneas se deben poner cuando oculto el campo fecha_nacimiento,
    ya que como es un campo obligatorio, da error.
    <input type="hidden" name="fecha_nacimiento_d" id="fecha_nacimiento_d" value="" />
    <input type="hidden" name="fecha_nacimiento_m" id="fecha_nacimiento_m" value="" />
    <input type="hidden" name="fecha_nacimiento_y" id="fecha_nacimiento_y" value="" />
    -->
    <input type="hidden" name="ocupacion" id="ocupacion" value="" />
    <input type="hidden" name="telefono" id="telefono" value="" />

</form>



<p>
    * Las direcciones de correo electrónico deben ser válidas para poder participar en el sorteo.
</p>
<p>
    Weleda Argentina garantiza la protección y confidencialidad de los datos personales, domiciliarios y de cualquier otro tipo que nos proporcionen nuestros clientes.
</p>



<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>