<?php
include_once(GALIX_FOLDER."/class.Module.php");
include_once(GALIX_FOLDER."/class.EntityManager.php");
include_once(INCLUDE_FOLDER."/external/phpMailer/class.phpmailer.php");
include_once(INCLUDE_FOLDER."/external/phpMailer/class.smtp.php");

define("NEWSLETTER_STATUS_PENDING",0);
define("NEWSLETTER_STATUS_SENT",1);
define("NEWSLETTER_STATUS_ERROR",2);

define("NEWSLETTER_SENDING_STATUS_COMPLETE",1);
define("NEWSLETTER_SENDING_STATUS_PENDING",0);

define("NEWSLETTER_RESULT_OK","1");
define("NEWSLETTER_RESULT_ERROR","2");
define("NEWSLETTER_RESULT_TIME_LIMIT","3");

class ModuleNewsletterManager extends Module {
	private $newsEntity = "";
	private $mailsTable = "";
	private $mailsLastNameColumn = "";
	private $mailsFirstNameColumn = "";
	private $mailsEmailColumn = "";
	private $mailsFilterColumn = "";
	private $sendingTable = "";
	private $sendingNewsletterFKColumn = "";
	private $sendingTimestampColumn = "";
	private $sendingNewsMailTable = "";
	private $sendingNewsMailUserFKColumn = "";
	private $sendingNewsMailSendingFKColumn = "";
	private $sendingNewsMailResultColumn = "";
	//private $mailSelectionTemplate = "";
	private $limitControlTable = "";
	private $limitControlTimestampColumn = "";
	private $mailSendingsListTemplate = "";
	private $mailSendingTemplate = "";
	private $mailSubjectColumn = "";
	private $mailTemplate = "";
	private $mailTxtTemplate = "";
	private $mailsLimit = 0;
	
	private $emails = array();
	
	function ModuleNewsletterManager($params) {
		$this->newsEntity = $params["newsEntity"];
		$this->mailsTable =  $params["mailsTable"];
		$this->mailsLastNameColumn =  $params["mailsLastNameColumn"];
		$this->mailsFirstNameColumn =  $params["mailsFirstNameColumn"];
		$this->mailsEmailColumn =  $params["mailsEmailColumn"];
		$this->mailsFilterColumn = $params["mailsFilterColumn"];
		$this->sendingTable =  $params["sendingTable"];
		$this->sendingNewsletterFKColumn =  $params["sendingNewsletterFKColumn"];
		$this->sendingTimestampColumn =  $params["sendingTimestampColumn"];
		$this->sendingNewsMailTable = $params["sendingNewsMailTable"];
		$this->sendingNewsMailUserFKColumn = $params["sendingNewsMailUserFKColumn"];
		$this->sendingNewsMailSendingFKColumn = $params["sendingNewsMailSendingFKColumn"];
		$this->sendingNewsMailResultColumn = $params["sendingNewsMailResultColumn"];
		$this->limitControlTable = $params['limitControlTable'];
		$this->limitControlTimestampColumn = $params['limitControlTimestampColumn'];
		//$this->mailSelectionTemplate = $params["mailSelectionTemplate"];
		$this->mailSendingsListTemplate = $params["mailSendingsListTemplate"];
		$this->mailSendingTemplate = $params["mailSendingTemplate"];
		$this->mailSubjectColumn = $params["mailSubjectColumn"];
		$this->mailTemplate = $params["mailTemplate"];
		$this->mailTxtTemplate = (empty($params["mailTxtTemplate"]))?"":$params["mailTxtTemplate"];
		$this->mailsLimit = $params["mailsLimit"];
	}
	
	function exec($params) {
		switch(RequestHandler::getGetValue("task")) {
			case "send":	return $this->execMailsSending();break;
			case "sendMail": return $this->execSendMail();break;
			case "new_send": return $this->execNewSending();break;
			default:	return $this->execMailsSendingsList();
		}
	}
	
