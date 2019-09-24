<?php

include_once(GALIX_FOLDER."class.Field.php");
include_once(GALIX_FOLDER."class.EntityManager.php");

/// TODO: Hacer valido para mas de 2 combos

class FieldComplexDirectReference extends Field {
	var $name;
	var $visualName;
	var $tableName;

	var $required;
	var $entitiesReferreds;
	var $values;

	function FieldComplexDirectReference($name,$params) {
		$this->name = $name;
		$this->visualName = $params['visualName'];
		$this->tableName = $params['tableName'];

		$this->required = $params['required'];
		$this->entitiesReferreds = $params['entitiesReferreds'];
	}


	function createJavascript() { ?>
		var http_CDR_<?=$this->name?>;
		var idControl_CDR_<?=$this->name?>;
		var maxI_CDR_<?=$this->name?> = -1;
		var pedidos_CDR_<?=$this->name?> = new Array();
		var valores_CDR_<?=$this->name?> = new Array();
		/*var cargando_CDR_<?=$this->name?> = 1;
		var cargando_ultimo_CDR_<?=$this->name?> = 0;*/

		function html_entity_decode_CDR_<?=$this->name?>(str) {
			var textTmp = document.createElement('textarea');
			textTmp.innerHTML = str;
			return textTmp.value;
		}

		function vaciarSelect_CDR_<?=$this->name?>(combo) {
			for(i=combo.options.length-1;i>=0;i--) {
				combo.remove(i);
			}
		}

		function fillCombo_CDR_<?=$this->name?>(nro,elements) {
			var elem = document.getElementById('CDR_<?=$this->name?>_'+nro);
			if(!elem) return false;
			vaciarSelect_CDR_<?=$this->name?>(elem);
			<? if(!$this->required )  { ?>
			if(nro == 0) {
				option = document.createElement('option');
				option.setAttribute('value','');
				option.appendChild(document.createTextNode("Ninguno"));
				elem.appendChild(option);
			}
			<? } ?>
			for(i=0; i < elements.length; i++) {
				option = document.createElement('option');
				option.setAttribute('value', elements[i].getAttribute('value'));
				option.appendChild(document.createTextNode(html_entity_decode_CDR_<?=$this->name?>(elements[i].firstChild.nodeValue)));
				elem.appendChild(option);
			}
			elem.value = valores_CDR_<?=$this->name?>[nro];
		}

		function handleHttpResponse_CDR_<?=$this->name?>() {
			if(http_CDR_<?=$this->name?>.readyState == 4) {
				var elementos = http_CDR_<?=$this->name?>.responseXML.getElementsByTagName('item');
				fillCombo_CDR_<?=$this->name?>(idControl_CDR_<?=$this->name?>,elementos);
				document.getElementById('CDR_<?=$this->name?>_'+idControl_CDR_<?=$this->name?>).onchange();

				/*if((cargando_CDR_<?=$this->name?>)&&(cargando_ultimo_CDR_<?=$this->name?>)) {
					cargando_CDR_<?=$this->name?> = 0;
				}*/

			}
		}


		function getXmlHttpObject_CDR_<?=$this->name?>() {
			var xmlhttp;
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e) {
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e) {
					try {
						xmlhttp = new XMLHttpRequest();
					}
					catch (e) {
						xmlhttp = false;
						alert("Error de configuracion. Imposible ejecutar Ajax Request");
					}
				}
			}
			return xmlhttp;
		}

		function enviaQuery_CDR_<?=$this->name?>( nro, archivo) {
			http_CDR_<?=$this->name?> = getXmlHttpObject_CDR_<?=$this->name?>();
			http_CDR_<?=$this->name?>.open("GET", archivo, true);

			idControl_CDR_<?=$this->name?> = nro;
			http_CDR_<?=$this->name?>.onreadystatechange = handleHttpResponse_CDR_<?=$this->name?>;

			http_CDR_<?=$this->name?>.send(null);
		}

		function changeCDR_<?=$this->name?>(combo, nro) {
			/*if(cargando_CDR_<?=$this->name?>)
				if(nro == maxI_CDR_<?=$this->name?>) cargando_ultimo_CDR_<?=$this->name?> = 1;
			}*/
			if(nro < maxI_CDR_<?=$this->name?>) {
				// Se cambia el siguiente
				enviaQuery_CDR_<?=$this->name?>((nro+1),pedidos_CDR_<?=$this->name?>[nro+1]+'&filterValue='+combo.value);
			}
		}
