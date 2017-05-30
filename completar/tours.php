<? 
require_once('../Connections/conexion.php'); 
mysql_select_db($database_conexion, $conexion); //Conexiona a la base de datos

$nomTour = $_REQUEST['nomTour'];
$arrayTours = array();
$selectTours = " SELECT nom_tour, id_tour FROM tours WHERE nom_tour LIKE '%".mysql_real_escape_string($nomTour) . "%'";
$queryTours = mysql_query($selectTours,$conexion)or die(mysql_error());
$totalTours = mysql_num_rows($queryTours);

if($totalTours > 0){
	while($rowTours = mysql_fetch_assoc($queryTours)){
		
		$row_array['label'] = $rowTours['nom_tour'];
        $row_array['value'] = $rowTours['id_tour'];
		array_push($arrayTours, $rowTours);
		}
		
		echo json_encode($arrayTours);
} else {
	
	echo '[{"id_tour":"","nom_tour":"No Encontró el Tour"}]';
	}

?>