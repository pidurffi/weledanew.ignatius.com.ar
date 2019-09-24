<?php

include_once(GALIX_FOLDER."class.Field.php");
include_once(GALIX_FOLDER."class.Image.php");

class FieldImageEpigraph extends Field {
	var $name;
	var $visualName;

	var $required;
	var $cardinality;
	var $tableReference;
	var $columnReference;
	var $imageTableName;
	var $epigraphTableName;
	var $imageStoreFolder;
	var $epigraphLength;
	var $imageFormats;
	var $imageX;
	var $imageY;
	var $resizeBehavior = RESIZE_BEHAVIOR_EXACT;

	var $thumbnail;

	var $thumbnailX;

	var $thumbnailY;

	var $thumbnailStoreFolder;

	var $thumbnailBehavior;	
	var $valuesImages = array();
	var $errorPosting = array();
	var $deleteImages;
	
	function FieldImageEpigraph($name,$params) {
		$this->name = $name;
		$this->visualName = $params['visualName'];

		$this->required = $params['required'];
		$this->cardinality = $params['cardinality'];
		$this->tableReference = $params['tableReference'];
		$this->columnReference = $params['columnReference'];
		$this->imageTableName = $params['imageTableName'];
		$this->epigraphTableName = $params['epigraphTableName'];
		$this->imageStoreFolder = $params['imageStoreFolder'];
		$this->epigraphLength = $params['epigraphLength'];
		$this->imageFormats = explode(",",$params['imageFormat']);
		$this->imageX = $params['imageX'];
		$this->imageY = $params['imageY'];
		$this->resizeBehavior = $params['resizeBehavior'];

		if(!empty($params['thumbnail'])) {

			$this->thumbnail = $params['thumbnail'];

			$this->thumbnailX = $params['thumbnailX'];

			$this->thumbnailY = $params['thumbnailY'];

			$this->thumbnailBehavior = $params['thumbnailBehavior'];

			$this->thumbnailStoreFolder  = $params['thumbnailStoreFolder'];

		}
		if($this->cardinality == "1") {
			$this->valuesImages['image_file'] = "";
			$this->valuesImages['epigraph'] = "";

			$this->valuesImages['image_full_file'] = "";

			$this->valuesImages['image_folder'] = $this->imageStoreFolder;

			$this->valuesImages['id'] = 0;

			if($this->thumbnail) {

				$this->valuesImages['image_thumbnail_full_file'] = "";

			}
		}
	}
	
	function getValuesImages() {
		return ;
	}
	
	function showFormFieldNew($params) {
		?>
		<input type="hidden" id="deleteEpigraphImageIds_<?=$this->name?>" name="deleteEpigraphImageIds_<?=$this->name?>" value="<?=$this->deleteImages?>" />

		<div>

		<div class="linea_1 clearfix">

			<input type="button" value="Agregar imagen" onclick="addEpigraphImage_<?=$this->name?>()" />

		</div>

		<div class="linea_1 clearfix" id="idAddImageEpigraph_<?=$this->name?>">

    		<div class="bloque_2">

    			<label>Archivo</label>

    			<input type="file" id="newEpigraphImageImage_<?=$this->name?>" name="newEpigraphImageImage_<?=$this->name?>[0]" />

    		</div>

    		<div class="bloque_2">

    			<label>Ep&iacute;grafe</label>

				<input type="text" maxlength="<?=$this->epigraphLength?>" id="newEpigraphImageEpigraph_<?=$this->name?>" name="newEpigraphImageEpigraph_<?=$this->name?>[0]" />    			

    		</div>

    	</div>

    	</div>

    	<? /*

    	<!-- 	

		<table border="0" cellspacing="0" cellpadding="1">
			<tbody id="tableAddImageEpigraph_<?=$this->name?>">
				<tr>
					<td><input type="button" value="Agregar imagen" onclick="addEpigraphImage_<?=$this->name?>()" /></td>
				</tr>
				<tr>
					<td><input type="file" id="newEpigraphImageImage_<?=$this->name?>" name="newEpigraphImageImage_<?=$this->name?>[0]" /></td>
					<td><input type="text" maxlength="<?=$this->epigraphLength?>" id="newEpigraphImageEpigraph_<?=$this->name?>" name="newEpigraphImageEpigraph_<?=$this->name?>[0]" /></td>
				</tr>
			</tbody>
		</table> -->

		*/ ?>
		<?
	}
	

