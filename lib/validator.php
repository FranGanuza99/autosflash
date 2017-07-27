<?php
class Validator
{
	public static function validateForm($fields)
	{
		foreach ($fields as $index => $value) {
			$value = strip_tags(trim($value));
			$value = htmlentities(trim($value));
			$fields[$index] = $value;
		}
		return $fields;
	}
//se valida la imagen que sea de los formatos solicitados 
	public static function validateImage($file)
	{
		$img_size = $file["size"];
     	if($img_size <= 2097152)
     	{
     		$img_type = $file["type"];
	     	if($img_type == "image/jpeg" || $img_type == "image/png" || $img_type == "image/gif")
	    	{
	    		$img_temporal = $file["tmp_name"];
	    		$img_info = getimagesize($img_temporal);
		    	$img_width = $img_info[0]; 
				$img_height = $img_info[1];
				
				$image = file_get_contents($img_temporal);
				return base64_encode($image);
	    	}
	    	else
	    	{
	    		throw new Exception("El formato de la imagen debe ser jpg, png o gif");
	    	}
     	}
     	else
     	{
     		throw new Exception("El tamaño de la imagen debe ser como máximo 2MB");
     	}
	}
//se valida la imagen el el tamaño y resolucion
	public static function validateImageProfile($file)
	{
		$img_size = $file["size"];
     	if($img_size <= 2097152)
     	{
     		$img_type = $file["type"];
	     	if($img_type == "image/jpeg" || $img_type == "image/png" || $img_type == "image/gif")
	    	{
	    		$img_temporal = $file["tmp_name"];
	    		$img_info = getimagesize($img_temporal);
		    	$img_width = $img_info[0]; 
				$img_height = $img_info[1];
				if ($img_width == $img_height)
				{
					$image = file_get_contents($img_temporal);
					return base64_encode($image);
					
				} else {
					throw new Exception("La dimensión de la imagen debe ser cuadrada");
				}
	    	}
	    	else
	    	{
	    		throw new Exception("El formato de la imagen debe ser jpg, png o gif");
	    	}
     	}
     	else
     	{
     		throw new Exception("El tamaño de la imagen debe ser como máximo 2MB");
     	}
	}


	function generarCodigo($longitud) {
		$key = '';
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
		$max = strlen($pattern)-1;
		for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
		return $key;
	}
}
?>