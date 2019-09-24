<?php
include_once(GALIX_FOLDER."class.Field.php");

define ("FIELD_DATE_FORMAT_DMY",1);
define ("FIELD_DATE_FORMAT_MDY",2);
define ("FIELD_DATE_FORMAT_YMD",3);

class FieldDate extends Field {
	var $name;
	var $visualName;
	var $tableName;
	var $format;
	var $required;
	var $min_year;
	var $max_year;

	function FieldDate($name,$params) {
		$this->name = $name;
		$this->visualName = $params['visualName'];
		$this->tableName = $params['tableName'];
		$this->format = $params['format'];
		$this->required = $params['required'];
		$this->min_year = $params['min_year'];
		$this->max_year = $params['max_year'];
		$this->value = array("d"=>0,"m"=>0,"y"=>0);
	}

	private function showFormFieldDay($params) { ?>
		<select name="<?=$this->name?>_d">
			<? if(!$this->required) { ?>
			<option value="">D&iacute;a</option>
			<? } ?>
			<? for($i=1;$i<=31;$i++) { ?>
			<option value="<?=$i?>" <?=($i==$this->value['d'])?"selected":""; ?>><?=$i?></option>
			<? } ?>
		</select>
	<?}

	private function showFormFieldMonth($params) {
        $nombre_de_mes = array(1=>"Enero",2=>"Febrero",3=>"Marzo",4=>"Abril",5=>"Mayo",6=>"Junio",
                7=>"Julio",8=>"Agosto",9=>"Septiembre",10=>"Octubre",11=>"Noviembre",12=>"Diciembre");
            ?>
		    <select name="<?=$this->name?>_m" <?=($i==$this->value['m'])?"selected":""; ?>>
			    <? if(!$this->required) { ?>
			    <option value="">Mes</option>
			    <? } ?>
			    <? for($i=1;$i<=12;$i++) { ?>
				<option value="<?=$i?>" <?=($i==$this->value['m'])?"selected":""; ?>><?=$nombre_de_mes[$i];?></option>
			    <? } ?>
		    </select>
            <?
    }

	private function showFormFieldYear($params) { ?>
		<select name="<?=$this->name?>_y" <?=($i==$this->value['y'])?"selected":""; ?>>
			<? if(!$this->required) { ?>
			<option value="">A&ntilde;o</option>
			<? } ?>
			<? for($i=$this->min_year;$i<=$this->max_year;$i++) { ?>
			<option value="<?=$i?>" <?=($i==$this->value['y'])?"selected":""; ?>><?=$i?></option>
			<? } ?>
		</select>
	<?	}

	function showFormField($params) {
		switch($this->format) {
			case FIELD_DATE_FORMAT_DMY:
											$this->showFormFieldDay($params);
											$this->showFormFieldMonth($params);
											$this->showFormFieldYear($params);
											break;
			case FIELD_DATE_FORMAT_MDY:
											$this->showFormFieldMonth($params);
											$this->showFormFieldDay($params);
											$this->showFormFieldYear($params);
											break;
			default:
											$this->showFormFieldYear($params);
											$this->showFormFieldMonth($params);
											$this->showFormFieldDay($params);
											break;
		}
		return;
	}

	function validateFromPost(&$errors) {
        /* Si día o mes o año son vacíos, debe verificar que la fecha sea válida.
            Es decir que, si los tres son vacíos, no verifico nada, ya que el campo no es obligatorio. */
        if ($this->value['d']!="" or $this->value['m']!="" or $this->value['y']!="")
        {
            /* Si día o mes o año son vacíos, da error. Si no, verifica la úiltima parte del OR (el checkdate).
            */
            if( ($this->value['d']=="" or $this->value['m']=="" or $this->value['y']=="")
                    or !checkdate($this->value['m'],$this->value['d'],$this->value['y']))
            {
            			$errors[] = "Debe elegir una fecha correcta";
		    }
        }
		return true;
	}

	function fillWithPost() {
		$this->value['d'] = $_POST[$this->name."_d"];
		$this->value['m'] = $_POST[$this->name."_m"];
		$this->value['y'] = $_POST[$this->name."_y"];
	}

	function  hasDirectSave() {
		return true;
	}

	function getValueForDbFromPost(&$isNull=false) {
		return valueToDb($this->value['y'])."-".valueToDb($this->value['m'])."-".valueToDb($this->value['d']);
	}

	function fillWithDb($reg) {
		list($this->value['y'],$this->value['m'],$this->value['d']) = explode("-",$reg[$this->name]);
	}

	function getJoinSql($entityTableName,$uniqueExtraAlias) {
		return "";
	}

	function getFieldSqlDescription($entityTableName,$uniqueExtraAlias) {
		$db = GlobalManager::getDb();
		$sql = $db->dateFormat(DB_DATE_FORMAT_YMD,$entityTableName.".".$this->tableName)." AS ".$this->name;
		return $sql;
	}

	// DEPRECADO, NO USAR. EL ORDEN SE PASA DIRECTAMENTE EL NOMBRE DE LA COLUMNA A ORDENAR, SIN IMPORTAR EL ATRIBUTO DEL QUE SE TRATE
	/*
	function getFieldSqlOrder($entityTableName,$uniqueExtraAlias,$fieldOrder="") {
		return 	$this->name;
	}
	*/
}

?>