	function execNewSending() {
			// Se muestran los mails
			if(empty($this->mailsFirstNameColumn)) $this->mailsFirstNameColumn = "'-'";
			if(empty($this->mailsLastNameColumn)) $this->mailsLastNameColumn = "'-'";
			
			$sql = "SELECT ".$this->mailsFirstNameColumn." AS first_name, ";
			$sql.= $this->mailsLastNameColumn." AS last_name, ";
			$sql.= $this->mailsEmailColumn." AS email, id ";
			$sql.= "FROM ".$this->mailsTable;
			if(!empty($this->mailsFilterColumn)) {
				$sql.= " WHERE ".$this->mailsFilterColumn. " = 1 ";
			}
			$res = $this->_db->execute($sql);
			if(!$res) FatalErrorHandler::finalize("Config Error: Imposible buscar base de datos de personas");

			$mails = array();
			while($reg = $this->_db->getRow($res)) {
				$mails[$reg['id']] = $reg['email']; 
			}
			
			// Se procesa la seleccion
			// Creo el envio
			$sql = "INSERT INTO ".$this->sendingTable."(".$this->sendingNewsletterFKColumn.",".$this->sendingTimestampColumn.") VALUES ";
			$sql.= "('".RequestHandler::getGetValue('id')."',NOW())";
			$res = $this->_db->execute($sql);

			if(!$res) {
				FatalErrorHandler::finalize("Imposible crear el env&iacute;o");
			}
			$sendingId = $this->_db->lastId();
			
			
			foreach($mails as $id=>$value) {
				$sql = "INSERT INTO ".$this->sendingNewsMailTable."(".$this->sendingNewsMailSendingFKColumn;
				$sql.= ",".$this->sendingNewsMailUserFKColumn.",".$this->sendingNewsMailResultColumn.") VALUES ";
				$sql.= "('".$sendingId."','".$id."','".NEWSLETTER_STATUS_PENDING."')";
				$res = $this->_db->execute($sql);
				if(!$res) {
					FatalErrorHandler::finalize("Imposible crear registro de envio");	
				}
			}
			header("Location: index.php?module=".RequestHandler::getGetValue("module")."&task=send&id_sending=".$sendingId);
	}
	
	function execMailsSendingsList() {
		$errors = array();
		
		$sql = "SELECT id,".$this->sendingNewsletterFKColumn." AS id_newsletter, ".$this->sendingTimestampColumn." AS date ";
		$sql.= "FROM ".$this->sendingTable;

		$res = $this->_db->execute($sql);
		if(!$res) FatalErrorHandler::finalize("Config Error: Imposible buscar envios");
		$list = array();
		while($reg = $this->_db->getRow($res)) {
			$stat = NEWSLETTER_SENDING_STATUS_COMPLETE;
			$sql = "SELECT DISTINCT(".$this->sendingNewsMailResultColumn.") FROM ".$this->sendingNewsMailTable;
			$sql.= " WHERE ".$this->sendingNewsMailSendingFKColumn." = ".$reg['id'];
			$res2 = $this->_db->execute($sql);
			if($res) {
				while($reg2 = $this->_db->getRow($res2)) {
					if(($reg2[$this->sendingNewsMailResultColumn] == NEWSLETTER_STATUS_PENDING) ||				
					   ($reg2[$this->sendingNewsMailResultColumn] == NEWSLETTER_STATUS_ERROR) ) {
					   	$stat = NEWSLETTER_SENDING_STATUS_PENDING;				
					   }
				}
			}
			else {
				$stat = NEWSLETTER_SENDING_STATUS_PENDING;
			}
			$reg['stat'] = $stat;
			$list[] = $reg;
		}

		GlobalManager::getTplMng()->setValue("errors",$errors);
		GlobalManager::getTplMng()->setValue("list",$list);
		GlobalManager::getTplMng()->setValue("module",$this);
		GlobalManager::getTplMng()->setTemplate($this->mailSendingsListTemplate);
		GlobalManager::getTplMng()->drawTemplate();
		
	}
	