	function getImageDeleteLink($valueNumber=0) {

		if($this->cardinality == "1") {

		}

		else {

			return "javascript:delEpigraphImage_".$this->name."(".$valueNumber.")";

		}

	}

	
	function showFormFieldImage($params,$valueNumber=0) {
		if($this->cardinality == "1") { ?>
			<input type="file" id="EpigraphImageImage_<?=$this->name?>" name="EpigraphImageImage_<?=$this->name?>" /><?
		  ?><input type="hidden" name="EpigraphImageImageValue_<?=$this->name?>" value="<?=$this->valuesImages['image_file']?>" />			
		<? }		
		else {
		?><input type="file" id="EpigraphImageImage_<?=$this->name?>_<?=$valueNumber?>" name="EpigraphImageImage_<?=$this->name?>[<?=$this->valuesImages[$valueNumber]['id']?>]" /><?
		?><input type="hidden" name="EpigraphImageImageValue_<?=$this->name?>[<?=$this->valuesImages[$valueNumber]['id']?>]" value="<?=$this->valuesImages[$valueNumber]['image_file']?>" /><?
		}		
	}
	
	function getImageId($valueNumber=0) {
		return "imgEpigraphImageImage_".$this->name."_".$valueNumber;
	}
	
	function getStyleImage($valueNumber) {
		if(!(strstr($this->deleteImages,",".$valueNumber.",")===false)) {
			return "opacity:.5;filter:alpha(opacity=50)";
		}
		return "";
	}
	
	function showFormFieldEpigraph($params,$valueNumber=0) {
		if($this->cardinality == "1") { ?>
		<input type="text" maxlength="<?=$this->epigraphLength?>"
					id="EpigraphImageEpigraph_<?=$this->name?>" 
					name="EpigraphImageEpigraph_<?=$this->name?>" 
					value="<?=$this->valuesImages['epigraph']?>" />		
		<? }
		else {
			$disabled = "";
			$extraStyle = "";
			if(!(strstr($this->deleteImages,",".$valueNumber.",")===false)) {
				$disabled = "readonly='readonly'";
				$extraStyle = "background-color:#AAAAAA";
			}		
			?><input type="text" maxlength="<?=$this->epigraphLength?>" 
					id="EpigraphImageEpigraph_<?=$this->name?>_<?=$valueNumber?>" 
					name="EpigraphImageEpigraph_<?=$this->name?>[<?=$this->valuesImages[$valueNumber]['id']?>]" 
					value="<?=$this->valuesImages[$valueNumber]['epigraph']?>" <?=$disabled?> style="<?=$extraStyle?>"/><?		
		}
	}
	
	function validateFromPost(&$errors) {
		// Image
		foreach($this->errorPosting as $error) $errors[] = $error;
		if($this->cardinality == "1") {
			$valueEp = $this->valuesImages['epigraph'];
			if(strlen($valueEp)>$this->epigraphLength) {
				$errors[] = "El epigrafe de ".$this->name." es demasiado largo (m&aacute;x: ".$this->epigraphLength.")";
				return false;
			}
		}
		else {
			// Epigraph
			foreach($this->valuesImages as $value) {
				$valueEp = $value['epigraph'];
				if(strlen($valueEp)>$this->epigraphLength) {
					$errors[] = "El epigrafe de ".$this->name." es demasiado largo (m&aacute;x: ".$this->epigraphLength.")";
					return false;
				}
			}
		}

		// Imagess

		if($this->required) {

			// FIXME: Falta agregar la complejidad por si borra fotos

			if($this->cardinality == "1") {

				if(empty($this->valuesImages['image_file'])) {

					$errors[] = "Falta elegir la foto ".$this->name;

				}

			}

			else {

				if(sizeof($this->valuesImages) == 0) {

					$errors[] = "Falta elegir una foto para ".$this->name;

					return false;

				}

			}

		}
		return true;
	}
	
