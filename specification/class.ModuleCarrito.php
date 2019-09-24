<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
include_once(GALIX_FOLDER . "/class.Module.php");

class ModuleCarrito extends Module {

    var $template = "";
    var $finalModule = "";
    var $sessionName = "";
    var $folderTxt = "";
    // Dirección (de Weleda) donde se envían un mensaje luego de una compra.
    var $mailTo = "adrian@ignatius.com.ar";
    //var $mailTo = "ventas@weleda.com.ar";
    // Dirección de mail adonde enviar errores
    var $mailToErrores = "adrian@ignatius.com.ar";
    var $mailTemplate = "";

    // Límite inferior para envío gratis. Si el costoTotal supera X pesos, el costoEnvio será cero.
    // Se define en /specification/variables.php.

    const limiteEnvioGratis = MONTO_MINIMO_PARA_ENVIO_GRATIS;

    // Datos de conexión al FTP de Weleda
    //var $ftp_server = 'ftp.ignatius01.com.ar';
    //var $ftp_user_name = 'pruebas@ignatius01.com.ar';
    //var $ftp_user_pass = 'pruebas';

    var $ftp_server = '200.59.162.213';
    var $ftp_user_name = 'Weleda';
    var $ftp_user_pass = 'Dico15963';

    // \\nodoviii\weleda$\

    function ModuleCarrito($params) {
        $this->template = $params['template'];
        $this->finalModule = $params['finalModule'];
        $this->sessionName = $params['sessionName'];
        $this->folderTxt = (empty($params['folderTxt'])) ? "" : $params["folderTxt"];
        $this->mailTemplate = (empty($params['mailTemplate'])) ? "" : $params["mailTemplate"];
    }

    function exec($params) {
        switch ($params["step"]) {
            case '1': return $this->step1();
                break;
            case '2': return $this->step2();
                break;
            case '3': return $this->step3();
                break;
            case 'mayorista_1': return $this->step_1_mayorista();
                break;
            case 'mayorista_2': return $this->step_2_mayorista();
                break;
            default: FatalErrorHandler::finalize("Error de configuracion del modulo Carrito");
        }
    }

    // Return 0 false
    // array('Provincia'=>nombre,'Localidad'=>nombre)
    function ValidateCP($cp) {
        $cp = trim($cp);
        if (empty($cp))
            return 0;
        $cp = GlobalManager::getDb()->real_escape_string($cp);

        if (CONSTANTE_PAIS == 'Argentina') {
            // En Argentina el CP ingresado debe conincidir con un CP en la base.
            $sql = "SELECT l.LOCALIDAD AS l_nombre, p.PROVINCIA AS p_nombre, c.* FROM CP c ";
            $sql.= "JOIN LOCALIDAD_ENVIOS l ON c.ID_LOCALIDAD = l.id ";
            $sql.= "JOIN PROVINCIA_ENVIOS p ON c.ID_PROVINCIA = p.id ";
            $sql.= "WHERE c.CP = '" . $cp . "'";
        } else {
            // En Chile el CP ingresado debe estar estar entre 2 valores.
            $sql = "SELECT '' AS l_nombre, '' AS p_nombre, c.* FROM CP c ";
            $sql.= "WHERE '" . $cp . "' >= c.CP AND '" . $cp . "' < c.CP_MAYOR; ";
        }



        $res = $this->_db->execute($sql);
        if (!$res)
            return 0;
        $reg = $this->_db->getRow($res);
        if (!$reg)
            return 0;
        $result = array("Provincia" => $reg['p_nombre'], "Localidad" => $reg['l_nombre']);
        return $result;
    }

    function step1() {
        $errors = array();
        $elements = SessionManager::getValue($this->sessionName);
        if (empty($elements))
            header("location: index.php?module=fr_carrito_list");

        $user = GlobalManager::getLogin()->getUser();

        $emCompra = new EntityManager("EntityCompra", array());
        $emCompra->prepareFields();
        if (isset($_POST['submit'])) {
            $login = GlobalManager::getLogin();
            $_POST["cliente"] = $login->getUserId();
            $_POST["costo_total"] = 0;


            if (CONSTANTE_PAIS == 'Argentina') {
                $resCP = $this->ValidateCP($_POST["codigo_postal"]);
                if ($resCP == 0) {
                    $errors[] = "C&oacute;digo postal desconocido";
                } else {
                    // Quiero que el usuario escriba la localidad a mano.
                    // $_POST["ciudad"] = $resCP["Localidad"];
                    // Se detectó que existen localidades cercanas a fronteras provinciales
                    // que comparten el CP. Por eso, ahora el usuario deberá escribir a mano
                    // la provincia.
                    //$_POST["provincia"] = $resCP["Provincia"];
                    $emCompra->fillFieldsWithPost();
                    /* Validate */
                    foreach ($emCompra->fields as $key => $field) {
                        $emCompra->fields[$key]->validateFromPost($errors);
                    }
                }
            } else {
                // En Chile no valido el código postal.
                // Quiero que el usuario escriba la localidad a mano.
                // $_POST["ciudad"] = $resCP["Localidad"];
                // Se detectó que existen localidades cercanas a fronteras provinciales
                // que comparten el CP. Por eso, ahora el usuario deberá escribir a mano
                // la provincia.
                //$_POST["provincia"] = $resCP["Provincia"];
                $emCompra->fillFieldsWithPost();
                /* Validate */
                foreach ($emCompra->fields as $key => $field) {
                    $emCompra->fields[$key]->validateFromPost($errors);
                }
            }

            /* Try to save */
            if (empty($errors)) {
                $idNuevo = $emCompra->saveFromPost($errors);
            }

            /* OK or not? */
            if (empty($errors)) {
                SessionManager::setValue("ultimaCompra", $idNuevo);
                header("Location: index.php?module=" . $this->finalModule);
            }
        } else {
            $emCompra->fields['nombre']->value = $user['nombre'] . " " . $user['apellido'];
        }
        GlobalManager::getTplMng()->setValue("usuario", $user);
        GlobalManager::getTplMng()->setValue("emCompra", $emCompra);
        GlobalManager::getTplMng()->setValue("errors", $errors);
        GlobalManager::getTplMng()->setTemplate($this->template);
        GlobalManager::getTplMng()->drawTemplate();
    }

    // array("Tarifa"=>xxxx,"Dias"=>xxxX);
    // TODO: Verificar que pasa si se pasa del peso

    function getTarifaDiasByCPPeso($cp, $peso) {
        $cp = trim($cp);
        $peso = trim($peso);
        $peso = $peso * 1;
        $sql = "SELECT t.TARIFA as tarif, ctent.DIAS as dias, t.codigoweleda ";
        $sql.= "FROM CP c ";
        $sql.= "JOIN COURTARI ctari ON ctari.ID_ZONA = c.ID_ZONA AND ctari.ID_TARIFA = c.ID_TARIFA ";
        $sql.= "JOIN TARIFA_ENVIO t ON t.ID = ctari.ID_TARIFA ";
        $sql.= "JOIN COURTENT ctent ON ctent.ID_ZONA = c.ID_ZONA ";
        $sql.= "WHERE c.CP = '" . GlobalManager::getDb()->real_escape_string($cp) . "' ";
        $sql.= "AND ctari.PESO_HASTA >= '" . $peso . "' ";
        $sql.= "ORDER BY PESO_HASTA ASC LIMIT 0,1 ";
        $res = $this->_db->execute($sql);
        if (!$res) {
            return 0;
        }
        $reg = $this->_db->getRow($res);
        if (empty($reg)) {
            return 0;
        }
        return array("Tarifa" => $reg['tarif'], "Dias" => $reg['dias'], "CodigoEnvioWeleda" => $reg['codigoweleda']);
    }

    function getTarifaDiasByCiudadPeso($ciudad_id, $peso) {
        // Se usa en Chile.
        $sql = "SELECT t.TARIFA as tarif, ctent.DIAS as dias, t.codigoweleda ";
        $sql.= "FROM LOCALIDAD_ENVIOS loc ";
        $sql.= "JOIN COURTARI ctari ON ctari.ID_ZONA = loc.ID_ZONA ";
        $sql.= "JOIN TARIFA_ENVIO t ON t.ID = ctari.ID_TARIFA ";
        $sql.= "JOIN COURTENT ctent ON ctent.ID_ZONA = loc.ID_ZONA ";
        $sql.= "WHERE loc.ID = $ciudad_id ";
        $sql.= "AND ctari.PESO_HASTA >= $peso ";
        $sql.= "ORDER BY PESO_HASTA ASC LIMIT 0,1 ";
        $res = $this->_db->execute($sql);
        if (!$res) {
            return 0;
        }
        $reg = $this->_db->getRow($res);
        if (empty($reg)) {
            return 0;
        }
        return array("Tarifa" => $reg['tarif'], "Dias" => $reg['dias'], "CodigoEnvioWeleda" => $reg['codigoweleda']);
    }

