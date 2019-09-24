<?php
define("RESIZE_BEHAVIOR_EXACT",1); // Ajusta el ancho y alto pasados, deformando la foto de ser necesario
define("RESIZE_BEHAVIOR_LIMITX",2); // Ajusta el ancho y define un nuevo alto manteniendo la proporcion 
define("RESIZE_BEHAVIOR_LIMITY",3); // Ajusta el alto y define un nuevo ancho manteniendo la proporcion 
define("RESIZE_BEHAVIOR_LIMITMAX",4); // Ajusta al valor necesario para que la imagen no pase de los nuevos valores, y ajusta el otro manteniendo la proporcion 
define("RESIZE_BEHAVIOR_LIMITX_CUT",5); // Ajusta el ancho y corta el alto
define("RESIZE_BEHAVIOR_LIMITY_CUT",6); // Ajusta el alto y corta el ancho

class Image {
	var $format;
	var $size_x;
	var $size_y;
	var $resource;
	var $formats = array('image/jpeg','image/png','image/gif');
	var $error;
	var $resized = false;
	var $originalFile = "";
	
	function Image() {
		if(!function_exists("imagecreatefromjpeg")) die("Falta instalar mÃ³dulo gd2 para php");
	}
	
	function setFormat($formats) {
		$this->formats = $formats;
	}
	
	function loadFromFile($file) {
		if(!file_exists($file)) {
			$this->error = "Archivo inexistente";
			return false;
		}
		
		$tam = getimagesize($file);
		if(empty($tam)) {
			$this->error = "Formato incorrecto";
			return false;
		}
		
		$this->format = $tam['mime'];
		$this->size_x = $tam[0];
		$this->size_y = $tam[1];

		switch($this->format) {
			case 'image/jpeg':	$this->resource = imagecreatefromjpeg($file);
						break;
			case 'image/png': $this->resource = imagecreatefrompng($file);
						break;
			case 'image/gif': $this->resource = imagecreatefromgif($file);
						break;
			default:	$this->error = "Formato incorrecto";
						return false;
		}
		if(!$this->resource) {
			$this->error = "Archivo mal formado";
			return false;
		}
		
		$this->originalFile = $file;
		return true;
	}
	
	function resize($newX,$newY,$behavior) {
		$originalPartWidth = $this->size_x;
		$originalPartHeight = $this->size_y;
		if(!$this->resource) {
			$this->error = "Imagen no creada";
			return false;
		}
		if(($newX == $this->size_x)&&($newY == $this->size_y)) {
			return true; // No se hace nada
		}
		
		switch($behavior) {
			case RESIZE_BEHAVIOR_EXACT:			break;
			case RESIZE_BEHAVIOR_LIMITX:		$newY = ($newX / $this->size_x) * $this->size_y; 	
												break;
			case RESIZE_BEHAVIOR_LIMITY:		$newX = ($newY / $this->size_y) * $this->size_x;
												break;
			case RESIZE_BEHAVIOR_LIMITMAX:		if($this->size_x / $newX > $this->size_y / $newY) 
													$newY = ($newX / $this->size_x) * $this->size_y;
												else
													$newX = ($newY / $this->size_y) * $this->size_x;
												break;
			case RESIZE_BEHAVIOR_LIMITX_CUT:	$tmpNewY = ($newX / $this->size_x) * $this->size_y;
												if($tmpNewY > $newY) { // Cut
													$originalPartHeight = ($newY / $tmpNewY) * $this->size_y;  
												}
												else { // Don't cut
													$newY = $tmpNewY;
												}
												break;
			case RESIZE_BEHAVIOR_LIMITY_CUT:	$tmpNewX = ($newY / $this->size_y) * $this->size_x;
												if($tmpNewX > $newX) { // Cut
													$originalPartWidth = ($newX / $tmpNewX) * $this->size_x;  
												}
												else { // Don't cut
													$newX = $tmpNewX;
												}												
												break;
		}
		$thumb = imagecreatetruecolor($newX,$newY);
		imagecopyresampled($thumb,$this->resource,0,0,0,0,$newX,$newY,$originalPartWidth,$originalPartHeight);
		imagedestroy($this->resource);
		$this->resource = $thumb;
		$this->resized = true;
		return true;
	}

	function saveToFile($file,$overwrite = false,$addExtension = false) {
		if($addExtension) {
			switch($this->format) {
				case 'image/jpeg':	$file.= ".jpg";break;
				case 'image/png':	$file.= ".png";break;
				case 'image/gif':	$file.= ".gif";break;
			}
		}
		
		$result = true;
		if(!$this->resource) {
			$this->error = "Imagen no creada";
			return false;
		}
		if((file_exists($file))&&(!$overwrite)) {
			$this->error = "Archivo ya existente";
			return false;
		}
		
		if($this->resized) {
			switch($this->format) {
				case 'image/jpeg':	$result = imagejpeg($this->resource,$file,100);
								break;	
				case 'image/png':	$result = imagepng($this->resource,$file,0);
								break;	
				case 'image/gif':	$result = imagegif($this->resource,$file);
								break;
			}
		}
		else {
			// Si nunca fue modificada solo copio el archivo
			copy($this->originalFile,$file);			
		}
		if(!$result) {
			$this->error = "Error grabando la imagen";
			return false;
		}
		return true;
	}
	
}
?>