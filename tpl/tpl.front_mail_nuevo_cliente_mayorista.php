<html>
    <head>
        <title>Weleda</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            p {width:768px;}
        </style>
    </head>

    <body title="Weleda" style="font-family:'Neo Sans',NeoSans,Arial,Helvetica,sans-serif; font-size:12px;">

        <p>
            <?
            if (CONSTANTE_PAIS == "Argentina")
                print('<img src="http://weleda.com.ar/imagenes/estructura/carrito/top_carrito_mayorista.jpg" />');
            elseif (CONSTANTE_PAIS == "Chile")
                print('<img src="http://weleda.cl/imagenes/estructura/carrito/encabezado_carrito.jpg" />');
            ?>
        </p>
        <p>
            Estimado <? echo $nombre ; ?>:
        </p>
        <p>
            &iexcl;HAGA SUS PEDIDOS ONLINE!
        </p>
		<p>
			Ahora, realizar el pedido de reaprovisionamiento de productos Weleda para su comercio es mucho m&aacute;s simple y r&aacute;pido. Con su mail y la contrase&ntilde;a que le enviamos podr&aacute; ingresar a una nueva plataforma para hacer su pedido. El m&eacute;todo de cobro y env&iacute;o se seguir&aacute; manteniendo sin cambios.
		</p>
        <p>
            <a href="http://www.weleda.com.ar/distribuidoresmayoristas.php">Haga clic aqu&iacute;</a> para ingresar a nuestro e.shop exclusivo para comercios.
        </p>

        <table border="0" cellpadding="0" cellspacing="0" width="98%">
            <tr>
                <td align="left">
                    <span style="font-weight: bold;">Correo electr&oacute;nico:</span> <?php echo $email; ?><br />
                    <span style="font-weight: bold;">Contrase&ntilde;a:</span> <?php echo $password; ?>
                </td>
            </tr>
        </table>
        <br />

        <p>Ante cualquier duda puede escribirnos a: <a href="mailto:info@weleda.com.ar">info@weleda.com.ar</a></p>


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