	/*function execMailsSelection() {
		$errors = array();
		$entityManager = new EntityManager($this->newsEntity,array());
		$entityManager->prepareFields();
		if(!$entityManager->loadFromDb($errors,RequestHandler::getGetValue("id"))) {
			FatalErrorHandler::finalize("Newsletter In&aacute;lido");
		}
				
		if((empty($_POST['send']))||(empty($_POST['mails']))) {
			// Se muestran los mails
			if(empty($this->mailsFirstNameColumn)) $this->mailsFirstNameColumn = "'-'";
			if(empty($this->mailsLastNameColumn)) $this->mailsLastNameColumn = "'-'";
			
			$sql = "SELECT ".$this->mailsFirstNameColumn." AS first_name, ";
			$sql.= $this->mailsLastNameColumn." AS last_name, ";
			$sql.= $this->mailsEmailColumn." AS email, id ";
			$sql.= "FROM ".$this->mailsTable;
			$res = $this->_db->execute($sql);
			
			if(!$res) FatalErrorHandler::finalize("Config Error: Imposible buscar base de datos de personas");
			$list = array();
			while($reg = $this->_db->getRow($res)) {
				$list[] = $reg;
			}
			if(isset($_POST['send'])) {
				$errors[] = "Falta seleccionar emails";
			}
			
			GlobalManager::getTplMng()->setValue("errors",$errors);
			GlobalManager::getTplMng()->setValue("list",$list);
			GlobalManager::getTplMng()->setValue("module",$this);
			GlobalManager::getTplMng()->setTemplate($this->mailSelectionTemplate);
			GlobalManager::getTplMng()->drawTemplate();
		}
		else {
			// Se procesa la seleccion
			// Creo el envio
			$sql = "INSERT INTO ".$this->sendingTable."(".$this->sendingNewsletterFKColumn.",".$this->sendingTimestampColumn.") VALUES ";
			$sql.= "('".RequestHandler::getGetValue('id')."',NOW())";
			$res = $this->_db->execute($sql);

			if(!$res) {
				FatalErrorHandler::finalize("Imposible crear el env&iacute;o");
			}
			$sendingId = $this->_db->lastId();
			
			foreach($_POST['mails'] as $id=>$value) {
				$sql = "INSERT INTO ".$this->sendingNewsMailTable."(".$this->sendingNewsMailSendingFKColumn;
				$sql.= ",".$this->sendingNewsMailUserFKColumn.",".$this->sendingNewsMailResultColumn.") VALUES ";
				$sql.= "('".$sendingId."','".$id."','".NEWSLETTER_STATUS_PENDING."')";
				$res = $this->_db->execute($sql);
				if(!$res) {
					FatalErrorHandler::finalize("Imposible crear registro de envio");	
				}
			}
			header("Location: index.php?module=".RequestHandler::getGetValue("module")."&task=send&id_sending=".$sendingId);
		}
		
	}*/

	public function showFormField($id) {
		?><input type="checkbox" name="mails[<?=$id?>]" /><?
	}
	
	
	function execMailsSending() {
		
		$sql = "SELECT ".$this->mailsFirstNameColumn." as first_name,".$this->mailsLastNameColumn." as last_name,";
		$sql.= $this->mailsEmailColumn." as email, c.".$this->sendingNewsMailUserFKColumn." as id ";
		$sql.= " FROM ".$this->mailsTable." t JOIN ".$this->sendingNewsMailTable." c ";
		$sql.= "ON t.id = c.".$this->sendingNewsMailUserFKColumn;
		$sql.= " WHERE (c.".$this->sendingNewsMailResultColumn." = '".NEWSLETTER_STATUS_PENDING."' ";
		$sql.= " OR c.".$this->sendingNewsMailResultColumn." = '".NEWSLETTER_STATUS_ERROR."' )";
		$sql.= " AND c.".$this->sendingNewsMailSendingFKColumn." = '".addslashes(RequestHandler::getGetValue("id_sending"))."' ";
		$res = $this->_db->execute($sql);
		if(!$res) {
			FatalErrorHandler::finalize("Imposible encontrar datos de emails de env&iacute;o");
		}
		
		while($reg = $this->_db->getRow($res)) {
			$this->emails[] = $reg;
		}
		GlobalManager::getTplMng()->setValue("module",$this);
		GlobalManager::getTplMng()->setValue("emails",$this->emails);
		GlobalManager::getTplMng()->setTemplate($this->mailSendingTemplate);
		GlobalManager::getTplMng()->drawTemplate();
		
	}

