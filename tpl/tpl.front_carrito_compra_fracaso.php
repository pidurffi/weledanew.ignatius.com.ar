<?php
/*
PÁGINA DE FRACASO
El  parámetro  TBK_URL_FRACASO corresponde  a  la  URL  que contiene  a la  página 
que  se  llamará  en  el  caso  que  la  transacción  fracase.  No  hay  ningún 
requerimiento sobre esta página, basta con que contenga un mensaje apropiado 
que informe al usuario que la transacción no se realizó.

(Pág. 77 del manual de Transbank)
 */
 
$mailToErrores = "adrian@ignatius.com.ar";
include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/external/phpMailer/class.phpmailer.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/external/phpMailer/class.smtp.php");

function enviarEmailAIgnatius($pedido_numero) {
    // Envía un mail al cliente que realiza la compra
    global $mailToErrores;
    $mail = new PHPMailer();
    if (CONSTANTE_PAIS == "Argentina") {
        $mail->From = "noreply@weleda.com.ar";
        $mail->FromName = "Weleda Argentina";
        //$mail->Subject = "Weleda, confirmación de pedido número " . $compra['id'];
    } elseif (CONSTANTE_PAIS == "Chile") {
        $mail->From = "noreply@weleda.cl";
        $mail->FromName = "Weleda Chile";
        $mail->Subject = "Weleda Chile, pedido fracasado número " . $pedido_numero;
    }
    $mail->CharSet = "UTF-8";

    $mail->AltBody = "";
    $body = "Fracasó el pedido número " . $pedido_numero . " en Weleda Chile.";
    
    $mail->MsgHTML($body);
    //$mail->AddAddress($mailToErrores);
	$mail->AddAddress('adrian@ignatius.com.ar', 'Weleda');
    $mail->IsHTML(true);
    if (!$mail->Send()) {
        error_log("No se pudo enviar el mail a ignatius. Pedido número " . $pedido_numero, 1, $mailToErrores);
		return false;
    } else {
        return true;
    }
	
}

?>
<div id="contenedor">

<div id="encabezado_carrito"></div>

<p style="text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
    Ha ocurrido un error. El pago no se pudo realizar.
</p>

<?php
if (CONSTANTE_PAIS == "Argentina")
{ }
elseif (CONSTANTE_PAIS == "Chile")
{
  /****************** CONFIGURAR AQUI *******************/ 
  $URL_SERVIDOR = $_SERVER['HTTP_HOST'];
    $PATHSUBMIT      = "http://" . $URL_SERVIDOR . "/index.php";
    /****************** FIN CONFIGURACION *****************/  
    $TBK_ID_SESION   = $_POST["TBK_ID_SESION"]; 
    $TBK_ORDEN_COMPRA  = $_POST["TBK_ORDEN_COMPRA"]; 

	
	/* ENVÍO MAIL A IGNATIUS */
	enviarEmailAIgnatius($TBK_ORDEN_COMPRA);
	
	
?>
<CENTER> 
      <B>TRANSACCI&Oacute;N FRACASADA</B> 
      <TABLE> 
      <TR><TD> 
              Orden de compra n&uacute;mero: <?php  ECHO $TBK_ORDEN_COMPRA; ?><BR> 
      </TD></TR> 
      <tr>
          <td>
              Las posibles causas de este rechazo son:
              <ul>
                  <li>Error en el ingreso de los datos de su tarjeta de cr&eacute;dito o d&eacute;bito (fecha y/o c&oacute;digo de seguridad).</li>
                  <li>Su tarjeta de cr&eacute;dito o d&eacute;bito no cuenta con el cupo necesario para cancelar la compra.</li>
                  <li>Tarjeta a&uacute;n no habilitada en el sistema financiero. </li>
                  <li>Si el problema persiste, por favor comun&iacute;quese con su banco emisor.</li>
              </ul>
         </td>
          
      </tr>
      </TABLE> 
</CENTER> 
    
        <table width="100%">
                <tr>
                <td align="center">
                   <form method="post">
                        <input type="button" value="Cerrar" onclick="window.close()">
                    </form>
                </td>
            </tr>
        </table>

<?
}
?>
</div>