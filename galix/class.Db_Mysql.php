<?php
include_once(GALIX_FOLDER . "class.Db.php");

class Db_Mysql extends Db {

    var $link = 0;

    function Db_Mysql($params) {
        $this->connect($params['host'], $params['user'], $params['pass'], $params['dbname']);
    }

    function connect($host, $user, $pass, $dbname) {
        $l = mysqli_connect($host, $user, $pass, $dbname);
        if (!$l)
            return false;
        //if(!mysql_select_db($dbname,$l)) return false;
        $this->link = $l;
        return true;
    }

    /*
     * Devuelve un resourse
     */

    function execute($sql) {
        //$var = mysql_query($sql,$this->link);
        $var = mysqli_query($this->link, $sql);
        print(mysqli_error($this->link));
        return $var;
    }

    /*
     * Devuelve un vector asociativo o false si no hay mÃ¡s datos
     */

    function getRow($resource) {
        return mysqli_fetch_array($resource);
    }

    /*
     * Devuelve el Ãºltimo ID insertado
     */

    function lastId() {
        return mysqli_insert_id($this->link);
    }

    function count($resource) {
        return mysqli_num_rows($resource);
    }

    function dateFormat($format, $value) {
        switch ($format) {
            case DB_DATE_FORMAT_YMD: return "DATE_FORMAT(" . $value . ",'%Y-%m-%e')";
        }
    }

    function real_escape_string($cadena) {
        // Ejecuta la función mysqli_real_escape_string.
        $var = mysqli_real_escape_string($this->link, $cadena);
        return $var;
    }

}

?>