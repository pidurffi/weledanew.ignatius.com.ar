<html>
    <head>
        <title>Weleda Argentina</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <style>
            p {width:768px;}
        </style>
    </head>

    <body title="Weleda Argentina" style="font-family:'Neo Sans',NeoSans,Arial,Helvetica,sans-serif; font-size:12px;">

        <p>
            <? if (CONSTANTE_PAIS == "Argentina") { ?>
            <table cellspacing="0" cellpadding="0" border="0" width="583">
                <tr>
                    <td>
                        <? // Logo de Weleda    ?>
                        <img src="http://www.weleda.com.ar/imagenes/newsletter/TOPNews_izq_ENE2012.jpg" />
                    </td>
                    <td>
                        <? // Imagen a la derecha del logo de Weleda.   ?>
                        <img src="http://www.weleda.com.ar/imagenes/newsletter/top_news_der_dic2013.jpg" />
                    </td>
                </tr>
            </table>
        <?
        } elseif (CONSTANTE_PAIS == "Chile") {
            print('<img src="http://weleda.cl/imagenes/estructura/carrito/top_mail_registracion_ch.jpg" />');
        }
        ?>
    </p>
    <p style="width: 583px;">
        <?
        // print('Tu amiga/o ' . $nombre . ' ' . $apellido . ' participó de nuestro Concurso de Día del Amigo y quiere regalarte este Tip ecofriendly:');
        print('Hola, ' . $nombre_amigo . '.<br />');
        print($nombre . ' ' . $apellido . ' ya está participando en el sorteo de Weleda.<br />');
        print('Vos podés participar ingresando acá: <a href="http://www.weleda.com.ar/index.php?module=fr_sorteo_alta">www.weleda.com.ar</a>');
        ?>
    </p>

    <? /*
      <p>
      Participan por 3 Mini Set Weleda<br />
      <?
      if (CONSTANTE_PAIS == "Argentina")
      print('<a href="http://www.weleda.com.ar/index.php?module=fr_sorteo_web">¡Participá vos también!</a>');
      elseif (CONSTANTE_PAIS == "Chile")
      print('<a href="http://www.weleda.cl/index.php?module=fr_sorteo_web">¡Participa tú también!</a>');
      ?>
      </p>
     */ ?>

    <table border="0" celpadding="10" style="width: 583px;">
        <tr>
            <td>
                <a href="http://www.weleda.com.ar">www.weleda.com.ar</a>
            </td>
            <td align="right">
                <a href="http://www.facebook.com/weledaargentina">
                    <img src="http://weleda.com.ar/imagenes/newsletter/facebook_logo.jpg" />
                </a>
            </td>
        </tr>
    </table>

    <br />

    <?
    if (CONSTANTE_PAIS == "Argentina") {
        print('<p style="font-size:10px;">Ramallo 2566, C1429DUR, Ciudad Aut&oacute;noma de Buenos Aires, Argentina. Tel. 011-4704-4700. Fax. 011-4702-1961<br />
            Horario de atenci&oacute;n: lunes a viernes de 9 a 18 hs. www.weleda.com.ar
            </p>');
    } elseif (CONSTANTE_PAIS == "Chile") {
        
    }
    ?>

</body>

</html>