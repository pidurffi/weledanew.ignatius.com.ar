<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/StylesSelectorPiel.css">
	</head>
	<body>
		<div style="margin-bottom:8px;" align="center">
			<img class="" src="http://weleda.com.ar/imagenes/SelectorPiel/Top_SelectorPiel.jpg" alt="" border="0" /><br />
		
		<?PHP if(!empty($_POST)){
			include_once("includes/external/phpMailer/class.phpmailer.php");
			include_once("includes/external/phpMailer/class.smtp.php");

			ob_start();
			include("css/StylesSelectorPiel.css");
			$email_estilos = ob_get_contents();
			ob_end_clean();

			$mail = new PHPMailer();
			$mail->FromName = "Weleda";
			$mail->From = "noreply@weleda.com.ar";
			$mail->CharSet = "UTF-8";
			$mail->Subject = "Tu experta Weleda online te recomienda";
			$mail->AltBody = "";

			$mail->MsgHTML('<html><head><style type="text/css">'.$email_estilos.'</style></head>'.$_POST['html_body'].'</html>');
			$mail->AddAddress($_POST['email']);
			$mail->IsHTML(true);
			if (!$mail->Send()) {
				error_log("No se pudo enviar el mail del resultado de piel");
				$message = "No se puedo enviar el correo. Intente nuevamente.";
				echo "<script type='text/javascript'>alert('$message'); javascript:history.back(1)</script>";
			}else{
				print 'Correo enviado correctamente'; ?><br />
				<a href="javascript:history.back(1)">
					<h3>Volver</h3>
				</a>
		</div>		
	</body>
</html>			
		<?
			}
		}else{
			?> <meta http-equiv="refresh" content="0; url=SelectorPiel.php" /> <?php
		}
?>