<?php

/* Este archivo solo puede usarse para Chile ya que la provincia no es requerida
 * y la ciudad_id sí.
 * En Argentina es al revés.
 * Además agrego cod_autorizacion_transbank y referencia.
 */

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityCompra extends Entity {

    var $directTable = "compra";
    var $attr = array("nombre" => array('visualName' => "Nombre", 'tableName' => 'nombre', 'type' => 'varchar', 'length' => 255, 'required' => true),
        "direccion" => array('visualName' => "Direcci&oacute;n", 'tableName' => 'direccion', 'type' => 'varchar', 'length' => 255, 'required' => true),
        "referencia" => array('visualName' => "Referencia", 'tableName' => 'referencia', 'type' => 'varchar', 'length' => 255, 'required' => false),
        "codigo_postal" => array('visualName' => "C&oacute;digo Postal", 'tableName' => 'codpostal', 'type' => 'varchar', 'length' => 255, 'required' => true),
        /* Nombre del cliente (sin apellido) */
        "cliente" => array('visualName' => "Cliente", 'tableName' => 'id_cliente', 'type' => 'direct_reference', 'entityRefired' => 'EntityCliente', 'descriptionFieldName' => 'nombre', 'required' => true),
        "costo_total" => array('visualName' => "Costo Total", 'tableName' => 'costo_total', 'type' => 'varchar', 'length' => 255, 'required' => false),
        "costo_envio" => array('visualName' => "Costo Envío", 'tableName' => 'costo_envio', 'type' => 'varchar', 'length' => 255, 'required' => false),
        "fecha" => array('tableName' => 'fecha', 'type' => "timestamp"),
        "dineromail_estado_operacion" => array('visualName' => "Estado operación DineroMail", 'tableName' => 'dineromail_estado_operacion', 'type' => 'number', 'min' => 0, 'max' => 100, 'required' => false),
        /* Compra válida. Se pone en 1 si es válida. */
        "valida" => array('visualName' => "Válida", 'tableName' => 'valida', 'type' => 'number', 'min' => 0, 'max' => 1, 'required' => false),
        "descuento_pesos" => array('visualName' => "descuento en pesos", 'tableName' => 'descuento_pesos', 'type' => 'number', 'min' => 0, 'required' => false),
        "descuento_porcentaje" => array('visualName' => "porcentaje de descuento", 'tableName' => 'descuento_porcentaje', 'type' => 'number', 'min' => 0, 'max' => 100, 'required' => false),
        "nombre_promocion" => array('visualName' => "nombre de la promoción", 'tableName' => 'nombre_promocion', 'type' => 'varchar', 'length' => 255, 'required' => false),
        // Provincia se usa solo en Argentina.
        "provincia" => array('visualName' => "Provincia", 'tableName' => 'id_provincia', 'type' => 'direct_reference', 'entityRefired' => 'EntityProvinciaEnvios', 'descriptionFieldName' => 'provincia', 'required' => false),
        // En Argentina se usa CIUDAD, que es un textbox.
        "ciudad" => array('visualName' => "Localidad", 'tableName' => 'ciudad', 'type' => 'varchar', 'length' => 255, 'required' => true),
        // En Chile se usa CIUDAD_ID, que se elige de una lista desplegable, y depende de PROVINCIA.
        "ciudad_id" => array(
            'visualName' => "Comuna",
            'tableName' => 'id_ciudad',
            'type' => "ComplexDirectReference",
            'required' => true,
            'entitiesReferreds' => array(
                "provincia" => array(
                    "entityReferred" => "EntityProvinciaEnvios",
                    "descriptionFieldName" => "provincia",
                    "referenceFieldName" => ""
                ),
                "ciudad_envio" => array(
                    "entityReferred" => "EntityCiudadEnvios",
                    "descriptionFieldName" => "LOCALIDAD",
                    "referenceFieldName" => "id_provincia"
                )
            )
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
        "codigo_promocion" => array('visualName' => "Código de promoción", 'tableName' => 'codigo_promocion', 'type' => 'varchar', 'length' => 20, 'required' => false),
	"cod_autorizacion_transbank" => array('visualName' => "Cód. aut. Transbank", 'tableName' => 'cod_autorizacion_transbank', 'type' => 'varchar', 'length' => 25, 'required' => false),
        "tipo_pago" => array('visualName' => "Tipo pago", 'tableName' => 'tipo_pago', 'type' => 'varchar', 'length' => 5, 'required' => false)
    );

    function EntityCompra() {
        
    }

}

?>