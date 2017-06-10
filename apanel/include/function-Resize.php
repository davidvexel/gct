<?php

function ResizeConserveAspectRatio($document_type, $documentTmp_name, $destination, $newWidth = 100) {
	//Crear una imagen nueva desde el flujo de imagen de la cadena

	   $w = $newWidth; 
       $h = $newWidth; 
	   
	   $documentTmp_name = imagecreatefromstring(file_get_contents($documentTmp_name)) 
              or die('<p>Formato de imagen no valido</p>'); 
			  
	$x = imagesx($documentTmp_name); 
    $y = imagesy($documentTmp_name); 
// maintain aspect ratio 	
	if($w && ($x < $y)) { 
		$w = round(($h / $y) * $x);
		} else { 
			$h = round(($w / $x) * $y); 
			
			}       
	
    $slate = imagecreatetruecolor($w, $h) or die('Dimensiones de imagen no válido'); 
    imagecopyresampled($slate, $documentTmp_name, 0, 0, 0, 0, $w, $h, $x, $y); 
			  
			  
	         //Crea una nueva imagen a partir de un fichero o de una URL
        switch ($document_type)
        {
            case 'image/jpeg':
			    imagejpeg($slate, $destination, 100) or die('Directory permission problem'); 
                break;
            case 'image/gif':
                imagegif($slate, $destination, 100) or die('Directory permission problem'); 
                break;
            case 'image/png':
                 imagepng($slate, $destination) or die('Directory permission problem'); 
                break;
        }
       
	   imagedestroy($slate); 
       imagedestroy($documentTmp_name); 
      return true;
}

?>
