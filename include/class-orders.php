<?php
/**
* Manage tour orders
*
* @author David Leal
* @package 1.0
*/

include "Connections/conexion.php";

require_once("vendor/conekta-php/lib/Conekta.php");

/**
 * 
 */
class Orders_Tours extends \Conekta\Conekta {
	
	/**
	 * Order data
	 */
	private $order_data;

	/**
	 * Api key
	 */
	private $conekta_api_key = 'key_BxfRv2u6KVQTzwpgKPofzw';

	/**
	 * Conekta public api key
	 */

	private $conekta_public_key = 'key_EsnjHpWA5rskw9yTNrWyaRA';

	/**
	 * Conekta api version
	 */
	private $conekta_api_version = '2.0.0';

	/**
	 * site path
	 */
	private $site_path = 'http://www.geckocancuntours.com/';

	/**
	 * Class constructor
	 *
	 * @param array $order_data
	 */
	public function __construct( $order_data = '' ) {

		if ( ! empty( $order_data ) ) {

			$this->order_data = $order_data;

			/**
			 * Save the order in the DB
			 */
			$order_id = $this->save_order( $this->order_data );

			if( ! empty( $order_id ) || null !== $order_id ) {
				/**
				 * Create the charge in Conekta
				 */
				if( 'oxxo' === $this->order_data['payment'] ) {

					/**
					 * Generate oxxo payment
					 */
					$charge = $this->conekta_oxxo_charge( $this->order_data, $order_id );

				} else if ( 'card' === $this->order_data['payment'] ) {

					/**
					 * Create customer
					 */

					$customer = $this->conekta_customer( $this->order_data );

					/**
					 * Generate card payment
					 */
					if( ! empty( $customer ) || null !== $customer ) {
						
						$charge = $this->conekta_card_charge( $customer, $this->order_data, $order_id );
					
					} else {
					
						throw new Exception( "Something went wrong", 1 );
					
					}
				
				} else {
					// deposit
				}

				/**
				 * Update order with payment info
				 */
				$update = $this->update_order_with_payment_data( $charge, $order_id );

				/**
				 * Send mails
				 */
				$mails = $this->send_mails( $this->order_data, $charge, $order_id );
			}

		}
	}

	/**
	 * Save order data
	 *
	 * @param array $data
	 * @return int order id
	 */
	public function save_order( $data ) {

		/**
		 * Use conexion variables
		 */
		global $conexion;

		global $database_conexion;

		/**
		 * Inser order in db
		 */
		$inser_sql = sprintf( 
			"INSERT INTO ordenes 
				(nombre, telefono, correo, pais, hotel, forma_pago, mensaje, monto, tour, fecha_tour, fecha, adultos, ninos, status, idioma, imagen, tour_name) 
			VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %s, '%s', '%s', %s, %s, '%s', '%s', '%s', '%s' )", 

			$data['nombre'],
			$data['telefono'],
			$data['email'],
			$data['pais'],
			$data['hotel'],
			$data['payment'],
			$data['comen'],
			$data['total'],
			$data['tour_id'], //id tour
			date("Y-m-d H:i:s", strtotime( $data['fecha'] ) ),
			date("Y-m-d H:i:s"),
			$data['adultos'],
			$data['ninos'],
			'pending',
			'es',
			$data['imagen'],
			$data['nom_tour']
		);

		/**
		 * Select DB
		 */
		mysqli_select_db($conexion, $database_conexion);

		/**
		 * Run mysql query
		 */
		$result = mysqli_query( $conexion, $inser_sql ) or die( mysqli_error( $conexion ) ." " . $inser_sql );
		
		$insert_id = mysqli_insert_id( $conexion );

