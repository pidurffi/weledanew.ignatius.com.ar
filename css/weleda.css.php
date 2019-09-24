@font-face {
	font-family: 'neo sans normal';
	src: url('/files/neosansweleda-rg.eot');
	src: local('?'),
	    url('/files/neosansweleda-rg.ttf') format('truetype'),
	    url('/files/neosansweleda-rg.woff') format('woff'),
	    url('/files/neosansweleda-rg.svg') format('svg');
	font-weight: normal;
	font-style: normal;
}

@font-face {
	font-family: 'neo sans medium';
	src: url('/files/neosansweleda-rg.eot');
	src: local('?'),
	    url('/fonts/neosansweleda-md.ttf') format('truetype'),
	    url('/fonts/neosansweleda-md.woff') format('woff'),
	    url('/fonts/neosansweleda-md.svg') format('svg');
	font-weight: normal;
	font-style: normal;
}


<?
$entityManager = new EntityManager("EntityHome", array());

$entityManager->prepareFields();

$list = $entityManager->find(true, "id = '1'");

$home = $list[0];
?>



/* CSS Document */



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

font-family:Verdana, Arial, Helvetica, sans-serif;

font-size:10px;

color:#939598;

}



a {color:#FF9933;}



div#contenedor {



margin:auto;



width:768px;



background-image:url('./imagenes/estructura/fdo_contenedor.jpg');



}







div#encabezado_inicio {

width:768px;

height:344px;



background-image:url('./imagenes/home/<?= $home['foto_grande'] ?>');



}



div#encabezado {

width:768px;

height:204px;

}		



div#encabezado_izq {

float:left;

padding:19px 0 0 45px;

width:180px;widt\h:135px;

height:204;heigh\t:185px;

}	



div#encabezado_izq a {

display:block;

width:86px;

height:73px;

}



div#encabezado_der {

float:left;

width:588px;

}



div#encabezado_inicio h1 {display:none;}



div#encabezado h1 {display:none;}	



div#cuerpo {

margin-left:202px;



width:558px;



}







div#contenido {



padding:14px 26px 25px 22px;

width:558px;widt\h:510px;

}







div#contenido div.tit_contenido {margin:0 0 23px 1px;}	



div#contenido div.tit_contenido h4 {display:none;}







/* TODO LO DINAMICO LO SACO DE ACA Y VA A PARAR A DINAMICO */



div#contenido div.tit_contenido.productos {



width:94px;



height:21px;



background-image:url('./imagenes/contenido/tit_productos.jpg');



}



div#contenido div.tit_contenido.mayoristas {



width:310px;



height:28px;



background-image:url('./imagenes/estructura/farmacias/tit_distrib.jpg');



}











div#contenido div.tit_contenido.cuidados_faciales {



width:180px;



height:25px;



background-image:url('./imagenes/contenido/tit_cuidados_faciales.jpg');



background-repeat:no-repeat;



}	







div#contenido div.tit_contenido.linea_iris {



margin:0 0 0 1px;



width:111px;



height:25px;



