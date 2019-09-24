<?


class FatalErrorHandler {
	
	static function finalize($msg="",$drawTemplate=true) {
		if($drawTemplate) {
			GlobalManager::getTplMng()->setTemplate("error");
			GlobalManager::getTplMng()->setType(TEMPLATE_TYPE_HTML);
			GlobalManager::getTplMng()->setValue("msg",$msg);
			GlobalManager::getTplMng()->drawTemplate();
		}
		else {
			echo $msg;			
		}
		die();
	}
	
}

?>