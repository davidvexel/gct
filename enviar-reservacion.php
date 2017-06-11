<?php

include("include/config.php");

include('include/class-orders.php');

if( isset( $_POST['reservaciones'] ) && $_POST['reservaciones'] = 'reservaciones' ) {
	
	session_start();

	$_SESSION['id_tour'] = NULL;
	
	unset( $_SESSION['id_tour'] );
		
	// @TODO: Create order with $_POST
	$new_order = new Orders_Tours( $_POST );
	
	$last_order = $new_order->get_last_order();

	$payment_information = json_decode( $last_order['payment_response'] );
			
	?>
	
	<ul class="datos">
	    <li>Nombre <span><?php echo $last_order['nombre'];  ?></span></li>
	    <li>Correo<span><?php echo $last_order['email']; ?></span></li>
	    <li>Teléfono<span><?php echo $telefono; ?></span></li>
	    <li>País<span><?php echo $last_order['pais']; ?></span></li>
	    <li>Hotel<span><?php echo $last_order['hotel'];  ?></span></li>
	    <li>Forma de pago: <span><?php echo $last_order['payment'] ?></span></li>
	    <li>Comentarios<span><?php echo $last_order['comen']; ?></span></li>
	</ul>
	<div align="center">
	    <h2>Orden Número</h2> <strong> <?php echo $last_order['id']; ?> </strong> <br />
	    <strong>Llegara  a su correo una copia con todos los datos de la reservación que ha realizado</strong> <br />
	    Para cualquiera duda o aclaración guarde su código de reservación
	</div>
	
	<div class="clear"></div>

	<div id="informacion_pago">
		<h2>Datos para pago en OXXO</h2>
		<b>Referencia: </b> <span><?php echo $payment_information->charges->{'0'}->payment_method->reference; ?></span> </br>
		<b>Cantidad: </b> <span><?php echo $payment_information->amount/100; ?></span>
	</div>
	<br />
<?php } else {
	header("location: index.php");
} ?>