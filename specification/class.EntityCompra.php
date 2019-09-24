<?php

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityCompra extends Entity {

    var $directTable = "compra";
    var $attr = array(
        "nombre" => array(
            'visualName' => "Nombre",
            'tableName' => 'nombre',
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
        "ciudad" => array(
            'visualName' => "Localidad",
            'tableName' => 'ciudad',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        /*
          "provincia" => array(
          'visualName' => "Provincia",
          'tableName' => 'provincia',
          'type' => 'varchar',
          'length' => 255,
          'required' => true
          ),
         */
        "codigo_postal" => array(
            'visualName' => "C&oacute;digo Postal",
            'tableName' => 'codpostal',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        /* Nombre del cliente (sin apellido) */
        "cliente" => array(
            'visualName' => "Cliente",
            'tableName' => 'id_cliente',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityCliente',
            'descriptionFieldName' => 'nombre',
            'required' => true
        ),
        // Si le agrego el email, deja de funcionar.
        /*
          "email" =>	array(
          'visualName' => "Cliente",
          'tableName' => 'id_cliente',
          'type' => 'direct_reference',
          'entityRefired' => 'EntityCliente',
          'descriptionFieldName' => 'email',
          'required' => true
          ),
         */
        // tipo_envio no se usa m�s. Ahora todo sale del CP
        /* "tipo_envio" =>	array(
          'visualName' => "Tipo Env&iacute;o",
          'tableName' => 'id_tipo_envio',
          'type' => 'direct_reference',
          'entityRefired' => 'EntityTipoEnvio',
          'descriptionFieldName' => 'tipo_envio',
          'required' => true
          ), */
        "costo_total" => array(
            'visualName' => "Costo Total",
            'tableName' => 'costo_total',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "costo_envio" => array(
            'visualName' => "Costo Envío",
            'tableName' => 'costo_envio',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "fecha" => array(
            'tableName' => 'fecha',
            'type' => "timestamp"
        ),
        "dineromail_estado_operacion" => array(
            'visualName' => "Estado operación DineroMail",
            'tableName' => 'dineromail_estado_operacion',
            'type' => 'number',
            'min' => 0,
            'max' => 100,
            'required' => false
        ),
        /* Compra v�lida. Se pone en 1 si es v�lida. */
        "valida" => array(
            'visualName' => "Válida",
            'tableName' => 'valida',
            'type' => 'number',
            'min' => 0,
            'max' => 1,
            'required' => false
        ),
        "descuento_pesos" => array(
            'visualName' => "descuento en pesos",
            'tableName' => 'descuento_pesos',
            'type' => 'number',
            'min' => 0,
            'required' => false
        ),
        "descuento_porcentaje" => array(
            'visualName' => "porcentaje de descuento",
            'tableName' => 'descuento_porcentaje',
            'type' => 'number',
            'min' => 0,
            'max' => 100,
            'required' => false
        ),
        "nombre_promocion" => array(
            'visualName' => "nombre de la promoción",
            'tableName' => 'nombre_promocion',
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
        ),
        /* A continuación, los datos de FACTURACIÓN.
          Son datos optativos que se usan si la compra es para regalo.
          Los datos de ENVÍO van en los campos definidos arriba y la factura se recibe en los campos de abajo. */
        "nombre_facturacion" => array('visualName' => "Nombre facturación", 'tableName' => 'nombre_facturacion', 'type' => 'varchar', 'length' => 255, 'required' => false),
        "direccion_facturacion" => array('visualName' => "Direcci&oacute;n de facturación", 'tableName' => 'direccion_facturacion', 'type' => 'varchar', 'length' => 255, 'required' => false),
        "ciudad_facturacion" => array('visualName' => "Localidad facturación", 'tableName' => 'ciudad_facturacion', 'type' => 'varchar', 'length' => 255, 'required' => false),
        "codigo_postal_facturacion" => array('visualName' => "C&oacute;digo postal facturación", 'tableName' => 'codpostal_facturacion', 'type' => 'varchar', 'length' => 255, 'required' => false),
        "provincia_facturacion" => array('visualName' => "Provincia facturación", 'tableName' => 'id_provincia_facturacion', 'type' => 'direct_reference', 'entityRefired' => 'EntityProvinciaEnvios', 'descriptionFieldName' => 'provincia', 'required' => false),
        /* Compra envuelta para regalo. */
        "para_regalo" => array('visualName' => "Envuelto para regalo", 'tableName' => 'para_regalo', 'type' => 'boolean', 'default' => 0, 'required' => false),

        
        "codigo_promocion" => array('visualName' => "Código de promoción", 'tableName' => 'codigo_promocion', 'type' => 'varchar', 'length' => 20, 'required' => false)
    );

    function EntityCompra() {
        
    }

}

?>