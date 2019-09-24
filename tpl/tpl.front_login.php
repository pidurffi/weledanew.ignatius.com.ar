<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$inicio = "0";
/* include(TPL_FOLDER."tpl.front_template_arriba.php"); */
// Defino $mayorista. Es true si se recibe tc en la URL.
$mayorista = isset($_GET["tc"]);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <script type="text/javascript">
            function cerrar($url)
            {
                if(opener == null)
                {
                    // no es un popup
                    // Redirecciona la ventana principal (desde donde se llam� al pop-up) para que el cliente se registre.
                    window.location = $url;
                }
                else
                {
                    // S� es un popup.
                    // Redirecciona la ventana principal (desde donde se llam� al pop-up) para que el cliente se registre.
                    opener.location.href = $url;
                    // Cierra la ventana del pop-up.
                    window.close();
                }
            }
              
            function noEsUnPopup()
            {
                // Defino el estilo del "top".
                if(opener == null)
                {
                    // La ventana de login no es un pop-up.
                    // (Login para participar del sorteo).
                    document.getElementById("encabezado_carrito").style.backgroundImage = 'url("imagenes/estructura/carrito/top_login.jpg")';
                    document.getElementById("encabezado_carrito").style.height = '202px';
                }
                else
                {
                    // La ventana de login es un pop-up (Log-in para comprar).
                    document.getElementById("encabezado_carrito").style.backgroundImage = '<?= ($mayorista ? "url(imagenes/estructura/carrito/encabezado_carrito_mayorista.jpg)" : "url(imagenes/estructura/carrito/encabezado_carrito.jpg)") ?>';
                    document.getElementById("encabezado_carrito").style.height = '120px';
                }
            }
        </script>

        <style type="text/css">

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
                padding:5px;
                font-family:Arial, Helvetica, sans-serif;
                font-size:11px;
            }

            div#contenedor_carrito {
                margin:auto;
                width:760px;
            }

            div.tit_contenido h3 {display:none;}

            div.tit_contenido.bienvenidos {
                margin-left:38px;

                width:146px;
                height:27px;
                background-image:url('/imagenes/estructura/carrito/tit_bienvenido.jpg');
                background-repeat:no-repeat;
            }	

            div#encabezado_carrito {
                width:760px;
                /* height:120px; */
                /* background-image:url('imagenes/estructura/carrito/encabezado_carrito.jpg'); */
            }

            div#cuerpo_carrito {
                padding-top:10px;
                width:760px;
                text-align:center;
            }

            table {
                font-family:Arial, Helvetica, sans-serif;
                font-size:11px;
                font-weight:bold;
            }

            table tr td {}

            table tr.titulo {
                background-color:#e0380b;
                color:#FFFFFF;
                height:22px;
            }

            table tr.contenido {
                background-color:#d6e0f9;
                height:27px;
                color:#868a93;
            }

            table tr.compra_total {
                background-color:#b1c3f3;
                color:#615f64;
                height:27px;
            }

            div#menu_carrito {
                margin-top:28px;
                width:444px;
                height:22px;
            }

            div#menu_carrito ul {
                margin:0;
                padding:0;
                list-style-type:none;
            }

            div#menu_carrito ul li {
                display:inline;
            }

            div#menu_carrito ul li a {
                display:block;
                float:left;
                height:0;
                padding-top:22px;
                overflow:hidden;
                text-decoration:none;
            }

            div#menu_carrito ul li a.seguir {background-image:url('/imagenes/menu_carrito/seguir.jpg'); width:115px;}
            div#menu_carrito ul li a.recalcular {background-image:url('/imagenes/menu_carrito/recalcular.jpg'); width:74px; margin-left:27px;}
            div#menu_carrito ul li a.limpiar {background-image:url('/imagenes/menu_carrito/limpiar.jpg'); width:100px; margin-left:29px;}
            div#menu_carrito ul li a.comprar {background-image:url('/imagenes/menu_carrito/comprar.jpg'); width:67px; margin-left:32px;}
            * html div#menu a:link, * html div#menu a:visited {height:22px; he\ight:0;}
            div#menu a:hover {background-position:0 -22px;}

            div#pie_carrito p {
                margin-top:20px;
                font-family:Arial, Helvetica, sans-serif;
                font-size:10px;
                color:#606062;
                font-weight:bold;
                text-align:center;
            }

            table.login {
                padding:10px 0;
                background-color:#e9dfca;
            }

            div#cuerpo_carrito table.menu_abajo {
                margin-top:10px;
                background-color:#d3bf96;
                width:688px;
                margin-left:36px;
            }

        </style>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>E-shop Weleda</title>

        <?php /* Google Analytics */ ?>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-29628921-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>

    </head>

    <body onload="noEsUnPopup();">
        <div id="contenedor_carrito" class="clearfix">
            <div id="encabezado_carrito"></div>
            <div id="cuerpo_carrito">
        <script type="text/javascript">
