<?php


include_once(GALIX_FOLDER . "class.Entity.php");

class EntityEncuesta3 extends Entity {

    var $directTable = "encuesta3";
    var $attr = array(
        
        "id_cliente" => array('visualName' => "id_cliente", 'tableName' => 'id_cliente', 'type' => 'number', 'min' => 1, 'required' => false),
        
        /* PREGUNTA 1, 3 RADIOBUTTONS Y UN TEXTBOX */
        "p1" => array('visualName' => "p1", 'tableName' => 'p1', 'type' => 'number', 'min' => 1, 'max' => 5, 'required' => false),
        "p1t1" => array('visualName' => "p1t1", 'tableName' => 'p1t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),
        /* PREGUNTA 2, 3 RADIOBUTTONS Y UN TEXTBOX */
        "p2" => array('visualName' => "p2", 'tableName' => 'p2', 'type' => 'number', 'min' => 1, 'max' => 5, 'required' => false),
        "p2t1" => array('visualName' => "p2t1", 'tableName' => 'p2t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),
        /* PREGUNTA 3, 3 RADIOBUTTONS Y UN TEXTBOX*/
        "p3" => array('visualName' => "p3", 'tableName' => 'p3', 'type' => 'number', 'min' => 1, 'max' => 5, 'required' => false),
        "p3t1" => array('visualName' => "p3t1", 'tableName' => 'p3t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),
        /* PREGUNTA 4, 3 RADIOBUTTONS Y UN TEXTBOX*/
        "p4" => array('visualName' => "p4", 'tableName' => 'p4', 'type' => 'number', 'min' => 1, 'max' => 5, 'required' => false),
        "p4t1" => array('visualName' => "p4t1", 'tableName' => 'p4t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),

        
        /* PREGUNTA 5, 3 RADIOBUTTONS Y UN TEXTBOX*/
        "p5" => array('visualName' => "p5", 'tableName' => 'p5', 'type' => 'number', 'min' => 1, 'max' => 5, 'required' => false),
        "p5t1" => array('visualName' => "p5t1", 'tableName' => 'p5t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),

        
        /* pregunta 6 - 4 checkboxes y un textbox */
        "p6o1" => array('visualName' => "p6o1", 'tableName' => 'p6o1', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p6o2" => array('visualName' => "p6o2", 'tableName' => 'p6o2', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p6o3" => array('visualName' => "p6o3", 'tableName' => 'p6o3', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p6o4" => array('visualName' => "p6o4", 'tableName' => 'p6o4', 'type' => 'boolean', 'default' => false, 'required' => false),
        
        "p6t1" => array('visualName' => "p6t1", 'tableName' => 'p6t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),
        
         "comentarios" => array(
            'visualName' => "Sugerencias",
            'tableName' => 'comentarios',
            'type' => 'varchar',
            'length' => 1000,
            'required' => false
        ),
        
        

    );

    function EntitySorteo() {
        
    }

}

?>