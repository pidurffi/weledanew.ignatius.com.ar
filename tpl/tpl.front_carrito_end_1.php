<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NR2RW7L');</script>
	<!-- End Google Tag Manager -->
		
    
        <?
// <title>...</title>
        if (CONSTANTE_PAIS == "Argentina")
            print("<title>Weleda e-shop paso 1</title>");
        elseif (CONSTANTE_PAIS == "Chile")
            print("<title>Weleda e-shop paso 1</title>");
        ?>
        <style>
            .clearfix:after {
                content: ".";
                display: block;
                height: 0;
                clear: both;
                visibility: hidden;
            }

            .clearfix {display: inline-table;}

            /* Hides from IE-mac \*/

            * html .clearfix {height: 1%;}
            .clearfix {display: block;}

            /* End hide from IE-mac */

            body {
                margin:0;
                padding:0px;
            }

            div#contenedor {
                margin:auto;
                width:760px;
            }

            table {
                font-family:Arial, Helvetica, sans-serif;
                font-size:11px;
                font-weight:bold;
            }

            table tr.titulo {
                background-color:#d3bf96;
                color:#FFFFFF;
                height:22px;
            }

            table tr.contenido {
                background-color:#bfc8de;
                height:27px;
                color:#111111;
            }

            table tr.contenido td {text-align:left; padding-left: 5px;}

            table tr.contenido td.input {
                /* width:80%; */
                text-align:left;
                padding-left:20px;
            }

            table tr.titulo td {
                width:675px;
                padding-left:5px;
            }

            table tr td.login {
                font-size:10px;
            }

            div.texto {
                width:475px;
                text-align:center;
                font-family:Arial, Helvetica, sans-serif;
                font-size:10px;
                font-weight:bold;
            }

            h3 {
                text-align:center;
                font-family:Arial, Helvetica, sans-serif;
                color:#6699cc;
                font-size:14px;
            }

            div#encabezado_carrito {
                width:760px;
                height:120px;
                background-image:url('imagenes/estructura/carrito/encabezado_carrito.jpg');
                background-position: center;
                background-repeat: no-repeat;
            }

            div#menu_control {
                margin:20px auto 0 auto;
                width:350px;
                height:44px;
                padding-left: 230px;
            }

            div#menu_control ul {
                padding:0;
                margin:0;
                list-style-type:none;
            }


            div#menu_control ul li {
                display:inline;
            }


            div#menu_control ul li a {
                display:block;
                float:left;
                height:0;
                padding-top:22px;
                overflow:hidden;
                text-decoration:none;
            }


            div#menu_control ul li a.atras {background-image:url('/imagenes/menu_carrito/atras.jpg'); width:67px;}

            * html div#menu_control a:link, * html div#menu_control a:visited {height:22px; he\ight:0;}

            div#menu_control a:hover {background-position:0 -22px;}
        </style>
        <script type="text/javascript">
            function ver_perfil()
            {
                window.opener.location = "index.php?module=fr_clientes_modificacion";
                window.close()
            }
        </script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


        <script type="text/javascript">
