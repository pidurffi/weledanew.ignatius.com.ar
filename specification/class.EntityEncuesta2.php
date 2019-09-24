<?php

/* Encuesta Set de Viaje Bebé */

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityEncuesta2 extends Entity {

    var $directTable = "encuesta2";
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
            'visualName' => "Ocupación",
            'tableName' => 'ocupacion',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "telefono" => array(
            'visualName' => "Teléfono",
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
        /* PREGUNTA 1, 6 CHECKBOXES, UN TEXTBOX y 2 RADIOBUTTONS*/
        "p1" => array('visualName' => "p1", 'tableName' => 'p1', 'type' => 'number', 'min' => 1, 'max' => 3, 'required' => false),
        "p1o1" => array('visualName' => "p1o1", 'tableName' => 'p1o1', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p1o2" => array('visualName' => "p1o2", 'tableName' => 'p1o2', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p1o3" => array('visualName' => "p1o3", 'tableName' => 'p1o3', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p1o4" => array('visualName' => "p1o4", 'tableName' => 'p1o4', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p1o5" => array('visualName' => "p1o5", 'tableName' => 'p1o5', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p1o6" => array('visualName' => "p1o6", 'tableName' => 'p1o6', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p1t1" => array('visualName' => "p1t1", 'tableName' => 'p1t1', 'type' => 'varchar', 'length' => 255, 'required' => false),
        /* PREGUNTA 2, 2 RADIOBUTTONS Y UN TEXTBOX */
        "p2" => array('visualName' => "p2", 'tableName' => 'p2', 'type' => 'number', 'min' => 1, 'max' => 3, 'required' => false),
        "p2t1" => array('visualName' => "p2t1", 'tableName' => 'p2t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),
        /* PREGUNTA 3, 2 RADIOBUTTONS Y UN TEXTBOX */
        "p3" => array('visualName' => "p3", 'tableName' => 'p3', 'type' => 'number', 'min' => 1, 'max' => 3, 'required' => false),
        "p3t1" => array('visualName' => "p3t1", 'tableName' => 'p3t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),
        /* PREGUNTA 4, 2 RADIOBUTTONS Y UN TEXTBOX*/
        "p4" => array('visualName' => "p4", 'tableName' => 'p4', 'type' => 'number', 'min' => 1, 'max' => 3, 'required' => false),
        "p4t1" => array('visualName' => "p4t1", 'tableName' => 'p4t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),
        /* PREGUNTA 5, 4 RADIOBUTTONS*/
        "p5" => array('visualName' => "p5", 'tableName' => 'p5', 'type' => 'number', 'min' => 1, 'max' => 3, 'required' => false),
        /* PREGUNTA 6, 2 RADIOBUTTONS Y UN TEXTBOX*/
        "p6" => array('visualName' => "p6", 'tableName' => 'p6', 'type' => 'number', 'min' => 1, 'max' => 3, 'required' => false),
        "p6t1" => array('visualName' => "p6t1", 'tableName' => 'p6t1', 'type' => 'varchar', 'length' => 1000, 'required' => false),
        /* PREGUNTA 7, 4 CHECKBOXES Y UN TEXTBOX */
        "p7oa" => array('visualName' => "p7oa", 'tableName' => 'p7oa', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p7ob" => array('visualName' => "p7ob", 'tableName' => 'p7ob', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p7oc" => array('visualName' => "p7oc", 'tableName' => 'p7oc', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p7od" => array('visualName' => "p7od", 'tableName' => 'p7od', 'type' => 'boolean', 'default' => false, 'required' => false),
        "p7t1" => array('visualName' => "p7t1", 'tableName' => 'p7t1', 'type' => 'varchar', 'length' => 1000, 'required' => false)
   

    );

    function EntitySorteo() {
        
    }

}

?>