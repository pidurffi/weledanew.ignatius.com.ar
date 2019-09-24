<?php
include_once(GALIX_FOLDER."class.Menu.php");

class MenuSimpleLevel extends Menu {
	
	// Se crea el menu
	function MenuSimpleLevel($params) {
		
	}
	
	function insertElement($name,$link,$selected=false) {
		$nroElemento = sizeof($this->menu);
		$this->menu[$nroElemento]["name"] = $name;
		$this->menu[$nroElemento]["link"] = $link;
		$this->menu[$nroElemento]["selected"] = $selected;
	}
	
}


?>