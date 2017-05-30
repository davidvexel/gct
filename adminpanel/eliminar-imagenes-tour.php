<?php 
require_once('../Connections/conexion.php'); 
include('include/negar_acceso.php'); 
?>
<?php
 if(isset($_GET['tour_id'])) { 
  $tour_id = $_GET['tour_id'];
  $nomcampo = $_GET['nomcampo'];
  $updateSQL = "UPDATE imagenes SET $nomcampo='' WHERE tour_id=$tour_id";
  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  
  $carpeta = "../fotos_tours/$tour_id/" .$_GET['nomimagen'];
  $elimimar = unlink($carpeta);

  header("Location: editar-imagenes-tour.php?id_tour=$tour_id");
 } else {
	  echo "Error en ID";
	 }
?>