    function step2() {
        $limiteEnvioGratis = self::limiteEnvioGratis;
        $errors = array();
        $idNuevo = SessionManager::getValue("ultimaCompra");
        if (empty($idNuevo)) {
            header("Location: index.php?module=fr_carrito_list");
        }
        $em = new EntityManager("EntityCompra", null);
        $em->prepareFields();

        // Traigo los datos de la compra.
        $compra = $em->find(true, "e_table.id='" . valueToDb($idNuevo) . "'");
        $compra = $compra[0];
        
        // Busco si hay descuentos activos (promociones). Trae solo un registro.
        // Busco promociones activas para la provincia ingresada por el cliente.
        //$provincia_id = $compra['provincia'];
        /*
          $sql = "SELECT * FROM promociones WHERE DATE(NOW()) BETWEEN fecha_inicio AND fecha_fin and provincia_id = (SELECT id FROM PROVINCIA_ENVIOS WHERE PROVINCIA='" . $compra['provincia'] . "' LIMIT 1) LIMIT 1;";
          $res = $this->_db->execute($sql);
          $reg = $this->_db->getRow($res);
          $promocion = $reg;
         */

        $descuento_porcentaje = 0;
        $descuento_pesos = 0;
        $promocion = '';
	$descuento_por_producto = FALSE;

        // Si se completó el textbox de código de promoción, busco si es válido.
        // Tiene que estar entre 2 fechas, y no haber sido usado antes (codigo_usado=0)
        // o que el campo usos_multiples sea 1 (y que no sea de "un uso por cliente").
	// Si no se cumple lo anterior, buscará promociones con un_uso_cliente = 1
	// y que no figuren como usadas en la tabla codigo_promocion.
        if ($compra['codigo_promocion'] != '') {
            $sql = "SELECT * FROM promociones WHERE DATE(NOW()) BETWEEN fecha_inicio AND fecha_fin
				AND upper(codigo) = '" . trim(strtoupper($compra['codigo_promocion'])) . "'
				AND (
					(un_uso_por_cliente = 0 AND (codigo_usado = 0 OR usos_multiples = 1))
					OR ( (select count(*) from promocion_cliente where codigo_promocion = '" . trim(strtoupper($compra['codigo_promocion'])) . "' and id_cliente = " . $compra["id_cliente"] . " ) = 0 )
				)
				LIMIT 1;";
            $res = $this->_db->execute($sql);
            $reg = $this->_db->getRow($res);
            $promocion = $reg;

            // Si se encontró un descuento con un valor entre 0 y 100 (no inclusive), se aplicará ese descuento.
            if ($promocion['porcentaje_descuento'] > 0 and $promocion['porcentaje_descuento'] < 100) {
                $descuento_porcentaje = $promocion['porcentaje_descuento'];
            }
			else
			{
				// Si no encontré descuento, busco descuentos específicos para productos.
				$sql = "SELECT * from promocion_producto
						WHERE DATE(NOW()) BETWEEN fecha_inicio AND fecha_fin
						AND upper(codigo) = '" . trim(strtoupper($compra['codigo_promocion'])) . "'
						AND (
							un_uso_por_cliente = 0
							OR ( (select count(*) from promocion_cliente where codigo_promocion = '" . trim(strtoupper($compra['codigo_promocion'])) . "' and id_cliente = " . $compra["id_cliente"] . " ) = 0 )
						);";
				$res = $this->_db->execute($sql);
				// Recorro los registros encontrados (porque puede haber descuentos para varios productos).
				while ($promocion = $this->_db->getRow($res)) {
					// Si se encontró un descuento con un valor entre 0 y 100 (no inclusive), se aplicará ese descuento.
					if ($promocion['porcentaje_descuento'] > 0 and $promocion['porcentaje_descuento'] < 100) {
						// Aplico el descuento al producto.
						$elements = SessionManager::getValue($this->sessionName);
						// Me fijo si no se aplicó el descuento antes.
						if( ! isset($elements[$promocion['id_producto']]['object']['descuento'])
								&& isset($elements[$promocion['id_producto']]) )
						{
							$elements[$promocion['id_producto']]['object']['precio'] = $elements[$promocion['id_producto']]['object']['precio'] * ( 1 - ($promocion['porcentaje_descuento'] / 100) );
							// Creo un campo llamado "descuento" que pongo en TRUE.
							// Si no, al ir hacia atrás y hacia adelante, le vuelve a aplicar el descuento al producto.
							$elements[$promocion['id_producto']]['object']['descuento'] = TRUE;
							// Al nombre Weleda le agrego el nombre de la promo ("10% de descuento", por ejemplo).
							$elements[$promocion['id_producto']]['object']['nombreweleda'] .= " (con " . $promocion['nombre'] . ")";
						}
						// Grabo la variable de sesión.
						SessionManager::setValue($this->sessionName,$elements);
						// Creo una variable en TRUE para indicar que se usó un descuento por producto.
						// Es para que avise no en pantalla que el descuento no existe.
						$descuento_por_producto = TRUE;
					}
                                        // Si el descuento es 100%, el producto va de regalo.
                                        elseif ($promocion['porcentaje_descuento'] == 100) {
                                            // Defino el ID del producto que el cliente recibirá de regalo.
                                            $id_producto = $promocion['id_producto'];
                                            // Agrego el producto gratis a la sesión.
                                            $elements = SessionManager::getValue($this->sessionName);
                                            $entityManager = new EntityManager('EntityProducto',array());
                                            $entityManager->prepareFields();
                                            $entity = $entityManager->find(true,"e_table.id = ".$id_producto);
                                            $entity = $entity[0];
                                            $entity["precio"] = 0; // El precio es cero.
                                            $entity["nombreweleda"] .= " (DE REGALO)"; // Le agrego " (DE REGALO)" al nombre del producto.
                                            // El índice del array es 999. No puedo usar el ID del producto porque si el cliente
                                            // compró el producto, el producto de regalo pisa al producto normal.
                                            $elements[999] = array();
                                            $elements[999]['count'] = 1; // La cantidad es uno.
                                            $elements[999]['object'] = $entity;
                                            SessionManager::setValue($this->sessionName,$elements);
                                            $descuento_por_producto = TRUE;
                                        }
				}
			}
        }
        /* Si el código de promoción está vacío (el usuario no lo ingresó),
         * busco en la tabla descuento_email, donde cargan
         * descuento válidos por comprador. */
        // En este caso, no se verifica el código; el descuento se busca por el mail del usuario logueado.
        else {
            // Traigo los datos del cliente para usar el email.
            $cliente = GlobalManager::getLogin()->getUser();
            $sql = "SELECT * FROM promociones_mail WHERE DATE(NOW()) BETWEEN fecha_inicio AND fecha_fin
                    AND promociones_mail.email = '" . $cliente['email'] . "'
                    LIMIT 1;";
            $res = $this->_db->execute($sql);
            $reg = $this->_db->getRow($res);
            $promocion = $reg;
             // Si se encontró un descuento con un valor entre 0 y 100 (no inclusive), se aplicará ese descuento.
            if ($promocion['porcentaje_descuento'] > 0 and $promocion['porcentaje_descuento'] < 100) {
                $descuento_porcentaje = $promocion['porcentaje_descuento'];
            }
			else {
				// No encontró descuentos por mail.
				// Busco si corresponde aplica un descuento por ser la primera compra.
				$sql = "SELECT
							cliente.id, cliente.email,
							cliente.recibe_newsletter, cliente.dt_lu,
							(SELECT COUNT(compra.id)
							FROM compra
							WHERE compra.dineromail_estado_operacion=2
								AND compra.id_cliente = cliente.id
							) as cantidad_compras,
							'Descuento primera compra' as nombre
					FROM cliente
					WHERE 
						cliente.dt_lu >= DATE('2014-01-01')
						AND cliente.recibe_newsletter = 1
					    AND cliente.id = " . $cliente['id'] . ";";
				$res = $this->_db->execute($sql);
				$reg = $this->_db->getRow($res);
				$promocion = $reg;
				// Si encontró al cliente actual y se registró con fecha anterior a X y activó recibe_newsletter,
				// buscará las compras de ese cliente. Si la cantidad de compras es 0, aplico el descuento.
				if ($promocion != false AND $promocion['cantidad_compras'] == 0) {
					$descuento_porcentaje = 10.0;
				}
				
			}
        }

        // Busco cuántas compras ya ha realizado el cliente (para regalarle un producto).
        // No le resto uno al count(*) porque la compra actual aun no se ha grabado en la base.
        // dineromail_estado_operacion debe ser 2 (operación acreditada en DineroMail).
        /*
          $sql = "SELECT count(*) as cantidad_compras FROM compra WHERE id_cliente = " . $compra["id_cliente"] . " AND dineromail_estado_operacion = 2
          AND id_cliente IN (SELECT id_cliente from encuesta3)
          AND id_cliente NOT IN (SELECT id_cliente from producto_gratis WHERE promocion = 1)
          AND id_cliente <= 3423 ;";
          $res = $this->_db->execute($sql);
          $reg = $this->_db->getRow($res);
          $cantidad_compras_cliente = $reg;
         */

        // Si el cliente ha comprado 1 o más veces, se le regala un producto.
        /*
          if ($cantidad_compras_cliente["cantidad_compras"] >= 1)
          {
          // Defino el ID del producto que el cliente recibirá de regalo.
          $id_producto = 33;
          // Agrego el producto a la sesión.
          $elements = SessionManager::getValue($this->sessionName);

          $entityManager = new EntityManager('EntityProducto',array());
          $entityManager->prepareFields();
          $entity = $entityManager->find(true,"e_table.id = ".$id_producto);
          $entity = $entity[0];
          $entity["precio"] = 0; // El precio es cero.
          $entity["nombreweleda"] .= " (DE REGALO)"; // Le agrego " (DE REGALO)" al nombre del producto.
          // El índice del array es 999. No puedo usar el ID del producto porque si el cliente
          // compró el producto, el producto de regalo pisa al producto normal.
          $elements[999] = array();
          $elements[999]['count'] = 1; // La cantidad es uno.
          $elements[999]['object'] = $entity;
          SessionManager::setValue($this->sessionName,$elements);
          }
         */
        
    

		/* Si el cliente usó el código WELEDAVERANO,
		se le regala al azar un producto de 4 (no puede elegir) */
		/*
        if (trim(strtoupper($compra['codigo_promocion'])) == 'WELEDAVERANO') {
          $numero_aleatorio = rand(1, 4);
          switch ($numero_aleatorio) {
              case 1:
                    // 203006	LOCION TONICA PARA LA PIEL 100 ML.
                     $id_producto = 38;
                     break;
               case 2:
                   //202011	BARRO TERMAL WELEDA 100 G.
                     $id_producto = 105;
                     break;
               case 3:
                   //203043 PINCEL PARA EL CUIDADO DE UÑAS 2,2 ML
                     $id_producto = 166;
                     break;
                case 4:
                    //203044 LAPIZ PARA SUAVIZAR CUTICULAS 3 ML
                     $id_producto = 165;
                     break;
            }
			// Agrego el producto a la sesión.
			$elements = SessionManager::getValue($this->sessionName);
			// Pregunto si existe el elemento 999, porque si ya existe, cambia el producto al azar por otro.
			if(!isset($elements[999])){
			$entityManager = new EntityManager('EntityProducto',array());
			$entityManager->prepareFields();
			$entity = $entityManager->find(true,"e_table.id = ".$id_producto);
			$entity = $entity[0];
			$entity["precio"] = 0; // El precio es cero.
			$entity["nombreweleda"] .= " (DE REGALO)"; // Le agrego " (DE REGALO)" al nombre del producto.
			// El índice del array es 999. No puedo usar el ID del producto porque si el cliente
			// compró el producto, el producto de regalo pisa al producto normal.
			$elements[999] = array();
			$elements[999]['count'] = 1; // La cantidad es uno.
			$elements[999]['object'] = $entity;
			SessionManager::setValue($this->sessionName,$elements);
			}
        }
		*/
        // El cliente recibirá un producto de 4 de regalo.
        // Defino el ID del producto que el cliente recibirá de regalo.
	      //$id_producto = 159;
		  /*
		  $numero_aleatorio = rand(1, 4);
          switch ($numero_aleatorio) {
              case 1:
                    // 203006	LOCION TONICA PARA LA PIEL 100 ML.
                     $id_producto = 38;
                     break;
               case 2:
                   //202011	BARRO TERMAL WELEDA 100 G.
                     $id_producto = 105;
                     break;
               case 3:
                   //203043 PINCEL PARA EL CUIDADO DE UÑAS 2,2 ML
                     $id_producto = 166;
                     break;
                case 4:
                    //203044 LAPIZ PARA SUAVIZAR CUTICULAS 3 ML
                     $id_producto = 165;
                     break;
		  }
		  */
          // Agrego el producto a la sesión.
		  /*
          $elements = SessionManager::getValue($this->sessionName);
		  if(!isset($elements[999])){
			  // Pregunto si existe el elemento 999, porque si ya existe, cambia el producto al azar por otro.
			  $entityManager = new EntityManager('EntityProducto',array());
			  $entityManager->prepareFields();
			  $entity = $entityManager->find(true,"e_table.id = ".$id_producto);
			  $entity = $entity[0];
			  $entity["precio"] = 0; // El precio es cero.
			  $entity["nombreweleda"] .= " (DE REGALO)"; // Le agrego " (DE REGALO)" al nombre del producto.
			  // El índice del array es 999. No puedo usar el ID del producto porque si el cliente
			  // compró el producto, el producto de regalo pisa al producto normal.
			  $elements[999] = array();
			  $elements[999]['count'] = 1; // La cantidad es uno.
			  $elements[999]['object'] = $entity;
			  SessionManager::setValue($this->sessionName,$elements);
		  }
		  */
          

        if (isset($_POST['submit'])) {
            // Se apretó SUBMIT.
            // Grabo la localidad/ciudad (ya que el usuario puede cambiarla).
            // Esto es porque hay varias localidades que tienen el mismo código postal.
            // De hecho, hay localidades cerca de fonteras provinciales que comparten
            // el CP, por eso se le permite al usuario que cambie la provincia.
            /*
              $localidad = $_POST['txtLocalidad'];
              $provincia = $_POST['txtprovincia'];
              $sql = "UPDATE compra ";
              $sql.= "SET ciudad = '" . $localidad . "' , ";
              $sql.= "provincia = '" . $provincia . "' ";
              $sql.= "WHERE id = '" . valueToDb($idNuevo) . "' ";
              GlobalManager::getDb()->execute($sql);
             */
            // Redirecciono.
            header("Location: index.php?module=" . $this->finalModule);
        } else {
            // No se apretó SUBMIT.
            $elements = SessionManager::getValue($this->sessionName);
            $costoTotal = 0;
            $pesoTotal = 0;
            $costoTotalSinEnvio = 0;
            foreach ($elements as $elemento) {
                //$costoTotal += $elemento['count'] * $elemento['object']['precio'];
                $costoTotalSinEnvio += $elemento['count'] * $elemento['object']['precio'];
                $pesoTotal += $elemento['count'] * $elemento['object']['peso'];
            }
            if (CONSTANTE_PAIS == 'Argentina') {

                // En Argentina busco el costo de envío por código postal.
                $detalles = $this->getTarifaDiasByCPPeso($compra['codigo_postal'], $pesoTotal);
            } else {
                // En Chile busco el costo de envío por ciudad (comuna) y peso.
                $detalles = $this->getTarifaDiasByCiudadPeso($compra['id_ciudad'], $pesoTotal);
            }

            if ($costoTotalSinEnvio >= $limiteEnvioGratis) {
                $costoEnvio = 0;
            } else {

                $costoEnvio = $detalles["Tarifa"];
            }
            $diasTotal = $detalles["Dias"];

            // Calculo el descuento en pesos (porcentaje sobre el costo total sin envío)
            $descuento_pesos = $costoTotalSinEnvio * $descuento_porcentaje / 100;
            $costoTotalConDescuento = $costoTotalSinEnvio - $descuento_pesos + $costoEnvio;
            $costoTotal = $costoTotalSinEnvio + $costoEnvio;

            // Si hay descuento, lo grabo en el registro en la tabla Compra.
            if ($descuento_pesos > 0) {
                $sql = "UPDATE compra ";
                $sql.= "SET descuento_pesos = '" . $descuento_pesos . "' , ";
                $sql.= "descuento_porcentaje = '" . $descuento_porcentaje . "' , ";
                $sql.= "nombre_promocion = '" . $promocion['nombre'] . "' ";
                $sql.= "WHERE id = '" . valueToDb($idNuevo) . "' ";
                GlobalManager::getDb()->execute($sql);
            }

            $user = GlobalManager::getLogin()->getUser();

            GlobalManager::getTplMng()->setTemplate($this->template);
            GlobalManager::getTplMng()->setValue("compra", $compra);
            //GlobalManager::getTplMng()->setValue("tipoEnvio",$tipoEnvio);
            GlobalManager::getTplMng()->setValue("elementos", $elements);
            GlobalManager::getTplMng()->setValue("costoTotal", $costoTotal);
            GlobalManager::getTplMng()->setValue("costoTotalConDescuento", $costoTotalConDescuento);
            GlobalManager::getTplMng()->setValue("costoEnvio", $costoEnvio);
            GlobalManager::getTplMng()->setValue("pesoTotal", $pesoTotal);
            GlobalManager::getTplMng()->setValue("diasTotal", $diasTotal);
            GlobalManager::getTplMng()->setValue('usuario', $user);
            GlobalManager::getTplMng()->setValue('descuento_pesos', $descuento_pesos);
            GlobalManager::getTplMng()->setValue('promocion', $promocion);
            GlobalManager::getTplMng()->setValue('descuento_por_producto', $descuento_por_producto);

            GlobalManager::getTplMng()->drawTemplate();
        }
    }

