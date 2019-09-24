<?

include_once(GALIX_FOLDER."class.Field.php");



class FieldFile extends Field {

	var $name;

	var $visualName;

	var $cardinality;

	var $tableReference;

	var $columnReference;

	var $tableName;

	var $storeFolder;

	var $fileFormats;

	var $maxSize;

	var $valuesFiles = array();

	var $errorPosting = array();

	var $deleteFiles;

	

	function FieldFile($name,$params) {

		$this->name = $name;

		$this->visualName = $params['visualName'];

		$this->cardinality = $params['cardinality'];

		$this->tableReference = $params['tableReference'];

		$this->columnReference = $params['columnReference'];

		$this->tableName = $params['tableName'];

		$this->storeFolder = $params['storeFolder'];

		$this->fileFormats = explode(",",$params['fileFormat']);

		$this->maxSize = $params['maxSize'];

		if($this->cardinality == "1") {

			$this->valuesFiles['file_filename'] = "";

			$this->valuesFiles['file_full_filename'] = "";

			$this->valuesFiles['file_folder'] = $this->storeFolder;

			$this->valuesFiles['id'] = 0;

		}

	}

	

	function showFormFieldNew($params) {

		?>

		<input type="hidden" id="deleteFileIds_<?=$this->name?>" name="deleteFileIds_<?=$this->name?>" value="<?=$this->deleteFiles?>" />

		<div class="linea_1 clearfix">

			<input type="button" value="Agregar archivo" onclick="addFile_<?=$this->name?>()" />

		</div>

		<div>

		<div class="linea_1 clearfix" id="idAddFile_<?=$this->name?>">

    		<div class="bloque_2">

    			<input type="file" id="newFile_<?=$this->name?>" name="newFile_<?=$this->name?>[0]" />

    		</div>

    	</div>

    	</div>

		<?

	}

	

	function showFormField($params,$valueNumber=0) {

		if($this->cardinality == "1") { ?>

			<input type="file" id="File_<?=$this->name?>" name="File_<?=$this->name?>" /><?

		  ?><input type="hidden" name="FileValue_<?=$this->name?>" value="<?=$this->valuesFiles['file_filename']?>" />			

		<? }		

		else {

		?><input type="file" id="File_<?=$this->name?>_<?=$valueNumber?>" name="File_<?=$this->name?>[<?=$this->valuesFiles[$valueNumber]['id']?>]" /><?

		?><input type="hidden" name="FileValue_<?=$this->name?>[<?=$this->valuesFiles[$valueNumber]['id']?>]" value="<?=$this->valuesFiles[$valueNumber]['file_filename']?>" /><?

		?><a href="javascript:delFile_<?=$this->name?>(<?=$valueNumber?>)">Borrar</a><?

		}		

	}

	

	function validateFromPost(&$errors) {

		return true;

	}

	

	function processFileUpload($key,$tmpFileName,$dstFileName) {

		// TODO: Validar formatos y maxSize

		$finalFileName = findFileName(APPLICATION_ROOT.$this->storeFolder,$dstFileName);



		if(!move_uploaded_file($tmpFileName,APPLICATION_ROOT."/".$this->storeFolder."/".$finalFileName)) {

				$this->errorPosting[] = "Error con el archivo ".$this->name.": ".$image->error;

				return false;

		}		

		if($this->cardinality == "1") {

			$this->valuesFiles['file_filename'] = $finalFileName;

			$this->valuesFiles['file_full_filename'] = $this->storeFolder."/".$finalFileName;

		}

		else {

			$this->valuesFiles[$key]['file_filename'] = $finalFileName;

			$this->valuesFiles[$key]['file_full_filename'] = $this->storeFolder."/".$finalFileName;

		}

		

		return true;

	}

	

