<?php

include_once(GALIX_FOLDER . "/class.Module.php");
include_once(GALIX_FOLDER . "/class.EntityManager.php");

class ModuleRegistration extends Module {

    var $template;
    var $entity;
    var $finalModule;
    var $uniqueFields = array();
    protected $extras = array();

    function ModuleRegistration($params) {
        $this->template = $params['template'];
        $this->entity = $params['entity'];
        $this->finalModule = $params['finalModule'];
        $this->uniqueFields = $params['uniqueFields'];
        if (!empty($params["extras"]))
            $this->extras = $params["extras"];
    }

    function exec($params) {
        $entityManager = new EntityManager($params['entity'], array());
        $entityManager->prepareFields();

        $errors = array();

        if (isset($_POST['submit'])) {
            $entityManager->fillFieldsWithPost();
            foreach ($entityManager->fields as $key => $field) {
                $entityManager->fields[$key]->validateFromPost($errors);
            }
            /* Valido duplicados */
            foreach ($this->uniqueFields as $uniqueField) {
                $field = $entityManager->fields[$uniqueField];
                if (!$field->hasDirectSave()) {
                    die("Error de implementacion. Comuniquese con el sitio");
                }
                $list = $entityManager->find(false, $field->tableName . " = '" . $field->getValueForDbFromPost() . "'");
                if (sizeof($list) > 0) {
                    $errors[] = "Ya existe una registraci&oacute;n con el mismo " . $field->visualName;
                }
            }
            if (empty($errors)) {
                $entityManager->saveFromPost($errors);
                // Si se acaba de registrar un suario, le envío un mail de bienvenida.
                // Debo enviar mail al cliente si se acaba de registrar solamente 
                // (el template es front_cliente_AM), que se define en Specification/appFront.php.
                // No debo enviar mail si llegué aquí desde otro template (desde el sorteo, por ejemplo).
                if ($this->template == 'front_cliente_AM') {
                    $isNull = false;
                    $this->enviarMailACliente($entityManager->fields['nombre']->getValueForDbFromPost($isNull), $entityManager->fields['apellido']->getValueForDbFromPost($isNull), $entityManager->fields['email']->getValueForDbFromPost($isNull), $entityManager->fields['password']->getValueForDbFromPost($isNull));
                    
                    // A los nuevos clientes se les genera una promoción asociada a su email.
                    // En el mail de bienvenida se le informa de esa promoción.
                    $sql = "INSERT INTO promociones_mail (fecha_inicio, fecha_fin, porcentaje_descuento, email, nombre)
                            VALUES(DATE(NOW()), DATE_ADD(NOW(), INTERVAL 7 DAY), 10, '" .  $entityManager->fields['email']->getValueForDbFromPost($isNull) . "', '10% descuento nuevo cliente');";
                    //$res = $this->_db->execute($sql);
                    
                }
                // Cuando completan el sorteo, a veces manda mails. 
                // Solo cuando existen los 2 campos de mails de amigos.
                elseif ($this->template == 'front_sorteoweb_AM' OR $this->template == 'front_sorteo_AM') {
                    $isNull = false;
                    if ($entityManager->fields['email_amigo_1']->getValueForDbFromPost($isNull) != '') {
                        $this->enviarMailAAmigos($entityManager->fields['nombre_amigo_1']->getValueForDbFromPost($isNull), $entityManager->fields['apellido_amigo_1']->getValueForDbFromPost($isNull), $entityManager->fields['email_amigo_1']->getValueForDbFromPost($isNull), $entityManager->fields['nombre']->getValueForDbFromPost($isNull), $entityManager->fields['apellido']->getValueForDbFromPost($isNull), $entityManager->fields['comentarios']->getValueForDbFromPost($isNull));
                    }
                    if ($entityManager->fields['email_amigo_2']->getValueForDbFromPost($isNull) != '') {
                        $this->enviarMailAAmigos($entityManager->fields['nombre_amigo_2']->getValueForDbFromPost($isNull), $entityManager->fields['apellido_amigo_2']->getValueForDbFromPost($isNull), $entityManager->fields['email_amigo_2']->getValueForDbFromPost($isNull), $entityManager->fields['nombre']->getValueForDbFromPost($isNull), $entityManager->fields['apellido']->getValueForDbFromPost($isNull), $entityManager->fields['comentarios']->getValueForDbFromPost($isNull));
                    }
                }
            }

            if (empty($errors)) {
                header("Location: index.php?module=" . $this->finalModule);
            }
        }


        foreach ($this->extras as $name => $extra) {
            $entityManager = new EntityManager($extra["entity"], array());
            $entityManager->prepareFields();
            $uniqueResult = false;
            $order = "";
            if (isset($extra["id"])) {
                $filterValue = $extra["id"];
                $filterBy = "e_table.id";
                $uniqueResult = true;
            } else {
                if (isset($extra["filterValue"])) {
                    $filterValue = $extra["filterValue"];
                    $filterBy = $extra["filterBy"];
                } else {
                    $filterValue = "1";
                    $filterBy = "1";
                }
                if (!empty($extra["orderBy"])) {
                    $order = $extra["orderBy"];
                }
            }
            if (!(strstr($filterValue, "@mainEntity") === false)) {
                list($entityReference, $entityField) = explode(".", $filterValue);
                if ((empty($entity)) || (!isset($entity[$entityField])))
                    FatalErrorHandler::finalize("Configuration Error");
                $filterValue = $entity[$entityField];
            }
            $list = $entityManager->find(true, $filterBy . " = '" . addslashes($filterValue) . "'", $order);
            if ($uniqueResult) {
                if (empty($list))
                    $list[0] = array();
                GlobalManager::getTplMng()->setValue($name, $list[0]);
            }
            else {
                GlobalManager::getTplMng()->setValue($name, $list);
            }
        }

        GlobalManager::getTplMng()->setTemplate($params['template']);
        GlobalManager::getTplMng()->setValue("em", $entityManager);
        GlobalManager::getTplMng()->setValue("errores", $errors);

        GlobalManager::getTplMng()->setValue("menu", GlobalManager::getMenu()->getMenuElements());
        GlobalManager::getTplMng()->drawTemplate();
    }