    private function generateMailBody($elements, $compra) {
        GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STRING;
        GlobalManager::getTplMng()->setValue("compra", $compra);
        GlobalManager::getTplMng()->setTemplate($this->mailTemplate);
        $cuerpo = GlobalManager::getTplMng()->drawTemplate();
        GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STANDARD;
        return $cuerpo;
    }

    private function generateMailBodyForClient($elements, $compra, $costoEnvio, $diasTotal, $costoTotal, $usuario) {
        // Genera el cuerpo del mail que se envía al cliente que compra.
        GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STRING;
        GlobalManager::getTplMng()->setValue("compra", $compra);
        GlobalManager::getTplMng()->setValue("elements", $elements);
        GlobalManager::getTplMng()->setValue("costoEnvio", $costoEnvio);
        GlobalManager::getTplMng()->setValue("diasTotal", $diasTotal);
        GlobalManager::getTplMng()->setValue("costoTotal", $costoTotal);
        GlobalManager::getTplMng()->setValue("usuario", $usuario);
        GlobalManager::getTplMng()->setTemplate("front_mail_compra_cliente");
        $cuerpo = GlobalManager::getTplMng()->drawTemplate();
        GlobalManager::getTplMng()->output = TEMPLATE_OUTPUT_STANDARD;
        return $cuerpo;
    }

