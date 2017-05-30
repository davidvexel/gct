<?php

function ResizeConserveAspectRatio($source, $destination = NULL, $long_dimension = 100) 
{ 
    $w = $long_dimension; 
    $h = $long_dimension; 
    $source = @imagecreatefromstring( 
              @file_get_contents($source)) 
              or die('<p>Not a valid image format. Click back and try again</p>'); 
			  
    $x = imagesx($source); 
    $y = imagesy($source); 
	
    if($w && ($x < $y)) $w = round(($h / $y) * $x); // maintain aspect ratio 	
    else $h = round(($w / $x) * $y);                // maintain aspect ratio 
	
    $slate = @imagecreatetruecolor($w, $h) or die('Invalid image dimmensions'); 
    imagecopyresampled($slate, $source, 0, 0, 0, 0, $w, $h, $x, $y); 
	
    if(!$destination) header('Content-type: image/jpg'); 
	
    @imagejpeg($slate, $destination, 100) or die('Directory permission problem'); 
    imagedestroy($slate); 
    imagedestroy($source); 
	
    if(!$destination) exit;
	
    return array($w,$h,'width="'.$w.'" height="'.$h.'"','mime'=>'image/jpg'); 
} 

?>