/* background-image:url('./imagenes/contenido/tit_linea_iris.jpg'); */



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.noche_iris {



margin:0 0 0 1px;



width:227px;



height:20px;



background-image:url('./imagenes/contenido/linea_iris/tit_crema_noche.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.dia_iris {



margin:0 0 0 1px;



width:197px;



height:20px;



background-image:url('./imagenes/contenido/linea_iris/tit_crema_dia.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.hidratante_iris {



margin:0 0 0 1px;



width:314px;



height:20px;



background-image:url('./imagenes/contenido/linea_iris/tit_hidratante_iris.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.limpiadora_class_iris {



margin:0 0 0 1px;



width:312px;



height:20px;



background-image:url('./imagenes/contenido/linea_iris/tit_limpiadora_class_iris.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.tonica_iris {



margin:0 0 0 1px;



width:200px;



height:20px;



background-image:url('./imagenes/contenido/linea_iris/tit_tonica_iris.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.limpiadora_iris {



margin:0 0 0 1px;



width:235px;



height:20px;



background-image:url('./imagenes/contenido/linea_iris/tit_limpiadora_iris.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.perlas_mosqueta {



margin:0 0 0 1px;



width:226px;



height:20px;



background-image:url('./imagenes/contenido/linea_mosqueta/tit_perlas.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.mascara_mosqueta {



margin:0 0 0 1px;



width:266px;



height:44px;



background-image:url('./imagenes/contenido/linea_mosqueta/tit_mascara_mosqueta.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.noche_mosqueta {



margin:0 0 0 1px;



width:313px;



height:20px;



background-image:url('./imagenes/contenido/linea_mosqueta/tit_noche_mosqueta.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.hidratante_mosqueta {



margin:0 0 0 1px;



width:327px;



height:20px;



background-image:url('./imagenes/contenido/linea_mosqueta/tit_hidratante_mosqueta.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.dia_mosqueta {



margin:0 0 0 1px;



width:285px;



height:20px;



background-image:url('./imagenes/contenido/linea_mosqueta/tit_dia_mosqueta.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.tonica_mosqueta {



margin:0 0 0 1px;



width:289px;



height:20px;



background-image:url('./imagenes/contenido/linea_mosqueta/tit_tonica.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.limpiadora_mosqueta {



margin:0 0 0 1px;



width:324px;



height:20px;



background-image:url('./imagenes/contenido/linea_mosqueta/tit_limpiadora.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.mascara_almendra {



margin:0 0 0 1px;



width:251px;



height:20px;



background-image:url('./imagenes/contenido/linea_almendra/tit_mascara.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.aceite_almendra {



margin:0 0 0 1px;



width:231px;



height:20px;



background-image:url('./imagenes/contenido/linea_almendra/tit_aceite.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.intensiva_almendra {



margin:0 0 0 1px;



width:320px;



height:20px;



background-image:url('./imagenes/contenido/linea_almendra/tit_intensiva.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.hidratante_almendra {



margin:0 0 0 1px;



width:275px;



height:20px;



background-image:url('./imagenes/contenido/linea_almendra/tit_hidratante.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.limpiadora_almendra {



margin:0 0 0 1px;



width:272px;



height:20px;



background-image:url('./imagenes/contenido/linea_almendra/tit_limpiadora.jpg');



background-repeat:no-repeat;



}												







div#contenido div.tit_contenido.contorno_mosqueta {



margin:0 0 0 1px;



width:383px;



height:20px;



background-image:url('./imagenes/contenido/linea_mosqueta/tit_contorno_mosqueta.jpg');



background-repeat:no-repeat;



}										







div#contenido div.tit_contenido.linea_classic {



margin:0 0 0 1px;



width:155px;



height:25px;



background-image:url('./imagenes/contenido/tit_linea_classic.jpg');



background-repeat:no-repeat;



}	







div#contenido div.tit_contenido.crema_nutritiva_w {



margin:0 0 0 1px;



width:165px;



height:20px;



background-image:url('./imagenes/contenido/linea_classic/tit_nutritiva_w.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.crema_nutritiva_class {



margin:0 0 0 1px;



width:206px;



height:20px;



background-image:url('./imagenes/contenido/linea_classic/tit_nutritiva_class.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.limpieza_jojoba {



margin:0 0 0 1px;



width:244px;



height:20px;



background-image:url('./imagenes/contenido/linea_classic/tit_limpieza_jojoba.jpg');



background-repeat:no-repeat;



}







div#contenido div.tit_contenido.humectante_class {



margin:0 0 0 1px;



width:235px;



height:20px;



background-image:url('./imagenes/contenido/linea_classic/tit_humectante_class.jpg');



background-repeat:no-repeat;



}				







div#contenido div.tit_contenido.linea_almendra {



margin:0 0 0 1px;



width:197px;



height:25px;



background-image:url('./imagenes/contenido/tit_linea_almendra.jpg');



background-repeat:no-repeat;



}		







div#contenido div.tit_contenido.linea_mosqueta {



margin:0 0 0 1px;



width:265px;



height:25px;



background-image:url('./imagenes/contenido/tit_linea_mosqueta.jpg');



background-repeat:no-repeat;



}	







div#pie {



width:768px;



height:8px;



background-image:url('./imagenes/estructura/pie.jpg');



background-repeat:no-repeat;



font-size:1px;



}







div#columna_izquierda {



float:left;



width:202px;



}







div#columna_izquierda div.menu_columna_izquierda {padding:0 0 0 37px; margin-top:20px;}		







div#columna_izquierda div.fdo_columna_izquierda {



width:177px;







padding-top:75px;



background-repeat: no-repeat;



}	







div#columna_izquierda div.destacado_col_izq {



margin-left:6px;



width:171px;



background-color:#dadbdb;



}







div#columna_izquierda div.destacado_col_izq div.encabezado_destacado {

width:171px;

height:69px;

}







div#columna_izquierda div.destacado_col_izq div.encabezado_destacado div.tit_destacado {



float:left;



width:99px;



height:69px;



}







div#columna_izquierda div.destacado_col_izq div.encabezado_destacado div.tit_destacado h4 {



margin:13px 0 0 15px;



padding:0;



font-family:Verdana, Arial, Helvetica, sans-serif;



font-size:12px;



color:#5c3e6d;



}







div#columna_izquierda div.destacado_col_izq div.texto_destacado {



padding:10px 6px 10px 21px;



}	







div#columna_izquierda div.destacado_col_izq div.texto_destacado p {



margin:0;



padding:0;



text-align:right;



font-family:Verdana, Arial, Helvetica, sans-serif;



color:#6d6e71;



font-size:10px;



}







div#columna_izquierda div.destacado_col_izq div.texto_destacado a {



padding-left:10px;



text-decoration:none;



font-family:Verdana, Arial, Helvetica, sans-serif;



font-size:10px;



color:#939598;



background-image:url('./imagenes/columna_izquierda/bullet_mas_info.jpg');



background-repeat:no-repeat;



background-position:0 3px;



}







div#columna_izquierda div.destacado_col_izq div.texto_destacado a:hover {text-decoration:underline;}				







div#columna_izquierda div.destacado_col_izq div.encabezado_destacado div.img_destacado {



float:left;



width:72px;



height:69px;



}		







div#columna_izquierda ul {



margin:0;



padding:0;



list-style-type:none;



}







div#columna_izquierda ul li.mama {



line-height:11px;



}