	function processImageUpload($key,$tmpFileName,$dstFileName) {
		$image = new Image();
		if(!$image->loadFromFile($tmpFileName)) {
			$this->errorPosting[] = "Error con la imagen ".$this->name.": ".$image->error;
			return false;
		}
		else {
			$image->resize($this->imageX,$this->imageY,$this->resizeBehavior);
			$finalFileName = findFileName(APPLICATION_ROOT.$this->imageStoreFolder,$dstFileName);
			if(!$image->saveToFile(APPLICATION_ROOT.$this->imageStoreFolder."/".$finalFileName)) {
				$this->errorPosting[] = "Error con la image ".$this->name.": ".$image->error;
				return false;
			}
			if($this->thumbnail) {
				$imageThumb = new Image();
				$imageThumb->loadFromFile($tmpFileName);
				if((!$imageThumb->resize($this->thumbnailX,$this->thumbnailY,$this->thumbnailBehavior))
				||(!$imageThumb->saveToFile(APPLICATION_ROOT.$this->thumbnailStoreFolder."/".$finalFileName))) {
					$this->errorPosting[] = "Error con la thumbnail de la imagen ".$this->name.": ".$image->error;
					return false;
				}
			}
			if($this->cardinality == "1") {
				$this->valuesImages['image_file'] = $finalFileName;
				$this->valuesImages['image_full_file'] = $this->imageStoreFolder."/".$finalFileName;
				if($this->thumbnail) {
					$this->valuesImages['image_thumbnail_full_file'] = $this->thumbnailStoreFolder."/".$finalFileName;
				}
			}
			else {
				$this->valuesImages[$key]['image_file'] = $finalFileName;
				$this->valuesImages[$key]['image_full_file'] = $this->imageStoreFolder."/".$finalFileName;
				if($this->thumbnail) {

					$this->valuesImages[$key]['image_thumbnail_full_file'] = $this->thumbnailStoreFolder."/".$finalFileName;
				}
			}
		}
		return true;
	}
	