	// Debe haber 2 funciones callback programadas en el template
	// Una para dibujar el pedido y otro el resultado
	// Ademas, abajo de todo debe haber una llamada a la funcion js sendMails();
	public function showJavascript() { ?>
		var emails = new Array();
		var actual = -1;
		var keepSending = 1;
		var timeLimit = 0;
		
		function verifyCallbacks() {
			if((!window.writeMailSending)||(!window.writeMailStatus)) {
				alert("Error de template. Imposible enviar los emails");
				return false;
			}
			if(!window.getXmlHttpObject) {
				alert("Error de template. Falta incluir archivo general funciones.js");
				return false;
			}
			return true;
		}
	
		function sendMails() {
			if(!verifyCallbacks()) return false;

			sendMail(0);			
		}
		
		function stopSendingMails() {
			keepSending = 0;
		}
		
		function resumeSendingMails() {
			keepSending = 1;
			sendMail(actual + 1);
		}
		
		function sendMail(i) {
			if(keepSending) {
				if(i < emails.length) {
					actual = i;
					httpObject = new getXmlHttpObject();
					enviaQuery( httpObject, 'index.php?module=<?=RequestHandler::getGetValue("module")?>&task=sendMail&id_sending=<?=RequestHandler::getGetValue("id_sending") ?>&id_mail='+emails[i][3], requestCallback );
					writeMailSending(emails[i][0],emails[i][1],emails[i][2]);
				}
			}
		}
		
		function requestCallback() {
			if(httpObject.readyState == 4) {
				text = httpObject.responseText;
				if(text.substring(0,1) == "<?=NEWSLETTER_RESULT_TIME_LIMIT?>") {
					timeLimit = text.substring(2,text.length);
					setInterval("timeLimitRefresh()",1000);
					writeMailStatus(false,true,"");
				}
				else {
					if(text == "<?=NEWSLETTER_RESULT_OK ?>") {
						writeMailStatus(true,false,"");
					}
					else {
						writeMailStatus(false,false,text.substring(2,text.length));
					}
					sendMail(actual+1);
				}
			}			
		}
		
		function timeLimitRefresh() {
			timeLimit -= 1;
			if(elem = document.getElementById("emailTimer")) {
				sec = timeLimit%60;
				if(sec < 10) sec = "0"+sec
				elem.innerHTML = (Math.floor(timeLimit/60)) + ":" + sec;
			}
			else {
				
			}
			if(timeLimit < 0) {
				window.document.location = window.document.location;
			}
		}
		
			var i = 0;		
		<? foreach($this->emails as $email) { ?>
			emails[i] = new Array();
			emails[i][0] = "<?=$email["first_name"] ?>";
			emails[i][1] = "<?=$email["last_name"] ?>";
			emails[i][2] = "<?=$email["email"] ?>";
			emails[i][3] = "<?=$email['id']?>";
			i++;
		<? } ?>
	<? }

	private function generateMailBody($entity,$firstName,$lastName) {
		GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STRING;
		GlobalManager::getTplMng()->setValue("entity",$entity);
		GlobalManager::getTplMng()->setValue("firstName",$firstName);
		GlobalManager::getTplMng()->setValue("lastName",$lastName);
		GlobalManager::getTplMng()->setTemplate($this->mailTemplate);
		$cuerpo = GlobalManager::getTplMng()->drawTemplate();
		GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STANDARD;
		return $cuerpo;
	}
	
	private function generateMailTextBody($entity,$firstName,$lastName) {
		if(empty($this->mailTxtTemplate)) return "";
		GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STRING;
		GlobalManager::getTplMng()->setValue("entity",$entity);
		GlobalManager::getTplMng()->setValue("firstName",$firstName);
		GlobalManager::getTplMng()->setValue("lastName",$lastName);
		GlobalManager::getTplMng()->setTemplate($this->mailTxtTemplate);
		$cuerpo = GlobalManager::getTplMng()->drawTemplate();
		GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STANDARD;
		return $cuerpo;
	}
	
