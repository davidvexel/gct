<?php
	require_once('Connections/conexion.php');
	include("include/config.php");
	include('include/function.php');
	include('include/idiomas/'.$idioma.'.php');
	include( 'include/class-orders.php' );
	header("X-UA-Compatible: IE=edge,chrome=1");
	
	//initialize the session
	if ( ! isset( $_SESSION ) ) {
	  session_start();
	}
	
	mysqli_select_db( $conexion, $database_conexion ); //Conexiona a la base de datos
	
	$query_tour = sprintf(" SELECT * FROM tours AS T INNER JOIN localizacion AS L ON (T.localizacion_id = L.id_localizacion) "
				." INNER JOIN  categorias AS C ON (T.cat_id = C.id_cat) WHERE listado = 'SI' AND id_tour = %s", GetSQLValueString($_SESSION['id_tour'], "int"));
	$tour = mysqli_query( $conexion, $query_tour) or die( mysqli_error( $conexion ) );
	$row_tour = mysqli_fetch_assoc( $tour );
	$totalRows_tour = mysqli_num_rows( $tour );
	
	if( $totalRows_tour === 0 ) {
		header("location: index.php");
	}
		
	?>
<?php include("include/html.php"); ?>
<head>
	<?php include("include/meta.php"); ?>
	<meta name="description" content="">
	<title><?php echo EMPRESA; ?></title>
	<?php include("include/css.php"); ?>
	<?php include("include/ico.php"); ?>
	<script src="<?php echo $path; ?>js/modernizr.custom.js"></script>
