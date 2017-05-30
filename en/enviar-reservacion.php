<?
sleep(3);
include("include/config.php");
if(isset($_POST['reservaciones']) && $_POST['reservaciones'] = 'reservaciones') {
	
session_start();
$_SESSION['id_tour']=NULL;
unset($_SESSION['id_tour']);

//Datos de reservación
		$CR = $_POST['CR'];
        $nom_tour = $_POST['nom_tour'];
        $fecha = $_POST['fecha'];
		$adultos = $_POST['adultos'];
		$precio_adulto = $_POST['precio_adulto'];
		$subtotal1 = $_POST['subtotal1'];
		$ninos = $_POST['ninos'];
		$precio_nino = $_POST['precio_nino'];
		$subtotal2 = $_POST['subtotal2'];
		$total = $_POST['total'];
		$imagen = $_POST['imagen'];
		
		// Datos Personales
		
		$nombre = $_POST['nombre'];			 
		$email = $_POST['email'];
		$telefono = $_POST['telefono'];
		$pais = $_POST['pais'];
		$hotel = $_POST['hotel'];
		$comen = $_POST['comen'];
		$FP = $_POST['FP'];
		
$reservacion = '
		<table  width="726" border="0" cellspacing="0" cellpadding="4" style="margin-bottom:10px; font-family:Arial, Helvetica, sans-serif" align="center">
  <tr>
    <td align="center"><img src="'.$path.'imagenes/logo.png" /></td>
  </tr>
  <tr>
    <td><h2 align="center" style="color:#396F00">Thank you for booking with us</h2>
<div align="center">One of our sales agents will contact you to finalize your reservation</div>
<table width="726" border="0" cellspacing="0" cellpadding="4" style="margin-bottom:10px;">
		<tbody>  
			<tr bgcolor="#396F00">
			  <td bgcolor="#396F00"><h2 style="color:#FFF">Details reservation</h2></td>
			  <td></td>
			  <td>&nbsp;</td>
		  </tr>
			<tr>
   				<td width="530">
                <ul class="datos">
					<li><b>Tour: </b>'.$nom_tour.'</li>
					<li><b>Date: </b>'.$fecha.'</li>
					<li><b>Adults: </b>'.$adultos.' Adutlos ('. $precio_adulto.' c/u) ('. $subtotal1.' sub-total)</li>
					<li><b>Children: </b>'.$ninos.' Menores ('.$precio_nino.' c/u) ('. $subtotal2.' sub-total)</li>
					<li><b>Total: </b>'.$total.'</li>
				</ul>
                </td>
   				<td width="30"></td>
				<td width="164"><img src="'.$path.'timthumb.php?src='.$pathImagen.$imagen.'&w=158&h=106&zc=1&q=90" width="158" height="106" /></td>			</tr>
		</tbody>
	</table>
<table width="726" border="0" cellspacing="0" cellpadding="4" style="margin-bottom:10px;">
		<tbody>  
			<tr>
			  <td bgcolor="#396F00"><h2 style="color:#FFF">Personal Data</h2> </td>
		  </tr>
			<tr>
   				<td>
                <ul class="datos">
					<li><b>Name: </b>'.$nombre.'</li>
					<li><b>Email: </b>'.$email.'</li>
					<li><b>Phone; </b>'.$telefono.'</li>
					<li><b>Conutry: </b>'. $pais.'</li>
                    <li><b>Hotel: </b>'. $hotel.'</li>
					<li><b>Method of payment: </b>'. $FP.'</li>
					<li><b>Comments: </b>'.$comen.'</li>
				</ul>
                </td>
		  </tr>
		</tbody>
	</table>
    <div align="center">
    <h2 style="color:#396F00" >Booking code</h2> <strong>'. $CR. '</strong> <br />
    For any questions or doubts, save your reservation code
    </div>
    </td>
  </tr>
</table>';

$asunto="Reservacion: ".$CR." - Gecko Cancun Tours";
$empresa=" Gecko Cancun Tours ";
$correo_empresa="info@geckocancuntours.com, guillermo.diaz@geckocancuntours.com, aram.diaz@geckocancuntours.com";
mail($email,$asunto,$reservacion,"MIME-Version:1.0\nContent-type:text/html;charset=UTF-8\nFrom:$empresa<$correo_empresa>");
$asunto .= " Copia ";
mail($correo_empresa,$asunto,$reservacion,"MIME-Version:1.0\nContent-type:text/html;charset=UTF-8\nFrom:$empresa<$correo_empresa>");
		
		
?>
<ul class="datos">
    <li>Name <span><?php echo $nombre;  ?></span></li>
    <li>Email<span><?php echo $email; ?></span></li>
    <li>Phone<span><?php echo $telefono; ?></span></li>
    <li>Country<span><?php echo $pais; ?></span></li>
    <li>Hotel<span><?php echo $hotel;  ?></li>
    <li>Method of payment: <span><?php echo $FP ?></span></li>
    <li>Comments<span><?php echo $comen; ?></span></li>
</ul>
<div align="center">
    <h2>Código de reservación</h2> <strong> <?php echo $CR; ?> </strong> <br />
    <strong>Got a copy to your email with all the details of your booking you have made</strong> <br />
   For any questions or doubts, save your reservation code
</div>
<br />
<? } else {
	header("location: index.php");
	}?>