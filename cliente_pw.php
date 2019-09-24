<?
/* página para pedir el envío de la contrase?a por mail */
$seccion = "clientes";
$actual = "clientes";
$archivoMenuIzq = $_SERVER['DOCUMENT_ROOT']."/inc/inc.columna_izquierda_$seccion.php";
include("tpl/tpl.front_template_arriba.php");

// Datos para conectar a la base.
include_once("specification/database.php");
$db_username = $_SPECIFICATION['DbClass']['params']['user'];
$db_password = $_SPECIFICATION['DbClass']['params']['pass'];
$db_dbname = $_SPECIFICATION['DbClass']['params']['dbname'];

include_once("includes/external/phpMailer/class.phpmailer.php");
include_once("includes/external/phpMailer/class.smtp.php");

?>

<?
if(isset($_POST["submit"]))
{
    //echo "Se apretó Submit";
    $errores[] = "";
    $email = $_POST[email];
    $sql = "SELECT password FROM cliente WHERE email = '".trim($email)."';";

    $conexion = mysql_connect("localhost",$db_username,$db_password)  or die("No conecta.");
    mysql_select_db($db_dbname, $conexion);

    $result = mysql_query($sql, $conexion) or die("No lee. ".$sql);

    if(mysql_num_rows($result) > 0)
    {
        // SE ENCONTRÓ LA CONTRASE?A
        $myrow = mysql_fetch_array($result);
        $password_recuperada = $myrow[password];

        // ENVÍO EL MAIL AL DESTINATARIO ($email)
                $mail = new PHPMailer();
                $mail->CharSet = "utf-8";
		$mail->From = "noreply@weleda.com.ar";
                $mail->FromName = "Weleda";
                $subject = "Datos de su cuenta";
                $mail->Subject = $subject;

		$body = "Sus datos para acceder al sitio de Weleda son los siguientes:<br />
                        Usuario: $email<br />
                        Contrase&ntilde;a: $password_recuperada";

                $mail->AltBody = "Sus datos para acceder al sitio de Weleda son los siguientes:
                        Usuario: $email
                        Contrase?a: $password_recuperada";
		
		$mail->Body = $body;

		$mail->AddAddress($email);
		$mail->IsHTML(false);

		if(!$mail->Send()) {
                        print("No se ha enviado un mensaje.<br />");
		}
		else {
                          ?>
                            <p style="font-size:12px;">
                                Se ha enviado un mensaje a <?=$email?> con la contrase&ntilde;a.<br /><br />
                                No olvide revisar su carpeta de correo no deseado en caso de que no lo reciba.
                            </p>
                            <p><a href="index.php">Volver a la p&aacute;gina de inicio</a></p>
                          <?
		}
    }
    else
    {
        // NO SE ENCONTRÓ LA CONTRASE?A
        ?>
            <p style="font-size:12px;">
                No se encontr&oacute; ning&uacute;n usuario con la direcci&oacute;n <?=$email?><br />
            </p>
            <p><a href="index.php">Volver a la p&aacute;gina de inicio</a></p>
        <?
    }

    

}
else
{
    // No se apretó Submit
    ?>

        <p style="font-size:12px;">
        Ingrese sus direcci&oacute;n de correo electr&oacute;nico para recibir la contrase&ntilde;a.
        </p>

      <form method="post" enctype="multipart/form-data" action="<?=$PHP_SELF;?>">
            <table border="0" align="center" width="100%">
                    <tr>
                            <td>Correo electr&oacute;nico</td>
                            <td><input type="text" id="email" name="email" size="32" maxlength="50" /></td>
                    </tr>
                    <tr>
                            <td>&nbsp;</td>
                            <td  align="left">
                                    <input name="submit" type="submit" value="Enviar" />
                            </td>
                    </tr>
            </table>


</form>

<?
}

?>
<? include("tpl/tpl.front_template_abajo.php"); ?>