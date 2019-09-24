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
                <h1>C�mo comprar</h1>
            <? include("instructivo2.php"); ?>
                <h2>Aceptaci�n de la compra</h2>
                <p>Confirmaci�n de orden de compra: Cuando concretas una compra recibir�s v�a e-mail una confirmaci�n de que tu orden de pedido ha sido aceptada y le asignamos un n�mero de pedido.</p>
                <h2>Precios</h2>
            <?
                if (CONSTANTE_PAIS == "Argentina")
                    print("<p>Todos los precios est�n en pesos argentinos.</p>");
                elseif (CONSTANTE_PAIS == "Chile")
                    print("<p>Todos los precios est�n en pesos chilenos.</p>");
            ?>
                <p>Monto m�nimo de compra: $<?= MONTO_MINIMO_DE_COMPRA ?>.</p>
            <? } ?>
            <?
            if ($_GET['i'] == 2) {
            ?>
                <h1>Forma de pago</h1>
                <p>El pago ser� realizado a trav�s del sistema de DineroMail.</p>
            <?
                if (CONSTANTE_PAIS == "Argentina")
                    print("<p>Se aceptan tarjetas de Cr�dito &mdash;VISA, MASTERCARD, ARGENCARD, CABAL, AMERICAN EXPRESS, ITALCRED&mdash;, PagoF�cil y RapiPago.</p>");
                elseif (CONSTANTE_PAIS == "Chile")
                    print("<p>Se aceptan tarjetas de cr�dito, transferencia bancaria, Servipag.</p>");
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
                <h1>Env�o</h1>
                <h2>Entrega del pedido</h2>
                <p>DHL entregar� los productos a trav�s de su personal debidamente identificado (uniforme y camioneta de la firma) o en su defecto un agente exclusivo de DHL (camioneta DHL).</p>
                <h1>Costo de env�o</h1>
                <p>
                <? while ($tarifa = mysql_fetch_array($lista_tarifas)) {
                ?>
                    <p><?= $tarifa['nombre_area'] ?>: $<?= number_format($tarifa['TARIFA'], 2, ',', '') ?></p>
                <? } ?>
            </p>
            <p>El env�o es gratuito para compras superiores a $ <?= MONTO_MINIMO_PARA_ENVIO_GRATIS ?>.</p>
            <h2>Informaci�n sobre el estado del env�o </h2>
            <ol>
                <li>A trav�s de la web ingresando en www.dhl.com.ar, Rastrea tu env�o, con el n�mero de gu�a que te enviaremos por mail al confirmar la compra.</li>
                <li>Centro de Atenci�n al Cliente de DHL: 4630-1000  4630-1000  opci�n 1, de Lunes a Viernes de 8hs. a 20hs y S�bados de 9 a 13hs. Desde cualquier punto del pa�s al 0810-2222345 0810-2222345, en los horarios mencionados.</li>
            </ol>
            <h2>Tiempos de entrega</h2>
            <p>Al confirmar tu compra te envi�remos tu n�mero de gu�a para que puedas seguir el estado de tu pedido. Recibir�s tu pedido dentro de los 5 d�as una vez que se confirma la compra.</p>
            <h2>Posibilidad de compra:</h2>
            <?
                if (CONSTANTE_PAIS == "Argentina")
                    print("<p>Desde cualquier provincia de la Rep�blica Argentina.</p>");
                elseif (CONSTANTE_PAIS == "Chile")
                    print("<p>Desde cualquier regi�n de Chile.</p>");
            ?>
                <h2>Entrega de los productos</h2>
                <p>La entrega de los productos se realizar� en el domicilio que hayas colocado. Es importante que tengas en cuenta que debe ser un domicilio real al registrarte.</p>
                <h2>&iquest;Qu� sucede si no hay nadie cuando vienen a traer mi pedido? </h2>
                <p>En caso de que el personal de DHL se presente y no se encuentre la persona para recibir el pedido, dejar� una notificaci�n especificando el n�mero de gu�a y un tel�fono para que se puedan contactar y as� coordinar la entrega. Se realizar� una segunda visita y se dejar� nuevamente una notificaci�n, con el n�mero de gu�a y un tel�fono para contactarse. En caso que el destinatario no se comunique con DHL, ellos se contactar�n con �l pasada la semana del primer contacto.</p>
            <? } ?>
            <?
            if ($_GET['i'] == 4) {
            ?>
                <h1>Devoluciones</h1>
                <p>Si el producto que recibiste no corresponde con el producto que seleccionaste, deber�s comunicarte con nosotros dentro de las 72 horas h�biles de recibida tu compra.</p>
                <p>
                    (++5411) 4704-4700<br />
                <?= despam("info@weleda.com.ar"); ?>
            </p>
            <? } ?>
                
                
            <?php if ($_GET['h'] == 1) {
                // Si vengo de la p�gina de inicio, env�o &h=1
                
                // Ac� va un bot�n "Empez� a comprar".
                ?>
                
            <? } ?>
                
            <a class="atras" href="javascript:history.back(1)">Atr�s</a>
            
            <br />
            <br />
        </div>
    </body>
</html>