<? $emCompra->createJavascripts(); ?>
        </script>

    </head>

    <body>
    
    	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NR2RW7L"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	
	
    
        <div id="encabezado_carrito"></div>
        <p style="text-align:left; font-family:Arial, Helvetica, sans-serif; font-size:11px;">
            <?= $usuario['nombre'] ?>&nbsp;<?= $usuario['apellido'] ?>&nbsp;
            <a href="#" onClick="ver_perfil()">Ver perfil</a>
        </p>
        <form method="post" action="index.php?module=<?= $_GET['module']; ?>">
            <div id="contenedor">
                <? foreach ($errors as $error) {
                    ?>
                    <span style="color:red"><?= $error ?></span><br/>
                <? } ?>
                <table border="0" cellpadding="0" cellspacing="1" style="padding-top:5px;" align="center">
                    <tr class="titulo">
                        <td colspan="2">Datos de comprador</td>
                    </tr>
                    <tr class="contenido">
                        <td>Nombre y apellido</td> <td class="input"> <?= $usuario['nombre'] ?>  <?= $usuario['apellido'] ?></td>
                    </tr>
                    <tr class="contenido">
                        <td>Tel&eacute;fono</td> <td class="input"> <?= $usuario['telefono'] ?> </td>
                    </tr>
                    <tr class="contenido">
                        <td>Correo electr&oacute;nico</td> <td class="input"> <?= $usuario['email'] ?></td>
                    </tr>
                </table>
                <table border="0" cellpadding="0" cellspacing="1" align="center" style="padding-top:5px;">
                    <tr class="titulo">
                        <td colspan="2">Datos de entrega</td>
                    </tr>
                    <tr class="contenido">
                        <td>Nombre y apellido</td> <td class="input"><?= $emCompra->fields['nombre']->showFormField(null, 45); ?>&nbsp;<span style="color:#FF0000;">*</span>
                        </td>
                    </tr>
                    <tr class="contenido">
                        <td>Direcci&oacute;n</td> <td class="input"><?= $emCompra->fields['direccion']->showFormField(null, 45); ?>&nbsp;<span style="color:#FF0000;">*</span></td>
                    </tr>
                    <?php
                    if (CONSTANTE_PAIS == 'Argentina') {
                        /* Solo Argentina usa el código postal. */
                        ?>
                        <tr class="contenido">
                            <td>C&oacute;digo postal</td> <td class="input"><?= $emCompra->fields['codigo_postal']->showFormField(null); ?>&nbsp;<span style="color:#FF0000;">*</span></td>
                        </tr>
                    <? } ?>
                    <tr class="contenido">
                        <td>
                            <?php
                            if (CONSTANTE_PAIS == 'Argentina') {
                                print("Localidad");
                            } else {
                                // Chile 
                                print("Región/Comuna");
                            }
                            ?>
                        </td>
                        <td class="input">
                            <?php
                            if (CONSTANTE_PAIS == 'Argentina') {
                                print($emCompra->fields['ciudad']->showFormField(null, 45) . '&nbsp;<span style="color:#FF0000;">*</span>');
                            } else {
                                // Chile 
                                print($emCompra->fields['ciudad_id']->showFormField(null) . '&nbsp;<span style="color:#FF0000;">*</span>');
                            }
                            ?>
                        </td>

                    </tr>

                    <?php if (CONSTANTE_PAIS == 'Argentina') { ?>
                        <tr class="contenido">
                            <td>
                                Provincia
                            </td>
                            <td class="input">
                                <?= $emCompra->fields['provincia']->showFormField(null); ?>&nbsp;<span style="color:#FF0000;">*</span>
                            </td>
                        </tr>    
                    <? }
                    ?>

                    <? /* La envoltura para regalo se ocultan porque lo pidieron para una promoción navideña
                      que nunca se terminó de implementar. */ ?>
                      <tr class="contenido">
                      <td colspan="2">
                      Envolver productos para regalo:
                      <?= $emCompra->fields['para_regalo']->showFormField(null); ?>
                      </td>
                      </tr>
                      
                    <tr class="contenido">
                        <td colspan = "2" style = "font-weight: normal;">
                            <?php
                            if (CONSTANTE_PAIS == 'Argentina') {
                                print("Con el c&oacute;digo postal se determinar&aacute;el costo de env&iacute;o.");
                            } else {
                                // Chile 
                                print('Con la comuna se determinar&aacute; el costo de env&iacute;o. Tiempo máximo de envío: 5 d&iacute;as.');
                                print('<br />Puedes retirar el env&iacute;o en una de las <a href="http://www.chilexpress.cl/index_oficinas.asp" target="_BLANK">Oficias de Chileexpress</a> si no realizan env&iacute;os a tu comuna.');
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan = "2" style = "text-align:right;">
                            <span style = "color:#FF0000;">* Campos obligatorios</span>
                        </td>
                    </tr>
                </table>

                <?php
                if (CONSTANTE_PAIS == 'Argentina') {
                    // Solo Argentina usa el código de promoción.
                    ?>    
                    <table border = "0" cellpadding = "0" cellspacing = "1" align = "center" style = "padding-top:5px; width:475px;">
                        <tr class = "contenido">
                            <td>Código de promoción</td>
                            <td class = "input">
                                <?= $emCompra->fields['codigo_promocion']->showFormField(null, 20); ?>
                            </td>
                        </tr>
                    </table>
                <? } ?>

                <? /* Los datos de facturación se ocultan porque lo pidieron y no lo implementaron
                 * en Presea.
                  <table border="0" cellpadding="0" cellspacing="1" align="center" style="padding-top:5px;">
                  <tr class="titulo">
                  <td colspan="2">Datos de facturación (complete para recibir la factura en otra dirección)</td>
                  </tr>
                  <tr class="contenido">
                  <td>Nombre y apellido</td> <td class="input"><?= $emCompra->fields['nombre_facturacion']->showFormField(null, 45); ?>
                  </td>
                  </tr>
                  <tr class="contenido">
                  <td>Direcci&oacute;n</td> <td class="input"><?= $emCompra->fields['direccion_facturacion']->showFormField(null, 45); ?></td>
                  </tr>
                  <tr class="contenido">
                  <td>C&oacute;digo postal</td> <td class="input"><?= $emCompra->fields['codigo_postal_facturacion']->showFormField(null); ?></td>
                  </tr>
                  <tr class="contenido">
                  <td>Localidad</td> <td class="input"><?= $emCompra->fields['ciudad_facturacion']->showFormField(null, 45); ?></td>
                  </tr>
                  <tr class="contenido">
                  <td>Provincia</td> <td class="input"><?= $emCompra->fields['provincia_facturacion']->showFormField(null); ?></td>
                  </tr>
                  </table>
                 */ ?>


                <?
/// TODO Implementar textarea
                /*
                  <h3>Otros comentarios o solicitudes especiales</h3> */
                ?>
                <input type="hidden" id="costo_envio" name="costo_envio" value="" />
                <input type="hidden" id="dineromail_estado_operacion" name="dineromail_estado_operacion" value="0" />
                <input type="hidden" id="valida" name="valida" value="0" />

                <input type="hidden" id="descuento_pesos" name="descuento_pesos" value="0" />
                <input type="hidden" id="descuento_porcentaje" name="descuento_porcentaje" value="0" />
                <input type="hidden" id="nombre_promocion" name="nombre_promocion" value="" />
                <input type="hidden" id="nombre_facturacion" name="nombre_facturacion" value="" />
                <input type="hidden" id="direccion_facturacion" name="direccion_facturacion" value="" />
                <input type="hidden" id="ciudad_facturacion" name="ciudad_facturacion" value="" />
                <input type="hidden" id="codigo_postal_facturacion" name="codigo_postal_facturacion" value="" />
                <input type="hidden" id="provincia_facturacion" name="provincia_facturacion" value="" />
                <input type="hidden" id="nombre_promocion" name="nombre_promocion" value="" />

                <?php
                if (CONSTANTE_PAIS == 'Argentina') {
                    ?>
                    <input type="hidden" id="ciudad_id" name="ciudad_id" value="0" />
                    <?
                } elseif (CONSTANTE_PAIS == 'Chile') {
                    /* El CP es obligatorio, así que no pongo "" sino "0". */
                    ?>
                    <input type="hidden" id="codigo_postal" name="codigo_postal" value="0" />
                    <input type="hidden" id="codigo_promocion" name="codigo_promocion" value="" />
                    <input type="hidden" id="ciudad" name="ciudad" value="-" />
                    <input type="hidden" id="provincia" name="provincia" value="0" />
                <? } ?>


                <div id="menu_control">
                    <ul>
                        <li><a class="atras" href="index.php?module=fr_carrito_list"></a></li>
                        <li style="margin-left:10px; padding-left:10px;">
                            <input type="submit" name="submit" id="submit" value=" " style="width:73px; height:22px; border:none; background:url(/imagenes/menu_carrito/continuar.jpg) no-repeat 100% 100%; cursor:pointer;" />
                        </li>
                    </ul>
                </div>
            </div>
        </form>

    </body>
</html>