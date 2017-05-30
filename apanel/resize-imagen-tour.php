<?php
require_once('../Connections/conexion.php'); 
require_once('include/function-Resize.php');
include('../include/config.php');

if(isset($_POST['timestamp'])){

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	
	$idEvento = $_POST['idEvento'];
	$widthImg = 850;
	$document_type = $_FILES['Filedata']['type'];
	$path = $rutaGaleria.$idEvento."/";
	$tipo = array('jpg','jpeg','gif','png','JPG'); 
	$ext = pathinfo($_FILES['Filedata']['name']);
	 
	if (in_array($ext['extension'],$tipo)) {
		 $prefijo = substr(md5(uniqid(rand())),0,6);
		 $documentName = $_FILES['Filedata']['name'];
		 $documentTmp_name =  $_FILES['Filedata']['tmp_name'];
		 $documentError = $_FILES['Filedata']['error'];
		 $name = $prefijo.'-'.$documentName;
		 
ResizeConserveAspectRatio($document_type, $documentTmp_name, $path.$name, $widthImg);

  	  $insertSQL = "INSERT INTO galeriaEvento (idEvento, nomImg) VALUES ('".$idEvento."', '".$name."')";

  mysql_select_db($database, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
	 echo '1';
	} else {
	echo "Archivo no valido";
	}
	
} else { 
header("location:index.php");
}

} else {
header("location:index.php");
	}
?>