div#columna_izquierda ul li {



line-height:18px;



padding-bottom:11px;



}		







div#columna_izquierda ul li a {



font-family:Verdana;



font-size:11px;



color:#686A6C;



text-decoration:none;



}







div#columna_izquierda ul li a:hover {color:#8A3C35;}			







div#recorrido_sitio {

padding:4px 0 0 0;

width:558px;





border-bottom:1px solid #d6d7c8;



height:23px;heigh\t:18px;	

}







div#recorrido_sitio ul {



margin:0;



padding:0;



list-style-type:none;



}







div#recorrido_sitio ul li {display:inline;}







div#recorrido_sitio ul li a {



text-decoration:none;



font-family:Verdana;



font-size:10px;



color:#A7A9AC;



}		



div#recorrido_sitio a {

text-decoration:none;

color:#666666;



}		



/*MENU PRINCIPAL*/	



div#menu_principal {



display:inline;



float:left;



margin:0 0 0 19px;



padding:6px 0 0 0;



width:390px;



height:20px;heigh\t:14px;



font-size:9px;



}	







div#menu_principal ul {



margin:0;



padding:0px;



height:14px;



list-style-type:none;



}







div#menu_principal ul li {



font-family:Verdana, Arial, Helvetica, sans-serif;



color:#FFFFFF;



display:inline;



}







div#menu_principal ul li a {
font-weight:bold;
color:#FFFFFF;
text-decoration:none;
}				







/*MENU ICONOS*/



div#menu_iconos {



display:inline;



margin:6px 0 0 65px;



float:left;



width:100px;



height:20px;



}







div#menu_iconos ul {



margin:0;



padding:0;



list-style-type:none;



}	







div#menu_iconos ul li {display:inline;}	







div#menu_iconos ul li a {



margin-left:14px;



padding-top:14px;



height:14px;heigh\t:0;



float:left;



