<?php

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityClienteMayorista extends Entity {
    /* Uso la misma tabla de Clientes pero con menos campos. */

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
        "email" => array(
            'visualName' => "Correo electr&oacute;nico",
            'tableName' => 'email',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
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
        /* El DNI solo se muestra en pantalla para la Argentina */
        /* Lo uso tambi�n para el cuit */
        "dni" => array(
            'visualName' => "DNI",
            'tableName' => 'dni',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "tipo_cliente" => array(
            'visualName' => "Tipo cliente",
            'tableName' => 'id_tipo_cliente',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityTipoCliente',
            'descriptionFieldName' => 'nombre',
            'required' => true
        ),
        "codigo" => array(
            'visualName' => "Código cliente",
            'tableName' => 'codigo',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "bonificacion" => array(
            'visualName' => "Bonificación",
            'tableName' => 'Bonificacion',
            'type' => 'number',
            'required' => true,
            'min' => 0,
            'max' => 100
        ),
        "percepcion_ingresos_brutos" => array(
            'visualName' => "Percepción ingresos brutos",
            'tableName' => 'percepcion_ingresos_brutos',
            'type' => 'number',
            'required' => false,
            'min' => 0,
            'max' => 100
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
        "tipo_responsable_inscripto" => array(
            'visualName' => "Tipo responsable inscripto",
            'tableName' => 'tipo_responsable_inscripto',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        // Condición: a qué grupo de oferta accede.
        "condicion" => array(
            'visualName' => "Condición",
            'tableName' => 'condicion',
            'type' => 'number',
            'required' => false,
            'min' => 0,
            'max' => 100
        )
    );

    function EntityClienteMayorista() {
        
    }

}

?>