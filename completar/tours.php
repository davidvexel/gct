<?php 
require_once('../Connections/conexion.php'); 
mysqli_select_db( $conexion, $database_conexion); //Conexiona a la base de datos

$nomTour = $_REQUEST['nomTour'];
$arrayTours = array();
$selectTours = " SELECT nom_tour, id_tour FROM tours WHERE nom_tour LIKE '%".mysqli_real_escape_string($nomTour) . "%'";
$queryTours = mysqli_query( $conexion, $selectTours )or die(mysqli_error());
$totalTours = mysqli_num_rows($queryTours);

if($totalTours > 0){
	while($rowTours = mysqli_fetch_assoc($queryTours)){
		
		$row_array['label'] = $rowTours['nom_tour'];
        $row_array['value'] = $rowTours['id_tour'];
		array_push($arrayTours, $rowTours);
		}
		
		echo json_encode($arrayTours);
} else {
	
	echo '[{"id_tour":"","nom_tour":"No Encontró el Tour"}]';
	}

?>