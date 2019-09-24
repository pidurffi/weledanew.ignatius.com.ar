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

    
    function validate_form(thisform)
    {
        with (thisform)
        {
            /*
            if (validate_required(nombre,"Por favor complete su nombre.")==false)
            {nombre.focus();return false;}
            if (validate_required(apellido,"Por favor complete su apellido.")==false)
            {apellido.focus();return false;}
            if (validate_required(email,"Por favor escriba su correo electr�nico.")==false)
            {email.focus();return false;}
            if (validate_email(email,"La direcci�n de correo electr�nico no es v�lida.")==false)
            {email.focus();return false;}
             */
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

<form name="myform" method="post" onsubmit="return validate_form(this)" enctype="multipart/form-data" action="index.php?module=fr_encuesta3_alta&id=<?= (isset($_GET['id'])) ? $_GET['id'] : ''; ?>" >
    <input type="hidden" name="grabar" value="0" />

    <h3 style='font-size: 22px; font-family: "Neo Sans", Arial, Helvetica, sans-serif; color: #852892; font-weight: bold; padding-bottom: 0px; margin-bottom: 0px;'>
        Encuesta e.shop
    </h3>

    <table border="0" align="center" width="100%">
        <tr>
            <td colspan="2" style="padding-bottom:5px;">
                <?
                foreach ($errores as $error) {
                    // Si respuesta1 es menos a 1, es porque no se eligi� un radio button.
                    $error = str_replace("El campo respuesta1 debe ser mayor a 1", "Por favor elija una respuesta", $error);
                    ?>
                    <span style="color:#FF0000"><?= $error ?></span><br/>
                <? } ?>
            </td>
        </tr>
    </table>

    <table border="0" align="center" width="100%">

        <tr>
            <td colspan="2" style="font-weight:normal; font-size:12px; line-height: 18px;">
                <p style="text-align: justify;">
                    Nos gustaría saber su opinión para poder mejorar la calidad de nuestro servicio de compra e.shop. Al contestar las siguientes preguntas, recibirá de regalo en su próxima compra una Leche corporal de 100ml.
                </p>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px;">
                <strong>1. ¿Cómo puede calificar su experiencia por su compra en el e.shop de Weleda? </strong>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px; padding-left: 30px;">
                <br />
                <strong>Navegación para ingresar y comprar</strong><br />
                <input type="radio" value="1" name="pregunta1" onchange="cambio_pregunta1()" checked /> Excelente <br />
                <input type="radio" value="2" name="pregunta1" onchange="cambio_pregunta1()" /> Muy buena <br />
                <input type="radio" value="3" name="pregunta1" onchange="cambio_pregunta1()" /> Buena<br />
                <input type="radio" value="4" name="pregunta1" onchange="cambio_pregunta1()" /> Regular <br />
                <input type="radio" value="5" name="pregunta1" onchange="cambio_pregunta1()" /> Mala  <br />
                ¿Por qué? <? $em->fields['p1t1']->showFormField(null,40) ?>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px; padding-left: 30px;">
                <br />
                <strong>Búsqueda/selección de los productos</strong><br />
                <input type="radio" value="1" name="pregunta2" onchange="cambio_pregunta2()" checked /> Excelente <br />
                <input type="radio" value="2" name="pregunta2" onchange="cambio_pregunta2()" /> Muy buena <br />
                <input type="radio" value="3" name="pregunta2" onchange="cambio_pregunta2()" /> Buena<br />
                <input type="radio" value="4" name="pregunta2" onchange="cambio_pregunta2()" /> Regular <br />
                <input type="radio" value="5" name="pregunta2" onchange="cambio_pregunta2()" /> Mala  <br />
                ¿Por qué? <? $em->fields['p2t1']->showFormField(null) ?>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px; padding-left: 30px;">
                <br />
                <strong>Carga de datos personales</strong><br />
                <input type="radio" value="1" name="pregunta3" onchange="cambio_pregunta3()" checked /> Excelente <br />
                <input type="radio" value="2" name="pregunta3" onchange="cambio_pregunta3()" /> Muy buena <br />
                <input type="radio" value="3" name="pregunta3" onchange="cambio_pregunta3()" /> Buena<br />
                <input type="radio" value="4" name="pregunta3" onchange="cambio_pregunta3()" /> Regular <br />
                <input type="radio" value="5" name="pregunta3" onchange="cambio_pregunta3()" /> Mala  <br />
                ¿Por qué? <? $em->fields['p3t1']->showFormField(null) ?>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px; padding-left: 30px;">
                <br />
                <strong>Pago de la compra</strong><br />
                <input type="radio" value="1" name="pregunta4" onchange="cambio_pregunta4()" checked /> Excelente <br />
                <input type="radio" value="2" name="pregunta4" onchange="cambio_pregunta4()" /> Muy buena <br />
                <input type="radio" value="3" name="pregunta4" onchange="cambio_pregunta4()" /> Buena<br />
                <input type="radio" value="4" name="pregunta4" onchange="cambio_pregunta4()" /> Regular <br />
                <input type="radio" value="5" name="pregunta4" onchange="cambio_pregunta4()" /> Mala  <br />
                ¿Por qué? <? $em->fields['p4t1']->showFormField(null) ?>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size: 12px;">
                <br /><strong>2. ¿Recibió su pedido en tiempo y forma? </strong>
            </td>
        </tr>


        <tr>
            <td colspan="2" style="font-size:12px; line-height: 18px; padding-left: 30px;">
                <br />
                <input type="radio" value="1" name="pregunta5" onchange="cambio_pregunta5()" checked /> Sí <br />
                <input type="radio" value="2" name="pregunta5" onchange="cambio_pregunta5()" /> No <br />
                Comentario <? $em->fields['p5t1']->showFormField(null) ?>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size: 12px;">
                <br /><strong>3. ¿Por qué elige comprar online en Weleda? </strong>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="font-size: 12px; padding-left: 30px;">
                <br />
                <? $em->fields['p6o1']->showFormField(null) ?> Descuentos especiales <br />
                <? $em->fields['p6o2']->showFormField(null) ?> Productos de regalos – Muestras <br />
                <? $em->fields['p6o3']->showFormField(null) ?> Comodidad<br />
                <? $em->fields['p6o4']->showFormField(null) ?> No hay puntos de venta en su localidad <br />
                Otro <? $em->fields['p6t1']->showFormField(null) ?>
            </td>
        </tr>

        <tr>
            <td style="padding-top:20px; font-size: 12px;" valign="top" colspan="2">Sugerencias
                <br />
                <textarea rows="3" cols="40" name="comentarios"></textarea>
            </td>
        </tr>


        <tr>
            <td colspan="2" align="left">
                <input name="submit" type="submit" value="Enviar" style="width:100px;" />
            </td>

        </tr>
		
		<tr>
            <td colspan="2" align="left">
                &nbsp;
            </td>

        </tr>
		
		<tr>
            <td colspan="2" align="center">
                Promoci&oacute;n v&aacute;lida hasta el 31/10/2012 o hasta agotar stock
            </td>

        </tr>


    </table >


    <input type="hidden" name="p1" id="p1" value="1" />
    <input type="hidden" name="p2" id="p2" value="1" />
    <input type="hidden" name="p3" id="p3" value="1" />
    <input type="hidden" name="p4" id="p4" value="1" />
    <input type="hidden" name="p5" id="p5" value="1" />

    <input type="hidden" name="id_cliente" id="id_cliente" value="<? $us = SessionManager::getValue("LOGIN");
                echo $us['id'];
                ?>" />



    <!--
    Estas tres l�neas se deben poner cuando oculto el campo fecha_nacimiento,
    ya que como es un campo obligatorio, da error.
    <input type="hidden" name="fecha_nacimiento_d" id="fecha_nacimiento_d" value="" />
    <input type="hidden" name="fecha_nacimiento_m" id="fecha_nacimiento_m" value="" />
    <input type="hidden" name="fecha_nacimiento_y" id="fecha_nacimiento_y" value="" />
    -->




</form>

<? include(TPL_FOLDER . "tpl.front_template_abajo.php"); ?>