<? if (!empty($close)) { ?>
        if(window.opener) window.close();
<? } ?>
                </script>

                <div class="tit_contenido bienvenidos">
                    <h3>Bienvenidos</h3>
                </div>
                <?
                if (isset($error)) {
                    ?>
                    <p style="color:#FF0000; text-align:center; font-weight:bold; font-size:12px;"><?= $error ?></p>
                <? } ?>

                <div id="login">
                    <div id="login_imagen"></div>
                    <div id="login_campos">
                        <p style="text-align:left; margin-left:38px;">
						<?php
						if ($mayorista)
							print("");
						else
							// minorista
							print("Si Ud. est&aacute; registrado, ingrese sus datos para continuar con la compra.");
						?>
						</p>
                        <form method="post" action="index.php?module=login">
                            <table class="login" width="50%" style="display: inline-table;">
                                <tr>
                                    <td width="50%" align="right" style="padding-right:5px;">
                                        <label for="user">Correo electrónico:</label>
                                    </td>
                                    <td width="50%" align="left" style="padding-left:5px;">
                                        <input type="text" name="user"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"  style="padding-right:5px;">
                                        <label for="pass">Contrase&ntilde;a:</label>
                                    </td>
                                    <td align="left" style="padding-left:5px;">
                                        <input type="password" name="pass"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"  style="padding-right:5px;">
                                    </td>
                                    <td align="left" style="padding-left:5px;">
                                          <input type="image" src="/imagenes/menu_carrito/ingresar.jpg" value="Ingresar" />
                                    </td>
                                </tr>

				<?php /*
                                <tr>
                                    <td colspan="2">
                                        <span style="font-size:14px; font-weight:bold;">El e-shop se encuentra suspendido.<br />
                                        Disculpe las molestias.</span>
                                    </td>
                                </tr>
                                */ ?>


                            </table>
                            <table width="40%" height="110" style="display: inline-table; font-weight:normal;">
                                <tr>
                                    <td style="vertical-align:middle;">
										<? if(!$mayorista) { ?>
											<p>Si no está registrado, <a href="#" onclick="cerrar('index.php?module=fr_clientes_alta')">complete aquí el formulario</a>.</p>
										<? } ?>
                                        <p>Si olvidó su contrase&ntilde;a, <a href="#" onclick="cerrar('cliente_pw.php')">ingrese aqu&iacute;</a>.</p>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
				<?php
				if (!$mayorista){ ?>
                <table class="menu_abajo">
                    <tr>
                        <td align="center" width="25%"><a href="carrito/carrito_pf_comocomprar.php?i=1">Cómo comprar</a></td>
                        <td align="center" width="25%"><a href="carrito/carrito_pf_comocomprar.php?i=2">Forma de pago</a></td>
                        <td align="center" width="25%"><a href="carrito/carrito_pf_comocomprar.php?i=3">Envío</a></td>
                        <td align="center" width="25%"><a href="carrito/carrito_pf_comocomprar.php?i=4">Devoluciones</a></td>
                    </tr>
                </table>
                <?php } ?>
            </div>

            <?
			if (!$mayorista)
				include("tpl.front_carrito_promociones.php"); ?>

        </div>

    </body>
</html>