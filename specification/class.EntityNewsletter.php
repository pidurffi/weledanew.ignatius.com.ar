<?php

include_once(GALIX_FOLDER . "class.Entity.php");

class EntityNewsletter extends Entity {

    var $directTable = "newsletter";
    var $attr = array(
        "cabecera" => array(
            'visualName' => "Cabecera",
            'tableName' => 'cabecera',
            'type' => 'htmlarea',
            'required' => false
        ),
        "pie" => array(
            'visualName' => "Pie",
            'tableName' => 'pie',
            'type' => 'htmlarea',
            'required' => false
        ),
        "titulo" => array(
            'visualName' => "Titulo",
            'tableName' => 'titulo',
            'type' => 'varchar',
            'length' => 255,
            'required' => true
        ),
        "noticia_1_titulo" => array(
            'visualName' => "Titulo",
            'tableName' => 'titulo_1',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "noticia_1_texto" => array(
            'visualName' => "Texto",
            'tableName' => 'texto_1',
            'type' => 'htmlarea',
            'required' => false
        ),
        "noticia_1_imagen" => array(
            'visualName' => "Foto",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'newsletter',
            'columnReference' => '',
            'imageTableName' => 'imagen_archivo_1',
            'epigraphTableName' => 'imagen_epigrafe_1',
            'imageStoreFolder' => '/imagenes/newsletter',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 160,
            'imageY' => 160,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/newsletter',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "noticia_1_tipo_noticia" => array(
            'visualName' => "Tipo",
            'tableName' => 'id_tipo_noticia_1',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityTipoNoticiaNewsletter',
            'descriptionFieldName' => 'titulo',
            'required' => false
        ),
        "noticia_1_enlace" => array(
            'visualName' => "Enlace",
            'tableName' => 'enlace_1',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "noticia_2_titulo" => array(
            'visualName' => "Titulo",
            'tableName' => 'titulo_2',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "noticia_2_texto" => array(
            'visualName' => "Texto",
            'tableName' => 'texto_2',
            'type' => 'htmlarea',
            'required' => false
        ),
        "noticia_2_imagen" => array(
            'visualName' => "Foto",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'newsletter',
            'columnReference' => '',
            'imageTableName' => 'imagen_archivo_2',
            'epigraphTableName' => 'imagen_epigrafe_2',
            'imageStoreFolder' => '/imagenes/newsletter',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 160,
            'imageY' => 160,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/newsletter',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "noticia_2_tipo_noticia" => array(
            'visualName' => "Tipo",
            'tableName' => 'id_tipo_noticia_2',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityTipoNoticiaNewsletter',
            'descriptionFieldName' => 'titulo',
            'required' => false
        ),
        "noticia_2_enlace" => array(
            'visualName' => "Enlace",
            'tableName' => 'enlace_2',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "noticia_3_titulo" => array(
            'visualName' => "Titulo",
            'tableName' => 'titulo_3',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "noticia_3_texto" => array(
            'visualName' => "Texto",
            'tableName' => 'texto_3',
            'type' => 'htmlarea',
            'required' => false
        ),
        "noticia_3_imagen" => array(
            'visualName' => "Foto",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'newsletter',
            'columnReference' => '',
            'imageTableName' => 'imagen_archivo_3',
            'epigraphTableName' => 'imagen_epigrafe_3',
            'imageStoreFolder' => '/imagenes/newsletter',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 160,
            'imageY' => 160,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/newsletter',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "noticia_3_tipo_noticia" => array(
            'visualName' => "Tipo",
            'tableName' => 'id_tipo_noticia_3',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityTipoNoticiaNewsletter',
            'descriptionFieldName' => 'titulo',
            'required' => false
        ),
        "noticia_3_enlace" => array(
            'visualName' => "Enlace",
            'tableName' => 'enlace_3',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "noticia_4_titulo" => array(
            'visualName' => "Titulo",
            'tableName' => 'titulo_4',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "noticia_4_texto" => array(
            'visualName' => "Texto",
            'tableName' => 'texto_4',
            'type' => 'htmlarea',
            'required' => false
        ),
        "noticia_4_imagen" => array(
            'visualName' => "Foto",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'newsletter',
            'columnReference' => '',
            'imageTableName' => 'imagen_archivo_4',
            'epigraphTableName' => 'imagen_epigrafe_4',
            'imageStoreFolder' => '/imagenes/newsletter',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 160,
            'imageY' => 160,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/newsletter',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "noticia_4_tipo_noticia" => array(
            'visualName' => "Tipo",
            'tableName' => 'id_tipo_noticia_4',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityTipoNoticiaNewsletter',
            'descriptionFieldName' => 'titulo',
            'required' => false
        ),
        "noticia_4_enlace" => array(
            'visualName' => "Enlace",
            'tableName' => 'enlace_4',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "noticia_5_titulo" => array(
            'visualName' => "Titulo",
            'tableName' => 'titulo_5',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "noticia_5_texto" => array(
            'visualName' => "Texto",
            'tableName' => 'texto_5',
            'type' => 'htmlarea',
            'required' => false
        ),
        "noticia_5_imagen" => array(
            'visualName' => "Foto",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'newsletter',
            'columnReference' => '',
            'imageTableName' => 'imagen_archivo_5',
            'epigraphTableName' => 'imagen_epigrafe_5',
            'imageStoreFolder' => '/imagenes/newsletter',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 160,
            'imageY' => 160,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/newsletter',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "noticia_5_tipo_noticia" => array(
            'visualName' => "Tipo",
            'tableName' => 'id_tipo_noticia_5',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityTipoNoticiaNewsletter',
            'descriptionFieldName' => 'titulo',
            'required' => false
        ),
        "noticia_5_enlace" => array(
            'visualName' => "Enlace",
            'tableName' => 'enlace_5',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "noticia_6_titulo" => array(
            'visualName' => "Titulo",
            'tableName' => 'titulo_6',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "noticia_6_texto" => array(
            'visualName' => "Texto",
            'tableName' => 'texto_6',
            'type' => 'htmlarea',
            'required' => false
        ),
        "noticia_6_imagen" => array(
            'visualName' => "Foto",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'newsletter',
            'columnReference' => '',
            'imageTableName' => 'imagen_archivo_6',
            'epigraphTableName' => 'imagen_epigrafe_6',
            'imageStoreFolder' => '/imagenes/newsletter',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 160,
            'imageY' => 160,
            'resizeBehavior' => RESIZE_BEHAVIOR_EXACT,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/newsletter',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_EXACT
        ),
        "noticia_6_tipo_noticia" => array(
            'visualName' => "Tipo",
            'tableName' => 'id_tipo_noticia_6',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityTipoNoticiaNewsletter',
            'descriptionFieldName' => 'titulo',
            'required' => false
        ),
        "noticia_6_enlace" => array(
            'visualName' => "Enlace",
            'tableName' => 'enlace_6',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "breve_1_titulo" => array(
            'visualName' => "Titulo",
            'tableName' => 'breve_1_titulo',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "breve_1_texto" => array(
            'visualName' => "Texto",
            'tableName' => 'breve_1_texto',
            'type' => 'htmlarea',
            'required' => false
        ),
        "breve_1_imagen" => array(
            'visualName' => "Foto",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'newsletter',
            'columnReference' => '',
            'imageTableName' => 'breve_imagen_archivo_1',
            'epigraphTableName' => 'breve_imagen_epigrafe_1',
            'imageStoreFolder' => '/imagenes/newsletter',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 90,
            'imageY' => 90,
            'resizeBehavior' => RESIZE_BEHAVIOR_LIMITX,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/newsletter',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_LIMITX
        ),
        "breve_1_enlace" => array(
            'visualName' => "Enlace",
            'tableName' => 'breve_enlace_1',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "breve_1_tipo_noticia" => array(
            'visualName' => "Tipo",
            'tableName' => 'id_tipo_noticia_breve_1',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityTipoNoticiaNewsletter',
            'descriptionFieldName' => 'titulo',
            'required' => false
        ),
        "breve_2_titulo" => array(
            'visualName' => "Titulo",
            'tableName' => 'breve_2_titulo',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "breve_2_texto" => array(
            'visualName' => "Texto",
            'tableName' => 'breve_2_texto',
            'type' => 'htmlarea',
            'required' => false
        ),
        "breve_2_imagen" => array(
            'visualName' => "Foto",
            'type' => 'imageAndEpigraph',
            'required' => false,
            'cardinality' => '1',
            'tableReference' => 'newsletter',
            'columnReference' => '',
            'imageTableName' => 'breve_imagen_archivo_2',
            'epigraphTableName' => 'breve_imagen_epigrafe_2',
            'imageStoreFolder' => '/imagenes/newsletter',
            'epigraphLength' => 255,
            'imageFormat' => 'image/jpeg,image/gif,image/png',
            'imageX' => 90,
            'imageY' => 90,
            'resizeBehavior' => RESIZE_BEHAVIOR_LIMITX,
            'thumbnail' => false,
            'thumbnailX' => 0,
            'thumbnailY' => 0,
            'thumbnailStoreFolder' => '/imagenes/newsletter',
            'thumbnailBehavior' => RESIZE_BEHAVIOR_LIMITX
        ),
        "breve_2_enlace" => array(
            'visualName' => "Enlace",
            'tableName' => 'breve_enlace_2',
            'type' => 'varchar',
            'length' => 255,
            'required' => false
        ),
        "breve_2_tipo_noticia" => array(
            'visualName' => "Tipo",
            'tableName' => 'id_tipo_noticia_breve_2',
            'type' => 'direct_reference',
            'entityRefired' => 'EntityTipoNoticiaNewsletter',
            'descriptionFieldName' => 'titulo',
            'required' => false
        )
    );

    function EntityNewsletter() {
        
    }

}

?>