<?	}

	function showFormField($params) {
		$i=0;
		$primerKey = "";
		foreach($this->entitiesReferreds as $key=>$valor) {
			if($i == 0) $primerKey = $key;
		?>
			<select onchange="changeCDR_<?=$this->name?>(this,<?=$i?>)" name="CDR_<?=$this->name?>[<?=$i?>]" id="CDR_<?=$this->name?>_<?=$i?>"></select>
			<script type="text/javascript">
				pedidos_CDR_<?=$this->name?>[<?=$i?>] = 'index.php?module=combo_request&entity=<?=$valor["entityReferred"]?>&descField=<?=$valor["descriptionFieldName"]?>&filterBy=<?=$valor["referenceFieldName"]?>';
				valores_CDR_<?=$this->name?>[<?=$i?>] = <?=(!empty($_POST['CDR_'.$this->name][$i]))?$_POST['CDR_'.$this->name][$i]:"0";?>;
			</script>
	  	<?	$i++;
		}
		?>
		<script type="text/javascript">
			maxI_CDR_<?=$this->name?> = <?=$i-1?>;
			enviaQuery_CDR_<?=$this->name?>( 0,'index.php?module=combo_request&entity=<?=$this->entitiesReferreds[$primerKey]["entityReferred"]?>&descField=<?=$this->entitiesReferreds[$primerKey]["descriptionFieldName"]?>');
		</script>
		<?
	}

	function validateFromPost(&$errors) {
		if(!$this->required) return true;

		if(empty($_POST["CDR_".$this->name][sizeof($this->entitiesReferreds)-1])) {
			$errors[] = "El campo ".$this->visualName." es obligatorio";
			return false;
		}
		return true;
	}

	function fillWithPost() {
		$this->values = $_POST["CDR_".$this->name];
	}

	function  hasDirectSave() {
		return true;
	}

	function getValueForDbFromPost(&$isNull=false) {
		if(empty($this->values[sizeof($this->values)-1])) $isNull = true;
		return valueToDb($this->values[sizeof($this->values)-1]);

	}

	function fillWithDb($reg) {
		$primerCiclo = true;
		$campoAnterior = "";
		$tmpValues = array();
		foreach(array_reverse($this->entitiesReferreds) as $key=>$reference) {
			if($primerCiclo) {
				$tmpValues[] = $reg[$this->tableName];
				$primerCiclo = false;
			}
			else {
				$tmpValues[] = $reg[$campoAnterior];
			}
			$campoAnterior = $reference["referenceFieldName"];
		}
		$this->values = array_reverse($tmpValues);

		foreach($this->values as $key=>$value) {
			$_POST["CDR_".$this->name][$key] = $value;
		}
//		$this->visualValue = $reg[$this->name];
		//$this->value = $reg[$this->tableName];
	}

	function getJoinSql($entityTableName,$uniqueExtraAlias) {
		$sql = "";
		$primerJoin = true;
		$tablaJoin = $entityTableName;
		$campoJoin = "";
		foreach(array_reverse($this->entitiesReferreds) as $key=>$reference) {
			$em = new EntityManager($reference["entityReferred"],array());
			$referenceTableName = $em->getEntityObject()->directTable;
			if(!$this->required) {
				$sql .= " LEFT ";
			}

			$sql .= "JOIN ".$referenceTableName." ".$uniqueExtraAlias.$key." ";
			if($primerJoin) {
				$sql .= " ON ".$tablaJoin.".".$this->tableName." = ".$uniqueExtraAlias.$key.".id ";
				$primerJoin = false;
			}
			else {
				$sql .= " ON ".$tablaJoin.".".$campoJoin." = ".$uniqueExtraAlias.$key.".id ";
			}

			$tablaJoin = $uniqueExtraAlias.$key;
			$campoJoin = $reference['referenceFieldName'];
		}
		return $sql;
	}

	function getFieldSqlDescription($entityTableName,$uniqueExtraAlias) {
		$i = 0;
		$sql = " ";
		$primerJoin = true;
		$campoJoin = "";
		$tablaJoin = "";
		foreach(array_reverse($this->entitiesReferreds) as $key=>$reference) {
			$i++;
			$sql .= " ".$uniqueExtraAlias.$key.".".$reference['descriptionFieldName']." AS ".$key.", ";
			if($primerJoin) {
				$sql .= $entityTableName.".".$this->tableName." AS ".$this->tableName;
				$primerJoin = false;
			}
			else {
				$sql .= $tablaJoin.".".$campoJoin;
			}

			if($i < sizeof($this->entitiesReferreds)) {
				$sql .= ",";
			}
			$campoJoin = $reference["referenceFieldName"];
			$tablaJoin = $uniqueExtraAlias.$key;
		}

		return $sql;

	}



	function getValue() {

		return $this->values[sizeof($this->values)-1];

	}

	// DEPRECADO, NO USAR. EL ORDEN SE PASA DIRECTAMENTE EL NOMBRE DE LA COLUMNA A ORDENAR, SIN IMPORTAR EL ATRIBUTO DEL QUE SE TRATE
	/*
	function getFieldSqlOrder($entityTableName,$uniqueExtraAlias,$fieldOrder="") {
		// TODO: Implementar pensando la logica
		die("Funcion no implementada: Ordenado de CDR");
	}
	*/


}

?>