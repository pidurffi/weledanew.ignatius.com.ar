<?php

include_once(GALIX_FOLDER . "/class.Module.php");

class ModuleSessionCollection extends Module {

    protected $template = "";
    protected $entity = "";
    protected $task = "";
    protected $finalModule = "";
    protected $sessionName;
    protected $extras = array();
    /* Parametros del dump */
    protected $dumpTable = "";
    protected $dumpTimestampField = "";
    protected $dumpSaveUserField = true;
    protected $dumpListTable = "";
    protected $dumpListEntityField = "";
    protected $dumpListDumpField = "";
    /* Parametros del changeCount */
    protected $nameCountFields = "";
    private $errors = array();

    function ModuleSessionCollection($params) {
        $this->task = $params["task"];
        $this->sessionName = $params["sessionName"];
        if (!empty($params["entity"]))
            $this->entity = $params["entity"];
        if (!empty($params["template"]))
            $this->template = $params["template"];
        if (!empty($params["finalModule"]))
            $this->finalModule = $params["finalModule"];
        if (!empty($params["extras"]))
            $this->extras = $params["extras"];

        if (!empty($params["dumpTable"]))
            $this->dumpTable = $params["dumpTable"];
        if (!empty($params["dumpTimestampField"]))
            $this->dumpTimestampField = $params["dumpTimestampField"];
        if (!empty($params["dumpSaveUserField"]))
            $this->dumpSaveUserField = $params["dumpSaveUserField"];
        if (!empty($params["dumpListTable"]))
            $this->dumpListTable = $params["dumpListTable"];
        if (!empty($params["dumpListEntityField"]))
            $this->dumpListEntityField = $params["dumpListEntityField"];
        if (!empty($params["dumpListDumpField"]))
            $this->dumpListDumpField = $params["dumpListDumpField"];

        if (!empty($params["nameCountFields"]))
            $this->nameCountFields = $params["nameCountFields"];
    }

    public function exec($params) {
        /* Primero proceso los extras. */
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

        switch ($this->task) {
            case "add":
                return $this->execAdd();
                break;
            case "list":
                return $this->execList();
                break;
            case "delete":
                return $this->execDelete();
                break;
            case "dump":
                return $this->execDump();
                break;
            case "changeCount":
                return $this->execChangeCount();
                break;
            case "changeCountCarritoMayorista":
                return $this->execChangeCountCarritoMayorista();
                break;
            case "reset":
                return $this->execReset();
                break;
            default:
                FatalErrorHandler::finalize("ModuleSessionCollection: undefined task");
        }
    }

    function execList() {
        GlobalManager::getTplMng()->setTemplate($this->template);
        $collection = SessionManager::getValue($this->sessionName);
        if (!$collection)
            $collection = array(); // En caso de que no se seteï¿½ nunca
        if (!empty($this->errors))
            GlobalManager::getTplMng()->setValue('errors', $this->errors);
        $user = GlobalManager::getLogin()->getUser();
        GlobalManager::getTplMng()->setValue('items', $collection);
        GlobalManager::getTplMng()->setValue('usuario', $user);
        GlobalManager::getTplMng()->drawTemplate();
    }

    function execAdd() {
        $elements = SessionManager::getValue($this->sessionName);
        if (!is_array($elements))
            $elements = array();

        $id = RequestHandler::getGetValue("id");
        // Defino la cantidad a agregar.
        // Si no se recibe el parámetro "cant",  RequestHandler::getGetValue devuelve null.
        // Es decir que, si $cantidad es null, estoy en el carrito "web",
        // y si tiene un valor, estoy en el carrito minorista/mayorista.
        $cantidad = RequestHandler::getGetValue("cant");

        if (!isValidId($id))
            FatalErrorHandler::finalize("Invalid Object");

        $entityManager = new EntityManager($this->entity, array());
        $entityManager->prepareFields();
        $entity = $entityManager->find(true, "e_table.id = " . $id);

        if (empty($entity)) {
            FatalErrorHandler::finalize($errors[0]);
        }

        $entity = $entity[0];

        if (isset($elements[$id])) {
            // El producto ya se encontraba en la compra.
            if ($cantidad == null) {
                // Carrito "web" (consumidor final). Agrego un ítem más.
                $elements[$id]['count']++;
            } else {
                // Carrito minorista/mayorista. Cambio la cantidad anterior por la nueva.
                $elements[$id]['count'] = $cantidad;
            }
        } else {
            // El producto no se encontraba en la compra.
            $elements[$id] = array();
            if ($cantidad == null) {
                // Carrito "web" (consumidor final). Agrego un ítem.
                $elements[$id]['count'] = 1;
            } else {
                // Carrito minorista/mayorista. Agrego la cantidad ingresada por el usuario.
                $elements[$id]['count'] = $cantidad;
            }
            // Esto graba todo el registro de producto en la variable de sesión.
            //$elements[$id]['object'] = $entity;
            // Grabo solo los campos que necesito en la variable de sesión.
            $elements[$id]['object']['id'] = $entity['id'];
            $elements[$id]['object']['precio'] = $entity['precio'];
            $elements[$id]['object']['precio_mayorista'] = $entity['precio_mayorista'];
            $elements[$id]['object']['precio_minorista'] = $entity['precio_minorista'];
            $elements[$id]['object']['peso'] = $entity['peso'];
            $elements[$id]['object']['nombreweleda'] = $entity['nombreweleda'];
            $elements[$id]['object']['codigo'] = $entity['codigo'];
        }

        SessionManager::setValue($this->sessionName, $elements);
        header("Location: index.php?module=" . $this->finalModule);
    }