    private function generaCuerpoDeMail($nombre, $apellido, $email, $password) {
        // Genera el cuerpo del mail que se envía al cliente que se registra.
        GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STRING;
        GlobalManager::getTplMng()->setValue("nombre", $nombre);
        GlobalManager::getTplMng()->setValue("apellido", $apellido);
        GlobalManager::getTplMng()->setValue("email", $email);
        GlobalManager::getTplMng()->setValue("password", $password);
        GlobalManager::getTplMng()->setTemplate("front_mail_nueva_registracion");
        $cuerpo = GlobalManager::getTplMng()->drawTemplate();
        GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STANDARD;
        return $cuerpo;
    }

    private function enviarMailACliente($nombre, $apellido, $email, $password) {
        // Envía un mail al cliente que acaba de registrarse.
        $mail = new PHPMailer();
        $mail->From = "noreply@weleda.com.ar";
        $mail->FromName = "Weleda";
        $mail->Subject = "Bienvenido a Weleda";
        $mail->AltBody = "";
        $body = $this->generaCuerpoDeMail($nombre, $apellido, $email, $password);
        if (!$body) {
            return false;
        }
        $mail->MsgHTML($body);
        $mail->AddAddress($email, $nombre . " " . $apellido);
        $mail->IsHTML(true);
        if (!$mail->Send()) {
            error_log("No se pudo enviar el mail al cliente luego de registrarse.", 1, $this->mailToErrores);
            return false;
        } else {
            return true;
        }
    }

    private function generaCuerpoDeMailAAmigos($nombre_amigo, $email_amigo, $nombre, $apellido, $mensaje) {
        // Genera el cuerpo del mail que se envía al cliente que se registra.
        GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STRING;
        GlobalManager::getTplMng()->setValue("nombre_amigo", utf8_encode($nombre_amigo));
        GlobalManager::getTplMng()->setValue("nombre", utf8_encode($nombre));
        GlobalManager::getTplMng()->setValue("apellido", utf8_encode($apellido));
        GlobalManager::getTplMng()->setValue("mensaje", utf8_encode($mensaje));
        GlobalManager::getTplMng()->setTemplate("front_mail_sorteo_amigos");
        $cuerpo = GlobalManager::getTplMng()->drawTemplate();
        GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STANDARD;
        return $cuerpo;
    }

    // Envía mails a amigos que ingresó un participante del concurso
    private function enviarMailAAmigos($nombre_amigo, $apellido_amigo, $email_amigo, $nombre, $apellido, $mensaje) {
        $mail = new PHPMailer();
        $mail->From = "noreply@weleda.com.ar";
        $mail->FromName = "Weleda";
        $mail->Subject = "Weleda - Concurso";
        $mail->AltBody = "";
        $body = $this->generaCuerpoDeMailAAmigos($nombre_amigo, $email_amigo, $nombre, $apellido, $mensaje);
        if (!$body) {
            return false;
        }
        $mail->MsgHTML($body);
        $mail->AddAddress($email_amigo, $nombre_amigo . $apellido_amigo);
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        if (!$mail->Send()) {
            error_log("No se pudo enviar el mail al cliente luego de completar los datos del sorteo.", 1, $this->mailToErrores);
            return false;
        } else {
            return true;
        }
    }

}

?>