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

    <img src="/imagenes/estructura/actualidad/tit_sorteo_feberero.jpg" />

    <table cellpadding="0" cellspacing="0" style="margin-top:15px;">

        <tr>
            <td>
                <img src="/imagenes/estructura/actualidad/sorteo_febrero.jpg" />
            </td>

            <td>
                <h3>Participá del sorteo y ganá un Set Verano</h3>

            </td>

        </tr>

    </table>

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
                <p>CONTANOS TU OPINIÓN</p>
                <p>Tu opinión es muy valiosa para seguir mejorando nuestro newsletter. ?Contanos qué pensás!</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                1 - ?Qué sección/es son las que más te interesan?<br />
                a. <? $em->fields['p1oa']->showFormField(null) ?> EN PROFUNDIDAD <br />
                b. <? $em->fields['p1ob']->showFormField(null) ?> EN FOCO <br />
                c. <? $em->fields['p1oc']->showFormField(null) ?> SALUD <br />
                d. <? $em->fields['p1od']->showFormField(null) ?> BREVES <br />
                ?Por qué? <? $em->fields['p1t1']->showFormField(null) ?>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                2 - ?Estás de acuerdo con la frecuencia en que recibís los newsletter?<br />
                <input type="radio" value="1" name="pregunta2" onchange="cambio_pregunta2()" checked /> SÍ <br />
                <input type="radio" value="2" name="pregunta2" onchange="cambio_pregunta2()" /> NO ?Cada cuánto te gustaría recibirlo? <? $em->fields['p2t1']->showFormField(null) ?>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                3 - ?Qué opinás sobre la extensión de las notas?<br />
                <input type="radio" value="1" name="pregunta3" onchange="cambio_pregunta3()" checked /> SON MUY EXTENSAS <br />
                <input type="radio" value="2" name="pregunta3" onchange="cambio_pregunta3()" /> ESTOY DE ACUERDO <br />
                <input type="radio" value="2" name="pregunta3" onchange="cambio_pregunta3()" /> SON MUY CORTAS
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                4 - ?Cómo definirías los contenidos?<br />
                <input type="radio" value="1" name="pregunta4" onchange="cambio_pregunta4()" checked /> MUY INTERESANTES <br />
                <input type="radio" value="2" name="pregunta4" onchange="cambio_pregunta4()" /> MEDIANAMENTE INTERESANTES <br />
                <input type="radio" value="2" name="pregunta4" onchange="cambio_pregunta4()" /> POCO INTERESANTES
            </td>
        </tr>
        
        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px;">
                5 - ?Qué temas te interesan?<br />
                a. <? $em->fields['p5oa']->showFormField(null) ?> Belleza <br />
                b. <? $em->fields['p5ob']->showFormField(null) ?> Bienestar <br />
                c. <? $em->fields['p5oc']->showFormField(null) ?> Salud <br />
                d. <? $em->fields['p5od']->showFormField(null) ?> Medicina / Antroposofía <br />
                e. <? $em->fields['p5oe']->showFormField(null) ?> Novedades / Lanzamientos <br />
                f. <? $em->fields['p5of']->showFormField(null) ?> Acciones / Promociones <br />
                g. <? $em->fields['p5og']->showFormField(null) ?> Otros <? $em->fields['p5t1']->showFormField(null) ?>
            </td>
        </tr>





    </table >

    <? /* <h3 style="margin:0 0 6px 0;">Participá del sorteo:</h3> */ ?>

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

    
    
                    <input type="hidden" name="p2" id="respuesta1" value="1" />
                    <input type="hidden" name="p3" id="respuesta1" value="1" />
                    <input type="hidden" name="p4" id="respuesta1" value="1" />
                    <!--
                    Estas tres líneas se deben poner cuando oculto el campo fecha_nacimiento,
                    ya que como es un campo obligatorio, da error.
                    <input type="hidden" name="fecha_nacimiento_d" id="fecha_nacimiento_d" value="" />
                    <input type="hidden" name="fecha_nacimiento_m" id="fecha_nacimiento_m" value="" />
                    <input type="hidden" name="fecha_nacimiento_y" id="fecha_nacimiento_y" value="" />
                    -->
                    <input type="hidden" name="ocupacion" id="ocupacion" value="1" />
                    <input type="hidden" name="telefono" id="telefono" value="" />

                </form>



                <p>

                    * Las direcciones de correo electrónico deben ser válidas para poder participar en el sorteo.

                </p>

                <p>

                    Weleda Argentina garantiza la protección y confidencialidad de los datos personales, domiciliarios y de cualquier otro tipo que nos proporcionen nuestros clientes.

                </p>



<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>