    function execDelete() {
        $item = RequestHandler::getGetValue("item");
        if ((!isValidId($item)) && ($item !== 0) && ($item !== "0"))
            FatalErrorHandler::finalize("Invalid Object");
        SessionManager::removeInArray($this->sessionName, $item);
        header("Location: index.php?module=" . $this->finalModule);
    }

    function execDump() {
        if ((empty($this->dumpTable)) || (empty($this->dumpListTable)) || (empty($this->dumpListEntityField)) || (empty($this->dumpListDumpField)))
            die("Error de configuracion de dump");

        $collection = SessionManager::getValue($this->sessionName);
        if (empty($collection)) {
            $this->errors[] = "No hay datos que guardar";
            return $this->execList();
        }

        $campos = array();
        $values = array();
        if (!empty($this->dumpTimestampField)) {
            $campos[] = $this->dumpTimestampField;
            $values[] = "NOW()";
        }
        if (!empty($this->dumpSaveUserField)) {
            $campos[] = $this->dumpSaveUserField;
            $login = GlobalManager::getLogin();
            $values[] = "'" . $login->getUserId() . "'";
        }

        $sql = "INSERT INTO " . $this->dumpTable . "(" . implode(",", $campos) . ") VALUES (" . implode(",", $values) . ")";
        $res = $this->_db->execute($sql);
        if (!$res) {
            $this->errors[] = "Imposible guardar los datos";
            return $this->execList();
        }
        $idDump = $this->_db->lastId();

        foreach ($collection as $element) {
            $sql = "INSERT INTO " . $this->dumpListTable . "(" . $this->dumpListDumpField . "," . $this->dumpListEntityField . ") ";
            $sql.= "VALUES('" . $idDump . "','" . $element['id'] . "')";
            $res = $this->_db->execute($sql);
            if (!$res) {
                $this->errors[] = "Imposible grabar los datos";
                return $this->execList();
            }
        }

        header("Location: index.php?module=" . $this->finalModule);
    }

    function execChangeCount() {
        $elements = SessionManager::getValue($this->sessionName);
        foreach ($elements as $key => $element) {
            if (isset($_POST[$this->nameCountFields][$key])) {
                // Pregunto si la nueva cantidad es cero (o negativo).
                if ($_POST[$this->nameCountFields][$key] <= 0) {
                    // Borro el ítem del array.
                    unset($elements[$key]);
                } else {
                    // Si no es cero, cambio la cantidad en el array.
                    $elements[$key]['count'] = $_POST[$this->nameCountFields][$key];
                }
            }
        }
        SessionManager::setValue($this->sessionName, $elements);
        header("Location: index.php?module=" . $this->finalModule);
    }

    function execChangeCountCarritoMayorista() {
        // Se ejecuta al hacer clic en Recalcular en el carrito mayorista.
        // Traigo el contenido de la sesión.
        $elements = SessionManager::getValue($this->sessionName);
        // Recorro el ítem $_POST['ids_productos'] que contiene todos los IDs de los productos
        // separados por guión.
        foreach (explode("-", $_POST['ids_productos']) as $producto_id) {
            // Si $_POST["count"][id del producto] es cero...
            if ($_POST["count"][$producto_id] <= 0) {
                // ...borro el ítem del array.
                unset($elements[$producto_id]);
            } else {
                // El producto está en el carrito. Creo el ítem en el array.
                // No importa si ya estaba creado.
                $entityManager = new EntityManager($this->entity, array());
                $entityManager->prepareFields();
                $entity = $entityManager->find(true, "e_table.id = " . $producto_id);

                if (empty($entity)) {
                    FatalErrorHandler::finalize($errors[0]);
                }

                $entity = $entity[0];
                $elements[$producto_id] = array();
                $elements[$producto_id]['count'] = $_POST["count"][$producto_id];
                $elements[$producto_id]['object'] = $entity;
            }
        }
        SessionManager::setValue($this->sessionName, $elements);
        header("Location: index.php?module=" . $this->finalModule);
    }

    function execReset() {
        $elements = array();
        SessionManager::setValue($this->sessionName, $elements);
        header("Location: index.php?module=" . $this->finalModule);
    }

}

?>