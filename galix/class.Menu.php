<?php


class Menu {

	protected $menu = array();

	

	// Se crea el menu

	function Menu($params) {

		

	}

	

	// Devuelve el menu con la siguiente forma

	// array[nro]['name'] array[nro]['link'] array[nro]['kids']

	function getMenuElements() {

		return $this->menu;

	}

	

	

}


?>