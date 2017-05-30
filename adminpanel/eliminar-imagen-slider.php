<?php
require_once('../Connections/conexion.php');
include('../include/function.php');
include('include/negar_acceso.php');

if (!isset($_SESSION)) {
  session_start();
}


 if(isset($_GET['id_slider'])) { 
 
$id_slider = $_GET['id_slider'];

$updateSQL = sprintf("UPDATE slider SET imgSlider='' WHERE id_slider=%s",
                       GetSQLValueString($id_slider, "int"));

mysql_select_db($database_conexion, $conexion); //Conexiona a la base de datos
$Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

   $carpeta = "../imagenes/slider/".$_GET['imgSlider'];
   $elimimar = @unlink($carpeta);

  header("Location: editar-slider.php?id_slider=$id_slider");

 } else {
	  echo "Error en ID";
	 }

?>
