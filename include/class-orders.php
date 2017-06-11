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
	 * Class constructor
	 */
	public function __construct( $order_data = '' ) {
		if ( ! empty( $order_data ) ) {

			$this->order_data = $order_data;

			/**
			 * Save the order in the DB
			 */
			$save = $this->save_order( $this->order_data );

			/**
			 * Create the charge in Conekta
			 */
			$charge = $this->conekta_charge( $this->order_data );
		}
	}

	/**
	 * Save order data
	 * @param array $data
	 */
	public function save_order( $data ) {
		echo 'saving data';
		return true;
		// var_dump( $this->order_data );
	}

	/**
	 * Create Conekta charge
	 *
	 * @param array $order_Data
	 * @return bool
	 */
	public function conekta_charge( $order_data ) {
		\Conekta\Conekta::setApiKey("key_eYvWV7gSDkNYXsmr");
		\Conekta\Conekta::setApiVersion("2.0.0");

		$valid_order =
		    array(
		        'line_items'=> array(
		            array(
		                'name'        => 'Box of Cohiba S1s',
		                'description' => 'Imported From Mex.',
		                'unit_price'  => 20000,
		                'quantity'    => 1,
		                'sku'         => 'cohb_s1',
		                'category'    => 'food',
		                'tags'        => array('food', 'mexican food')
		                )
		           ),
		          'currency'    => 'mxn',
		          'metadata'    => array('test' => 'extra info'),
		          'charges'     => array(
		              array(
		                  'payment_source' => array(
		                      'type'       => 'oxxo_cash',
		                      'expires_at' => strtotime(date("Y-m-d H:i:s")) + "36000"
		                   ),
		                   'amount' => 20000
		                )
		            ),
		            'currency'      => 'mxn',
		            'customer_info' => array(
		                'name'  => 'John Constantine',
		                'phone' => '+5213353319758',
		                'email' => 'hola@hola.com'
		            )
		        );
		
		try {
		  $order = \Conekta\Conekta\Order::create( $valid_order );
		} catch ( \Conekta\Conekta\ProcessingError $e ){ 
		  echo $e->getMessage();
		} catch ( \Conekta\Conekta\ParameterValidationError $e ){
		  echo $e->getMessage();
		} catch ( \Conekta\Conekta\Handler $error ){
		  echo $error->getMessage();
		}
	}

	/**
	 * Mailer
	 */
	public function send_mails( $order_data, $conekta_data ) {

		// get reservation mail template
		$reservacion = '';

		$asunto = "Reservacion: " . $CR . " - Gecko Cancun Tours";

		$empresa = "Gecko Cancun Tours ";
		
		//$correo_empresa="info@geckocancuntours.com, gecko.cancun@outlook.com, kbronzito@hotmail.com, guako@hotmail.com";
		
		$correo_empresa = 'contacto@vexel.mx';
		
		$mime = "MIME-Version:1.0\nContent-type:text/html;charset=UTF-8\nFrom:$empresa<$correo_empresa>";

		// Client email
		mail( $email, $asunto, $reservacion, $mime);
		
		$asunto .= " Copia ";
		
		// admin email
		mail( $correo_empresa, $asunto, $reservacion, $mime);
	}
}