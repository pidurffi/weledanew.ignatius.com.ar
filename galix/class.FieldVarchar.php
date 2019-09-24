<?php

include_once(GALIX_FOLDER . "class.Field.php");

class FieldVarchar extends Field {

    var $name;
    var $visualName;
    var $tableName;
    var $length;
    var $required;
    var $valueValidation;

    function FieldVarchar($name, $params) {
        $this->name = $name;
        $this->visualName = $params['visualName'];
        $this->tableName = $params['tableName'];
        $this->length = (!empty($params['length'])) ? $params['length'] : 0;
        $this->required = $params['required'];
    }

    function showFormField($params, $size = 0, $readonly = false) {
        // $size es el tamaño que tiene el textbox. Es optativo.
		// $readonly se pone en true si el textbox debe ser de solo lectura.
        echo "<input type='text' id='" . $this->name . "' name='" . $this->name . "' maxlength='" . $this->length . "' value='" . utf8_encode($this->value) . "'" . ($size == 0 ? "" : " size='" . $size . "'") . ($readonly ? " readonly" : "") . " />";
        return;
    }

    // Muestra el segundo campo para validar (se usa por ejemplo para validar email).
    function showFormFieldValidation($params) {
        echo "<input type='text' id='fp_validation_" . $this->name . "' name='fp_validation_" . $this->name . "' maxlength='" . $this->length . "' value='" . utf8_encode($this->valueValidation) . "'/>";
        return;
    }

    // Nueva versión que valida si dos campos son iguales.
    // Se usa por ejemplo para valida correo electrónico. (A.B.)
    function validateFromPost(&$errors) {
        $value = $_POST[$this->name];
        if ($this->required) {
            if (strlen(trim($value)) == 0) {
                $errors[] = "El campo " . $this->visualName . " es obligatorio";
                return false;
            }
        }
        if (strlen($value) > $this->length) {
            $errors[] = "El campo " . $this->name . " es demasiado largo (m&aacute;x: " . $this->length . ")";
            return false;
        }
        // Si existe fp_validation_nombre, lo verifico. Si no, no.
        if (isset($_POST['fp_validation_' . $this->name])) {
            if ($_POST[$this->name] != $_POST['fp_validation_' . $this->name]) {
                $errors[] = "Verificaci&oacute;n de " . $this->visualName . " incorrecta";
                return false;
            }
        }
        return true;
    }

    function fillWithPost() {
        $this->value = $_POST[$this->name];
        if (isset($_POST['fp_validation_' . $this->name])) {
            $this->valueValidation = $_POST['fp_validation_' . $this->name];
        }
    }

    function hasDirectSave() {
        return true;
    }

    function getValueForDbFromPost(&$isNull=false) {
        return valueToDb($this->value);
    }

    function fillWithDb($reg) {
        $this->value = $reg[$this->name];
    }

    function getJoinSql($entityTableName, $uniqueExtraAlias) {
        return "";
    }

    function getFieldSqlDescription($entityTableName, $uniqueExtraAlias) {
        $sql = $entityTableName . "." . $this->tableName . " AS " . $this->name;
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