	function fillWithPost() {

		if($this->cardinality == "1") {
			if(!empty($_FILES["EpigraphImageImage_".$this->name])) {
				$this->valuesImages = array(	"id" => "",
												"image_file" => $_POST['EpigraphImageImageValue_'.$this->name],
												"image_folder" => $this->imageStoreFolder,
												"epigraph" => $_POST['EpigraphImageEpigraph_'.$this->name],
												"image_full_file" => $this->imageStoreFolder."/".$_POST['EpigraphImageImageValue_'.$this->name]);

				if($this->thumbnail) {

					$this->valuesImages["image_thumbnail_full_file"] = $this->thumbnailStoreFolder."/".$_POST['EpigraphImageImageValue_'.$this->name];

				}

				if($_FILES["EpigraphImageImage_".$this->name]['error']==0) {

					$this->processImageUpload(0,
											$_FILES['EpigraphImageImage_'.$this->name]['tmp_name'],
											$_FILES['EpigraphImageImage_'.$this->name]['name']);
				}
				else {
					if($_FILES["EpigraphImageImage_".$this->name]['error']!=4) $this->errorPosting[] = "Error subiendo la imagen ".$this->name;
				}							
			}
		}
		else {
			$this->deleteImages = $_POST['deleteEpigraphImageIds_'.$this->name];
			$minor = -1;
			// Images for Update
			if(!empty($_FILES["EpigraphImageImage_".$this->name]))
				foreach($_FILES["EpigraphImageImage_".$this->name]['error'] as $key=>$value) {
					if($key <= $minor) $minor = $key;
					$this->valuesImages[$key] = array(	"id" => $key,
														"image_file" => $_POST['EpigraphImageImageValue_'.$this->name][$key],
														"image_folder" => $this->imageStoreFolder,
														"epigraph" => $_POST['EpigraphImageEpigraph_'.$this->name][$key],
														"image_full_file" => $this->imageStoreFolder."/".$_POST['EpigraphImageImageValue_'.$this->name][$key]);
					if($this->thumbnail) {

						$this->valuesImages[$key]["image_thumbnail_full_file"] = $this->thumbnailStoreFolder."/".$_POST['EpigraphImageImageValue_'.$this->name];

					}
					if($value==0) {
						$this->processImageUpload($key,
												  $_FILES['EpigraphImageImage_'.$this->name]['tmp_name'][$key],
												  $_FILES['EpigraphImageImage_'.$this->name]['name'][$key]);
					}
					else if($value!=4) $this->errorPosting[] = "Error subiendo la imagen ".$this->name;
				}
			// Images for Add
			$added = $minor-1;
			foreach($_FILES['newEpigraphImageImage_'.$this->name]['error'] as $key=>$value) {
				if($value == 0) {
					$this->valuesImages[$added] = array("id" => $added,
														"image_folder" => $this->imageStoreFolder,
														"epigraph" => $_POST['newEpigraphImageEpigraph_'.$this->name][$key]);
					// Upload Image
					$this->processImageUpload(  $added,
												$_FILES['newEpigraphImageImage_'.$this->name]['tmp_name'][$key],
												$_FILES['newEpigraphImageImage_'.$this->name]['name'][$key]);
					$added--;
				}
				else if($value!=4) $this->errorPosting = "Error subiendo la imagen ".$this->name;
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
		if($this->cardinality == "1") {
			$sql = "UPDATE ".$this->tableReference." SET ".$this->imageTableName."='".addslashes($this->valuesImages['image_file'])."', ";
			$sql.= $this->epigraphTableName."='".addslashes($this->valuesImages['epigraph'])."' WHERE id = '".$entityId."'";
			$res = GlobalManager::getDb()->execute($sql);
			if(!$res) {
				$errors[] = "Error grabando imagen en la base";
			}
		}
		else {
			// Delete Images
			$borradas = str_replace(",,","--",$this->deleteImages);
			$borradas = str_replace(",","",$borradas);
			$borradas = str_replace("--",",",$borradas);
			
			// Delete old images
			$sql = "SELECT * FROM ".$this->tableReference." WHERE id IN (".$borradas.") AND ".$this->columnReference."=".$entityId;
			$res = GlobalManager::getDb()->execute($sql);
			if($res) {
				while($reg = GlobalManager::getDb()->getRow($res)) {

					unlink(APPLICATION_ROOT.$this->imageStoreFolder."/".$reg[$this->imageTableName]);

					if($this->thumbnail) {

						unlink(APPLICATION_ROOT.$this->thumbnailStoreFolder."/".$reg[$this->imageTableName]);

					}
				}
			}
			$sql = "DELETE FROM ".$this->tableReference." WHERE id IN (".$borradas.") AND ".$this->columnReference."=".$entityId;
			GlobalManager::getDb()->execute($sql);
			
			// Delete new images
			$borradas = explode(",",$borradas);
			foreach($borradas as $borrada) if($borrada < 0) {
				unlink(APPLICATION_ROOT.$this->imageStoreFolder."/".$this->valuesImages[$borrada]['image_file']);
				if($this->thumbnail) {

					unlink(APPLICATION_ROOT.$this->thumbnailStoreFolder."/".$this->valuesImages[$borrada]['image_file']);

				}
			} 				
			
			
			// Add and Update
			foreach($this->valuesImages as $key=>$value) {
				if($key > 0) { // Update
					// TODO: Borrar imÃ¡genes viejas si cambia el archivo
					$sql = "UPDATE ".$this->tableReference." SET ";
					$sql.= $this->epigraphTableName." = '".valueToDb($value['epigraph'])."', ";
					$sql.= $this->imageTableName." = '".$value['image_file']."' ";
					$sql.= "WHERE id = '$key' AND ".$this->columnReference." = $entityId";
				}
				else { // Insert
					if(in_array($key,$borradas)) $sql = "SELECT 1 FROM ".$this->tableReference;
					else {
						$sql = "INSERT INTO ".$this->tableReference."(".$this->columnReference.",".$this->epigraphTableName.",".$this->imageTableName.") ";
						$sql.= " VALUES('".$entityId."','".$value['epigraph']."','".$value['image_file']."')";
					}
				}
				$res = GlobalManager::getDb()->execute($sql);
				if(!$res) {
					$errors[] = "Error grabando imagen en la base";
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
			$this->valuesImages = array(
									"id"=>"",
									"image_file"=>$reg[$this->imageTableName],
									"image_folder"=>$this->imageStoreFolder,
									"epigraph"=>$reg[$this->epigraphTableName],
									"image_full_file"=>$this->imageStoreFolder."/".$reg[$this->imageTableName]);

			if($this->thumbnail) {

				$this->valuesImages["image_thumbnail_full_file"] = $this->thumbnailStoreFolder."/".$reg[$this->imageTableName];

			}
		}
		else {
			$sql = "SELECT * FROM ".$this->tableReference." WHERE ".$this->columnReference." = '".$reg['id']."' ORDER BY id ASC";
			$res = GlobalManager::getDb()->execute($sql);
			if(!$res) return false;
			 
			while($reg = GlobalManager::getDb()->getRow($res)) {
				$this->valuesImages[$reg['id']] = array(	"id"=>$reg['id'],
															"image_file"=>$reg[$this->imageTableName],
															"image_folder"=>$this->imageStoreFolder,
															"epigraph"=>$reg[$this->epigraphTableName],
															"image_full_file"=>$this->imageStoreFolder."/".$reg[$this->imageTableName]);
				if($this->thumbnail) {

					$this->valuesImages[$reg['id']]["image_thumbnail_full_file"] = $this->thumbnailStoreFolder."/".$reg[$this->imageTableName];

				}
			}
		}
		return true;
	}

	function getJoinSql($entityTableName,$uniqueExtraAlias) {
		return "";
	}
	
	function getFieldSqlDescription($entityTableName,$uniqueExtraAlias) {
		if($this->cardinality == "1") {
			$sql = $entityTableName.".".$this->imageTableName.",".$entityTableName.".".$this->epigraphTableName;
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
			return $entityTableName.".".$this->epigraphTableName;
		}
		else {
			// TODO: Implementar pensando la logica
			die("Funcion no implementada: Ordenado de FieldImageEpigraph");	
		}
	}
	*/
	
	
	function createJavascript() {
		if($this->cardinality == "1") {
		}
		else {
			?>
			var imgs_<?=$this->name?>=1; 
			function addEpigraphImage_<?=$this->name?>() {

				var idLevel1 = document.getElementById('idAddImageEpigraph_<?=$this->name?>');

				var inputImOb = document.getElementById('newEpigraphImageImage_<?=$this->name?>');
				var inputEpOb = document.getElementById('newEpigraphImageEpigraph_<?=$this->name?>');
				var newImOb = inputImOb.cloneNode(true);
				var newEpOb = inputEpOb.cloneNode(true);
				newImOb.name = 'newEpigraphImageImage_<?=$this->name?>['+imgs_<?=$this->name?>+']';
				newEpOb.name = 'newEpigraphImageEpigraph_<?=$this->name?>['+imgs_<?=$this->name?>+']';
				newImOb.id = '';
				newEpOb.id = '';
				imgs_<?=$this->name?>++;

				var newDiv1 = document.createElement('div');

				newDiv1.className = idLevel1.className;

				var newDiv2_1 = document.createElement('div'); 

				var newDiv2_2 = document.createElement('div');

				newDiv2_1.appendChild(newImOb);

				newDiv2_1.className = inputImOb.parentNode.className;

				newDiv2_2.appendChild(newEpOb);

				newDiv2_2.className = inputEpOb.parentNode.className;

				newDiv1.appendChild(newDiv2_1); 

				newDiv1.appendChild(newDiv2_2);

				idLevel1.parentNode.appendChild(newDiv1); 

				return true; 
				
			};
			
			function delEpigraphImage_<?=$this->name?>(valueNumber) {
				var deleteInput = document.getElementById('deleteEpigraphImageIds_<?=$this->name?>');
				if(!deleteInput) {
					return false;
				}
				var imageOb = document.getElementById('imgEpigraphImageImage_<?=$this->name?>_'+valueNumber);
				var str = ","+valueNumber+",";
				var inputOb = document.getElementById('EpigraphImageEpigraph_<?=$this->name?>_'+valueNumber);
				
				var whereIs = deleteInput.value.indexOf(str,0); 
				if( whereIs == -1 ) {
					// Delete
					deleteInput.value += str;				
					if(imageOb) {
						imageOb.style.opacity=".5";
						imageOb.style.filter="alpha(opacity=50)";
						inputOb.readOnly = true;
						inputOb.style.backgroundColor = "#666666";
					}
				}
				else {
					// Restore
					var newValue = deleteInput.value.substr(0,whereIs) + deleteInput.value.substr(whereIs+str.length,deleteInput.value.length);
					deleteInput.value = newValue;
					if(imageOb) {
						imageOb.style.opacity="1";
						imageOb.style.filter="alpha(opacity=100)";
						inputOb.readOnly = false;
						inputOb.style.backgroundColor = "#FFFFFF";
					}
				}
				
			}
		<?
		}
	}
	
	function delete($entityId,&$errors) {
		$reg['id'] = $entityId;
		if(!$this->fillWithDb($reg)) {
			$errors[] = "Error borrando las imÃ¡genes";
			return false;
		}
		
		if($this->cardinality == "1") {
			$nombre_arch = APPLICATION_ROOT.$this->valuesImages['image_full_file'];
			if((strlen(trim($this->valuesImages['image_file']))>0) && (!unlink($nombre_arch))) {
				$errors[] = "Error eliminando la imagen ".$this->valuesImages['image_file'];
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
			foreach($this->valuesImages as $key=>$value) {
				$nombre_arch = APPLICATION_ROOT.$value['image_full_file'];
				if(!unlink($nombre_arch)) {
					$errors[] = "Error eliminando la imagen ".$value['image_file'];
				}
			}
		}
		return true;
	}
	
	function getValue() {
		return $this->valuesImages;
	}
	
}

?>