    private function sendMail($elements, $compra) {
        $mail = new PHPMailer();
        //$mail->IsSMTP();
        //$mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";
        //$mail->Host = "smtp.gmail.com";
        //$mail->Port = 465;
        //$mail->Username = "phpmailtesting@gmail.com";
        //$mail->Password = "dorismar";
        $mail->From = "noreply@weleda.com.ar";
        $mail->FromName = "Weleda";
        $mail->Subject = "Nueva compra on-line, pedido número " . $compra['id'];
        $mail->AltBody = "";
        $body = $this->generateMailBody($elements, $compra);
        if (!$body) {
            return false;
        }
        $mail->MsgHTML($body);
        $mail->AddAddress($this->mailTo, $this->mailTo);
        $mail->IsHTML(true);

        if (!$mail->Send()) {
            error_log("No se pudo enviar el mail a Weleda. Pedido número " . $compra['id'], 1, $this->mailToErrores);
            return false;
        } else {
            return true;
        }
    }

    private function sendMailToClient($elements, $compra, $costoEnvio, $diasTotal, $costoTotal, $usuario) {
        // Envía un mail al cliente que realiza la compra
        $mail = new PHPMailer();
        $mail->From = "noreply@weleda.com.ar";
        $mail->FromName = "Weleda";
        $mail->Subject = "Weleda, confirmación de pedido número " . $compra['id'];
        $mail->AltBody = "";
        $body = $this->generateMailBodyForClient($elements, $compra, $costoEnvio, $diasTotal, $costoTotal, $usuario);
        if (!$body) {
            return false;
        }
        $mail->MsgHTML($body);
        $mail->AddAddress($usuario['email'], $usuario['nombre'] . " " . $usuario['apellido']);
        $mail->IsHTML(true);
        if (!$mail->Send()) {
            error_log("No se pudo enviar el mail al cliente que hizo la compra. Pedido número " . $compra['id'], 1, $this->mailToErrores);
            return false;
        } else {
            return true;
        }
    }

    private function grabarEnBase($elements, $compra, &$errors) {
        // Antes de insertar, borro, porque si el cliente recarga la página, dará violación de clave primaria
        // en la tabla compra_producto.
        $sql = "DELETE FROM compra_producto WHERE id_compra =  '" . $compra['id'] . "';";
        $res = GlobalManager::getDb()->execute($sql);
         
        foreach ($elements as $key => $elemento) {
            // Si el ID del producto es 999, no lo agrego a la tabla compra_producto
            // porque daría violación de clave. El 999 se usa como índice del array cuando
            // un producto va de regalo con precio cero. El ítem se agrega en el array de sesión en el paso 2.
            if ($key != 999) {
                $sql = "INSERT INTO compra_producto(id_compra,id_producto,cantidad,precio) ";
                $sql.= "VALUES('" . $compra['id'] . "','" . $key . "','" . $elemento['count'] . "','" . $elemento['count'] * $elemento['object']['precio'] . "')";
                $res = true;
                $res = GlobalManager::getDb()->execute($sql);
                if (!$res) {
                    $errors[] = "Imposible grabar la venta. Pruebe luego";
                    return false;
                }
            } else {
                // Grabo en la base que se le enviará al cliente un producto gratis.
                // Esto es para que no lo reciba más de una vez.
                $sql = "INSERT INTO producto_gratis(id_cliente,promocion) ";
                $sql.= "VALUES(" . $compra['id_cliente'] . ", 1 );";
                $res = true;
                $res = GlobalManager::getDb()->execute($sql);
            }
        }
        return true;
    }

    private function grabarEnBaseCompraMayorista($elements, $compra, &$errors, $cliente) {
        foreach ($elements as $key => $elemento) {
            // Si el ID del producto es 999, no lo agrego a la tabla compra_producto
            // porque daría violación de clave. El 999 se usa como índice del array cuando
            // un producto va de regalo con precio cero. El ítem se agrega en el array de sesión en el paso 2.
            if ($key != 999) {
                $precio = 0;
                switch ($cliente['tipo_cliente']) {
                    case "Web":
                        /* web (venta al público) */
                        $precio = $elemento['object']['precio'];
                        break;
                    case "Minorista":
                        /* Minorista */
                        $precio = $elemento['object']['precio_minorista'];
                        break;
                    case "Mayorista":
                        /* Mayorista */
                        $precio = $elemento['object']['precio_mayorista'];
                        break;
                }

                $sql = "INSERT INTO compra_producto(id_compra,id_producto,cantidad,precio) ";
                $sql.= "VALUES('" . $compra['id'] . "','" . $key . "','" . $elemento['count'] . "','" . $elemento['count'] * $precio . "')";
                $res = true;
                $res = GlobalManager::getDb()->execute($sql);
                if (!$res) {
                    $errors[] = "Imposible grabar la venta. Pruebe luego";
                    return false;
                }
            } else {
                // Grabo en la base que se le enviará al cliente un producto gratis.
                // Esto es para que no lo reciba más de una vez.
                $sql = "INSERT INTO producto_gratis(id_cliente,promocion) ";
                $sql.= "VALUES(" . $compra['id_cliente'] . ", 1 );";
                $res = true;
                $res = GlobalManager::getDb()->execute($sql);
            }
        }
        return true;
    }

    private function obtenerNroPedido($file) {
        fseek($file, 0, SEEK_SET);
        $numero = 0;
        while (!feof($file)) {
            $linea = fgets($file);
            if (strlen(trim($linea)) <= 0)
                continue;
            $partes = explode('|', $linea);
            $numero = trim($partes[0]);
            $numero*=1;
            if (!is_integer($numero))
                return 0;
        }
        fseek($file, 0, SEEK_END);
        return $numero + 1;
    }

