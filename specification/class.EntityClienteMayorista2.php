<?php

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityClienteMayorista2 extends Entity {
    /* Se usa en la pantalla de Perfil para modificar la contraseña. No se le permite modificar nada más.
		Al crear una clase nueva, se evita tener que poner los campos ocultos en la página. */

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
            'required' => false
        ),
		"password" => array(
            'visualName' => "Contrase&ntilde;a",
            'tableName' => 'password',
            'type' => 'password',
            'length' => 255,
            'encType' => ENCTYPE_NONE,
            'required' => true
        ),
        "email" => array(
            'visualName' => "Correo electr&oacute;nico",
            'tableName' => 'email',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),

    );

    function EntityClienteMayorista2() {
        
    }

}

?>