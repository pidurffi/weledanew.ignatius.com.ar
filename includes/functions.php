<?php

function postToDb($key) {
	if(empty($_POST[$key])) return "";
	if (!get_magic_quotes_gpc()) {
    	return addslashes($_POST[$key]);
	} else {
	    return $_POST[$key];
	}
}

// Funcion que se debe usar solo para valores obtenidos del post
function valueToDb($value) {
	if (!get_magic_quotes_gpc()) {
    	return addslashes($value);
	} else {
	    return $value;
	}
}

function printr($value) {
	echo "<pre>";print_r($value);echo "</pre>";
}


function isValidId($value) {
	if(empty($value)) return false;
	if(!is_numeric($value)) return false;
	if(floor($value)!=$value) return false;
	if($value<=0) return false;
	return true;
}

function findFileName($path,$fileName) {
	$indice = 0;
	while(file_exists($path."/".$indice."_".$fileName)) $indice++;
	return $indice."_".$fileName;
}
?>