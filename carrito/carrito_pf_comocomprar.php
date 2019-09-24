<?php
include_once '../specification/variables.php';
function despam($email) {
    /* Para imprimir emails. */
    $partA = substr($email, 0, strpos($email, '@'));
    $partB = substr($email, strpos($email, '@'));
    $linkText = (func_num_args() == 2) ? func_get_arg(1) : $email;
    $linkText = str_replace('@', '<span class="nospam" style="{margin-right: .1em; margin-left: .1em;}">&#64;</span>', $linkText);
    return '<a href="e-mail" onClick=\'a="' . $partA . '";this.href="mail"+"to:"+a+"' . $partB . '";\'>' . $linkText . '</a>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <style>
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
                margin:0;
                padding:0px;
                font-family:Arial, Helvetica, sans-serif;
                color:#000000;
                font-size: 12px;
            }
            div#contenedor_carrito {
                margin:auto;
                width:760px;
            }
            div#encabezado_carrito {
                width:760px;
                height:120px;
                background-image:url('/imagenes/estructura/carrito/encabezado_carrito.jpg');
                background-repeat:no-repeat;
                background-position:center;
            }
            div#cuerpo_carrito {
                padding:8px 22px 0 22px;
                width:760px;widt\h:714px;
                text-align: center;
            }
            table {
                font-family:Arial, Helvetica, sans-serif;
                font-size:12px;
            }
            table tr td { }
            table tr td.fondito {background-color: #e9dfca;}
            table tr td.pad5right {padding-right:5px; vertical-align:top;}
            table tr td.valigntop {vertical-align:top;}
            table tr.titulo {
                background-color:#e0380b;
                color:#FFFFFF;
                height:22px;
            }
            table tr.contenido {
                background-color:#d6e0f9;
                height:27px;
                color:#868a93;
            }
            table tr.compra_total {
                background-color:#b1c3f3;
                color:#615f64;
                height:27px;
            }
            div#menu_carrito {
                width:600px;widt\h:450px;
                height:22px;
                margin-top:20px;
                padding-left: 150px;
            }
            div#menu_carrito ul {
                margin:0;
                padding:0;
                list-style-type:none;
            }
            div#menu_carrito ul li {
                display:inline;
            }
            div#menu_carrito ul li a {
                display:block;
                float:left;
                height:0;
                padding-top:22px;
                overflow:hidden;
                text-decoration:none;
            }
            div#menu_carrito ul li a.seguir {background-image:url('/imagenes/menu_carrito/seguir.jpg'); width:115px;}
            div#menu_carrito ul li a.recalcular {background-image:url('/imagenes/menu_carrito/recalcular.jpg'); width:74px; margin-left:27px;}
            div#menu_carrito ul li a.limpiar {background-image:url('/imagenes/menu_carrito/limpiar.jpg'); width:100px; margin-left:29px;}
            div#menu_carrito ul li a.comprar {background-image:url('/imagenes/menu_carrito/comprar.jpg'); width:67px; margin-left:32px;}
            * html div#menu a:link, * html div#menu a:visited {height:22px; he\ight:0;}
            div#menu a:hover {background-position:0 -22px;}
            div#pie_carrito p {
                margin-top:20px;
                font-family:Arial, Helvetica, sans-serif;
                font-size:10px;
                color:#606062;
                font-weight:bold;
                text-align:center;
            }
            ol, p { }
            a.atras {
                display:block;
                overflow:hidden;
                padding-top:22px;
                margin:auto;
                width:67px;
                height:0;
                background-image:url('/imagenes/menu_carrito/atras.jpg');
            }
            h1 {color: #D3BF96; font-size: 24px;
                font-weight: bold;
                font-family: Arial, Helvetica, sans-serif;
                text-align: left;
            }
            h2 {color: #003690; font-size: 16px;
                font-weight: bold;
                font-family: Arial, Helvetica, sans-serif;
                text-align: left;
            }
            img {border: 1px solid #003690; }
            img.sinborde {border: 0px; }
        </style>
        
        <title>Carrito de Compras - Weleda</title>
        <script type="text/javascript">
            var changingId;
            var changingLastValue;
            function changeCount() {
                document.getElementById('form').submit();
            }
            function startChanging(id,element) {
                changingId = id;
                changingLastValue = element.value;
            }
            function stopChanging(id,element) {
                if((changingId == id)&&(changingLastValue != element.value)) {
                    changeCount();
                }
            }
        </script>
        
         <?php /* Google Analytics */ ?>
        <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-29628921-1']);
        _gaq.push(['_trackPageview']);

        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
        </script>
    </head>
    <body>
        <div id="contenedor_carrito">
            <div id="encabezado_carrito"></div>
            <?
            if ($_GET['i'] == 1) {
            ?>
                <h1>Cómo comprar</h1>
            <? include("instructivo2.php"); ?>
                <h2>Aceptación de la compra</h2>
                <p>Confirmación de orden de compra: Cuando concretas una compra recibirás vía e-mail una confirmación de que tu orden de pedido ha sido aceptada y le asignamos un número de pedido.</p>
                <h2>Precios</h2>
            <?
                if (CONSTANTE_PAIS == "Argentina")
                    print("<p>Todos los precios están en pesos argentinos.</p>");
                elseif (CONSTANTE_PAIS == "Chile")
                    print("<p>Todos los precios están en pesos chilenos.</p>");
            ?>
                <p>Monto mínimo de compra: $<?= MONTO_MINIMO_DE_COMPRA ?>.</p>
            <? } ?>
            <?
            if ($_GET['i'] == 2) {
            ?>
                <h1>Forma de pago</h1>
                <p>El pago será realizado a través del sistema de DineroMail.</p>
            <?
                if (CONSTANTE_PAIS == "Argentina")
                    print("<p>Se aceptan tarjetas de Crédito &mdash;VISA, MASTERCARD, ARGENCARD, CABAL, AMERICAN EXPRESS, ITALCRED&mdash;, PagoFácil y RapiPago.</p>");
                elseif (CONSTANTE_PAIS == "Chile")
                    print("<p>Se aceptan tarjetas de crédito, transferencia bancaria, Servipag.</p>");
            ?>
            <? } ?>
            <?
            if ($_GET['i'] == 3) {
                // Datos para conectar a la base.
                include_once("../specification/database.php");
                $db_username = $_SPECIFICATION['DbClass']['params']['user'];
                $db_password = $_SPECIFICATION['DbClass']['params']['pass'];
                $db_dbname = $_SPECIFICATION['DbClass']['params']['dbname'];
                $conexion = mysql_connect("localhost", $db_username, $db_password) or die("No conecta.");
                mysql_select_db($db_dbname, $conexion);
                $sql = "SELECT TARIFA, nombre_area FROM TARIFA_ENVIO GROUP BY nombre_area ORDER BY TARIFA";
                $lista_tarifas = mysql_query($sql, $conexion) or die("No lee. " . $sql);
            ?>
                <h1>Envío</h1>
                <h2>Entrega del pedido</h2>
                <p>DHL entregará los productos a través de su personal debidamente identificado (uniforme y camioneta de la firma) o en su defecto un agente exclusivo de DHL (camioneta DHL).</p>
                <h1>Costo de envío</h1>
                <p>
                <? while ($tarifa = mysql_fetch_array($lista_tarifas)) {
                ?>
                    <p><?= $tarifa['nombre_area'] ?>: $<?= number_format($tarifa['TARIFA'], 2, ',', '') ?></p>
                <? } ?>
            </p>
            <p>El envío es gratuito para compras superiores a $ <?= MONTO_MINIMO_PARA_ENVIO_GRATIS ?>.</p>
            <h2>Información sobre el estado del envío </h2>
            <ol>
                <li>A través de la web ingresando en www.dhl.com.ar, Rastrea tu envío, con el número de guía que te enviaremos por mail al confirmar la compra.</li>
                <li>Centro de Atención al Cliente de DHL: 4630-1000  4630-1000  opción 1, de Lunes a Viernes de 8hs. a 20hs y Sábados de 9 a 13hs. Desde cualquier punto del país al 0810-2222345 0810-2222345, en los horarios mencionados.</li>
            </ol>
            <h2>Tiempos de entrega</h2>
            <p>Al confirmar tu compra te enviáremos tu número de guía para que puedas seguir el estado de tu pedido. Recibirás tu pedido dentro de los 5 días una vez que se confirma la compra.</p>
            <h2>Posibilidad de compra:</h2>
            <?
                if (CONSTANTE_PAIS == "Argentina")
                    print("<p>Desde cualquier provincia de la República Argentina.</p>");
                elseif (CONSTANTE_PAIS == "Chile")
                    print("<p>Desde cualquier región de Chile.</p>");
            ?>
                <h2>Entrega de los productos</h2>
                <p>La entrega de los productos se realizará en el domicilio que hayas colocado. Es importante que tengas en cuenta que debe ser un domicilio real al registrarte.</p>
                <h2>&iquest;Qué sucede si no hay nadie cuando vienen a traer mi pedido? </h2>
                <p>En caso de que el personal de DHL se presente y no se encuentre la persona para recibir el pedido, dejará una notificación especificando el número de guía y un teléfono para que se puedan contactar y así coordinar la entrega. Se realizará una segunda visita y se dejará nuevamente una notificación, con el número de guía y un teléfono para contactarse. En caso que el destinatario no se comunique con DHL, ellos se contactarán con él pasada la semana del primer contacto.</p>
            <? } ?>
            <?
            if ($_GET['i'] == 4) {
            ?>
                <h1>Devoluciones</h1>
                <p>Si el producto que recibiste no corresponde con el producto que seleccionaste, deberás comunicarte con nosotros dentro de las 72 horas hábiles de recibida tu compra.</p>
                <p>
                    (++5411) 4704-4700<br />
                <?= despam("info@weleda.com.ar"); ?>
            </p>
            <? } ?>
                
                
            <?php if ($_GET['h'] == 1) {
                // Si vengo de la página de inicio, envío &h=1
                
                // Acá va un botón "Empezá a comprar".
                ?>
                
            <? } ?>
                
            <a class="atras" href="javascript:history.back(1)">Atrás</a>
            
            <br />
            <br />
        </div>
    </body>
</html>