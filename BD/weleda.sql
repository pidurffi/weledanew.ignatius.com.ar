/*
MySQL Backup
Source Host:           localhost
Source Server Version: 5.0.41-community-nt
Source Database:       weleda
Date:                  2008/10/22 17:40:16
*/

SET FOREIGN_KEY_CHECKS=0;
use weleda;
#----------------------------
# Table structure for familia
#----------------------------
CREATE TABLE `familia` (
  `id` int(11) NOT NULL auto_increment,
  `foto_listado` varchar(255) NOT NULL default '',
  `epigrafe_foto_listado` varchar(255) NOT NULL default '',
  `foto` varchar(255) NOT NULL default '',
  `epigrafe_foto` varchar(255) NOT NULL default '',
  `nombre` varchar(255) NOT NULL default '',
  `foto_nombre` varchar(255) NOT NULL default '',
  `epigrafe_foto_nombre` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
#----------------------------
# Records for table familia
#----------------------------


insert  into familia values 
(1, '0_indexliterfot.jpg', 'index', '0_fdo_encabezado_cuidados_fac.jpg', 'fondo', 'Familia 1', '0_tit_limpiadora_iris.jpg', ''), 
(2, '0_img_cuidados_faciales.jpg', 'cuidados', '1_fdo_encabezado_cuidados_fac.jpg', 'cuidados', 'cuidados fachales', '0_tit_cuidados_faciales.jpg', '');
#----------------------------
# Table structure for home
#----------------------------
CREATE TABLE `home` (
  `id` int(11) NOT NULL auto_increment,
  `foto_grande` varchar(255) NOT NULL default '',
  `epigrafe_foto_grande` varchar(255) NOT NULL default '',
  `titulo_1` varchar(255) NOT NULL default '',
  `titulo_2` varchar(255) NOT NULL default '',
  `titulo_3` varchar(255) NOT NULL default '',
  `imagen_titulo_1` varchar(255) NOT NULL default '',
  `imagen_titulo_2` varchar(255) NOT NULL default '',
  `imagen_titulo_3` varchar(255) NOT NULL default '',
  `subtitulo_1` varchar(255) NOT NULL default '',
  `subtitulo_2` varchar(255) NOT NULL default '',
  `subtitulo_3` varchar(255) NOT NULL default '',
  `copete_1` varchar(255) NOT NULL default '',
  `copete_2` varchar(255) NOT NULL default '',
  `copete_3` varchar(255) NOT NULL default '',
  `imagen_1` varchar(255) NOT NULL default '',
  `texto_imagen_1` varchar(255) NOT NULL default '',
  `imagen_2` varchar(255) NOT NULL default '',
  `texto_imagen_2` varchar(255) NOT NULL default '',
  `imagen_3` varchar(255) NOT NULL default '',
  `texto_imagen_3` varchar(255) NOT NULL default '',
  `link_1` varchar(255) NOT NULL default '',
  `link_2` varchar(255) NOT NULL default '',
  `link_3` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
#----------------------------
# Records for table home
#----------------------------


insert  into home values 
(1, '0_fdo_encabezado_inicio.jpg', 'cxxcvxcv', 'productos', 'sorteo', 'comprar', '0_tit_banner_productos.jpg', '0_tit_banner_sorteo.jpg', '0_tit_banner_comprar.jpg', 'AAceites corporales y esenciass', 'UUNA BUENA IDEAA', 'Farmacia Belladona Online', 'Relajación, bienestar y belleza.', 'Completá tus datos y participá por un sorteo de un set de Tratamientos Capilares Weleda.', 'Primer farmacia en la Argentina especializada en Medicinas Complementarias y productos para el bienestar.', '0_img_banner_productos.jpg', 'prods', '1_img_banner_sorteo.jpg', 'sorteo', '0_img_banner_comprar.jpg', '', 'index.php?module=fr_productos', '#', '#');
#----------------------------
# Table structure for linea
#----------------------------
CREATE TABLE `linea` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(255) NOT NULL default '',
  `foto` varchar(255) NOT NULL default '',
  `epigrafe_foto` varchar(255) NOT NULL default '',
  `foto_listado` varchar(255) NOT NULL default '',
  `epigrafe_foto_listado` varchar(255) NOT NULL default '',
  `id_familia` int(11) NOT NULL default '0',
  `subtitulo` varchar(255) NOT NULL default '',
  `copete` varchar(255) NOT NULL default '',
  `descripcion` text NOT NULL,
  `foto_nombre` varchar(255) NOT NULL default '',
  `epigrafe_foto_nombre` varchar(255) NOT NULL default '',
  `foto_banner` varchar(255) NOT NULL default '',
  `epigrafe_foto_banner` varchar(255) NOT NULL default '',
  `titulo_banner` varchar(255) NOT NULL default '',
  `descripcion_banner` text NOT NULL,
  `link_banner` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
#----------------------------
# Records for table linea
#----------------------------


insert  into linea values 
(1, 'linea', '0_fdo_encabezado_linea_iris.jpg', 'fondo', '0_img_linea_iris.jpg', 'linea', 1, 'asd', 'asdasd', '<p>asda<b>sdsada</b>sdas</p>', '1_tit_linea_iris.jpg', '', '1_linea_iris.jpg', '', ' Iris Germánica', '<p>allos del Iris son sus rizomas, que poseen una gran habilidad de almacenar la humedad que re&uacute;nen de ra&iacute;ces subterr&aacute;neas.<br />\r\nEl extracto de Iris sobre la epidermis, ayuda a retener</p>', 'http://www.google.com'), 
(2, 'linea', '1_fdo_encabezado_linea_iris.jpg', '', '1_img_linea_iris.jpg', '', 1, 'asdsadsad', 'asdasd', '', '', '', '', '', '', '', '');
#----------------------------
# Table structure for producto
#----------------------------
CREATE TABLE `producto` (
  `id` int(11) NOT NULL auto_increment,
  `foto` varchar(255) NOT NULL default '',
  `epigrafe_foto` varchar(255) NOT NULL default '',
  `foto_listado` varchar(255) NOT NULL default '',
  `epigrafe_foto_listado` varchar(255) NOT NULL default '',
  `nombre` varchar(255) NOT NULL default '',
  `subtitulo` varchar(255) NOT NULL default '',
  `descripcion` text NOT NULL,
  `id_linea` int(11) NOT NULL default '0',
  `foto_nombre` varchar(255) NOT NULL default '',
  `epigrafe_foto_nombre` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
#----------------------------
# Records for table producto
#----------------------------


insert  into producto values 
(1, '1_img_limpiadora_iris.jpg', '', '0_leche_limpiadora.jpg', '', 'producto 1', 'asdasdasdasdasdasdasd', '<p>sadsafsd f dfg dfg fdh dh</p>\r\n<p>gua, aceite de Jojoba, aceite de <b>S&eacute;samo, alcohol, glicerina, extracto de Hamamelis virginiana, aceites esenciales naturales, linoleato de glicerilo, arcilla, jab&oacute;n </b>de cera de abeja, extracto de Iris germ&aacute;nica,</p>', 1, '0_tit_limpiadora_iris.jpg', ''), 
(2, '1_img_limpiadora_iris.jpg', '', '0_leche_limpiadora.jpg', '', 'producto 2', 'asdasdasdasdasdasdasd', '<p>sadsafsd f dfg dfg fdh dh</p>\r\n<p>gua, aceite de Jojoba, aceite de <b>S&eacute;samo, alcohol, glicerina, extracto de Hamamelis virginiana, aceites esenciales naturales, linoleato de glicerilo, arcilla, jab&oacute;n </b>de cera de abeja, extracto de Iris germ&aacute;nica,</p>', 1, '0_tit_limpiadora_iris.jpg', '');
#----------------------------
# Table structure for pto_venta
#----------------------------
CREATE TABLE `pto_venta` (
  `id` int(11) NOT NULL auto_increment,
  `id_subregion` int(11) NOT NULL default '0',
  `direccion` varchar(255) NOT NULL default '',
  `mail` varchar(255) NOT NULL default '',
  `telefono` varchar(255) NOT NULL default '',
  `nombre` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
#----------------------------
# Records for table pto_venta
#----------------------------


insert  into pto_venta values 
(1, 1, 'Avda. Gral. Las Heras 2360', 'recoleta@farmacity.com', '4555-6555', 'Farmacity Recoleta');
#----------------------------
# Table structure for region
#----------------------------
CREATE TABLE `region` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
#----------------------------
# Records for table region
#----------------------------


insert  into region values 
(1, 'Regi�n 1'), 
(2, 'Region 22'), 
(3, 'Region 3'), 
(4, 'Regi�n 4'), 
(5, 'r5');
#----------------------------
# Table structure for subregion
#----------------------------
CREATE TABLE `subregion` (
  `id` int(11) NOT NULL auto_increment,
  `id_region` int(11) NOT NULL default '0',
  `nombre` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
#----------------------------
# Records for table subregion
#----------------------------


insert  into subregion values 
(1, 1, 'Subregi�n 1_1'), 
(2, 1, 'Subregion 1_2'), 
(3, 2, 'Subregion 2_1'), 
(4, 2, 'Subregion 2_2');
#----------------------------
# Table structure for usuario
#----------------------------
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(255) NOT NULL default '',
  `password` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
#----------------------------
# Records for table usuario
#----------------------------


insert  into usuario values 
(1, 'admin', '202cb962ac59075b964b07152d234b70'), 
(2, 'adrian', 'adrian');

