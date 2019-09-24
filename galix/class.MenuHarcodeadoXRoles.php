<?php
include_once(GALIX_FOLDER."/class.Menu.php");



class MenuHarcodeadoXRoles extends Menu {

	

	function MenuHarcodeadoXRoles() {

		$this->menu = $this->getMenuCompleto();

/*		$orden_menu=0;

		$modulos_accesibles = SessionManager::getValue('modulos_accesibles');

		// TodavÃ­a no logueado

		if(!is_array($modulos_accesibles)) {

			return false;

		}

		

		$menuCompleto = $this->getMenuCompleto();

		foreach($modulos_accesibles as $key=>$modulo) {

			foreach($menuCompleto as $key=>$nodo) {

				if($this->itemInMenu($menuCompleto[$key],$modulo)) $menuCompleto[$key]['visible'] = true;

			}

		}

		

		

		foreach($menuCompleto as $key=>$nodo) {

			// Devuelve true si hay que eliminarlo

			if($this->limpiarNodoMenuCompleto($menuCompleto[$key])) {

				unset($menuCompleto[$key]);	

			}			

		}

		

		$this->menu = $menuCompleto;*/

	}



	function getMenuCompleto() {

		$menuCompleto = array();

		

		/* Regiones */

		$menuCompleto[0]['id'] = 'Regiones';

		$menuCompleto[0]['name'] = 'Regiones';

		$menuCompleto[0]['link'] = '';

		$menuCompleto[0]['kids'] = array();

		$menuCompleto[0]['visible'] = false;

		

		$menuCompleto[0]['kids'][0]['id'] = 'regiones_lista';

		$menuCompleto[0]['kids'][0]['name'] = "Lista";

		$menuCompleto[0]['kids'][0]['link'] = "index.php?module=regiones_lista";

		$menuCompleto[0]['kids'][0]['kids'] = array();

		$menuCompleto[0]['kids'][0]['visible'] = false;

		

		$menuCompleto[0]['kids'][1]['id'] = 'regiones_alta';

		$menuCompleto[0]['kids'][1]['name'] = "Alta";

		$menuCompleto[0]['kids'][1]['link'] = "index.php?module=regiones_alta";

		$menuCompleto[0]['kids'][1]['kids'] = array();

		$menuCompleto[0]['kids'][1]['visible'] = false;



		/* Subregiones */

		$menuCompleto[1]['id'] = 'Subregiones';

		$menuCompleto[1]['name'] = 'Subregiones';

		$menuCompleto[1]['link'] = '';

		$menuCompleto[1]['kids'] = array();

		$menuCompleto[1]['visible'] = false;

		

		$menuCompleto[1]['kids'][0]['id'] = 'subregiones_lista';

		$menuCompleto[1]['kids'][0]['name'] = "Lista";

		$menuCompleto[1]['kids'][0]['link'] = "index.php?module=subregiones_lista";

		$menuCompleto[1]['kids'][0]['kids'] = array();

		$menuCompleto[1]['kids'][0]['visible'] = false;

		

		$menuCompleto[1]['kids'][1]['id'] = 'subregiones_alta';

		$menuCompleto[1]['kids'][1]['name'] = "Alta";

		$menuCompleto[1]['kids'][1]['link'] = "index.php?module=subregiones_alta";

		$menuCompleto[1]['kids'][1]['kids'] = array();

		$menuCompleto[1]['kids'][1]['visible'] = false;

		

		/* Home */

		$menuCompleto[2]['id'] = 'Subregiones';

		$menuCompleto[2]['name'] = 'Subregiones';

		$menuCompleto[2]['link'] = '';

		$menuCompleto[2]['kids'] = array();

		$menuCompleto[2]['visible'] = false;

				

		/*

		/* Productos *

		$menuCompleto[0]['id'] = 'Productos';

		$menuCompleto[0]['name'] = 'Productos';

		$menuCompleto[0]['link'] = '';

		$menuCompleto[0]['kids'] = array();

		$menuCompleto[0]['visible'] = false;

		

		$menuCompleto[0]['kids'][0]['id'] = 'productos_lista';

		$menuCompleto[0]['kids'][0]['name'] = "Lista";

		$menuCompleto[0]['kids'][0]['link'] = "index.php?module=productos_lista";

		$menuCompleto[0]['kids'][0]['kids'] = array();

		$menuCompleto[0]['kids'][0]['visible'] = false;

		

		$menuCompleto[0]['kids'][1]['id'] = 'productos_alta';

		$menuCompleto[0]['kids'][1]['name'] = "Alta";

		$menuCompleto[0]['kids'][1]['link'] = "index.php?module=productos_alta";

		$menuCompleto[0]['kids'][1]['kids'] = array();

		$menuCompleto[0]['kids'][1]['visible'] = false;



		/* Rubros *

		$menuCompleto[1]['id'] = 'Rubros';

		$menuCompleto[1]['name'] = 'Rubros';

		$menuCompleto[1]['link'] = '';

		$menuCompleto[1]['kids'] = array();

		$menuCompleto[1]['visible'] = false;



		$menuCompleto[1]['kids'][0]['id'] = 'rubros_lista';

		$menuCompleto[1]['kids'][0]['name'] = "Lista";

		$menuCompleto[1]['kids'][0]['link'] = "index.php?module=rubros_lista";

		$menuCompleto[1]['kids'][0]['kids'] = array();

		$menuCompleto[1]['kids'][0]['visible'] = false;

		

		$menuCompleto[1]['kids'][1]['id'] = 'rubros_alta';

		$menuCompleto[1]['kids'][1]['name'] = "Alta";

		$menuCompleto[1]['kids'][1]['link'] = "index.php?module=rubros_alta";

		$menuCompleto[1]['kids'][1]['kids'] = array();

		$menuCompleto[1]['kids'][1]['visible'] = false;

		

		/* Obras *

		$menuCompleto[2]['id'] = 'Obras';

		$menuCompleto[2]['name'] = 'Obras';

		$menuCompleto[2]['link'] = '';

		$menuCompleto[2]['kids'] = array();

		$menuCompleto[2]['visible'] = false;

		

		$menuCompleto[2]['kids'][0]['id'] = 'obras_lista';

		$menuCompleto[2]['kids'][0]['name'] = "Lista";

		$menuCompleto[2]['kids'][0]['link'] = "index.php?module=obras_lista";

		$menuCompleto[2]['kids'][0]['kids'] = array();

		$menuCompleto[2]['kids'][0]['visible'] = false;

		

		$menuCompleto[2]['kids'][1]['id'] = 'obras_alta';

		$menuCompleto[2]['kids'][1]['name'] = "Alta";

		$menuCompleto[2]['kids'][1]['link'] = "index.php?module=obras_alta";

		$menuCompleto[2]['kids'][1]['kids'] = array();

		$menuCompleto[2]['kids'][1]['visible'] = false;

		*/

		return $menuCompleto;

	}

	

	// Debe poner en true los visibles si lo encuentra

	function itemInMenu(&$nodo, $modulo) {

		if($nodo['id']==$modulo) {

			$nodo['visible'] = true;

			return true;

		}

		else {

			if(sizeof($nodo['kids'])==0) {

				return false;

			}

			else {

				foreach($nodo['kids'] as $key=>$kid) {

					if($this->itemInMenu($nodo['kids'][$key],$modulo)) {

						$nodo['visible'] = true;

						return true; 

					}

				}

			}

		}

	}



	// Devuelve true si el nodo estÃ¡ debe quitarse

	function limpiarNodoMenuCompleto(&$nodo) {

		if(!$nodo['visible']) return true;

		else {

			foreach($nodo['kids'] as $key=>$kid) {

				if($this->limpiarNodoMenuCompleto($nodo['kids'][$key])) {

					unset($nodo['kids'][$key]);

				}

			}

			return false;

		}

	}

	

}




?>