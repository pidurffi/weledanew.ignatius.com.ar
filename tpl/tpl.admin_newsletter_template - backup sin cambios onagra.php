<?php
$tipoNoticia = array(
    1 => 'foco.jpg',
    2 => 'profundidad.jpg',
    3 => 'tips.jpg',
    4 => 'salud.jpg',
    5 => 'responsabilidadsocial.jpg',
    6 => 'estilodevida.jpg',
    7 => 'bellezanatural.jpg',
    8 => 'vidaverde.jpg',
    9 => 'tipweleda.jpg',
    10 => 'promo.jpg',
    11 => 'sorteo.jpg',
    12 => 'actualidad.jpg'
);

function mostrarTexto($texto) {

    global $global_fn, $global_ln;

    $texto = str_replace('@nombre', GlobalManager::getTplMng()->getValue('firstName'), $texto);
    $texto = str_replace('@apellido', GlobalManager::getTplMng()->getValue('lastName'), $texto);

    return $texto;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?= $entity['titulo'] ?></title>
    </head>
    <body style = "margin:0; padding:20px 0 0 0;">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
                <td align="center">
                    <table cellspacing="0" cellpadding="0" border="0" width="584">
                        <tr>
                            <td style = "width:584px; height:19px; text-align:right;">
                                <h1 style = "font-family:Arial; font-size:18px; color:#1f3c74;"><?= $entity['titulo'] ?></h1>
                            </td>
                        </tr>
                        <tr>
                            <td style = "width:584px; height:156px;">
                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
		                             <tr>
                                        <td>
                                            <? // Logo de Weleda   ?>
                                            <img src="http://www.weleda.com.ar/imagenes/newsletter/TopNews_izq_DIC14.jpg" />
                                        </td>
                                        <td>
                                            <? // Imagen a la derecha del logo de Weleda.  ?>
                                            <img src="http://www.weleda.com.ar/imagenes/newsletter/TopNews_der_DIC14.jpg" />
                                        </td>
                                    </tr>
		                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style = "width:584px; height:20px; padding-bottom:10px; text-align:left; padding-left:205px; font-size:10px;">
                                <a target="_blank" href="http://www.weleda.com.ar/index.php?module=fr_productos" style = "text-decoration:none; color: #1d3d6e; font-family:Arial; font-size:10px;">Productos</a>&nbsp;|&nbsp;
                                <a target="_blank" href="http://www.weleda.com.ar/medicina.php" style = "text-decoration:none; color: #1d3d6e;font-family:Arial; font-size:10px;">Medicina</a>&nbsp;|&nbsp;
                                <a target="_blank" href="http://www.weleda.com.ar/grupoweledafilosofia.php" style = "text-decoration:none; color: #1d3d6e;font-family:Arial; font-size:10px;">Grupo Weleda</a>&nbsp;|&nbsp;
                                <a target="_blank" href="http://www.weleda.com.ar/puntosdeventa.php" style = "text-decoration:none; color: #1d3d6e;font-family:Arial; font-size:10px;">Puntos de Venta</a>&nbsp;|&nbsp;
                                <a target="_blank" href="http://www.weleda.com.ar/index.php?module=fr_noticias" style = "text-decoration:none; color: #1d3d6e;font-family:Arial; font-size:10px;">Actualidad Weleda</a>
                            </td>
                        </tr>
                        <!-- encabezado del newsletter-->
                        <tr>
                            <td style = "margin:20px 0; width:584px; font-family:Arial; color:#1d3d6e; font-size:15px; text-align:left;">
                                <? /* <p>Querida/o <?php echo mostrarTexto("@nombre"); ?>:<br /> */ ?>
                                <?= mostrarTexto($entity['cabecera']) ?>
                            </td>
                        </tr>
                        <!-- FIN encabezado del newsletter-->
                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0" border="0">
                                    <?
                                    for ($i = 1; $i < 7; $i++) {
                                        $titulo = mostrarTexto(trim($entity['noticia_' . $i . '_titulo']));
                                        $texto = mostrarTexto(trim($entity['noticia_' . $i . '_texto']));
                                        $link = trim($entity['noticia_' . $i . '_enlace']);
                                        $tipo = $entity['id_tipo_noticia_' . $i];
                                        $imagenFile = $entity['imagen_archivo_' . $i];
                                        $imagenText = $entity['imagen_epigrafe_' . $i];
                                        if (!empty($tipo)) {
                                            $imagenTipoNoticia = $tipoNoticia[$tipo];
                                        } else {
                                            $imagenTipoNoticia = '';
                                        }
                                        $style1 = ($i % 2) ? "width:584px; height:35px;" : "width:584px;text-align:right;";
                                        $style2 = ($i % 2) ? "padding:0 20px 0 20px;width:384px;" : "padding:0 20px 0 20px;width:384px;";
                                        $style3 = ($i % 2) ? "width:61px; height:20px; padding-bottom:5px;" : "width:61px; height:20px; padding-bottom:5px;";

                                        if ((empty($titulo)) && (empty($texto)) && (empty($link)))
                                            continue;
                                        $fondo = ($i % 2) ? "fdo_amarillo.jpg" : "fdo_azul.jpg";
                                        ?>
                                        <tr>
                                            <td style="width:584px; margin-bottom:20px; padding-top:10px;">
                                                <img src = "http://www.weleda.com.ar/imagenes/newsletter/<?= $fondo ?>"></img>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <table cellspacing="0" cellpadding="0" border="0">
                                                    <tr>
                                                        <? if ($i % 2) { ?>
                                                            <td width="160" style="padding-right:20px; vertical-align: top;" valign="top"><img width="160" height="160" src = "http://www.weleda.com.ar/imagenes/newsletter/<?= $imagenFile ?>" /></td>
                                                            <td width="384" style="text-align:left;">
                                                                <? if (!empty($imagenTipoNoticia)) { ?>
                                                                    <div style = "<?= $style3 ?>"><img src = "http://www.weleda.com.ar/imagenes/newsletter/<?= $imagenTipoNoticia ?>"></img></div>
                                                                <? } ?>
                                                                <h2 style = "margin:5px 0 5px 0; padding:0; font-family:Arial; color:#1e3d73; font-size:16px;"><?= $titulo ?></h2>
                                                                <div style="font-family:Arial; margin:0; padding:0; color:#969697; font-size:15px;">
                                                                    <p><?= $texto ?>
                                                                        <?
                                                                        // Muestro el link si no está vacío.
                                                                        if ($link != "") {
                                                                            ?>
                                                                            <a target="_blank" href="<?= $link ?>" style = "text-decoration:none; color:#1d417b; font-weight:bold; font-size:10px;">&gt;&gt; VER M&Aacute;S</a>
                                                                        <? } ?>
                                                                    </p>
                                                                </div>
                                                            </td>
                                                        <? } else { ?>
                                                            <td width="384" style="text-align:left; padding-left:10px;">
                                                                <? if (!empty($imagenTipoNoticia)) { ?>
                                                                    <div style = "<?= $style3 ?>"><img src = "http://www.weleda.com.ar/imagenes/newsletter/<?= $imagenTipoNoticia ?>"></img></div>
                                                                <? } ?>
                                                                <h2 style = "margin:5px 0 5px 0; padding:0; font-family:Arial; color:#1e3d73; font-size:16px;"><?= $titulo ?></h2>
                                                                <div style="font-family:Arial; margin:0; padding:0; color:#969697; font-size:15px;">
                                                                    <p><?= $texto ?>
                                                                        <?
                                                                        // Muestro el link si no está vacío.
                                                                        if ($link != "") {
                                                                            ?>
                                                                            <a target="_blank" href="<?= $link ?>" style = "text-decoration:none; color:#1d417b; font-weight:bold; font-size:10px;">&gt;&gt; VER M&Aacute;S</a>
                                                                        <? } ?>
                                                                    </p>
                                                                </div>
                                                            </td>
                                                            <td width="160" style="padding-left:20px; vertical-align: top;" valign="top"><img width="160" height="160" src = "http://www.weleda.com.ar/imagenes/newsletter/<?= $imagenFile ?>" /></td>
                                                        <? } ?>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    <? } ?>
                                </table>
                            </td>
                        </tr>

                        <!-- noticias breves -->
                        <?
// si una de las dos noticias breves est� vac�a, sale el DIV.
// Si las dos noticias breves est�n vac�as, no sale el DIV.
                        if (!(empty($entity['breve_1_titulo']) AND empty($entity['breve_2_titulo']) )) {
                            ?>
                            <tr><td style = "width:584px; height:35px; padding-top:10px;"><img src = "http://www.weleda.com.ar/imagenes/newsletter/fdo_amarillo.jpg"></img></td></tr>
							<? // <tr><td style = "width:584px; height:20px; padding-bottom:20px; padding-left:261px;"><img src = "http://www.weleda.com.ar/imagenes/newsletter/breves.jpg" /></td></tr> ?>
                            <tr>
                                <td style = "width:584px; padding-bottom:20px;">
                                    <table cellspacing="0" cellpadding="0" border="0">
										<tr><? for ($i=1;$i<=2;$i++) { ?>
											<td colspan="2" style="text-align:center; padding-bottom:15px;"><? if (!empty($entity['id_tipo_noticia_breve_'.$i])) {
													$imagenTipoNoticia = $tipoNoticia[$entity['id_tipo_noticia_breve_'.$i]];
												} else {
													$imagenTipoNoticia = '';
												}
										
												if (!empty($imagenTipoNoticia)) { ?>
													<img src = "http://www.weleda.com.ar/imagenes/newsletter/<?= $imagenTipoNoticia ?>"></img>
												<? } ?>
											</td>
										<? } ?></tr>
                                        <tr>
                                            <? /* Texto breve 1 */ ?>
                                            <td width="190"  style = "padding:0px; vertical-align:top;" valign="top">
                                                <h2 style = "margin:0; padding:0; font-family:Arial; color:#1e3d73; font-size:16px; text-align:right;"><?= mostrarTexto($entity['breve_1_titulo']) ?></h2>
                                                <div style = "font-family:Arial; margin:0; padding:0; color:#969697; font-size:15px; text-align:right;">
                                                    <p><?= mostrarTexto($entity['breve_1_texto']) ?>
                                                        <?
                                                        // Muestro el link si no est� vac�o.
                                                        if ($entity['breve_1_enlace'] != "") {
                                                            ?>
                                                            <a target="_blank" href="<?= $entity['breve_1_enlace'] ?>" style = "text-decoration:none; color:#1d417b; font-weight:bold; font-size:10px;">&gt;&gt; VER M&Aacute;S</a>
                                                        <? } ?>
                                                    </p>
                                                </div>
                                            </td>
                                            <? /* Imagen breve 1 */ ?>
                                            <td width="85" style = "padding:10px; vertical-align:top;" valign="top">
                                                <img src = "http://www.weleda.com.ar/imagenes/newsletter/<?= $entity['breve_imagen_archivo_1'] ?>"/>
                                            </td>
                                            <? /* Imagen breve 2 */ ?>
                                            <td width="85" style = "padding:10px; vertical-align:top;" valign="top">
                                                <img src = "http://www.weleda.com.ar/imagenes/newsletter/<?= $entity['breve_imagen_archivo_2'] ?>"></img>
                                            </td>
                                            <? /* Texto breve 2 */ ?>
                                            <td width="190" style = "padding:0px; vertical-align:top;" valign="top"> 
                                                <h2 style = "margin:0; padding:0; font-family:Arial; color:#1e3d73; font-size:16px;"><?= mostrarTexto($entity['breve_2_titulo']) ?></h2>

                                                <div style = "font-family:Arial; margin:0; padding:0; color:#969697; font-size:15px; text-align:left;">
                                                    <p><?= mostrarTexto($entity['breve_2_texto']) ?>

                                                        <?
                                                        // Muestro el link si no est� vac�o.
                                                        if ($entity['breve_2_enlace'] != "") {
                                                            ?>
                                                            <a target="_blank" href="<?= $entity['breve_2_enlace'] ?>" style = "text-decoration:none; color:#1d417b; font-weight:bold; font-size:10px;">&gt;&gt; VER M&Aacute;S</a>
                                                        <? } ?>
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>

                        <? } // fin IF de noticias breves vac�as   ?>
                        <!--<div style = "padding:24px 28px 0 28px; width:584px;widt\h:528px; height:163px;heigh\t:139px; background-color:#2aa7df;">
                                        <p style = "font-family:Arial; margin:0; padding:0; color:#ffffff; font-size:12px;"><?= mostrarTexto($entity['pie']) ?></p>
                            </div>-->

                        <tr>
                            <td style = "padding:20px;width:544px;background-color:#2aa7df;">
                                <table cellpadding="10" cellspacing="0" border="0">
                                    <tr>
                                        <td valign="top" align="center">
                                            <span style="color:#FFFFFF; font-size:12px;">Seguinos en</span><br />
                                            <a href="https://www.facebook.com/weledaargentina">
                                                <img src="http://www.weleda.com.ar/imagenes/newsletter/facebook_logo.jpg" border="0" title="Seguinos en Facebook" style="padding-top:5px;" />
                                            </a>
                                        </td>
                                        <td>
                                            <p style = "font-family:Arial; margin:0; padding:0; color:#ffffff; font-size:12px;">Por consultas, sugerencias o inconvenientes t&eacute;cnicos escribanos a <a style = "text-decoration:none; font-family:Arial; font-size:13px; color:#96d7eb;" href="mailto:info@weleda.com.ar">info@weleda.com.ar</a></p>
                                            <p style = "font-family:Arial; margin:20px 0 0 0; padding:0; color:#ffffff; font-size:12px;">Este mensaje y la lista de suscriptores a que es enviado cumple con lo establecido en la Ley No. 25.326 Art. 27 Inc. 3 (Ley de "Habeas Data") de la Rep&uacute;blica Argentina.</p>
                                            <p style = "font-family:Arial; margin:20px 0 0 0; padding:0; color:#ffffff; font-size:12px;">Copyright 2013 Weleda S.A | Todos los derechos reservados</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                </td>
            </tr>
        </table>
    </body>
</html>