text-decoration:none;



overflow:hidden;



background-repeat:no-repeat;



}







div#menu_iconos ul li a.inicio {



margin:0;



width:13px; 



background-image:url('./imagenes/menu_iconos/inicio.gif');



}







div#menu_iconos ul li a.mapa {



width:13px; 



background-image:url('./imagenes/menu_iconos/mapa.gif');



}







div#menu_iconos ul li a.contacto {



width:11px; 



background-image:url('./imagenes/menu_iconos/contacto.gif');



}







div#menu_iconos ul li a.carrito {



width:14px; 



background-image:url('./imagenes/menu_iconos/carrito3.png');



}







div#menu_iconos ul li a.buscar {



width:13px; 



background-image:url('./imagenes/menu_iconos/buscar.gif');



}	







div#cuerpo_inicio {



width:760px;



}







div#contenido_inicio {



padding:28px 30px 14px 30px;



width:760px;widt\h:700px;



background-image:url('./imagenes/contenido/fdo_contenido_inicio.jpg');



background-repeat:no-repeat;



}		







/*BANNERS*/



div#contenido_inicio div.banner {



float:left;



display:inline;



margin-left:29px;



width:214px;



}







div#contenido_inicio div.banner.producto {margin:0;}



div#contenido_inicio div.banner h2 {display:none;}



div#contenido_inicio div.banner div.tit_banner {



width:214px;



height:15px;



}



div#contenido_inicio div.banner.producto div.tit_banner.producto {background-image:url('./imagenes/home/<?= $home["imagen_titulo_1"] ?>');}



div#contenido_inicio div.banner.sorteo div.tit_banner.sorteo {background-image:url('./imagenes/home/<?= $home["imagen_titulo_2"] ?>');}



div#contenido_inicio div.banner.comprar div.tit_banner.comprar {background-image:url('./imagenes/home/<?= $home["imagen_titulo_3"] ?>');}







div#contenido_inicio div.banner h3 {



padding:0;



margin:18px 0 0 0;



font-family:Verdana;



font-size:11px;



color:#686A6C;



}	







div#contenido_inicio div.banner div.texto {



width:214px;



height:64px;



font-family:Verdana;



font-size:11px;



color:#686A6C;



}







div#contenido_inicio div.banner div.texto p {margin:8px 0 0 0;}







div#contenido_inicio div.banner div.foto_enlace {



width:214px;



height:116px;



}







div#contenido_inicio div.banner div.foto_enlace div.enlace {



float:left;



padding-top:94px;



width:70px;



height:116px;heigh\t:22px;



}







/*div#contenido_inicio div.banner div.foto_enlace div.enlace ul {



margin:77px 0 0 13px; 



padding:0; 



list-style-image:url(./imagenes/contenido/bullet_ver_mas.gif);



}*/







div#contenido_inicio div.banner div.foto_enlace div.enlace a {



padding:0 0 1px 7px;



font-family:Verdana;



font-size:10px;



color:#686A6C;



text-decoration:none;



background-image:url('./imagenes/contenido/bullet_ver_mas.gif');



background-repeat:no-repeat;



background-position:left;	



}	







div#contenido_inicio div.banner div.foto_enlace div.imagen {



float:left;



width:144px;



height:116px;



}	



/*MENU PRODUCTOS*/



div#contenido div.item_menu_productos {



float:left;



width:248px;



height:94px;

/*

background-image:url('./imagenes/contenido/fdo_item_menu_prod.jpg');

*/



margin-bottom:15px;



}







div#contenido div.item_menu_productos p {



margin:14px 0 0 0;



padding:0;



font-family:Verdana, Arial, Helvetica, sans-serif;



font-size:9px;



color:#000000;



}	







div#contenido div.item_menu_productos.violeta {background-image:url('./imagenes/contenido/fdo_item_menu_prod_violeta.jpg');}



div#contenido div.item_menu_productos.rosa {background-image:url('./imagenes/contenido/fdo_item_menu_prod_rosa.jpg');}



div#contenido div.item_menu_productos.fuxia {background-image:url('./imagenes/contenido/fdo_item_menu_prod_fuxia.jpg');}