    private function grabarEnTxt($elements, $compra, $usuario, $costoEnvio, $codigoEnvio, &$errors, $porcentaje_precio_final = 1) {
        // En $porcentaje_precio_final se debe recibir un valor entre 0 y 1.
        // Si es 1, los precios quedan igual (es decir, no hay descuento).
        // Si los productos tienen un 10% de descuento, $porcentaje_precio_final recibirá 0.9; entonces,
        // los precios se multiplicarán por 0.9, quedando el 90% del precio original.
        $fecha = getdate();
        $mes = ($fecha['mon'] >= 10) ? $fecha['mon'] : "0" . $fecha['mon'];
        $dia = ($fecha['mday'] >= 10) ? $fecha['mday'] : "0" . $fecha['mday'];
        $hrs = ($fecha['hours'] >= 10) ? $fecha['hours'] : "0" . $fecha['hours'];
        $mns = ($fecha['minutes'] >= 10) ? $fecha['minutes'] : "0" . $fecha['minutes'];
        $sgs = ($fecha['seconds'] >= 10) ? $fecha['seconds'] : "0" . $fecha['seconds'];
        $postfijo = ($fecha['year'] % 100) . $mes . $dia . "_" . $hrs . $mns . $sgs . "_" . $compra['id'];
        $nombre_archivo = APPLICATION_ROOT . $this->folderTxt . "/carrito_" . $postfijo . ".txt";
        $arch = fopen($nombre_archivo, "a+");
        if (!$arch) {
            if (file_exists($nombre_archivo)) {

                for ($i = 0; $i < 10; $i++) {
                    sleep(1);
                    $arch = fopen($nombre_archivo, "a");
                    if ($arch)
                        break;
                }
                $errors[] = "Imposible crear el archivo";
                return false;
            }
            else {
                $errors[] = "Imposible crear el archivo";
                return false;
            }
        }

        $falso = 0;
        foreach ($elements as $elemento) {
            // 1-NUMERO
            fputs($arch, $compra['id'] . "|");
            // 2-CODIGO
            // (no muestra el ID de la tabla Producto sino el código interno de Weleda [codigo])
            fputs($arch, $elemento['object']['codigo'] . "|");
            // 3-DETALLE
            fputs($arch, $this->limpiar_cadena_iconv_mayus(substr($elemento['object']['nombreweleda'], 0, 50)) . "|");
            // 4-PRECIO
            $strPrecio = sprintf("%012.2f", $elemento['object']['precio'] * $porcentaje_precio_final);
            fputs($arch, trim($strPrecio) . "|");
            // 5-CANTIDAD
            fputs($arch, $elemento['count'] . "|");
            // 6-VENDEDOR (valor fijo = 80)
            fputs($arch, "80" . "|");
            // 7-CLIENTE
            fputs($arch, (50000 + $compra['id_cliente']) . "|");
            // 8-FECHA
            fputs($arch, date("d/m/y") . "|");
            // 9-FECHA ENT (igual a fecha)
            fputs($arch, date("d/m/y") . "|");
            // 10-OBSERVACION
            if ($elemento['object']['id'] == 999) {
                fputs($arch, "(DE REGALO)" . "|");
            } elseif ($compra['para_regalo'] == 1) {
                fputs($arch, "(ENVUELTO PARA REGALO)" . "|");
            } else {
                fputs($arch, "" . "|");
            }

            // 11-REFERENCIA
            fputs($arch, "" . "|");
            // 12-REFERENCI1
            fputs($arch, "" . "|");
            // 13-MONEDA
            fputs($arch, "1" . "|");
            // 14-COTIZACION
            fputs($arch, "1" . "|");
            // 15-EMPRESA
            fputs($arch, "0");

            fputs($arch, "\r\n");
        }
        // Escribo los gastos de envío como si fuera un producto más.
        // 1-NUMERO
        fputs($arch, $compra['id'] . "|");
        // 2-CODIGO (Es el campo codigoweleda de la tabla tarifa_envio)
        //fputs($arch,"70001"."|");
		// El código de envío no puede estar vacío (genera un error en Presea).
		if ($codigoEnvio == "") { $codigoEnvio = "70001"; }
        fputs($arch, trim($codigoEnvio) . "|");
        // 3-DETALLE
        fputs($arch, "WEB - GASTOS DE ENVIO" . "|");
        // 4-PRECIO (costo del envío)
        $strPrecio = sprintf("%012.2f", $costoEnvio);
        fputs($arch, trim($strPrecio) . "|");
        // 5-CANTIDAD
        fputs($arch, "1" . "|");
        // 6-VENDEDOR
        fputs($arch, "80" . "|");
        // 7-CLIENTE
        fputs($arch, (50000 + $compra['id_cliente']) . "|");
        // 8-FECHA
        fputs($arch, date("d/m/y") . "|");
        // 9-FECHA ENT
        fputs($arch, date("d/m/y") . "|");
        // 10-OBSERVACIONES
        fputs($arch, "" . "|");
        // 11-REFERENCIA
        fputs($arch, "" . "|");
        // 12-REFERENCI1
        fputs($arch, "" . "|");
        // 13-MONEDA
        fputs($arch, "1" . "|");
        // 14-COTIZACION
        fputs($arch, "1" . "|");
        // 15-EMPRESA
        fputs($arch, "0");
        // FIN línea gastos de envío
        fputs($arch, "\r\n");
        // Cierro el archivo.
        fclose($arch);
        // Datos del archivo del carrito para subir al FTP.
        $destination_file_archivo_carrito = "carrito_" . $postfijo . ".txt";

        // **************************************************************************************
        // Genero archivo de cliente
        $nombre_archivo = APPLICATION_ROOT . $this->folderTxt . "/clientes_" . $postfijo . ".txt";
        $arch = fopen($nombre_archivo, "a+");
        if (!$arch) {
            if (file_exists($nombre_archivo)) {
                for ($i = 0; $i < 10; $i++) {
                    sleep(1);
                    $arch = fopen($nombre_archivo, "a");
                    if ($arch)
                        break;
                }
                $errors[] = "Imposible crear el archivo";
                return false;
            }
            else {
                $errors[] = "Imposible crear el archivo";
                return false;
            }
        }
        // 1 CLIENTE
        fputs($arch, (50000 + $compra['id_cliente']) . "|");
        // 2 NOMBRE
        //fputs($arch, strtoupper($usuario['nombre']) . "|");

        fputs($arch, $this->limpiar_cadena_iconv_mayus($usuario['nombre']) . "|");
        // 3 APELLIDO
        fputs($arch, $this->limpiar_cadena_iconv_mayus($usuario['apellido']) . "|");
        // 4 EMAIL
        fputs($arch, $this->limpiar_cadena_iconv_mayus($usuario['email']) . "|");
        // 5 FECHA_NAC
        fputs($arch, date("d/m/Y", strtotime($usuario['fecha_nacimiento'])) . "|");
        // 6 OCUPACION
        fputs($arch, $this->limpiar_cadena_iconv_mayus($usuario['ocupacion']) . "|");
        // 7 TELEFONO

        fputs($arch, $this->limpiar_cadena_iconv_mayus($usuario['telefono']) . "|");
        // 8 HIJOS3 (debe ser S o N, así que pongo siempre N)
        //fputs($arch, $usuario['hijos_menores_a_3_anios']."|");
        fputs($arch, "N" . "|");
        // 9 COMENTARIOS
        fputs($arch, "" . "|");
        // 10 DIRECCION
        fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['direccion']) . "|");

        // 11 CIUDAD
        fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['ciudad']) . "|");
        // 12 PROVINCIA
        fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['provincia']) . "|");
        // 13-CPOSTAL
        fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['codigo_postal']));

        /* Grabo datos de facturación.
         * Esto se pidió para un promoción navideña que nunca se implementó.
         * El TXT que va a Presea no puede tener estos datos. */

        /*
          fputs($arch, "|");
          fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['nombre_facturacion']) . "|");
          fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['direccion_facturacion']) . "|");
          fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['ciudad_facturacion']) . "|");
          fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['codigo_postal_facturacion']) . "|");

          fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['provincia_facturacion']));
         */
        /* FIN de datos de facturación. */

        fputs($arch, "\r\n");
        fclose($arch);
        // Datos del archivo del cliente para subir al FTP.
        $destination_file_archivo_cliente = "clientes_" . $postfijo . ".txt";
        // Grabo los nombres de los archivos TXT en el registro de la compra.
        $sql = "UPDATE compra ";
        $sql.= "SET archivo_txt_carrito = '" . $destination_file_archivo_carrito . "', ";
        $sql.= "archivo_txt_cliente = '" . $destination_file_archivo_cliente . "' ";
        $sql.= "WHERE id = '" . $compra['id'] . "' ";
        GlobalManager::getDb()->execute($sql);

        return true;
    }

    private function grabarEnTxt_mayorista($elements, $compra, $usuario, $costoEnvio, $codigoEnvio, &$errors, $bonificacion_pesos) {
        $fecha = getdate();
        $mes = ($fecha['mon'] >= 10) ? $fecha['mon'] : "0" . $fecha['mon'];
        $dia = ($fecha['mday'] >= 10) ? $fecha['mday'] : "0" . $fecha['mday'];
        $hrs = ($fecha['hours'] >= 10) ? $fecha['hours'] : "0" . $fecha['hours'];
        $mns = ($fecha['minutes'] >= 10) ? $fecha['minutes'] : "0" . $fecha['minutes'];
        $sgs = ($fecha['seconds'] >= 10) ? $fecha['seconds'] : "0" . $fecha['seconds'];
        $postfijo = ($fecha['year'] % 100) . $mes . $dia . "_" . $hrs . $mns . $sgs . "_" . $compra['id'];
        $nombre_archivo = APPLICATION_ROOT . $this->folderTxt . "/carrito_" . $postfijo . ".txt";

        $arch = fopen($nombre_archivo, "a+");
        if (!$arch) {
            if (file_exists($nombre_archivo)) {

                for ($i = 0; $i < 10; $i++) {
                    sleep(1);
                    $arch = fopen($nombre_archivo, "a");
                    if ($arch)
                        break;
                }
                $errors[] = "Imposible crear el archivo";
                return false;
            }
            else {
                $errors[] = "Imposible crear el archivo";
                return false;
            }
        }

        $falso = 0;
        foreach ($elements as $elemento) {
            // 1-NUMERO
            fputs($arch, $compra['id'] . "|");
            // 2-CODIGO
            // (no muestra el ID de la tabla Producto sino el código interno de Weleda [codigo])
            fputs($arch, $elemento['object']['codigo'] . "|");
            // 3-DETALLE
            fputs($arch, $this->limpiar_cadena_iconv_mayus(substr($elemento['object']['nombreweleda'], 0, 50)) . "|");
            // 4-PRECIO
            $precio = 0;
            // El precio se determina según el tipo de cliente.
            switch ($usuario['tipo_cliente']) {
                case "Web":
                    /* web (venta al público) */
                    $precio = $elemento['object']['precio'];
                    break;
                case "Minorista":
                    /* Minorista */
                    $precio = $elemento['object']['precio_minorista'];
                    break;
                case "Mayorista":
                    /* Mayorista */
                    $precio = $elemento['object']['precio_mayorista'];
                    break;
            }
            $strPrecio = sprintf("%012.2f", $precio);
            fputs($arch, trim($strPrecio) . "|");
            // 5-CANTIDAD
            fputs($arch, $elemento['count'] . "|");
            // 6-VENDEDOR (valor fijo = 80)
            fputs($arch, "80" . "|");
			// 7-CLIENTE
			// No pongo el ID de cliente sino el código (ya que los clientes mayoristas se importan en el backoffice).
			fputs($arch, $usuario['codigo'] . "|");
            // 8-FECHA
            fputs($arch, date("d/m/y") . "|");
            // 9-FECHA ENT (igual a fecha)
            fputs($arch, date("d/m/y") . "|");
            // 10-OBSERVACION
            if ($elemento['object']['id'] == 999) {
                fputs($arch, "(DE REGALO)" . "|");
            } elseif ($compra['para_regalo'] == 1) {
                fputs($arch, "(ENVUELTO PARA REGALO)" . "|");
            } else {
                fputs($arch, "" . "|");
            }

            // 11-REFERENCIA
            fputs($arch, "" . "|");
            // 12-REFERENCI1
            fputs($arch, "" . "|");
            // 13-MONEDA
            fputs($arch, "1" . "|");
            // 14-COTIZACION
            fputs($arch, "1" . "|");
            // 15-EMPRESA
            fputs($arch, "0");

            fputs($arch, "\r\n");
        }
        // Escribo los gastos de envío como si fuera un producto más.
        //  (En el mayorista no)
        //  
        //  En el carrito mayorista escribo la bonificación como un producto más (con valor negativo)
        //  NO. SE SUSPENDE, YA QUE PRESEA NO PUEDE RECIBIR VALORES NEGATIVOS.
        //  Es decir que Presea deberá aplicar el descuento a cada cliente.
        //  Para que esto sea posible, el descuento (bonoficación) asignado al cliente en el carrito
        //  debe conincidir con la bonificación cargada en Presea; si no, el cliente verá un precio
        //  final distinto.
        /*
          // 1-NUMERO
          fputs($arch, $compra['id'] . "|");
          // 2-CODIGO (Es el campo codigoweleda de la tabla tarifa_envio)
          fputs($arch, "0" . "|");
          // 3-DETALLE
          fputs($arch, "BONIFICACION" . "|");
          // 4-PRECIO (costo del envío)
          $strPrecio = sprintf("%012.2f", $bonificacion_pesos * -1);
          fputs($arch, trim($strPrecio) . "|");
          // 5-CANTIDAD
          fputs($arch, "1" . "|");
          // 6-VENDEDOR
          fputs($arch, "80" . "|");
          // 7-CLIENTE
          // No pongo el ID de cliente sino el código (ya que a los clientes mayoristas se les ingresa el código en el backoffice).
          fputs($arch, $usuario['codigo'] . "|");
          // 8-FECHA
          fputs($arch, date("d/m/y") . "|");
          // 9-FECHA ENT
          fputs($arch, date("d/m/y") . "|");
          // 10-OBSERVACIONES
          fputs($arch, "" . "|");
          // 11-REFERENCIA
          fputs($arch, "" . "|");
          // 12-REFERENCI1
          fputs($arch, "" . "|");
          // 13-MONEDA
          fputs($arch, "1" . "|");
          // 14-COTIZACION
          fputs($arch, "1" . "|");
          // 15-EMPRESA
          fputs($arch, "0");
          // FIN línea gastos de envío
          fputs($arch, "\r\n");
         */

        // Cierro el archivo.
        fclose($arch);
        // Datos del archivo del carrito para subir al FTP.
        $destination_file_archivo_carrito = "carrito_" . $postfijo . ".txt";

        // **************************************************************************************
        // Genero archivo de cliente
        $nombre_archivo = APPLICATION_ROOT . $this->folderTxt . "/clientes_" . $postfijo . ".txt";
        $arch = fopen($nombre_archivo, "a+");
        if (!$arch) {
            if (file_exists($nombre_archivo)) {
                for ($i = 0; $i < 10; $i++) {
                    sleep(1);
                    $arch = fopen($nombre_archivo, "a");
                    if ($arch)
                        break;
                }
                $errors[] = "Imposible crear el archivo";
                return false;
            }
            else {
                $errors[] = "Imposible crear el archivo";
                return false;
            }
        }
        // 1 CLIENTE
        // No pongo el ID de cliente sino el código (ya que los clientes mayoristas se importan en el backoffice).
        fputs($arch, $usuario['codigo'] . "|");
        // 2 NOMBRE
        fputs($arch, $this->limpiar_cadena_iconv_mayus($usuario['nombre']) . "|");
        // 3 APELLIDO
        fputs($arch, $this->limpiar_cadena_iconv_mayus($usuario['apellido']) . "|");
        // 4 EMAIL
        fputs($arch, $this->limpiar_cadena_iconv_mayus($usuario['email']) . "|");
        // 5 FECHA_NAC
        fputs($arch, date("d/m/y") . "|");
        // 6 OCUPACION
        fputs($arch, "-" . "|");
        // 7 TELEFONO
        fputs($arch, $this->limpiar_cadena_iconv_mayus($usuario['telefono']) . "|");
        // 8 HIJOS3 (debe ser S o N, así que pongo siempre N)
        //fputs($arch, $usuario['hijos_menores_a_3_anios']."|");
        fputs($arch, "N" . "|");
        // 9 COMENTARIOS
        fputs($arch, "" . "|");
        // 10 DIRECCION
        fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['direccion']) . "|");

        // 11 CIUDAD
        fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['ciudad']) . "|");
        // 12 PROVINCIA
        fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['provincia']) . "|");
        // 13-CPOSTAL
        fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['codigo_postal']));

        /* Grabo datos de facturación.
         * Esto se pidió para un promoción navideña que nunca se implementó.
         * El TXT que va a Presea no puede tener estos datos. */

        /*
          fputs($arch, "|");
          fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['nombre_facturacion']) . "|");
          fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['direccion_facturacion']) . "|");
          fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['ciudad_facturacion']) . "|");
          fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['codigo_postal_facturacion']) . "|");

          fputs($arch, $this->limpiar_cadena_iconv_mayus($compra['provincia_facturacion']));
         */
        /* FIN de datos de facturación. */

        fputs($arch, "\r\n");
        fclose($arch);
        // Datos del archivo del cliente para subir al FTP.
        $destination_file_archivo_cliente = "clientes_" . $postfijo . ".txt";
        // Grabo los nombres de los archivos TXT en el registro de la compra.
        $sql = "UPDATE compra ";
        $sql.= "SET archivo_txt_carrito = '" . $destination_file_archivo_carrito . "', ";
        $sql.= "archivo_txt_cliente = '" . $destination_file_archivo_cliente . "' ";
        $sql.= "WHERE id = '" . $compra['id'] . "' ";
        GlobalManager::getDb()->execute($sql);

        return true;
    }

    private function grabarEnXml($elements, $compra, &$errors) {
        return true;
    }

    function step3() {
        $limiteEnvioGratis = self::limiteEnvioGratis;
        $idNuevo = SessionManager::getValue("ultimaCompra");
        if (empty($idNuevo)) {
            header("Location: index.php?module=fr_carrito_list");
        }
        $em = new EntityManager("EntityCompra", null);
        $em->prepareFields();
        $compra = $em->find(true, "e_table.id='" . valueToDb($idNuevo) . "'");
        $compra = $compra[0];

        // Traigo los datos del cliente
        $emUsuario = new EntityManager("EntityCliente", null);
        $emUsuario->prepareFields();
        $usuario = $emUsuario->find(true, "e_table.id='" . $compra['id_cliente'] . "'");
        //$usuario = $usuario[0]; (lo comento porque da error -_-

        /* $em = new EntityManager("EntityTipoEnvio",null);
          $em->prepareFields();
          $tipoEnvio = $em->find(true,"e_table.id='".valueToDb($compra['id_tipo_envio'])."'");
          $tipoEnvio = $tipoEnvio[0];
         */

        $descuento_porcentaje = 0;
        $descuento_pesos = 0;

        $elements = SessionManager::getValue($this->sessionName);
        $costoTotal = 0;
        $pesoTotal = 0;
        $costoTotalSinEnvio = 0;
        foreach ($elements as $elemento) {
            // Aplico el descuento a cada artículo. Si no hay descuento, $descuento debe ser 1.
            // No lo aplico al costo total para que no afecte el costo de envío.
            // $elemento['object']['precio'] = $elemento['object']['precio'];
            //$costoTotal += $elemento['count'] * $elemento['object']['precio'];
            $costoTotalSinEnvio += $elemento['count'] * $elemento['object']['precio'];
            $pesoTotal += $elemento['count'] * $elemento['object']['peso'];
        }

        if (CONSTANTE_PAIS == 'Argentina') {
            // En Argentina busco el costo de envío por código postal.
            $detalles = $this->getTarifaDiasByCPPeso($compra['codigo_postal'], $pesoTotal);
        } else {
            // En Chile busco el costo de envío por ciudad (comuna) y peso.
            $detalles = $this->getTarifaDiasByCiudadPeso($compra['id_ciudad'], $pesoTotal);
        }

        if ($costoTotalSinEnvio >= $limiteEnvioGratis) {
            $costoEnvio = 0;
        } else {
            $costoEnvio = $detalles["Tarifa"];
        }
        $diasTotal = $detalles["Dias"];
        // Código del costo del envío (es el campo codigoweleda de la tabla tarifa_envio)
        $codigoEnvio = $detalles["CodigoEnvioWeleda"];

        // Calculo el descuento en pesos (porcentaje sobre el costo total sin envío)
        $descuento_pesos = $compra['descuento_pesos'];
        $descuento_porcentaje = $compra['descuento_porcentaje'];
        $nombre_promocion = $compra['nombre_promocion'];

        $costoTotalConDescuento = $costoTotalSinEnvio - $descuento_pesos + $costoEnvio;
        $costoTotal = $costoTotalSinEnvio + $costoEnvio;

        $sql = "UPDATE compra SET costo_total = '" . $costoTotalConDescuento . "', valida = '1' ";
        $sql.= ", pesototal = '" . $pesoTotal . "', costo_envio = '" . $costoEnvio . "', dias_envio = '" . $diasTotal . "' ";
        $sql.= "WHERE id = '" . valueToDb($idNuevo) . "' ";
        GlobalManager::getDb()->execute($sql);


        // Si se utilizó un código de promoción, le pongo "1" al campo codigo_usado, para que no se vuelva a usar.
        if ($compra['codigo_promocion'] != '') {
            $sql = "UPDATE promociones SET codigo_usado = 1 WHERE upper(codigo) = '" . trim(strtoupper($compra['codigo_promocion'])) . "' ";
            GlobalManager::getDb()->execute($sql);
			// Inserto en la tabla promocion_cliente los ID de la promoción y del cliente para que ese cliente no la vuelva
			// a usar (sirve para las promociones que tenga un_uso_por_cliente =1).
			// Primero debo borrarla ya que hay promociones que se pueden usar más de una vez (usos_multiples=1)
			// y daría error al insertar datos duplicados.
			$sql = "DELETE FROM promocion_cliente WHERE codigo_promocion = '" . trim(strtoupper($compra['codigo_promocion'])) . "' AND id_cliente = " . $compra['id_cliente'];
            GlobalManager::getDb()->execute($sql);
			$sql = "INSERT promocion_cliente(codigo_promocion, id_cliente) VALUES('" . trim(strtoupper($compra['codigo_promocion'])) . "', " . $compra['id_cliente'] . ")";
            GlobalManager::getDb()->execute($sql);
        }

        $errors = array();

        // El $porcentaje_precio_final es lo que quedará de los precios si hubiera un descuento.
        // Por ej., si $descuento_porcentaje es 10 (10%), $porcentaje_precio_final será 0.9
        // (queda el 90% del precio original).
        // Los precios de cada producto se multiplicarán por 0.9 al generar el botón de DineroMail.
        // Si el $descuento_porcentaje es 0, los precios se multiplicarán por uno
        // (queda el 100% del precio original).
        $porcentaje_precio_final = 1 - $descuento_porcentaje / 100;

        // Datos del comprador (no del envío)
        $usuario = GlobalManager::getLogin()->getUser();

        if ($this->grabarEnBase($elements, $compra, $errors)
        )
            ;
        if ($this->grabarEnTxt($elements, $compra, $usuario, $costoEnvio, $codigoEnvio, $errors, $porcentaje_precio_final))
            $this->grabarEnXml($elements, $compra, $errors);

        if (!empty($errors)) {
            $sql = "UPDATE compra SET valida = '0' WHERE id = '" . valueToDb($idNuevo) . "' ";
            GlobalManager::getDb()->execute($sql);
        }

        GlobalManager::getTplMng()->setTemplate($this->template);
        GlobalManager::getTplMng()->setValue("errores", $errors);
        GlobalManager::getTplMng()->setValue("compra", $compra);
        //GlobalManager::getTplMng()->setValue("tipoEnvio",$tipoEnvio);
        GlobalManager::getTplMng()->setValue("costoEnvio", $costoEnvio);
        GlobalManager::getTplMng()->setValue("codigoEnvio", $codigoEnvio);
        GlobalManager::getTplMng()->setValue("pesoTotal", $pesoTotal);
        GlobalManager::getTplMng()->setValue("diasTotal", $diasTotal);
        GlobalManager::getTplMng()->setValue("elementos", $elements);
        GlobalManager::getTplMng()->setValue("costoTotal", $costoTotal);
        GlobalManager::getTplMng()->setValue("descuento_pesos", $descuento_pesos);
        GlobalManager::getTplMng()->setValue("porcentaje_precio_final", $porcentaje_precio_final);
        GlobalManager::getTplMng()->setValue("costoTotalConDescuento", $costoTotalConDescuento);
        GlobalManager::getTplMng()->setValue("usuario", $usuario);
        GlobalManager::getTplMng()->setValue("nombre_promocion", $nombre_promocion);
        GlobalManager::getTplMng()->drawTemplate();

        // Vacío la lista de elementos comprados.
        // ESTO SE QUITA. Porque si se recarga la página en el paso 3, aparece la lista de productos vacía
        // y al apretar PAGAR va a DineroMail sin productos.
        // Esto hará que luego de pagar el carrito siga teniendo los productos.
        //$elements = array();
        //SessionManager::setValue($this->sessionName, $elements);

        //SessionManager::setValue("ultimaCompra",null);
        //SessionManager::setValue($this->sessionName,$elements);
    }

    function limpiar_cadena_mayus($toClean) {
        /* Remueve los caracteres especiales del string que se le pase para que
         * no contenga ningún carácter que no sean letras. Es porque Presea no acepta
         * caracteres raros. O sea, una eñe es raro para Presea. O_O
         * El string que devuelve solo contiene letras mayúsculas.
         */
        $STRS = array(
            'Š' => 'S', 'š' => 's', 'Ð' => 'Dj', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
            'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
            'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U',
            'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
            'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
            'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u',
            'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f', '¿' => '?', '¡' => '!', '&quot;' => ' '
        );
        // Realizo el reemplazo de caracteres.
        $toClean = strtr($toClean, $STRS);
        return strtoupper($toClean);
    }

    // Utilizo la función ICONV para quitar acentos (Presea no funciona con acentos, eñes, etc.).
    function limpiar_cadena_iconv_mayus($toClean) {
        // Convierto la cadena de entrada a UTF8 (si no, da error).
        $toClean = utf8_encode($toClean);
        // Es necesario definir setlocale.
        setlocale(LC_CTYPE, 'es_AR.UTF-8');
        // Devuelvo la cadena convertida de UTF8 a ASCII, pasada a mayúsculas.
        return strtoupper(iconv('UTF-8', 'ASCII//TRANSLIT', $toClean));
    }

    /*  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°° */
    /*  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°° */
    /*                   CARRITO MAYORISTA                  */
    /*  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°° */
    /*  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°° */

    function step_1_mayorista() {
        /* En el carrito mayorista no se le piden los datos al comprador, así que el paso 1
         * equivale a los pasos 1 y 2 del carrito para el público. */
        $errors = array();
        $elements = SessionManager::getValue($this->sessionName);
        if (empty($elements))
            header("location: index.php?module=fr_eshop_productos");

        if (isset($_POST['submit'])) {
            // header("Location: index.php?module=" . $this->finalModule);
        } else {

            $login = GlobalManager::getLogin();
            $_POST["cliente"] = $login->getUserId();
            $_POST["costo_total"] = 0;

            // Traigo los datos del cliente
            $emCliente = new EntityManager("EntityClienteMayorista", array());
            $emCliente->prepareFields();
            $cliente = $emCliente->find(true, "e_table.id='" . valueToDb($login->getUserId()) . "'");
            $cliente = $cliente[0];

            $emCompra = new EntityManager("EntityCompra", array());
            $emCompra->prepareFields();
            $emCompra->fillFieldsWithPost();

            /* Validate */
            foreach ($emCompra->fields as $key => $field) {
                $emCompra->fields[$key]->validateFromPost($errors);
            }

            $idNuevo = SessionManager::getValue("ultimaCompra");

            if (empty($errors)) {
                if (!empty($idNuevo) /* isset($idNuevo) */) {
                    // Si ultimaCompra tiene valor, la compra ya esta grabada.
                    // No genero un nuevo ID.
                    // Actualizo el registro en la tabla Compra.
                    $emCompra->saveFromPost($errors, $idNuevo);
                } else {
                    // Es una compra nueva. Grabo un nuevo registro.
                    $idNuevo = $emCompra->saveFromPost($errors);
                    SessionManager::setValue("ultimaCompra", $idNuevo);
                }
            }

            // $elements = SessionManager::getValue($this->sessionName);
            $costoTotal = 0;
            $pesoTotal = 0;
            $costoTotalSinEnvio = 0;
            $descuento_pesos = 0;

            $descuento_porcentaje = 0;
            /* BUSCO EL DESCUENTO DEL CLIENTE (campo BONIFICACION tabla CLIENTE */
            /*
              $sql = "SELECT bonificacion FROM cliente WHERE id = " . $login->getUserId() . ";";
              $res = $this->_db->execute($sql);
              $cliente = $this->_db->getRow($res);
             */

            // Defino el descuento de cada cliente (campo BONIFICACION de la tabla CLIENTE
            // Si se encontró un descuento con un valor entre 0 y 100 (no inclusive), se aplicará ese descuento.
            if ($cliente['bonificacion'] > 0 and $cliente['bonificacion'] < 100) {
                $descuento_porcentaje = $cliente['bonificacion'];
            }

            foreach ($elements as $elemento) {
                //$costoTotal += $elemento['count'] * $elemento['object']['precio'];
                $precio = 0;
                // El precio se determina según el tipo de cliente.
                switch ($cliente['tipo_cliente']) {
                    case "Web":
                        /* web (venta al público) */
                        $precio = $elemento['object']['precio'];
                        break;
                    case "Minorista":
                        /* Minorista */
                        $precio = $elemento['object']['precio_minorista'];
                        break;
                    case "Mayorista":
                        /* Mayorista */
                        $precio = $elemento['object']['precio_mayorista'];
                        break;
                }
                $costoTotalSinEnvio += $elemento['count'] * $precio;
                $pesoTotal += $elemento['count'] * $elemento['object']['peso'];
            }

            // Calculo el descuento en pesos (porcentaje sobre el costo total sin envío)
            // Lo redondeo a dos decimales.
            $descuento_pesos = round($costoTotalSinEnvio * $descuento_porcentaje / 100, 2);
            // Calculo el costo total con descuento (redondeado a dos decimales).
            $costoTotalConDescuento = round($costoTotalSinEnvio - $descuento_pesos, 2);
            $costoTotal = $costoTotalSinEnvio;

            // Si se definió un recargo (percepción ingresos brutos), se calcula (sobre el precio con descuento).
            $recargo_pesos = 0;
            if ($cliente['percepcion_ingresos_brutos'] > 0) {
                $recargo_pesos = $costoTotalConDescuento * $cliente['percepcion_ingresos_brutos'] / 100;
                $costoTotalConDescuento += $recargo_pesos;
            }

            // Si hay descuento, lo grabo en el registro en la tabla Compra.
            if ($descuento_pesos > 0) {
                $sql = "UPDATE compra ";
                $sql.= "SET descuento_pesos = '" . $descuento_pesos . "' , ";
                $sql.= "descuento_porcentaje = '" . $descuento_porcentaje . "' , ";
                $sql.= "nombre_promocion = '" . utf8_decode("Bonificación cliente (") . $descuento_porcentaje . "%)' ";
                $sql.= "WHERE id = '" . valueToDb($idNuevo) . "' ";
                GlobalManager::getDb()->execute($sql);
            }

            // Traigo los datos de la compra.
            $sql = "SELECT * FROM compra WHERE id = " . $idNuevo . ";";
            $res = GlobalManager::getDb()->execute($sql);
            $compra = $this->_db->getRow($res);

            GlobalManager::getTplMng()->setTemplate($this->template);
            GlobalManager::getTplMng()->setValue("compra", $compra);
            GlobalManager::getTplMng()->setValue("elementos", $elements);
            GlobalManager::getTplMng()->setValue("costoTotal", $costoTotal);
            GlobalManager::getTplMng()->setValue("costoTotalConDescuento", $costoTotalConDescuento);
            GlobalManager::getTplMng()->setValue("costoEnvio", 0);
            GlobalManager::getTplMng()->setValue("pesoTotal", $pesoTotal);
            GlobalManager::getTplMng()->setValue("diasTotal", 0);
            GlobalManager::getTplMng()->setValue('cliente', $cliente);
            GlobalManager::getTplMng()->setValue('descuento_pesos', $descuento_pesos);
            GlobalManager::getTplMng()->setValue('recargo_pesos', $recargo_pesos);
            //GlobalManager::getTplMng()->setValue('promocion', "");

            GlobalManager::getTplMng()->drawTemplate();
        }
    }

    /* Step 2 Mayorista. Equivale al step 3 del carrito para el público. */

    function step_2_mayorista() {
        $idNuevo = SessionManager::getValue("ultimaCompra");
        if (empty($idNuevo)) {
            header("location: index.php?module=fr_eshop_productos");
            // Pongo Exit para que no se siga ejecutando, porque si no, genera los TXT.
            exit();
        }
        // Traigo el registro de la compra.
        $sql = "SELECT id, id_cliente, nombre, direccion, ciudad, ";
        $sql .= "provincia, codpostal as codigo_postal, para_regalo, ";
        $sql .= "descuento_pesos, descuento_porcentaje, nombre_promocion ";
        $sql .= "FROM compra WHERE id = " . $idNuevo . ";";
        $res = GlobalManager::getDb()->execute($sql);
        $compra = $this->_db->getRow($res);

        // Traigo los datos del cliente (ClienteMayorista)
        $emUsuario = new EntityManager("EntityClienteMayorista", null);
        $emUsuario->prepareFields();
        $cliente = $emUsuario->find(true, "e_table.id='" . $compra['id_cliente'] . "'");
        $cliente = $cliente[0];

        $descuento_porcentaje = 0;
        $descuento_pesos = 0;
        $diasTotal = 0;
        $costoEnvio = 0;

        $elements = SessionManager::getValue($this->sessionName);
        $costoTotal = 0;
        $pesoTotal = 0;
        $costoTotalSinEnvio = 0;
        foreach ($elements as $elemento) {
            //$costoTotalSinEnvio += $elemento['count'] * $elemento['object']['precio'];
            $precio = 0;
            // El precio se determina según el tipo de cliente.
            switch ($cliente['tipo_cliente']) {
                case "Web":
                    /* web (venta al público) */
                    $precio = $elemento['object']['precio'];
                    break;
                case "Minorista":
                    /* Minorista */
                    $precio = $elemento['object']['precio_minorista'];
                    break;
                case "Mayorista":
                    /* Mayorista */
                    $precio = $elemento['object']['precio_mayorista'];
                    break;
            }
            $costoTotalSinEnvio += $elemento['count'] * $precio;
            $pesoTotal += $elemento['count'] * $elemento['object']['peso'];
        }

        // Código del costo del envío (es el campo codigoweleda de la tabla tarifa_envio)
        // (En el carrito mayorista no pongo costos de envío)
        $codigoEnvio = "0";

        // Calculo el descuento en pesos (porcentaje sobre el costo total sin envío)
        $descuento_pesos = $compra['descuento_pesos'];
        $descuento_porcentaje = $compra['descuento_porcentaje'];
        $nombre_promocion = $compra['nombre_promocion'];

        $costoTotalConDescuento = $costoTotalSinEnvio - $descuento_pesos + $costoEnvio;
        $costoTotal = $costoTotalSinEnvio + $costoEnvio;

        // Si se definió un recargo (percepción ingresos brutos), se calcula (sobre el precio con descuento).
        $recargo_pesos = 0;
        if ($cliente['percepcion_ingresos_brutos'] > 0) {
            $recargo_pesos = $costoTotalConDescuento * $cliente['percepcion_ingresos_brutos'] / 100;
            $costoTotalConDescuento += $recargo_pesos;
        }


        $sql = "UPDATE compra SET costo_total = '" . $costoTotalConDescuento . "', valida = '1' ";
        $sql.= ", pesototal = '" . $pesoTotal . "', costo_envio = '" . $costoEnvio . "', dias_envio = '" . $diasTotal . "' ";
        $sql.= "WHERE id = '" . valueToDb($idNuevo) . "' ";
        GlobalManager::getDb()->execute($sql);

        $errors = array();

        if ($this->grabarEnBaseCompraMayorista($elements, $compra, $errors, $cliente)
        )
            ;

        if ($this->grabarEnTxt_mayorista($elements, $compra, $cliente, $costoEnvio, $codigoEnvio, $errors, $descuento_pesos)
        )
            ;

        if (!empty($errors)) {
            $sql = "UPDATE compra SET valida = '0' WHERE id = '" . valueToDb($idNuevo) . "' ";
            GlobalManager::getDb()->execute($sql);
        }


        GlobalManager::getTplMng()->setTemplate($this->template);
        GlobalManager::getTplMng()->setValue("errores", $errors);
        GlobalManager::getTplMng()->setValue("compra", $compra);
        //GlobalManager::getTplMng()->setValue("tipoEnvio",$tipoEnvio);
        GlobalManager::getTplMng()->setValue("costoEnvio", $costoEnvio);
        //GlobalManager::getTplMng()->setValue("codigoEnvio", $codigoEnvio);
        GlobalManager::getTplMng()->setValue("pesoTotal", $pesoTotal);
        //GlobalManager::getTplMng()->setValue("diasTotal", $diasTotal);
        GlobalManager::getTplMng()->setValue("elementos", $elements);
        GlobalManager::getTplMng()->setValue("costoTotal", $costoTotal);
        GlobalManager::getTplMng()->setValue("descuento_pesos", $descuento_pesos);
        // GlobalManager::getTplMng()->setValue("porcentaje_precio_final", $porcentaje_precio_final);
        GlobalManager::getTplMng()->setValue("costoTotalConDescuento", $costoTotalConDescuento);
        GlobalManager::getTplMng()->setValue("cliente", $cliente);
        //GlobalManager::getTplMng()->setValue("nombre_promocion", $nombre_promocion);
        GlobalManager::getTplMng()->setValue('recargo_pesos', $recargo_pesos);
        GlobalManager::getTplMng()->drawTemplate();

        // Vacío la lista de elementos comprados.
        $elements = array();
        SessionManager::setValue($this->sessionName, $elements);
        // Vacío el ID de la última compra.
        SessionManager::setValue("ultimaCompra", "");
    }

}

?>