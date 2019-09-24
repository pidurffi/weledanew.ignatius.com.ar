<div class="destacado_col_izq clearfix">

		<?

			$titulo_banner = "";

			$imagen_banner = "";

			$descripcion_banner = "";

			$link_banner = "";

			$destacado_producto = FALSE;



			if(!empty($producto['titulo_banner'])) {

				$titulo_banner = htmlentities($producto['titulo_banner']);

				$imagen_banner = $producto['foto_banner'];

				$descripcion_banner = $producto['descripcion_banner'];

				$link_banner = "";

				// La imagen podría ser grande cuando el rectángulo de la izquierda es un producto.

				$destacado_producto = TRUE;

			}

			else {

				if(!empty($producto_suelto['titulo_banner'])) {

					$titulo_banner = htmlentities($familia["titulo_banner"]);

					$imagen_banner = $familia["foto_banner"];

					$descripcion_banner = $familia["descripcion_banner"];

					$link_banner = $familia["link_banner"];

				}

				else {

					$titulo_banner = htmlentities($linea["titulo_banner"]);

					$imagen_banner = $linea["foto_banner"];

					$descripcion_banner = $linea["descripcion_banner"];

					$link_banner = $linea["link_banner"];
					

				}

			}

		?>



			<div class="encabezado_destacado clearfix">

				<div class="tit_destacado clearfix">

					<h4><?=$titulo_banner?></h4>

				</div>

				<?

				if(!$destacado_producto)

				{

				?>

					<div class="img_destacado clearfix">

						<? if(!empty($imagen_banner))  { ?>

						<img src="imagenes/productos/<?=$imagen_banner?>" />

						<? } ?>

					</div>

				<?

				}

				else

				{

				?>

					<div style="width:170px; float:left;">

						<? if(!empty($imagen_banner))  { ?>

						<img src="imagenes/productos/<?=$imagen_banner?>" />

						<? } ?>

					</div>

				<?

				}

				?>

			</div>

			<div class="texto_destacado clearfix" style="float:left;">

				<?=$descripcion_banner?>

					<? if(!empty($link_banner)) { ?>

					<a href="./<?=$link_banner?>">ver m&aacute;s info</a>

					<? } ?>



			</div>



</div>

<div style="padding-top:10px; margin-left:6px; width:171px;" class="clearfix">

<?

	if(!empty($linea['foto_enlace']))

	{

		// si es TRUE el campo nueva_ventana_foto_enlace, el link se debe abrir en una nueva ventana

		if($linea['nueva_ventana_foto_enlace'])

			{ $target = "target='_BLANK'"; }

		else { $target=""; }

	?>

		<a href="<?=$linea["link_foto_enlace"]?>" <?=$target;?>><img src="imagenes/productos/<?=$linea["foto_enlace"]?>" border="0" /></a>

	<?

	}

?>

</div>