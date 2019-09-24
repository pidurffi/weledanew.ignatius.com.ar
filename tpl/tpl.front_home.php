<?php
$inicio = "1";
include(TPL_FOLDER."tpl.front_template_arriba_nature.php");
?>

  <!-- Intro -->
  <div class="owl-carousel slider-intro">
    <div class="slider-intro__item --item-001" style="background-image:url(../images/home_carrusel_01.jpg)"></div>
    <div class="slider-intro__item --item-002"></div>
  </div>
  
  <!-- Simple Text -->
  <section class="section simple-text">
    <div class="container">
      <h2 class="section__title">Todo lo que sos tiene su complemento en la naturaleza.</h2>
      <p class="section__description">La naturaleza está en nosotros; somos parte de ella. Compartimos los mismos orígenes; crecemos, nos desarrollamos, florecemos. Una mirada en profundidad nos revela que las plantas y los seres humanos tienen muchas similitudes. Es por eso que nada nos hace ver y sentir mejor que reconectarnos con el poder de la naturaleza.</p>
    </div>
  </section>

  <!-- Simple Text -->
  <section class="section simple-text">
    <div class="container">
      <h2 class="section__title">Vos y la naturaleza: ¡hacen match!</h2>
      <p class="section__description">Descubrí lo realmente conectado que estás con la naturaleza.</p>
    </div>
  </section>

  <!-- Video -->
  <div class="section video">
    <div class="container">
      <div class="video__wrapper">
        <!-- <a class="video__wrapper__button"></a> -->
        <iframe class="video__wrapper__iframe" id="2n9mLmlOTc4" frameborder="0" allowfullscreen="1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" title="YouTube video player" width="640" height="360" src="https://www.youtube-nocookie.com/embed/2n9mLmlOTc4?controls=0&showinfo=0&rel=0&enablejsapi=1&origin=https%3A%2F%2Fwww-weledaint.hosting.onehippo.com&widgetid=1&autoplay=0"></iframe>
      </div>
    </div>
  </div>

  <!-- Newsletter -->
  <section class="section newsletter">
    <div class="container">
      <div class="newsletter__wrapper">
        <div class="newsletter__description">
          <h3 class="newsletter__description__title">Conectate con nosotros para reconectarte con la naturaleza</h3>
          <p class="newsletter__description__text">Suscribite a nuestro newsletter para recibir descuentos exclusivos, recomendaciones para el cuidado de la piel y ¡muchos otros beneficios!</p>
          <a href="index.php?module=fr_clientes_alta" class="newsletter__description__button">Quiero suscribirme</a>
        </div>
        <div class="newsletter__image"></div>
      </div>
    </div>
  </section>

  <!-- Text & Image -->
  <section class="section tai">
    <div class="container">
      <div class="tai__wrapper">
        <div class="tai__description --left">
          <h3 class="tai__description__title">Utilizamos el poder de la naturaleza desde 1921</h3>
          <p class="tai__description__text">Como pionera en la agricultura biodinámica, Weleda es una marca de belleza green mucho antes de que el concepto estuviera de moda. Desde hace décadas nos mantenemos fieles a nuestros principios creando medicinas y productos de belleza con ingredientes puramente naturales, partiendo desde una visión holística. Utilizamos las mismas recetas originales y auténticas que nutren, reviven y cuidan el alma y el cuerpo.</p>
        </div>
        <figure class="tai__image">
          <img src="images/desde1921.jpg" alt="">
        </figure>
      </div>
      <div class="tai__wrapper">
        <figure class="tai__image">
          <img src="images/creer.png" alt="">
        </figure>
        <div class="tai__description --right">
          <h3 class="tai__description__title">Volver a creer en la naturaleza</h3>
          <p class="tai__description__text">Nuestros principios se basan en la antroposofía de Rudolf Steiner y en la creencia de que el cuerpo tiene la capacidad de curarse a sí mismo con el apoyo de la naturaleza. Nuestras extraordinarias fórmulas con ingredientes naturales brindan un apoyo a los procesos naturales del cuerpo. Esto es lo que hace único a Weleda.</p>
        </div>
      </div>
      <div class="tai__wrapper">
        <div class="tai__description --left">
          <h3 class="tai__description__title">Plantas cuidadosamente seleccionadas</h3>
          <p class="tai__description__text">La flor de rosa, por ejemplo, con sus diversas variedades y aromas, es conocida como la reina de todas las flores. Uno de los aceites más efectivos para suavizar la piel es el de la rosa mosqueta, que se usa en nuestra Línea Facial y Corporal de Rosa Mosqueta, mientras que el hermoso aroma de la rosa damascena armoniza y relaja el cuerpo y el alma.</p>
        </div>
        <figure class="tai__image">
          <img src="images/rosamosqueta.jpg" alt="">
        </figure>
      </div>
    </div>
  </section>

  <!-- Parallax -->
  <section class="section parallax"></section>
  

  <!-- Best Sellers -->
  <?php
  // Traigo productos destacados
  $sql = "SELECT producto.id, producto.foto, producto.foto_listado,
				producto.nombre, producto.subtitulo, producto.precio,
				producto.id_linea, producto.id_familia_directa, linea.id_familia
		FROM producto
		LEFT JOIN linea ON producto.id_linea = linea.id
		WHERE producto.id IN (88,109,25,29,27,28,30)";
	$res = GlobalManager::getDb()->execute($sql);
  ?>
    <section class="section best-sellers">
    <div class="container">
      <h2 class="section__title">Shop our best sellers</h2>
      <p class="section__description">Revive your skin and create a self care routine with our most loved products.</p>
      <div class="owl-carousel slider-best-sellers">

	  <?php while($prod = GlobalManager::getDb()->getRow($res))
		{ 
		// Preparo el link al producto.
		if($prod['id_familia_directa']==NULL)
		{
			$link_producto = "index.php?module=fr_producto&id=" . $prod["id"] . "&id_linea=" . $prod["id_linea"] . "&id_familia=" . $prod["id_familia"];
		}
		else
		{
			$link_producto="index.php?module=fr_producto_suelto&id=" . $prod['id'];
		}
	?>
		<div class="best-sellers__item">
          <img class="best-sellers__item__image" src="imagenes/productos/<?= $prod['foto'] ?>" alt="">
          <h3 class="best-sellers__item__title"><?= $prod['nombre'] ?></h3>
          <p class="best-sellers__item__description"><?= utf8_encode($prod['subtitulo']) ?></p>
          <span class="best-sellers__item__quantity">&nbsp;</span>
          <span class="best-sellers__item__price">
            <span class="best-sellers__item__price__discount"></span>
            <span class="best-sellers__item__price__current"><?= "$ ".number_format($prod['precio'], 2, ',', '.') ?></span>
          </span>
          <a href="<?= $link_producto ?>" class="button best-sellers__item__button">Ver producto</a>
        </div>
		
		<?php }	?>
		
		</div>
    </div>
  </section>
  
  

  <!-- Quality -->
  <section class="section quality">
    <h2 class="section__title">Clean beauty you can trust</h2>
    <p class="section__description">We believe in nature’s ability to help you feel healthy, balanced, and beautiful. Our products are thoughtfully crafted to harness the vitality of nature and work in harmony with your body’s own restorative abilities. We are committed to building farming partnerships that honor the human spirit and respect the natural world.</p>
    <a href="" class="quality__button">Discover more <i class="fas fa-chevron-right"></i></a>
    <div class="quality__icons">
      <div class="quality__icons__item">
        <img class="quality__icons__item__icon" src="images/quality-icons/natural-care.png" alt="">
        <p class="quality__icons__item__description">Certified Natural Skincare by NATURE</p>
      </div>
      <div class="quality__icons__item">
        <img class="quality__icons__item__icon" src="images/quality-icons/no-mineral-oil.png" alt="">
        <p class="quality__icons__item__description">Free from parabens and phthalates</p>
      </div>
      <div class="quality__icons__item">
        <img class="quality__icons__item__icon" src="images/quality-icons/no-synthetic.png" alt="">
        <p class="quality__icons__item__description">Free from synthetic preservatives and fragrances</p>
      </div>
      <div class="quality__icons__item">
        <img class="quality__icons__item__icon" src="images/quality-icons/no-animal-testing.png" alt="">
        <p class="quality__icons__item__description">No animal testing</p>
      </div>
      <div class="quality__icons__item">
        <img class="quality__icons__item__icon" src="images/quality-icons/organic.png" alt="">
        <p class="quality__icons__item__description">Farming partnerships</p>
      </div>
      <div class="quality__icons__item">
        <img class="quality__icons__item__icon" src="images/quality-icons/responsible.png" alt="">
        <p class="quality__icons__item__description">Ethical sourcing with respect for people and biodiversity</p>
      </div>
    </div>
  </section>

  <!-- Shop by category -->
  <section class="section shop-category">
    <div class="container">
      <h2 class="section__title">Shop by category</h2>
      <p class="section__description">Nourish your skin your rich plant oils that brighten your spirir and calm your mind. Experience our full range of plant-rick skincare.</p>
      <div class="shop-category__grid">
        <div class="shop-category__item">
          <a href="">
            <figure class="shop-category__item__image">
              <img src="https://weledaint-prod.global.ssl.fastly.net/binaries/content/gallery/us-en/homepage/content-images/facecategoryphoto.jpg" alt="">
            </figure>
            <div class="shop-category__item__title">Face Care</div>
          </a>
        </div>
        <div class="shop-category__item">
          <a href="">
            <figure class="shop-category__item__image">
              <img src="https://weledaint-prod.global.ssl.fastly.net/binaries/content/gallery/us-en/homepage/content-images/facecategoryphoto.jpg" alt="">
            </figure>
            <div class="shop-category__item__title">Face Care</div>
          </a>
        </div>
        <div class="shop-category__item">
          <a href="">
            <figure class="shop-category__item__image">
              <img src="https://weledaint-prod.global.ssl.fastly.net/binaries/content/gallery/us-en/homepage/content-images/facecategoryphoto.jpg" alt="">
            </figure>
            <div class="shop-category__item__title">Face Care</div>
          </a>
        </div>
        <div class="shop-category__item">
          <a href="">
            <figure class="shop-category__item__image">
              <img src="https://weledaint-prod.global.ssl.fastly.net/binaries/content/gallery/us-en/homepage/content-images/facecategoryphoto.jpg" alt="">
            </figure>
            <div class="shop-category__item__title">Face Care</div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- News -->
  <section class="section news">
    <div class="container">
      <h2 class="section__title">Discover what's new</h2>
      <p class="section__description">Revive your skin and create a self care routine with our most loved products.</p>
      <div class="owl-carousel slider-news">
        <div class="news__item">
          <figure class="news__item__image">
            <img src="https://weledaint-prod.global.ssl.fastly.net/binaries/content/gallery/us-en/content/imageofweledaproducts_salepage_contentmodudle.png" alt="">
          </figure>
          <h3 class="news__item__title">Weleda and TerraCycle</h3>
          <p class="news__item__description">We’ve partnered with TerraCycle® to bring you the Weleda Recycling Program for the Skin Food Experience.</p>
          <a href="" class="news__item__button">Read more <i class="fas fa-chevron-right"></i></a>
        </div>
        <div class="news__item">
          <figure class="news__item__image">
            <img src="https://weledaint-prod.global.ssl.fastly.net/binaries/content/gallery/us-en/content/imageofweledaproducts_salepage_contentmodudle.png" alt="">
          </figure>
          <h3 class="news__item__title">Weleda and TerraCycle</h3>
          <p class="news__item__description">We’ve partnered with TerraCycle® to bring you the Weleda Recycling Program for the Skin Food Experience.</p>
          <a href="" class="news__item__button">Read more <i class="fas fa-chevron-right"></i></a>
        </div>
        <div class="news__item">
          <figure class="news__item__image">
            <img src="https://weledaint-prod.global.ssl.fastly.net/binaries/content/gallery/us-en/content/imageofweledaproducts_salepage_contentmodudle.png" alt="">
          </figure>
          <h3 class="news__item__title">Weleda and TerraCycle</h3>
          <p class="news__item__description">We’ve partnered with TerraCycle® to bring you the Weleda Recycling Program for the Skin Food Experience.</p>
          <a href="" class="news__item__button">Read more <i class="fas fa-chevron-right"></i></a>
        </div>
        <div class="news__item">
          <figure class="news__item__image">
            <img src="https://weledaint-prod.global.ssl.fastly.net/binaries/content/gallery/us-en/content/imageofweledaproducts_salepage_contentmodudle.png" alt="">
          </figure>
          <h3 class="news__item__title">Weleda and TerraCycle</h3>
          <p class="news__item__description">We’ve partnered with TerraCycle® to bring you the Weleda Recycling Program for the Skin Food Experience.</p>
          <a href="" class="news__item__button">Read more <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
    </div>
  </section>

  <!-- Share -->
  <div class="share">
    <h3 class="share__title">Share this article</h3>
    <ul class="share__list">
      <li class="share__list__item">
        <a class="share__list__item__icon" href=""><i class="fab fa-facebook-f"></i></a>
      </li>
      <li class="share__list__item">
        <a class="share__list__item__icon" href=""><i class="fab fa-pinterest-p"></i></a>
      </li>
      <li class="share__list__item">
        <a class="share__list__item__icon" href=""><i class="fas fa-envelope"></i></a>
      </li>
    </ul>
  </div>


<?php  include(TPL_FOLDER."tpl.front_template_abajo_nature.php");
 ?>