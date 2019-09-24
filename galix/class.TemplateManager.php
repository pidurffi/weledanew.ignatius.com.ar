<?php

define("TEMPLATE_TYPE_HTML",1);
define("TEMPLATE_TYPE_CSS",2);

define("TEMPLATE_OUTPUT_STANDARD",1);
define("TEMPLATE_OUTPUT_STRING",2);

class TemplateManager {
	var $template;
	var $values = array();
	var $type = TEMPLATE_TYPE_HTML;
	var $output = TEMPLATE_OUTPUT_STANDARD;
	
	function setType($typeTemplate) {
		$this->type = $typeTemplate;
	}
	
	function setTemplate($template) {
		$this->template = $template;
	}
	
	function drawTemplate() {
		$file = "";
		if($this->type == TEMPLATE_TYPE_HTML) {
			if($this->output == TEMPLATE_OUTPUT_STANDARD) header("Content-type: text/html");
			$file = TPL_FOLDER."tpl.".$this->template.".php";
		}
		if($this->type == TEMPLATE_TYPE_CSS) {
			$file = CSS_FOLDER.$this->template.".css.php";
			if($this->output == TEMPLATE_OUTPUT_STANDARD) header("Content-type: text/css");
		}
		
		if(file_exists($file)) {
			// Seteo variables de alcance local, solo dentro del template
			foreach($this->values as $key=>$value) {
				$$key = $value; 
			}
			if($this->output == TEMPLATE_OUTPUT_STRING) {
				ob_clean();
				include($file);
				$out = ob_get_contents();
				ob_clean();
				return $out;
			}
			else {
				include($file);
			}
		}
		else {
			return false;
		}
		return true;
	}
	
	function setValue($key,$valor) {
		$this->values[$key]=$valor;
	}
	
	// MÃ¡s que nada para manejo de arrays
	function getValue($key) {
		return $this->values[$key];
	}
	
	function deleteValue($key) {
		unset($this->values[$key]);
	}
	
	
}

?>