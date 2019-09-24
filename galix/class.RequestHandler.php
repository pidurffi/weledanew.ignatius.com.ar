<?



class RequestHandler {

	

	static function getGetValue($key) {

		if(isset($_GET[$key])) return $_GET[$key];

		else return null;

	}

	

	static function getPostValue($key) {

		if(!empty($_POST[$key])) return $_POSTT[$key];

		else return null;

	}

	

}



?>