<?php
include_once(GALIX_FOLDER."class.Entity.php");

class EntityPuntoVenta extends Entity {

	var $directTable = "pto_venta";

	var $attr = array(
					"nombre"=>array(
										'visualName' => "Nombre",
										'tableName' => 'nombre',
										'type' => 'varchar',
										'length' => 255,
										'required' => true
										),
					"mail"=>array(
										'visualName' => "EMail",
										'tableName' => 'mail',
										'type' => 'varchar',
										'length' => 255,
										'required' => false
										),
					"telefono"=>array(
										'visualName' => "Tel&eacute;fono",
										'tableName' => 'telefono',
										'type' => 'varchar',
										'length' => 255,
										'required' => false
										),
					"direccion"=>array(
										'visualName' => "Direcci&oacute;n",
										'tableName' => 'direccion',
										'type' => 'varchar',
										'length' => 255,
										'required' => true
										),
					"subregion" => array(
										'visualName' => "Subregi&oacute;n",
										'tableName' => 'id_subregion',
										'type' => "ComplexDirectReference",
										'required' => true,
										'entitiesReferreds' => array(
																	"region" => array(
																						"entityReferred" => "EntityRegion",
																						"descriptionFieldName" => "nombre",
																						"referenceFieldName" => ""
																						),
																	"subregion" => array(
																						"entityReferred" => "EntitySubregion",
																						"descriptionFieldName" => "nombre",
																						"referenceFieldName" => "id_region"
																						)
																	)
										),
                    "fax"=>array(
                                        'visualName' => "Fax",
                                        'tableName' => 'fax',
                                        'type' => 'varchar',
                                        'length' => 255,
                                        'required' => false
                                        ),
                    "web"=>array(
                                        'visualName' => "Web",
                                        'tableName' => 'web',
                                        'type' => 'varchar',
                                        'length' => 255,
                                        'required' => false
                                        ),
					"logo" => array(
										'visualName' => "Logo",
										'type' => 'imageAndEpigraph',
										'required' => false,
										'cardinality' => '1',
										'tableReference' => 'pto_venta',
										'columnReference' => '',
										'imageTableName' => 'logo',
										'epigraphTableName' => 'logo_epigrafe',
										'imageStoreFolder' => '/imagenes/estructura/farmacias',
										'epigraphLength' => 255,
										'imageFormat' => 'image/jpeg,image/gif,image/png',
										'imageX' => 100,
										'imageY' => 60,
										'resizeBehavior' => RESIZE_BEHAVIOR_LIMITX,
										'thumbnail' => false,
										'thumbnailX' => 0,
										'thumbnailY' => 0,
										'thumbnailStoreFolder' => '/imagenes/estructura/farmacias',
										'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
										)
					);


	function EntityPuntoVenta() {

	}

}

?>