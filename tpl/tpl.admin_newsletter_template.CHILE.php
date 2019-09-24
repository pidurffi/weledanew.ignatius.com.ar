<?

$tipoNoticia = array(
					1=>'foco.jpg',
					2=>'profundidad.jpg',
					3=>'tips.jpg',
					4=>'salud.jpg',
					5=>'responsabilidadsocial.jpg'
					);


function mostrarTexto($texto) {

	global $global_fn,$global_ln;

	$texto = str_replace('@nombre',GlobalManager::getTplMng()->getValue('firstName'),$texto);
	$texto = str_replace('@apellido',GlobalManager::getTplMng()->getValue('lastName'),$texto);
	return $texto;

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?=$entity['titulo']?></title>

</head>



<body style = "margin:0; padding:20px 0 0 0;">

<div style = "width:584px; margin:auto;">

	<div style = "width:584px; height:19px; text-align:right;"><h1 style = "font-family:Arial; font-size:14px; color:#1f3c74;"><?=$entity['titulo']?></h1></div>


	<div style = "width:584px; height:156px;">
		<? // Logo de Weleda ?>
		<div style = "float:left; width:584px; height:156px;"><img src = "http://www.ignatius02.com.ar/imagenes/newsletter/topNewsChile_DIC10.jpg" /></div>
	</div>
	

	<div style = "width:584px; height:20px;">

		<a target="_blank" href="http://www.weleda.cl/index.php?module=fr_productos" style = "text-decoration:none; color: #1d3d6e; font-family:Arial; font-size:11px; margin-left:210px;">Productos</a> |

		<a target="_blank" href="http://www.weleda.cl/medicina.php" style = "text-decoration:none; color: #1d3d6e;font-family:Arial; font-size:11px;">Medicina</a> |

		<a target="_blank" href="http://www.weleda.cl/grupoweledafilosofia.php" style = "text-decoration:none; color: #1d3d6e;font-family:Arial; font-size:11px;">Grupo Weleda</a> |

		<a target="_blank" href="http://www.weleda.cl/puntosdeventa.php" style = "text-decoration:none; color: #1d3d6e;font-family:Arial; font-size:11px;">Puntos de Venta</a> |

		<a target="_blank" href="http://www.weleda.cl/index.php?module=fr_noticias" style = "text-decoration:none; color: #1d3d6e;font-family:Arial; font-size:11px;">Noticias</a>

	</div>



	 <!-- encabezado del newsletter-->

	<div style = "margin:20px 0; width:584px;font-family:Arial; color:#1d3d6e; font-size:12px;">
		
		<? /* <p>Querida/o <?php echo mostrarTexto("@nombre"); ?>:<br /> */ ?>
		<?=mostrarTexto($entity['cabecera']) ?></p>

	</div>

	<!-- FIN encabezado del newsletter-->



	<? for($i=1;$i<7;$i++) {
		$titulo = mostrarTexto(trim($entity['noticia_'.$i.'_titulo']));
		$texto = mostrarTexto(trim($entity['noticia_'.$i.'_texto']));
		$link = trim($entity['noticia_'.$i.'_enlace']);
		$tipo = $entity['id_tipo_noticia_'.$i];
		$imagenFile = $entity['imagen_archivo_'.$i];
		$imagenText = $entity['imagen_epigrafe_'.$i];
		if(!empty($tipo)) { $imagenTipoNoticia = $tipoNoticia[$tipo]; } else { $imagenTipoNoticia = ''; }
		$style1 = ($i%2)?"width:584px; height:35px;":"width:584px;text-align:right;";
		$style2 = ($i%2)?"float:left; padding:0 20px 0 20px;width:384px;":"float:left; padding:0 20px 0 20px;width:384px;";
		$style3 = ($i%2)?"width:61px; height:20px;":"width:61px; height:20px; margin-left:305px;";

		if((empty($titulo))&&(empty($texto))&&(empty($link))) continue;
		$fondo = ($i%2)?"fdo_amarillo.jpg":"fdo_azul.jpg";

		?>

		<div class="contenedor_bloque_noticias" style = "width:584px;margin-bottom:20px;">
			<div class="fondo" style = "<?=$style1 ?>"><img src = "http://www.ignatius02.com.ar/imagenes/newsletter/<?=$fondo?>"></img></div>

			<? if($i%2) { ?>
			<div class="imagen" style = "float:left; width:160px; height:160px;"><img width="160" height="160" src = "http://www.ignatius02.com.ar/imagenes/newsletter/<?=$imagenFile?>" /></div>

			<? }else{ ?>
			<div class="imagen" style = "float:right; width:160px; height:160px;"><img width="160" height="160" src = "http://www.ignatius02.com.ar/imagenes/newsletter/<?=$imagenFile?>" /></div>

			<? } ?>

			<div class="contenedor_texto" style = "<?=$style2 ?>">

				<? if( !empty($imagenTipoNoticia) ) { ?>
					<div style = "<?=$style3?>"><img src = "http://www.ignatius02.com.ar/imagenes/newsletter/<?=$imagenTipoNoticia ?>"></img></div>
				<? } ?>

				<h2 style = "margin:5px 0 5px 0; padding:0; font-family:Arial; color:#1e3d73; font-size:14px;"><?=$titulo ?></h2>
				<div style="font-family:Arial; margin:0; padding:0; color:#969697; font-size:11px;">
					<p><?=$texto ?>
						<?	// Muestro el link si no está vacío.
							if($link != "") { ?>
								<a target="_blank" href="<?=$link ?>" style = "text-decoration:none; color:#1d417b; font-weight:bold; font-size:10px;">&gt;&gt; VER MÁS</a>
							<? } ?>
					</p>
				 </div>

			</div>

			<br style="clear:both;"/><!--Tipo CLEARFIX-->

		</div>

	<? } ?>






	<!-- noticias breves -->

	<? // si una de las dos noticias breves está vacía, sale el DIV.
		// Si las dos noticias breves están vacías, no sale el DIV.
	if( !empty($entity['breve_1_titulo']) OR !empty($entity['breve_2_titulo']) )
	{
	?>


	<div style = "width:584px; margin-bottom:20px;">

		<div style = "width:584px; height:35px;"><img src = "http://www.ignatius02.com.ar/imagenes/newsletter/fdo_amarillo.jpg"></img></div>

		<div style = "width:61px; height:20px; margin-left:261px;"><img src = "http://www.ignatius02.com.ar/imagenes/newsletter/breves.jpg" /></div>



			<!--breve izquierda-->

			<div class="bloque_texto_izq" style="float:left; width:292px;">

				<div class="texto_izq" style = "float:left; padding:20px 20px 0 10px;width:162px;">

					<h2 style = "margin:0; padding:0; font-family:Arial; color:#1e3d73; font-size:14px; text-align:right;"><?=mostrarTexto($entity['breve_1_titulo']) ?></h2>
					<div style = "font-family:Arial; margin:0; padding:0; color:#969697; font-size:11px; text-align:right;">
						<p><?=mostrarTexto($entity['breve_1_texto']) ?>
						
							<?	// Muestro el link si no está vacío.
							if($entity['breve_1_enlace']!="") { ?>
								<a target="_blank" href="<?=$entity['breve_1_enlace'] ?>" style = "text-decoration:none; color:#1d417b; font-weight:bold; font-size:10px;">&gt;&gt; VER MÁS</a>
							<? } ?>
						</p>
					</div>

				</div>

				<div style = "padding:10px 15px 0 0 ; float:left;width:85px;/*background-color:#333333;*/"><img src = "http://www.ignatius02.com.ar/imagenes/newsletter/<?=$entity['breve_imagen_archivo_1']?>"/></div>

			</div>

			<!--FIN breve izquierda-->



		<!--<div style = "float:left; width:8px; height:212px;"><img src = "http://www.weleda.com.ar/newsletter-200907/imagenes/linea_banner.jpg" height="210" width="8"></img></div>-->



			<!--breve derecha-->

			<div class="bloque_texto_der" style="float:left; width:292px;/*background-color:#00FFFF;*/">

				<div style = "padding:10px 0 0 15px; float:left;width:85px;/*background-color:#666666;*/">

					<img src = "http://www.ignatius02.com.ar/imagenes/newsletter/<?=$entity['breve_imagen_archivo_2']?>"></img></div>

				<div class="texto_der" style = "float:left; padding:20px 10px 0 20px;width:162px;">

					<h2 style = "margin:0; padding:0; font-family:Arial; color:#1e3d73; font-size:14px;"><?=mostrarTexto($entity['breve_2_titulo']) ?></h2>

					<div style = "font-family:Arial; margin:0; padding:0; color:#969697; font-size:11px;">
					<p><?=mostrarTexto($entity['breve_2_texto']) ?>
					
						<?	// Muestro el link si no está vacío.
							if($entity['breve_2_enlace']!="") { ?>
							<a target="_blank" href="<?=$entity['breve_2_enlace'] ?>" style = "text-decoration:none; color:#1d417b; font-weight:bold; font-size:10px;">&gt;&gt; VER MÁS</a>
						<? } ?>
					</p>
					</div>

				</div>

			</div>

			<!--FIN breve derecha-->

			<br style="clear:both;"/><!--Tipo CLEARFIX-->

	</div>

	<? } // fin IF de noticias breves vacías ?>









	<!--<div style = "padding:24px 28px 0 28px; width:584px;widt\h:528px; height:163px;heigh\t:139px; background-color:#2aa7df;">

		<p style = "font-family:Arial; margin:0; padding:0; color:#ffffff; font-size:12px;"><?=mostrarTexto($entity['pie']) ?></p>

	</div>-->

	<div style = "padding:20px;width:544px;background-color:#2aa7df;">

		<p style = "font-family:Arial; margin:0; padding:0; color:#ffffff; font-size:12px;">Por consultas, sugerencias o inconvenientes técnicos escribanos a <a style = "text-decoration:none; font-family:Arial; font-size:13px; color:#96d7eb;" href="mailto:info@weleda.cl">info@weleda.cl</a></p>

		<p style = "font-family:Arial; margin:20px 0 0 0; padding:0; color:#ffffff; font-size:12px;">Si Ud. no desea recibir más comunicaciones de Weleda, por favor envíe un mensaje a <a style = "text-decoration:none; font-family:Arial; font-size:13px; color:#96d7eb;" href="mailto:unsubscribe@weleda.cl">unsubscribe@weleda.cl</a> </p>

		<p style = "font-family:Arial; margin:20px 0 0 0; padding:0; color:#ffffff; font-size:12px;">Copyright Weleda Chile Ltda. | Todos los derechos reservados</p>

	</div>



</div>





</body>

</html>