div#contenido div.item_menu_productos.rosa_claro {background-image:url('./imagenes/contenido/fdo_item_menu_prod_rosa_cla.jpg');}

div#contenido div.contenido_actualidad div.item_menu_productos	{background-image:url('./imagenes/estructura/actualidad/fdo_item_menu_actual.jpg');}







div#contenido div.item_menu_productos.impar {margin-right:14px;}



div#contenido div.item_menu_productos h4 {



width:100px;



margin:0;



padding:0;



font-family:Verdana;



font-size:9px;



font-weight:bold;



color:#8a3c35;



}







div#contenido div.item_menu_productos div.texto {



float:left;



padding:14px 0 0 14px;



width:169px;widt\h:155px;



height:94px;heigh\t:80px;



}







div#contenido div.item_menu_productos div.texto a {



display:block;



font-family:Verdana;



font-size:11px;



font-weight:bold;



color:#8A3C35;



text-decoration:none;



}

div#contenido div.contenido_medicina div.item_menu_productos div.texto a {color:#6E2E97;}
div#contenido div.contenido_actualidad div.item_menu_productos div.texto a {color:#0E3AA8;} 







div#contenido div.item_menu_productos.violeta div.texto a { /* color:#5c3e6d; */}



div#contenido div.item_menu_productos.rosa div.texto a {color:#8b5469;}



div#contenido div.item_menu_productos.fuxia div.texto a {color:#7c0049;}



div#contenido div.item_menu_productos.rosa_claro div.texto a {color:#70484d;}					







div#contenido div.item_menu_productos div.fdo_imagen {



float:left;



width:79px;



height:94px;



}







div#contenido div.item_menu_productos div.fdo_imagen img {border:none;}	







div.tit_seccion h3 {



margin:0 0 2px 0;



padding:0;



font-family:Verdana, Arial, Helvetica, sans-serif;



font-size:13px;



font-weight:lighter;



color:#686a6c;



}







h5 {



margin:8px 0 13px 0;



padding:0;



font-family:Verdana, Arial, Helvetica, sans-serif;



font-size:15px;



font-weight:lighter;



color:#5c3e6d;



}







div.texto_descripcion_producto p {



margin:0 0 12px 0;



padding:0;



font-family:Verdana, Arial, Helvetica, sans-serif;



font-size:10px;



font-weight:bold;



color:#939598;



}







div.texto_linea p {

margin:0;

padding:0 0 19px 0;

}







div.texto_linea p span {font-weight:bold; color:#999999;}	







div.contenido_producto {



float:left;



width:360px;



}	







div.imagen_producto {



width:140px;



float:right;



margin-top:10px;



}				







div.imagen_producto .agregar_carrito {



width:115px;



height:37px;



background-color:#ced0d0;



float:right;



margin-top:20px;



}







div.imagen_producto .agregar_carrito img.carrito {



margin:11px 10px 0 13px;



float:left;



}







div.imagen_producto .agregar_carrito a {



display:block;



margin:6px 0 0 0;



font-family:Verdana, Arial, Helvetica, sans-serif;



text-decoration:none;



color:#231f20;



font-weight:bold;



font-size:9px;



}	







div.otros_productos {



float:left;



margin:30px 0 0 0;



width:510px;



height:170px;



background-repeat:no-repeat;



}







div.otros_productos h4 {



margin:15px 0 10px 0;



padding:0;



font-family:Verdana, Arial, Helvetica, sans-serif;



font-weight:bold;



font-size:11px;



}	







div.otro_producto {



float:left;



width:60px;



height:140px;



}







div.otro_producto .img_otro_producto img {



border:none;



width:60px;



}







div.otro_producto .texto_otro_producto {text-align:center; line-height:10px; padding:0 3px;}







div.otro_producto .texto_otro_producto a {



font-family:Verdana, Arial, Helvetica, sans-serif;



font-size:9px;



text-decoration:none;



}



div#contenido ul.puntos_venta {

margin:0;

padding:0;

list-style-type:none;

}    				





div#contenido ul.puntos_venta li a {

text-decoration:none;	

font-family:Verdana, Arial, Helvetica, sans-serif;

