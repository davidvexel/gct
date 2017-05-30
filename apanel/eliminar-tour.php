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

mysql_select_db($database, $conexion);
$ElimEvento = sprintf("DELETE FROM Eventos WHERE idEvento=%s", GetSQLValueString($idEvento, "int"));
$ResEvento = mysql_query($ElimEvento, $conexion) or die(mysql_error());

$ElimGaleria = sprintf("DELETE FROM galeriaEvento WHERE idEvento=%s", GetSQLValueString($idEvento, "int"));
$ResGaleria = mysql_query($ElimGaleria, $conexion) or die(mysql_error());

$dir = "../fotos_eventos/".$idEvento;
rrmdir($dir);
 
 header("Location: lista-portafolio.php");

 } else {
	  echo "Error en ID";
	 }

?>
