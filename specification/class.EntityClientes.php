<?php

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityCliente extends Entity {

    var $directTable = "cliente";
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
        "password" => array(
            'visualName' => "Contrase&ntilde;a",
            'tableName' => 'password',
            'type' => 'password',
            'length' => 255,
            'encType' => ENCTYPE_NONE,
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
            'required' => true,
            'min_year' => 1920,
            'max_year' => 2020
        ),
        /* el RUT solo se muestra en pantalla para Chile */
        "rut" => array(
            'visualName' => "RUT",
            'tableName' => 'rut',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
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
        "hijos_menores_a_3_anios" => array(
            'visualName' => "Hijos menores a 3 a?os",
            'tableName' => 'hijos_menores_a_3_anios',
            'type' => 'boolean',
            'default' => false,
            'required' => false
        ),
        /* El DNI solo se muestra en pantalla para la Argentina */
        "dni" => array(
            'visualName' => "DNI",
            'tableName' => 'dni',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "terminosycondiciones" => array(
            'visualName' => "Términos y condiciones",
            'tableName' => 'terminosycondiciones',
            'type' => 'boolean',
            'default' => false,
            'required' => true
        ),
		"direccion" => array(
            'visualName' => "Dirección",
            'tableName' => 'direccion',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
		"localidad" => array(
            'visualName' => "Localidad",
            'tableName' => 'localidad',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
		"provincia" => array(
            'visualName' => "Provincia",
            'tableName' => 'id_provincia',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityProvinciaEnvios',
            'descriptionFieldName' => 'provincia',
            'required' => true
        )
    );

    function EntityCliente() {
        
    }

}

?>