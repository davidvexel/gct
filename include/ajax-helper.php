<?php
/**
 * Ajax helper
 * 
 * Get tours price by zone
 *
 * @author David Leal
 */

include "../Connections/conexion.php";

if( $_REQUEST['action'] ) {
	$action = $_REQUEST['action'];
} else {
	throw new Exception("No action selected", 1);
}

// call the function
switch ( $action ) {
	case 'search_hotel':
		search_hotel_by_name( $_REQUEST, $conexion, $database_conexion );
		break;
	case 'get_zone_price':
		get_price_by_zone( $_REQUEST, $conexion, $database_conexion );
}

/**
 * Search hotel by name
 *
 * @param array $req
 * @param array $conexion
 * @param string $db
 */
function search_hotel_by_name( $req, $conexion, $db ) {
	
	mysqli_select_db( $conexion, $db ); //Conexiona a la base de datos

	$hotel_name = $req['hotel'];

	$array_hotels = array();
	
	$select_hotels = " SELECT nombre, id, zona FROM hoteles WHERE nombre LIKE '%" . $hotel_name . "%'";
	
	$query_hotels = mysqli_query( $conexion, $select_hotels ) or die( mysqli_error() );
	
	$total_hotels = mysqli_num_rows($query_hotels);

	if( $total_hotels > 0 ){

		while( $row_hotels = mysqli_fetch_assoc( $query_hotels ) ) {
			
			$row_array['label'] = $row_hotels['nombre'];
	        $row_array['value'] = $row_hotels['id'];
	        $row_array['zona'] = $row_hotels['zona'];

			array_push( $array_hotels, $row_hotels );
		}
			
		echo json_encode( $array_hotels );
	
	} else {	
		echo '[{"id":"","nombre":"No results"}]';
	}

}

/**
 * Get tour price according with the zone
 *
 * @param array $req
 * @param array $conexion
 * @param string $db
 */
function get_price_by_zone( $req, $conexion, $db ) {
	// @TODO: get tour price by zone
	// @TODO: get dollar rate conversion
	$prices = array(
		'adulto' => 100,
		'nino' => 50,
		'adulto_pesos' => 1800,
		'nino_pesos' => 900,
		'tour' => $req['tour'],
	);

	echo json_encode( $prices );
}

?>