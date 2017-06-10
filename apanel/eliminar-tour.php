<?php 
require_once('../Connections/conexion.php');
require_once('../include/function.php'); 

if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
require_once('include/negar_acceso.php');

 if(isset($_GET['idEvento'])) { 
 
$idEvento = $_GET['idEvento'];

mysqli_select_db( $conexion, $database );
$ElimEvento = sprintf("DELETE FROM Eventos WHERE idEvento=%s", GetSQLValueString($idEvento, "int"));
$ResEvento = mysqli_query( $conexion, $ElimEvento ) or die(mysqli_error());

$ElimGaleria = sprintf("DELETE FROM galeriaEvento WHERE idEvento=%s", GetSQLValueString($idEvento, "int"));
$ResGaleria = mysqli_query( $conexion, $ElimGaleria ) or die(mysqli_error());

$dir = "../fotos_eventos/".$idEvento;
rrmdir($dir);
 
 header("Location: lista-portafolio.php");

 } else {
	  echo "Error en ID";
	 }

?>
