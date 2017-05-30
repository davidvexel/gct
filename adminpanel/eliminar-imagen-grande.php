<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php'); 
?>
<?php

if(isset($_GET['id_tour'])) { 
 
$id_tour = $_GET['id_tour'];

$updateSQL = sprintf("UPDATE tours SET imagen='' WHERE id_tour=%s",
                       GetSQLValueString($id_tour, "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

   $carpeta = "../fotos_tours/principal/" .$_GET['imagen'];
   $elimimar = unlink($carpeta);

  header("Location: editar-tour.php?id_tour=$id_tour");

 } else {
	  echo "Error en ID";
	 }

?>