	function fillWithPost() {

		if($this->cardinality == "1") {

			if(!empty($_FILES["File_".$this->name])) {

				$this->valuesFiles = array(	"id" => "",

												"file_filename" => $_POST['FileValue_'.$this->name],

												"file_folder" => $this->storeFolder,

												"file_full_filename" => $this->storeFolder."/".$_POST['FileValue_'.$this->name]);

				if($_FILES["File_".$this->name]['error']==0) {

					$this->processFileUpload(0,

											$_FILES['File_'.$this->name]['tmp_name'],

											$_FILES['File_'.$this->name]['name']);

				}

				else {

					if($_FILES["File_".$this->name]['error']!=4) $this->errorPosting[] = "Error subiendo el archivo ".$this->name;

				}							

			}

		}

		else {

			$this->deleteFiles = $_POST['deleteFileIds_'.$this->name];

			$minor = -1;

			// Files for Update

			if(!empty($_FILES["File_".$this->name]))

				foreach($_FILES["File_".$this->name]['error'] as $key=>$value) {

					if($key <= $minor) $minor = $key;

					$this->valuesFiles[$key] = array(	"id" => $key,

														"file_filename" => $_POST['FileValue_'.$this->name][$key],

														"file_folder" => $this->storeFolder,

														"file_full_filename" => $this->storeFolder."/".$_POST['FileValue_'.$this->name][$key]);

					if($value==0) {

						$this->processFileUpload($key,

												  $_FILES['File_'.$this->name]['tmp_name'][$key],

												  $_FILES['File_'.$this->name]['name'][$key]);

					}

					else if($value!=4) $this->errorPosting[] = "Error subiendo el archivo ".$this->name;

				}

			// File for Add

			$added = $minor-1;

			foreach($_FILES['newFile_'.$this->name]['error'] as $key=>$value) {

				if($value == 0) {

					$this->valuesFiles[$added] = array("id" => $added,

														"file_folder" => $this->storeFolder);

					// Upload File

					$this->processFileUpload(  $added,

												$_FILES['newFile_'.$this->name]['tmp_name'][$key],

												$_FILES['newFile_'.$this->name]['name'][$key]);

					$added--;

				}

				else if($value!=4) $this->errorPosting = "Error subiendo el archivo ".$this->name;

			}

		}

	}

	

	function hasDirectSave() {

		return false;

		/*if($this->cardinality == "1") {

			return true;

		}

		else {

			return false;	

		}*/

	}	



	function doIndirectSaveFromPost($entityId,&$errors) {

		// TODO: si la cardinalidad es 1, tiene grabado directo

		if($this->cardinality == "1") {

			$sql = "UPDATE ".$this->tableReference." SET ".$this->tableName."='".addslashes($this->valuesFiles['file_filename'])."' ";

			$sql.= " WHERE id = '".$entityId."'";

			$res = GlobalManager::getDb()->execute($sql);

			if(!$res) {

				$errors[] = "Error grabando archivo en la base";

			}

		}

		else {

			// Delete Files

			$borradas = str_replace(",,","--",$this->deleteFiles);

			$borradas = str_replace(",","",$borradas);

			$borradas = str_replace("--",",",$borradas);

			

			// Delete old files

			$sql = "SELECT * FROM ".$this->tableReference." WHERE id IN (".$borradas.") AND ".$this->columnReference."=".$entityId;

			$res = GlobalManager::getDb()->execute($sql);

			if($res) {

				while($reg = GlobalManager::getDb()->getRow($res)) {

					unlink(APPLICATION_ROOT.$this->storeFolder."/".$reg[$this->tableName]);

				}

			}

			$sql = "DELETE FROM ".$this->tableReference." WHERE id IN (".$borradas.") AND ".$this->columnReference."=".$entityId;

			GlobalManager::getDb()->execute($sql);

			

			// Delete new files

			$borradas = explode(",",$borradas);

			foreach($borradas as $borrada) if($borrada < 0) {

				unlink(APPLICATION_ROOT.$this->storeFolder."/".$this->valuesFiles[$borrada]['file_filename']);

			} 				

			

			

			// Add and Update

			foreach($this->valuesFiles as $key=>$value) {

				if($key > 0) { // Update

					// TODO: Borrar archivos viejas si cambia el archivo

					$sql = "UPDATE ".$this->tableReference." SET ";

					$sql.= $this->tableName." = '".$value['file_filename']."' ";

					$sql.= "WHERE id = '$key' AND ".$this->columnReference." = $entityId";

				}

				else { // Insert

					if(in_array($key,$borradas)) $sql = "SELECT 1 FROM ".$this->tableReference;

					else {

						$sql = "INSERT INTO ".$this->tableReference."(".$this->columnReference.",".$this->tableName.") ";

						$sql.= " VALUES('".$entityId."','".$value['file_filename']."')";

					}

				}

				$res = GlobalManager::getDb()->execute($sql);

				if(!$res) {

					$errors[] = "Error grabando archivo en la base";

				}

			}

		}

	}	

	

	function getValueForDbFromPost(&$isNull=false) {

		/*if($this->cardinality == "1") {

			return valueToDb($this->valuesImages['image_file']);

		}

		else {

			return "";

		}*/

		return "";

		//return valueToDb($this->value);

	}



