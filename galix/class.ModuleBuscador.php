<?php

include_once(GALIX_FOLDER . "/class.Module.php");

class ModuleBuscador extends Module {

    protected $template = "";
    protected $searchString = "";

    function ModuleBuscador($params) {
        $this->template = $params["template"];
        $this->id = $params["searchString"];
    }

    function exec($params) {
        GlobalManager::getTplMng()->setTemplate($this->template);
        GlobalManager::getTplMng()->setValue("searchString", $params["searchString"]);
        
        // Uso utf8_decode porque si no, no encuentra nada cuando se buscan algo con tildes.
        $params["searchString"] = utf8_decode($params["searchString"]);

        $sql = "SELECT P.nombre, P.id, P.foto_listado, P.id_linea, L.id_familia, P.subtitulo
                    FROM producto P
                    JOIN linea L ON P.id_linea = L.id
                    WHERE P.nombre LIKE '%" . $params["searchString"] . "%'
                        OR P.descripcion LIKE '%" . $params["searchString"] . "%'
                        OR P.subtitulo LIKE '%" . $params["searchString"] . "%'
                    ORDER BY P.nombre; ";
        $res = GlobalManager::getDb()->execute($sql);
        $list = array();
        while ($reg = GlobalManager::getDb()->getRow($res)) {
            $list[] = $reg;
        }
        GlobalManager::getTplMng()->setValue("productos", $list);
        
        $sql = "SELECT titulo, id, copete, resumen, fotito, id_seccion
                    FROM noticias
                    WHERE titulo LIKE '%" . $params["searchString"] . "%'
                        OR copete LIKE '%" . $params["searchString"] . "%'
                        OR resumen LIKE '%" . $params["searchString"] . "%'
                    ORDER BY titulo; ";
        $res = GlobalManager::getDb()->execute($sql);
        $list = array();
        while ($reg = GlobalManager::getDb()->getRow($res)) {
            $list[] = $reg;
        }
        GlobalManager::getTplMng()->setValue("noticias", $list);


        GlobalManager::getTplMng()->drawTemplate();
    }

}

?>