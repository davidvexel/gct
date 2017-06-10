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

mysqli_select_db( $conexion, $database_conexion); //Conexiona a la base de datos
$Result1 = mysqli_query( $conexion, $updateSQL ) or die(mysqli_error());

   $carpeta = "../imagenes/slider/".$_GET['imgSlider'];
   $elimimar = @unlink($carpeta);

  header("Location: editar-slider.php?id_slider=$id_slider");

 } else {
	  echo "Error en ID";
	 }

?>
