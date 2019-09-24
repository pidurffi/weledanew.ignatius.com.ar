<html>
    <head>
        <title>Weleda Argentina</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <style>
            p {width:768px;}
        </style>
    </head>

    <body title="Weleda Argentina" style="font-family:'Neo Sans',NeoSans,Arial,Helvetica,sans-serif; font-size:12px;">

        <p>
            <?
            if (CONSTANTE_PAIS == "Argentina")
                print('<img src="http://weleda.com.ar/imagenes/estructura/carrito/top_mail_registracion_v2.jpg" />');
            elseif (CONSTANTE_PAIS == "Chile")
                print('<img src="http://weleda.cl/imagenes/estructura/carrito/encabezado_carrito.jpg" />');
            ?>
        </p>
        <p>
            Hola, <? echo $nombre . " " . $apellido; ?>.
        </p>
        <p>
            &iexcl;Bienvenido/a al mundo Weleda!
        </p>
        <p>
            &iexcl;Te agradecemos por confiar en nuestra exclusiva L&iacute;nea de Cosm&eacute;tica Natural y Org&aacute;nica desde 1921!<br />
            La siguiente informaci&oacute;n es la que has cargado en nuestro sitio. Con ella recibir&aacute;s nuestro Newsletter, podr&aacute;s participar de sorteos &iexcl;y comprar a trav&eacute;s de nuestro <a href="http://www.weleda.com.ar/index.php?module=login">e.shop</a>!
        </p>

        <table border="0" cellpadding="0" cellspacing="0" width="98%">
            <tr>
                <td align="center">
                    <span style="font-weight: bold;">Correo electr&oacute;nico:</span> <?php echo $email; ?><br />
                    <span style="font-weight: bold;">Contrase&ntilde;a:</span> <?php echo $password; ?>
                </td>
            </tr>
        </table>
        <br />
        <p>&iexcl;Te invitamos a que tambi&eacute;n nos sigas en Facebook!</p>

        <p>Ante cualquier duda pod&eacute;s escribirnos a: <a href="mailto:info@weleda.com.ar">info@weleda.com.ar</a></p>

        <p>&iexcl;&iexcl;GRACIAS POR VIVIR WELEDA!!</p>

        <?
        if (CONSTANTE_PAIS == "Argentina") {
            print('<p style="font-size:10px;">Ramallo 2566, C1429DUR, Ciudad Aut&oacute;noma de Buenos Aires, Argentina. Tel. 011-4704-4700. Fax. 011-4702-1961<br />
            Horario de atenci&oacute;n: lunes a viernes de 9 a 18 hs. www.weleda.com.ar
            </p>');
        } elseif (CONSTANTE_PAIS == "Chile") {
            print('<p style="font-size:10px;">XXX, Santiago, Chile. Tel. XXX<br />
            Horario de atenci&oacute;n: lunes a viernes de 9 a 18 hs. ventas@weleda.cl / www.weleda.cl
            </p>');
        }
        ?>

    </body>

</html>