font-size:10px;

font-weight:bold;

color:#939598;

}  





div#contenido ul.puntos_venta li a:hover {color:#feb913;}   			

div.bloque_texto_contenido.ingredientes {margin:0 0 30px 0; padding:0; width:510px;}		



div.bloque_texto_contenido div.imagen {

width:150px;

float:left;

margin-right:20px;

}



div.bloque_texto_contenido div.texto {

float:left;

width:300px;

font-family:Verdana, Arial, Helvetica, sans-serif;

font-size:10px;

color:#939598;

}	



div.bloque_texto_contenido div.texto.ingredientes {width:380px;}

div.bloque_texto_contenido div.texto.noticias {width:auto; float:left;}

div.bloque_texto_contenido.noticias div.imagen {float:left; width:180px; margin:0 20px 10px 0;}

div.bloque_texto_contenido div.texto p {

margin:0 0 19px 0;

padding:0;

}		



div.bloque_texto_contenido div.texto h5 {

font-family:Verdana, Arial, Helvetica, sans-serif;

color:#0066FF;

font-weight:bold;

font-size:14px;

margin:0;

}	



div.bloque_texto_contenido div.texto p span.secretos {

padding:0;

margin:0;

color:#0066FF;

}



div.bloque_texto_contenido div.texto p span.secretos_grande {

padding:0;

margin:0;

color:#0066FF;

font-size:14px;

font-weight:bold;

}	



div.bloque_texto_contenido div.texto ul.secretos {color:#FF6633;}



div.bloque_texto_contenido div.texto a.guia_cuidados {

color:#0066FF;

font-size:14px;

font-weight:bold;

text-decoration:none;

}	



/*TABLA*/



.text {

font-family: Verdana, Arial, Helvetica, sans-serif;

font-size: 10px;

font-weight: normal;

color: #0066CC;

text-decoration: none;

}

.titutlos {

font-family: Verdana, Arial, Helvetica, sans-serif;

font-size: 12px;

font-weight: normal;

color: #0066FF;

}

.arriba {

font-family: Verdana, Arial, Helvetica, sans-serif;

font-size: 10px;

font-weight: bold;

color: #FFFFFF;

}

.text1 {

font-family: Verdana, Arial, Helvetica, sans-serif;

font-size: 10px;

font-weight: normal;

color: #333333;

}

.text2 {

font-family: Verdana, Arial, Helvetica, sans-serif;

font-size: 10px;

font-weight: normal;

color: #FFFFFF;

}



div.bloque_texto_contenido div.texto.ingredientes h4 {

margin:0;

padding:0;

font-family:Verdana, Arial, Helvetica, sans-serif;

font-size:10px;

font-weight:bold;

color:#666666;

}



/*FIN TABLA*/



/*CONTACTO*/



div.bloque_contacto {

margin:12px 0 0 12px;

float:left;

width:249px;

height:165px;

background-color:#f8f2e4;

}



div.bloque_contacto.primero {margin-left:0;}    



div.bloque_contacto .bandera {

float:left;

padding:22px 0 0 26px;

width:86px;widt\h:60px;

height:157px;heigh\t:135px;

}



div.bloque_contacto .texto {

float:left;

padding:9px 0 0 22px;

width:163px;widt\h:141px;

height:157px;heigh\t:148px;

}



div.bloque_contacto .texto p span {color:#767772; font-weight:bold;}



div.bloque_contacto .texto ul {

margin:0;

padding:0;

list-style-type:none;

} 



div.bloque_contacto .texto ul li a {text-decoration:none; color:#1038a9;}



/*FIN CONTACTO*/									

div.contenido_medicina div.item_menu_productos {
background-image:url('./imagenes/estructura/medicina/fdo_item_menu_med.jpg');
} 

div.bloque_texto_contenido div.texto.medicina {width:auto;} 


div#contenido div.tit_contenido.puntosdeventa {
margin:0 0 0 1px;
padding-bottom:20px;
width:310px;
height:28px;
background-image:url('./imagenes/estructura/farmacias/tit_Ptosdeventa.jpg');
background-repeat:no-repeat;
}    