	function fillWithDb($reg) {

		if($this->cardinality == "1") {

			$sql = "SELECT * FROM ".$this->tableReference." WHERE id = '".$reg['id']."'";

			$res = GlobalManager::getDb()->execute($sql);

			if(!$res) return false;

			$reg = GlobalManager::getDb()->getRow($res);

			$this->valuesFiles = array(

									"id"=>"",

									"file_filename"=>$reg[$this->tableName],

									"file_folder"=>$this->storeFolder,

									"file_full_filename"=>$this->storeFolder."/".$reg[$this->tableName]);

		}

		else {

			$sql = "SELECT * FROM ".$this->tableReference." WHERE ".$this->columnReference." = '".$reg['id']."' ORDER BY id ASC";

			$res = GlobalManager::getDb()->execute($sql);

			if(!$res) return false;

			 

			while($reg = GlobalManager::getDb()->getRow($res)) {

				$this->valuesFiles[$reg['id']] = array(	"id"=>$reg['id'],

															"file_filename"=>$reg[$this->tableName],

															"file_folder"=>$this->storeFolder,

															"file_full_filename"=>$this->storeFolder."/".$reg[$this->tableName]);

			}

		}

		return true;

	}



	function getJoinSql($entityTableName,$uniqueExtraAlias) {

		return "";

	}

	

	function getFieldSqlDescription($entityTableName,$uniqueExtraAlias) {

		if($this->cardinality == "1") {

			$sql = $this->tableName;

		}

		else {

			$sql = "'MULTIPLE ELEMENT' AS ".$this->name;

		}

		return $sql;

	}

	// DEPRECADO, NO USAR. EL ORDEN SE PASA DIRECTAMENTE EL NOMBRE DE LA COLUMNA A ORDENAR, SIN IMPORTAR EL ATRIBUTO DEL QUE SE TRATE
	/*
	
	function getFieldSqlOrder($entityTableName,$uniqueExtraAlias,$fieldOrder="") {
		if($this->cardinality == "1") {
			return $this->tableName;
		}
		else {
			// TODO: Implementar pensando la logica
			die("Funcion no implementada: Ordenado de FieldFile");	
		}
	}
	*/
	

	function createJavascript() {

		if($this->cardinality == "1") {

		}

		else {

			?>

			var files_<?=$this->name?>=1; 

			function addFile_<?=$this->name?>() {

				var idLevel1 = document.getElementById('idAddFile_<?=$this->name?>');

				var inputFiOb = document.getElementById('newFile_<?=$this->name?>');

				var newFiOb = inputFiOb.cloneNode(true);

				newFiOb.name = 'newFile_<?=$this->name?>['+files_<?=$this->name?>+']';

				newFiOb.id = '';

				files_<?=$this->name?>++;

				var newDiv1 = document.createElement('div');

				newDiv1.className = idLevel1.className;

				var newDiv2_1 = document.createElement('div'); 

				newDiv2_1.appendChild(newFiOb);

				newDiv2_1.className = inputFiOb.parentNode.className;

				newDiv1.appendChild(newDiv2_1); 

				idLevel1.parentNode.appendChild(newDiv1); 

				return true; 

				

			};

			

			function delFile_<?=$this->name?>(valueNumber) {

				var deleteInput = document.getElementById('deleteFileIds_<?=$this->name?>');

				if(!deleteInput) {

					return false;

				}

				var fileOb = document.getElementById('imgFile_<?=$this->name?>_'+valueNumber);

				var str = ","+valueNumber+",";

				

				var whereIs = deleteInput.value.indexOf(str,0); 

				if( whereIs == -1 ) {

					// Delete

					deleteInput.value += str;				

					if(fileOb) { // FX for delete

					}

				}

				else {

					// Restore

					var newValue = deleteInput.value.substr(0,whereIs) + deleteInput.value.substr(whereIs+str.length,deleteInput.value.length);

					deleteInput.value = newValue;

					if(fileOb) { // FX for restore

					}

				}

				

			}

		<?

		}

	}

	

	function delete($entityId,&$errors) {

		$reg['id'] = $entityId;

		if(!$this->fillWithDb($reg)) {

			$errors[] = "Error borrando los archivos";

			return false;

		}

		

		if($this->cardinality == "1") {

			$nombre_arch = APPLICATION_ROOT.$this->valuesFiles['file_full_filenames'];

			if((strlen(trim($this->valuesFiles['file_filename']))>0) && (!unlink($nombre_arch))) {

				$errors[] = "Error eliminando el archivo ".$this->valuesFiles['file_filename'];

			}

		}

		else {

			

			// Borrado de la db

			$sql = "DELETE FROM ".$this->tableReference." WHERE ".$this->columnReference." = ".$reg['id'];

			$res = GlobalManager::getDb()->execute($sql);

			if(!$res) {

				$errors[] = "Error borrando de la base";

				return false;

			}

			

			// Borrado fisico

			foreach($this->valuesFiles as $key=>$value) {

				$nombre_arch = APPLICATION_ROOT.$value['file_full_filename'];

				if(!unlink($nombre_arch)) {

					$errors[] = "Error eliminando el archivo ".$value['file_filename'];

				}

			}

		}

		return true;

	}

	

	function getValue() {

		return $this->valuesFiles;

	}

	

}



?>