<? include(TPL_FOLDER."tpl.admin_global_arriba.php"); ?>
<script src="../includes/functions.js" type="text/javascript" ></script>
<script type="text/javascript">
<? $module->showJavascript();?>
	var newLi;

	function writeMailSending(firstName,lastName,email) {
		ulList = document.getElementById('listado_emails');
		newLi = document.createElement("LI");
		newLi.appendChild(document.createTextNode("Enviando a "+lastName+", "+firstName+" ("+email+") ...... "));
		ulList.appendChild(newLi);
	}
	
	function writeMailStatus(ok,timelimit,errorMsg) {
		if(ok) {
			newLi.appendChild(document.createTextNode("OK"));
		}
		else {
			if(timelimit) {
				newLi.appendChild(document.createTextNode("ERROR: Límite de envíos alcanzado"));
			}
			else {
				newLi.appendChild(document.createTextNode("ERROR "+errorMsg));
			}
		}
	}
	
	function stop() {
		stopSendingMails();
	}
	
	function resume() {
		resumeSendingMails();
	}
	
</script>
<? if(empty($emails)) { ?>
No hay mails pendientes de env&iacute;o
<? } else { ?>
Envios
<? } ?>
<br/>

<ul id="listado_emails">
</ul>
<span id="emailTimer"></span><br/>

<script type="text/javascript">
sendMails();
</script>
<input type="button" value="pause" onclick="stop()" />
<input type="button" value="resume" onclick="resume()" />

<? include(TPL_FOLDER."tpl.admin_global_abajo.php"); ?>