</head>
<body>
	<div id="wrapper">
		<div class="container">
			<?php include("include/header.php"); ?>
			<?php include("include/aside.php"); ?>
			<div class="twelve columns">
				<p class="titulo">Reservacion</p>
				<p><?php echo TEXTO_RESERVAR; ?></p>
				<p class="titulo"><?php echo DETALLESRESERVACION; ?></p>
				<?php 
					$tour_id = $row_tour['id_tour'];
					$nom_tour = $row_tour['nom_tour'];
					$fecha = $_SESSION['fecha'];
					$tm = $row_tour['tm'];
					$imagen = $row_tour['imagen'];
					// Calculo del sub-total de adultos
					$adultos = $_SESSION['adultos'];
					$precio_adulto = $row_tour['precio_adulto'];
					$subtotal1 = $adultos * $precio_adulto;
					// Calculo del sub-total de niños
					$ninos = $_SESSION['ninos'];
					$precio_nino = $row_tour['precio_nino'];
					$subtotal2 = $ninos * $precio_nino;
					$total = $subtotal1 + $subtotal2;
					
					?>
				<div class="three columns alpha">
					<img src="<?php echo $path; ?>timthumb.php?src=<?php echo $pathImagen.$imagen; ?>&amp;w=160&amp;h=120&amp;zc=1&amp;q=90" alt="img01" title="img01" class="imagen radius mbottom">
				</div>
				<!--three.columns-->
				<div class="nine columns omega">
					<ul class="datos">
						<li>Tour <span><?php echo $nom_tour ?></span></li>
						<li>Fecha <span><?php echo $fecha; ?></span></li>
						<li>Adultos <span><?php echo $adultos; ?> Adultos ($<?php echo $precio_adulto. " " .$tm; ?> c/u) ($<?php print $subtotal1. " " .$tm; ?> sub-total)</span></li>
						<li>Niños <span><?php echo $ninos; ?> Niños ($<?php echo $precio_nino. " " .$tm; ?> c/u) ($<?php print $subtotal2. " " .$tm; ?> sub-total)</span></li>
						<li>Total <b><span>$<?php print $total. " " .$tm; ?></span></b></li>
					</ul>
				</div>
				<!--nine.columns-->
				<div class="clear"></div>
				<p class="titulo"><?php echo INFORMACIONGENERAL; ?></p>
				<div id="msn"></div>
				<form class="formulario" id="formulario">
					<fieldset class="six columns alpha">
						<label><?php echo FORMNOMBRE; ?> <span>*</span></label>
						<input name="nombre" id="nombre" type="text" tabindex="1" data-conekta="card[name]" required="required">
						
						<label><?php echo FORMCORREO; ?> <span>*</span></label>
						<input name="email" id="email" type="email" tabindex="3" required="required">

						<label>Dirección</label>
						<input name="direccion"  id="direccion" type="text" tabindex="5">

					</fieldset>

					<fieldset class="six columns omega">
						
						<label><?php echo FORMTELEFONO; ?> <span>*</span></label>
						<input name="telefono" id="telefono" type="text" tabindex="2" required="required">
						
						<label><?php echo FORMPAIS; ?></label>
						<select name="pais" id="pais" tabindex="4">
							<option>Afghanistan</option>
							<option>Albania</option>
							<option>Algeria</option>
							<option>American Samoa</option>
							<option>Andorra</option>
							<option>Angola</option>
							<option>Anguilla</option>
							<option>Antarctica</option>
							<option>Antigua and Barbuda</option>
							<option>Argentina</option>
							<option>Armenia</option>
							<option>Aruba</option>
							<option>Australia</option>
							<option>Austria</option>
							<option>Azerbaidjan</option>
							<option>Bahamas</option>
							<option>Bahrain</option>
							<option>Bangladesh</option>
							<option>Barbados</option>
							<option>Belarus</option>
							<option>Belgium</option>
							<option>Belize</option>
							<option>Benin</option>
							<option>Bermuda</option>
							<option>Bhutan</option>
							<option>Bolivia</option>
							<option>Bosnia-Herzegovina</option>
							<option>Botswana</option>
							<option>Bouvet Island</option>
							<option>Brazil</option>
							<option>British Indian Ocean</option>
							<option>Brunei Darussalam</option>
							<option>Bulgaria</option>
							<option>Burkina Faso</option>
							<option>Burundi</option>
							<option>Cambodia</option>
							<option>Cameroon</option>
							<option>Canada</option>
							<option>Cape Verde</option>
							<option>Cayman Islands</option>
							<option>Central African Republic</option>
							<option>Chad</option>
							<option>Chile</option>
							<option>China</option>
							<option>Christmas Island</option>
							<option>Cocos (Keeling) Islands</option>
							<option>Colombia</option>
							<option>Comoros</option>
							<option>Congo</option>
							<option>Cook Islands</option>
							<option>Costa Rica</option>
							<option>Croatia</option>
							<option>Cuba</option>
							<option>Cyprus</option>
							<option>Czech Republic</option>
							<option>Denmark</option>
							<option>Djibouti</option>
							<option>Dominica</option>
							<option>Dominican Republic</option>
							<option>East Timor</option>
							<option>Ecuador</option>
							<option>Egypt</option>
							<option>El Salvador</option>
							<option>Equatorial Guinea</option>
							<option>Estonia</option>
							<option>Ethiopia</option>
							<option>Falkland Islands</option>
							<option>Faroe Islands</option>
							<option>Fiji</option>
							<option>Finland</option>
							<option>Former USSR</option>
							<option>France</option>
							<option>French Guyana</option>
							<option>French Southern Territories</option>
							<option>Gabon</option>
							<option>Gambia</option>
							<option>Georgia</option>
							<option>Germany</option>
							<option>Ghana</option>
							<option>Gibraltar</option>
							<option>Great Britain/UK</option>
							<option>Greece</option>
							<option>Greenland</option>
							<option>Grenada</option>
							<option>Guadeloupe (French)</option>
							<option>Guam (USA)</option>
							<option>Guatemala</option>
							<option>Guinea</option>
							<option>Guinea Bissau</option>
							<option>Guyana</option>
							<option>Haiti</option>
							<option>Heard & McDonald Islands</option>
							<option>Honduras</option>
							<option>Hong Kong</option>
							<option>Hungary</option>
							<option>Iceland</option>
							<option>India</option>
							<option>Indonesia</option>
							<option>Iran</option>
							<option>Iraq</option>
							<option>Ireland</option>
							<option>Israel</option>
							<option>Italy</option>
							<option>Ivory Coast</option>
							<option>Jamaica</option>
							<option>Japan</option>
							<option>Jordan</option>
							<option>Kazakhstan</option>
							<option>Kenya</option>
							<option>Kiribati</option>
							<option>Kuwait</option>
							<option>Kyrgyzstan</option>
							<option>Laos</option>
							<option>Latvia</option>
							<option>Lebanon</option>
							<option>Lesotho</option>
							<option>Liberia</option>
							<option>Libya</option>
							<option>Liechtenstein</option>
							<option>Lithuania</option>
							<option>Luxembourg</option>
							<option>Macau</option>
							<option>Macedonia</option>
							<option>Madagascar</option>
							<option>Malawi</option>
							<option>Malaysia</option>
							<option>Maldives</option>
							<option>Mali</option>
							<option>Malta</option>
							<option>Marshall Islands</option>
							<option>Martinique</option>
							<option>Mauritania</option>
							<option>Mauritius</option>
							<option>Mayotte</option>
							<option selected="selected">Mexico</option>
							<option>Micronesia</option>
							<option>Moldavia</option>
							<option>Monaco</option>
							<option>Mongolia</option>
							<option>Montserrat</option>
							<option>Morocco</option>
							<option>Mozambique</option>
							<option>Myanmar</option>
							<option>Namibia</option>
							<option>Nauru</option>
							<option>Nepal</option>
							<option>Netherlands</option>
							<option>Netherlands Antillas</option>
							<option>Neutral Zone</option>
							<option>New Caledonia</option>
							<option>New Zealand</option>
							<option>Nicaragua</option>
							<option>Niger</option>
							<option>Nigeria</option>
							<option>Niue</option>
							<option>Norfolk Island</option>
							<option>North Corea</option>
							<option>Northern Mariana Islands</option>
							<option>Norway</option>
							<option>Oman</option>
							<option>Otro</option>
							<option>Pakistan</option>
							<option>Palau</option>
							<option>Panama</option>
							<option>Papua New Guinea</option>
							<option>Paraguay</option>
							<option>Peru</option>
							<option>Philippines</option>
							<option>Pitcairn Island</option>
							<option>Poland</option>
							<option>Polynesia</option>
							<option>Portugal</option>
							<option>Puerto Rico</option>
							<option>Qatar</option>
							<option>Reunion</option>
							<option>Romania</option>
							<option>Russian Federation</option>
							<option>Rwanda</option>
							<option>S. Georgia Is. </option>
							<option>Saint Helena</option>
							<option>Saint Kitts & Nevis Anguilla</option>
							<option>Saint Lucia</option>
							<option>Saint Pierre and Miquelon</option>
							<option>Saint Tome and Principe</option>
							<option>Saint Vicent & Grenadines</option>
							<option>Samoa</option>
							<option>San Marino</option>
							<option>Saudi Arabia</option>
							<option>Senegal</option>
							<option>Seychelles</option>
							<option>Sierra Leone</option>
							<option>Singapore</option>
							<option>Slovak Republic</option>
							<option>Slovenia</option>
							<option>Solomon Islands</option>
							<option>Somalia</option>
							<option>South Africa</option>
							<option>South Corea</option>
							<option>Spain</option>
							<option>Sri Lanka</option>
							<option>Sudan</option>
							<option>Suriname</option>
							<option>Svalvard & Jan Mayen Is.</option>
							<option>Swaziland</option>
							<option>Sweden</option>
							<option>Switzerland</option>
							<option>Syria</option>
							<option>Tadjikistan</option>
							<option>Taiwan</option>
							<option>Tanzania</option>
							<option>Thailand</option>
							<option>Togo</option>
							<option>Tokelau</option>
							<option>Tonga</option>
							<option>Trinidad and Tobago</option>
							<option>Tunisia</option>
							<option>Turkey</option>
							<option>Turkmenistan</option>
							<option>Turks and Caicos Islands</option>
							<option>Tuvalu</option>
							<option>Uganda</option>
							<option>Ukraine</option>
							<option>United Arab Emirates</option>
							<option>United States</option>
							<option>Uruguay</option>
							<option>USA Military</option>
							<option>USA Minor Outlying Islands</option>
							<option>Uzbekistan</option>
							<option>Vanuatu</option>
							<option>Vatican City State</option>
							<option>Venezuela</option>
							<option>Vietnam</option>
							<option>Virgin Islands (British)</option>
							<option>Virgin Islands (USA)</option>
							<option>Wallis and Futura Islands</option>
							<option>Western Sahara</option>
							<option>Yemen</option>
							<option>Yugoslavia</option>
							<option>Zaire</option>
							<option>Zambia</option>
							<option>Zimbabwe</option>
						</select>
						
						<label><?php echo 'Hotel'; ?></label>
						<input type="text" name="hotel" tabindex="6" />


					</fieldset>
					<div class="clear"></div>
					<label><?php echo FORMMENSAJE; ?></label>
					<textarea name="comen" id="comen" tabindex="7"></textarea>
					
					<div class="clear"></div>
					<p class="titulo"><?php echo 'Detalles de Pago'; ?></p>
					
					<p>Sleccione su metodo de pago</p>

					<div class="payments">
						<div class="method">
							<input id="bank" type="radio" name="payment" checked="checked" value="bank" tabindex="8"> 
							<label for="bank">Transferencia o Depósito</label>
						</div>
						<div class="method">
							<input id="oxxo" type="radio" name="payment" value="oxxo">
							<label for="oxxo">OXXO</label>
						</div>
						<div class="method">
							<input id="card" type="radio" name="payment" value="card">
							<label for="card">Tarjeta de Crédito</label>
						</div>
					</div>
					
					<!-- Card payment details -->
					<div id="card-payment" style="display:none">
						<fieldset class="four columns alpha">
							<label for="">Numero de Tarjeta</label>
							<input type="text" size="20" data-conekta="card[number]">
						</fieldset>

						<fieldset class="eight columns omega">
							<label for="">Expiración</label>
							<select class="third" id="exp_month" data-conekta="card[exp_month]">
								<option value="01">Ene</option>
							</select>

							<select class="third" id="exp_year" data-conekta="card[exp_year]">
								<option value="18">2018</option>
							</select>

							<input class="third" type="password" size="4" data-conekta="card[cvc]" placeholder="CVV">
						</fieldset>
						<br><br>
					</div>
					
					<div class="card-errors"></div>

					</br></br>

					<label><?php echo FORMCODIGO; ?> <span>*</span></label>
					
					<input name="codigo" id="codigo" type="text" class="captcha" tabindex="9" autocomplete="off" maxlength="6"  required="required">
					
					<button type="submit"><?php echo FORMCONFIRMAR; ?></button>
					
					<p><small><span>*</span> <?php echo FORMOBLIGATORIO; ?></small></p>
					<p><small><span>*</span> <?php echo FORMTERMS; ?></small></p>

					<!-- Información de seguridad -->
					<!-- Metodos de pago aceptados -->
					<!-- Al hacer click acepto los terminos y condiciones -->

					<input type="hidden" name="reservaciones" value="reservaciones" />
					<input type="hidden" name="tour_id" value="<?php echo $tour_id; ?>" />
					<input type="hidden" name="nom_tour" value="<?php echo $nom_tour; ?>" />
					<input type="hidden" name="fecha" value="<?php echo $fecha; ?>" />
					<input type="hidden" name="adultos" value="<?php echo $adultos; ?>" />
					<input type="hidden" name="precio_adulto" value="<?php echo $precio_adulto. " " .$tm; ?>" />
					<input type="hidden" name="subtotal1" value="<?php print $subtotal1. " " .$tm; ?>" />
					<input type="hidden" name="ninos" value="<?php echo $ninos; ?>" />
					<input type="hidden" name="precio_nino" value="<?php echo $precio_nino. " " .$tm; ?>" />
					<input type="hidden" name="subtotal2" value="<?php print $subtotal2. " " .$tm; ?>" />
					<input type="hidden" name="total" value="<?php print $total. " " .$tm; ?>" />
					<input type="hidden" name="imagen" value="<?php echo $imagen; ?>" />
				</form>
			</div>
			<!--.twelve .columns-->
		</div>
		<!--fin .container-->
	</div>
	<!--fin #wrapper-->
	<?php include("include/footer.php"); ?>
	<?php include("include/script.php"); ?>
</body>
</html>
<?php
	mysqli_free_result($tour);
?>