<?php
include_once(GALIX_FOLDER."/class.Module.php");
include_once(INCLUDE_FOLDER."/external/phpMailer/class.phpmailer.php");
include_once(INCLUDE_FOLDER."/external/phpMailer/class.smtp.php");

class ModuleAvisoNewsletters extends Module {

	var $template = "";
	var $emailAviso = "";

	function ModuleAvisoNewsletters($params) {
 		$this->template = $params['template'];
 		$this->emailAviso = $params['emailAviso'];
	}

	function exec($params) {
		
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465;
		$mail->Username = "phpmailtesting@gmail.com";
		$mail->Password = "dorismar";
		$mail->From = "Pruebas";
		$mail->FromName = "Pruebas";
		$mail->Subject = "WELEDA - Se ha realizado un envio de newsletters";
		$mail->AltBody = "";
		
		GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STRING;
		GlobalManager::getTplMng()->setTemplate($this->template);
		$cuerpo = GlobalManager::getTplMng()->drawTemplate();
		GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STANDARD;
		$mail->MsgHTML($cuerpo);
		$mail->AddAddress($this->emailAviso,$this->emailAviso);
		$mail->IsHTML(true);
		$mail->Send();
		header("location: index.php?module=".RequestHandler::getGetValue("nextmodule")."&task=".RequestHandler::getGetValue("task")."&id=".RequestHandler::getGetValue("id"));
	}


}

?>