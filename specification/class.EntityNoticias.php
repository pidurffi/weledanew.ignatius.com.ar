<?php

include_once(GALIX_FOLDER."class.Entity.php");

class EntityNoticias extends Entity {

	var $directTable = "noticias";
	var $attr = array(
					"titulo"=>array(
										'visualName' => "Titulo",
										'tableName' => 'titulo',
										'type' => 'varchar',
										'length' => 255,
										'required' => true
										),
     				"copete"=>array(
										'visualName' => "Copete",
										'tableName' => 'copete',
										'type' => 'varchar',
										'length' => 255,
										'required' => false
										),
					"texto" => array(
										'visualName' => "Texto",
										'tableName' => 'texto',
										'type' => 'htmlarea',
										'required' => false
										),
					"foto" => array(
										'visualName' => "Foto",
										'type' => 'imageAndEpigraph',
										'required' => false,
										'cardinality' => '1',
										'tableReference' => 'noticias',
										'columnReference' => '',
										'imageTableName' => 'foto',
										'epigraphTableName' => 'texto_foto',
										'imageStoreFolder' => '/imagenes/noticias',
										'epigraphLength' => 255,
										'imageFormat' => 'image/jpeg,image/gif,image/png',
										'imageX' => 180,
										'imageY' => 320,
										'resizeBehavior' => RESIZE_BEHAVIOR_LIMITX,
										'thumbnail' => false,
										'thumbnailX' => 0,
										'thumbnailY' => 0,
										'thumbnailStoreFolder' => '/imagenes/noticias',
										'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
										),
				    "fotito" => array(
										'visualName' => "Fotito",
										'type' => 'imageAndEpigraph',
										'required' => false,
										'cardinality' => '1',
										'tableReference' => 'noticias',
										'columnReference' => '',
										'imageTableName' => 'fotito',
										'epigraphTableName' => 'texto_fotito',
										'imageStoreFolder' => '/imagenes/noticias',
										'epigraphLength' => 255,
										'imageFormat' => 'image/jpeg,image/gif,image/png',
										'imageX' => 90,
										'imageY' => 90,
										'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
										'thumbnail' => false,
										'thumbnailX' => 0,
										'thumbnailY' => 0,
										'thumbnailStoreFolder' => '/imagenes/noticias',
										'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
										),

     				"resumen" => array(
										'visualName' => "Resumen",
										'tableName' => 'resumen',
										'type' => 'htmlarea',
										'required' => false
										),
                    "orden" => array(
									'visualName' => "Orden",
									'tableName' => 'orden',
									'type' => 'number',
									'required' => false,
									'min' => 0,
									'max' => 10000
									),
                    "seccion" =>    array(
                                        'visualName' => "Sección",
                                        'tableName' => 'id_seccion',
                                        'type' => 'direct_reference',
                                        'entityRefired' => 'EntitySeccionNoticias',
                                        'descriptionFieldName' => 'seccion',
                                        'required' => true
                                        )
					);



	function EntityNoticias() {



	}



}



?>