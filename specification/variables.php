<?php
  // En este archivo se definen variables globales (o "constantes", como les guste m�s).
  // Si se utilizan varias versiones del sitio web, nunca debe subirse este archivo al servidor
  // para no sobreescribir las variables.

  // El tercer parámetro del define es TRUE para que sea insensible a las mayúsculas.
  define("CONSTANTE_PAIS","Argentina",TRUE);
  //define("CONSTANTE_PAIS","Chile");

  // Monto mínimo de una compra para que permita hacer clic en el botón COMPRAR.
  define("MONTO_MINIMO_DE_COMPRA", 200);
  // Monto mínimo de una compra para que el envío sea gratuito.
  define("MONTO_MINIMO_PARA_ENVIO_GRATIS", 1700);
  // Monto mínimo de una compra para el carrito mayorista.
  define("MONTO_MINIMO_DE_COMPRA_MAYORISTA", 3500);
?>
