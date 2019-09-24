<?php

/* Encuesta Newsletter */

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityEncuesta1 extends Entity {

    var $directTable = "encuesta1";
    var $attr = array(
        "nombre" => array(
            'visualName' => "Nombre",
            'tableName' => 'nombre',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "apellido" => array(
            'visualName' => "Apellido",
            'tableName' => 'apellido',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "email" => array(
            'visualName' => "Correo electr&oacute;nico",
            'tableName' => 'email',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "recibe_newsletter" => array(
            'visualName' => "Recibe newsletter",
            'tableName' => 'recibe_newsletter',
            'type' => 'boolean',
            'default' => true,
            'required' => false
        ),
        "fecha_nacimiento" => array(
            'visualName' => "Fecha de nacimiento",
            'tableName' => "fecha_nacimiento",
            'type' => "date",
            'format' => FIELD_DATE_FORMAT_DMY,
            'required' => false,
            'min_year' => 1920,
            'max_year' => 2020
        ),
        "ocupacion" => array(
            'visualName' => "Ocupaci�n",
            'tableName' => 'ocupacion',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "telefono" => array(
            'visualName' => "Tel�fono",
            'tableName' => 'telefono',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "comentarios" => array(
            'visualName' => "Comentarios",
            'tableName' => 'comentarios',
            'type' => 'varchar',
            'length' => 1000,
            'required' => false
        ),
        /* PREGUNTA 1, 4 CHECKBOXEX Y UN TEXTBOX */
		"p1" => array('visualName' => "p1", 'tableName' => 'p1', 'type' => 'number', 'min' => 1, 'max' => 4, 'required' => false),
        "p1oa" => array('visualName' => "p1oa", 'tableName' => 'p1oa', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p1ob" => array('visualName' => "p1ob", 'tableName' => 'p1ob', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p1oc" => array('visualName' => "p1oc", 'tableName' => 'p1oc', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p1od" => array('visualName' => "p1od", 'tableName' => 'p1od', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p1t1" => array('visualName' => "p1t1", 'tableName' => 'p1t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),
        /* PREGUNTA 2, 2 RADIOBUTTONS Y UN TEXTBOX */
        "p2" => array('visualName' => "p2", 'tableName' => 'p2', 'type' => 'number', 'min' => 1, 'max' => 4, 'required' => false),
        "p2t1" => array('visualName' => "p2t1", 'tableName' => 'p2t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),
        /* PREGUNTA 3, 3 RADIOBUTTONS Y UN TEXTBOX */
        "p3" => array('visualName' => "p3", 'tableName' => 'p3', 'type' => 'number', 'min' => 1, 'max' => 4, 'required' => false),
		"p3t1" => array('visualName' => "p3t1", 'tableName' => 'p3t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),
        /* PREGUNTA 4, 3 RADIOBUTTONS Y UN TEXTBOX */
        "p4" => array('visualName' => "p4", 'tableName' => 'p4', 'type' => 'number', 'min' => 1, 'max' => 4, 'required' => false),
		"p4t1" => array('visualName' => "p4t1", 'tableName' => 'p4t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),
        /* PREGUNTA 5, 7 CHECKBOXES Y UN TEXTBOX */
        "p5oa" => array('visualName' => "p5oa", 'tableName' => 'p5oa', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p5ob" => array('visualName' => "p5ob", 'tableName' => 'p5ob', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p5oc" => array('visualName' => "p5oc", 'tableName' => 'p5oc', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p5od" => array('visualName' => "p5od", 'tableName' => 'p5od', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p5oe" => array('visualName' => "p5oe", 'tableName' => 'p5oe', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p5of" => array('visualName' => "p5of", 'tableName' => 'p5of', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p5og" => array('visualName' => "p5og", 'tableName' => 'p5og', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p5t1" => array('visualName' => "p5t1", 'tableName' => 'p5t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),
        /* PREGUNTA 6, 4 CHECKBOXES Y UN TEXTBOX */
        "p6oa" => array('visualName' => "p6oa", 'tableName' => 'p6oa', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p6ob" => array('visualName' => "p6ob", 'tableName' => 'p6ob', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p6oc" => array('visualName' => "p6oc", 'tableName' => 'p6oc', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p6od" => array('visualName' => "p6od", 'tableName' => 'p6od', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p6t1" => array('visualName' => "p6t1", 'tableName' => 'p6t1', 'type' => 'varchar', 'length' => 1000, 'required' => false)
    );

    function EntitySorteo() {
        
    }

}

?>