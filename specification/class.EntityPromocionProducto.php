<?phpinclude_once(GALIX_FOLDER . "class.Entity.php");class EntityPromocionProducto extends Entity {    var $directTable = "promocion_producto";    var $attr = array(        "fecha_inicio" => array(            'tableName' => 'fecha_inicio',            'type' => "datetime",            'visualName' => 'Fecha inicio',            'format' => FIELD_DATE_FORMAT_DMY,            'min_year' => 2016,            'max_year' => 2020,            'required' => true        ),        "fecha_fin" => array(            'tableName' => 'fecha_fin',            'type' => "datetime",            'visualName' => 'Fecha fin',            'format' => FIELD_DATE_FORMAT_DMY,            'min_year' => 2016,            'max_year' => 2020,            'required' => true        ),        "producto" =>	array(            'visualName' => "Producto",            'tableName' => 'id_producto',            'type' => 'direct_reference',            'entityRefired' => 'EntityProducto',            'descriptionFieldName' => 'nombre',            'required' => true            ),        "porcentaje_descuento" => array(                        'visualName' => "Porcentaje de descuento",                        'tableName' => 'porcentaje_descuento',                        'type' => 'number',                        'required' => false,                        'min' => 0,                        'max' => 100                        ),        /*        "un_uso_por_cliente"=> array(                    'visualName' => "Un uso por cliente",                    'tableName' => 'un_uso_por_cliente',                    'type' => 'boolean',                    'default' => false,                    'required' => false                    ),         */        /*        "codigo" => array(            'visualName' => "Código promoción",            'tableName' => 'codigo',            'type' => 'varchar',            'length' => 255,            'required' => false        ),         */        "nombre" => array(            'visualName' => "Nombre promoción",            'tableName' => 'nombre',            'type' => 'varchar',            'length' => 255,            'required' => false        ),        "stock_maximo" => array(                 'visualName' => "Stock máximo",                 'tableName' => 'stock_maximo',                 'type' => 'number',                 'required' => false,                 'min' => 0        )    );    function EntityPromocionProducto() {    }}?>