		return $insert_id;

	}

	/**
	 * Create Conekta OXXO charge
	 *
	 * @param array $order_Data
	 * @return bool
	 */
	public function conekta_oxxo_charge( $order_data ) {
		\Conekta\Conekta::setApiKey( $this->conekta_api_key );
		\Conekta\Conekta::setApiVersion( $this->conekta_api_version );

		$valid_order = array(
			'line_items'=> array(
				array(
					'name'        => $order_data['nom_tour'],
					'description' => $order_data['adultos'] . ' Adultos - ' . $order_data['ninos'],
					'unit_price'  => 20000,
					'quantity'    => 1,
					'sku'         => $order_data['tour_id'],
					'category'    => 'tours',
					'tags'        => array('tours', 'gecko cancun tours')
				)
			),
			'metadata' => array('source' => 'Gecko Cancun Tours'),
			'charges'  => array(
				array(
					'payment_method' => array(
						'type' => 'oxxo_cash'
					)//payment_method
				)
			),
			'currency' => 'mxn',
			'customer_info' => array(
				'name'  => $order_data['nombre'],
				'phone' => $order_data['telefono'],
				'email' => $order_data['email']
			)
		);
		
		try {
			
			$order = \Conekta\Order::create( $valid_order );
		
		} catch ( \Conekta\Conekta\ProcessingError $e ){ 
		
			echo $e->getMessage();
		
		} catch ( \Conekta\Conekta\ParameterValidationError $e ){
		
			echo $e->getMessage();
		
		} catch ( \Conekta\Conekta\Handler $error ){
		
			echo $error->getMessage();
		
		}

		return $order;
	}

	/**
	 * Create conekta customer
	 *
	 * @param array $order_data
	 * @return obj $customer
	 */
	public function conekta_customer( $order_data ) {
		\Conekta\Conekta::setApiKey( $this->conekta_api_key );
		\Conekta\Conekta::setApiVersion( $this->conekta_api_version );

		try {
			$customer = \Conekta\Customer::create(
				array(
					"name" => $order_data['nombre'],
					"email" => $order_data['email'],
					"phone" => $order_data['telefono'],
					"payment_sources" => array(
						array(
							"type" => "card",
							"token_id" => $order_data['conektaTokenId']
						)
					)//payment_sources
				)//customer
			);
		} catch (\Conekta\ProccessingError $error){
		
			echo $error->getMesage();
		
		} catch (\Conekta\ParameterValidationError $error){
		
			echo $error->getMessage();
		
		} catch (\Conekta\Handler $error){
		
			echo $error->getMessage();
		
		}

		return $customer;
	}

	/**
	 * Create Conekta Card charge
	 *
	 * @param array $order_Data
	 * @return bool
	 */
	public function conekta_card_charge( $customer, $order_data, $order_id ) {
		\Conekta\Conekta::setApiKey( $this->conekta_api_key );
		\Conekta\Conekta::setApiVersion( $this->conekta_api_version );

		try {
		  $order = \Conekta\Order::create(
			array(
				"line_items" => array(
					array(
						"name" => $order_data['order_data'],
						"unit_price" => 1000,
						"quantity" => 12
					)
				), //line_items
				"currency" => "MXN",
				"customer_info" => array(
				"customer_id" => $customer['id']
				), //customer_info
				"metadata" => array( "order_id" => $order_id, "tour_id" => $order_data['tour_id'] ),
				"charges" => array(
					array(
						"payment_method" => array(
							"type" => "default"
						)//payment_method
					) //first charge
				) //charges
			)//order
		  );
		} catch (\Conekta\ProccessingError $error){
			echo $error->getMesage();
		} catch (\Conekta\ParameterValidationError $error){
			echo $error->getMessage();
		} catch (\Conekta\Handler $error){
			echo $error->getMessage();
		}

		return $order;
	}

	/**
	 * Update order with either Conekta data or some payment method
	 *
	 * @param obj $data
	 * @param int $oder_id
	 * @return void
	 */
	public function update_order_with_payment_data( $data, $order_id ) {
		
		/**
		 * Use conexion variables
		 */
		global $conexion;

		global $database_conexion;

		$payment_response = array(
			'id' => $data->id,
			'charges' => $data->charges,
			'amount' => $data->amount,
		);

		$payment_response = json_encode( $payment_response );

		$update_sql = sprintf( "UPDATE `ordenes` SET payment_response='%s' WHERE id=%s",
			$payment_response,
			$order_id
		);

		mysqli_select_db( $conexion, $database_conexion );

		$result = mysqli_query( $conexion, $update_sql ) or die( mysqli_error( $conexion ) . $update_sql );

	}

	/**
	 * Get last order inserted
	 *
	 * @return $row order information
	 */
	public function get_last_order() {
		/**
		 * Use conexion variables
		 */
		global $conexion;

		global $database_conexion;

		$query = 'SELECT * FROM ordenes ORDER BY id DESC LIMIT 1';

		mysqli_select_db( $conexion, $database_conexion );

		$result = mysqli_query( $conexion, $query ) or die( myqli_error( $conexion ) . $query );

		$row = mysqli_fetch_assoc( $result );

		return $row;

	}

	/**
	 * Mailer
	 * 
	 * @param array $order_data
	 * @param object $conekta_data
	 * @param int $order_id
	 * @return void
	 */
	public function send_mails( $order_data, $conekta_data, $order_id ) {

		/**
		 * Site path
		 */
		$path = $this->site_path;

		/**
		  *  get reservation mail template
		  */
		$reservacion_mail = file_get_contents( 'include/email_templates/new_order.html' );

		$mail_strings = array( '{{path}}', '{{nom_tour}}', '{{fecha}}', '{{adultos}}', '{{precio_adulto}}', '{{subtotal1}}', '{{ninos}}', '{{precio_nino}}', '{{subtotal2}}', '{{total}}', '{{nombre}}', '{{email}}', '{{telefono}}', '{{pais}}', '{{hotel}}', '{{FP}}', '{{comen}}', '{{CR}}' );

		$order_strings = array( );

		$message = str_replace( $mail_strings, $order_strings, $reservacion_mail ); 

		$asunto = "Reservacion: " . $order_id . " - Gecko Cancun Tours";

		$empresa = "Gecko Cancun Tours ";
		
		//$correo_empresa="info@geckocancuntours.com, gecko.cancun@outlook.com, kbronzito@hotmail.com, guako@hotmail.com";
		
		$correo_empresa = 'contacto@vexel.mx';
		
		$mime = "MIME-Version:1.0\nContent-type:text/html;charset=UTF-8\nFrom:$empresa<$correo_empresa>";

		/**
		 * Client email
		 */
		mail( $order_data['email'], $asunto, $message, $mime);
		
		$asunto .= " Copia ";
		
		/**
		 * Company email
		 */
		mail( $correo_empresa, $asunto, $message, $mime);
	}
}