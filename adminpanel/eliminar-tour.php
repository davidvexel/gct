<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php'); 
?>
<?php

//Elimina la carpeta  y las imágenes que contiene la propiedad 

 function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     rmdir($dir);
   }
 } 

if ((isset($_GET['id_tour'])) && ($_GET['id_tour'] != "")) {
	
  $id_tour = $_GET['id_tour'];
  
   mysqli_select_db( $conexion, $database_conexion);
	
  $deleteSQL = sprintf("DELETE FROM tours WHERE id_tour=%s", GetSQLValueString($id_tour , "int"));
  $Result1 = mysqli_query( $conexion, $deleteSQL ) or die(mysqli_error());
  
  
  $deleteSQL = sprintf("DELETE FROM imagenes WHERE tour_id=%s", GetSQLValueString($id_tour, "int"));
  $Result1 = mysqli_query( $conexion, $deleteSQL ) or die(mysqli_error());
  
   $carpeta = "../fotos_tours/$id_tour";
   $elimimar = rrmdir($carpeta);

  $url = $_SERVER['HTTP_REFERER'];
  header("Location: $url");

}

?>