	public function execSendMail() {
		// Verifico que pueda mandar mails
		
		$sql = "SELECT COUNT(*) AS cant FROM ".$this->limitControlTable." ";
		$sql.= "WHERE ".$this->limitControlTimestampColumn." > NOW() - INTERVAL 1 HOUR ";
		$res = $this->_db->execute($sql);
		if(!$res) {
			FatalErrorHandler::finalize("Imposible buscar los envíos de mail",false);
		}
		$reg = $this->_db->getRow($res);
		if($reg['cant'] >= $this->mailsLimit) {
			$sql = "SELECT MAX( TIMEDIFF(".$this->limitControlTimestampColumn." + INTERVAL 1 HOUR, NOW())) as falta FROM ".$this->limitControlTable;
			$res = $this->_db->execute($sql);
			$reg = $this->_db->getRow($res);
			list($h,$m,$s) = explode(":",$reg['falta']);
			echo NEWSLETTER_RESULT_TIME_LIMIT." ".($h*60*60+$m*60+$s);
			die();
		}
		
		$sql = "SELECT ".$this->mailsFirstNameColumn." as first_name,".$this->mailsLastNameColumn." as last_name,";
		$sql.= $this->mailsEmailColumn." as email, c.".$this->sendingNewsMailUserFKColumn." as id ";
		$sql.= " FROM ".$this->mailsTable." t JOIN ".$this->sendingNewsMailTable." c ";
		$sql.= "ON t.id = c.".$this->sendingNewsMailUserFKColumn;
		$sql.= " WHERE c.".$this->sendingNewsMailResultColumn." = '".NEWSLETTER_STATUS_PENDING."' ";
		$sql.= " AND c.".$this->sendingNewsMailSendingFKColumn." = '".addslashes(RequestHandler::getGetValue("id_sending"))."' ";
		$sql.= " AND c.".$this->sendingNewsMailUserFKColumn." = '".addslashes(RequestHandler::getGetValue("id_mail"))."' ";
		$res = $this->_db->execute($sql);
		if((!$res)||(!$client = $this->_db->getRow($res))) {
			FatalErrorHandler::finalize(NEWSLETTER_RESULT_ERROR." Imposible encontrar datos de email de env&iacute;o",false);
		}
		$sql = "SELECT ".$this->sendingNewsletterFKColumn." as id_entity ";
		$sql.= "FROM ".$this->sendingTable. " st ";
		$sql.= "WHERE id = '".addslashes(RequestHandler::getGetValue('id_sending'))."'";
		$res = $this->_db->execute($sql);
		if((!$res)||(!$ent = $this->_db->getRow($res))) {
			FatalErrorHandler::finalize(NEWSLETTER_RESULT_ERROR." Imposible encontrar datos de email de env&iacute;o",false);
		}
		
		$errors = array();
		$entityManager = new EntityManager($this->newsEntity,array());
		$entityManager->prepareFields();
		
		$aux = $entityManager->find(true,"@entity_id = '".$ent['id_entity']."'");
		if((!$aux)||(sizeof($aux)!=1)) {
			FatalErrorHandler::finalize(NEWSLETTER_RESULT_ERROR." Mail In&aacute;lido",false);
		}
		
		$entity = $aux[0];
		
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
        
        $mail->Host = "mail.noticiasweleda.com.ar";
        $mail->Port = 26;
        $mail->Username = "info@noticiasweleda.com.ar";
        $mail->Password = "info4567";
        $mail->From = "info@noticiasweleda.com.ar";
		if(CONSTANTE_PAIS == "Argentina") $mail->FromName = "Weleda Argentina";
			elseif(CONSTANTE_PAIS == "Chile") $mail->FromName = "Weleda Chile";
				else $mail->FromName = "Weleda";
        $mail->SMTPDebug  = 1; 
        $mail->Timeout = 10;

        /*
        $mail->SMTPSecure = "ssl";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465;
		$mail->Username = "phpmailtesting@gmail.com";
		$mail->Password = "dorismar";
		$mail->From = "Pruebas";
		$mail->FromName = "Pruebas";
        */
        
		$mail->Subject = $entity[$this->mailSubjectColumn];
		$mail->AltBody = $this->generateMailTextBody($aux[0],$client['first_name'],$client['last_name']);
		$body = $this->generateMailBody($aux[0],$client['first_name'],$client['last_name']);
		if(!$body) {
			FatalErrorHandler::finalize(NEWSLETTER_RESULT_ERROR." Imposible general cuerpo del mail",false);
		}
		$mail->MsgHTML($body);
		$mail->AddAddress($client['email'],$client['email']);
		$mail->IsHTML(true);
		$result = NEWSLETTER_STATUS_SENT;
		if(!$mail->Send()) {
			echo NEWSLETTER_RESULT_ERROR." ".$mail->ErrorInfo;
			$result = NEWSLETTER_STATUS_ERROR;
		}
		else {
			echo NEWSLETTER_RESULT_OK;
		}
		$sql = "UPDATE ".$this->sendingNewsMailTable." SET ".$this->sendingNewsMailResultColumn." = '".$result."' ";
		$sql.= "WHERE ".$this->sendingNewsMailSendingFKColumn."='".addslashes(RequestHandler::getGetValue('id_sending'))."' ";
		$sql.= "AND ".$this->sendingNewsMailUserFKColumn."= '".addslashes(RequestHandler::getGetValue("id_mail"))."'";
		$res = $this->_db->execute($sql);

		// Grabo control de envio de mails
		$sql = "INSERT INTO ".$this->limitControlTable."(".$this->limitControlTimestampColumn.") VALUES (NOW());";
		$res = $this->_db->execute($sql);
		if(!$res) {
			FatalErrorHandler::finalize("Imposible grabar el envío del mail",false);
		}
		
	}
	
}

?>