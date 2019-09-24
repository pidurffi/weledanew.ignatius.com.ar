<?php

// FORMULARIO PARA ENVIAR LOS DATOS PARA QUE TE ENVIEN UN CATALOGO

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityCatalogo extends Entity {

    var $directTable = "catalogo";
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
            'required' => false
        ),
        "ciudad" => array(
            'visualName' => "Ciudad",
            'tableName' => 'ciudad',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "provincia" => array(
            'visualName' => "Provincia",
            'tableName' => 'provincia',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "codigo_postal" => array(
            'visualName' => "C&oacute;digo Postal",
            'tableName' => 'codigo_postal',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "direccion" => array(
            'visualName' => "Direcci&oacute;n",
            'tableName' => 'direccion',
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
        "dni" => array(
            'visualName' => "DNI",
            'tableName' => 'dni',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
		"respuesta1" => array(
            'visualName' => "Respuesta",
            'tableName' => 'respuesta1',
            'type' => 'number',
            'min' => 1,
            'max' => 3,
            'required' => false
        ),
		"terminosycondiciones" => array(
            'visualName' => "Términos y condiciones",
            'tableName' => 'terminosycondiciones',
            'type' => 'boolean',
            'default' => false,
            'required' => true
        ),
		/* identificacion: se graba desde un campo oculto */
		"identificacion" => array(
            'visualName' => "identificacion",
            'tableName' => 'identificacion',
            'type' => 'varchar',
            'length' => 25,
            'required' => false
        ),
		
    );
   

}

?>