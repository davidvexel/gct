<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	
	$widthImg = 300;
	$document_type = $_FILES['Filedata']['type'];
	$path = $_SERVER['DOCUMENT_ROOT']."/imagenRedir/img/";// Relative to the root
		// Validate the file type
	$tipo = array('jpg','jpeg','gif','png'); // File extensions
	$ext = pathinfo($_FILES['Filedata']['name']);
	 
	if (in_array($ext['extension'],$tipo)) {
		 $prefijo = substr(md5(uniqid(rand())),0,6);
		 $documentName = $_FILES['Filedata']['name'];
		 $documentTmp_name =  $_FILES['Filedata']['tmp_name'];
		 $documentError = $_FILES['Filedata']['error'];
		 $name = $prefijo.'-'.$documentName;
		 
 #move_uploaded_file($documentTmp_name,$path.$name);
ResizeConserveAspectRatio($document_type, $documentTmp_name, $path.$name, $widthImg);


	
	echo '1';
	} else {
	echo "Archivo no valido";
	}
	
}
?>