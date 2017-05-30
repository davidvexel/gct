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
    <td><h2 align="center" style="color:#396F00">Gracias por reservar con nosotros</h2>
<div align="center">Unos de nuestros agentes de venta se comunicara con usted para concretar su reservación</div>
<table width="726" border="0" cellspacing="0" cellpadding="4" style="margin-bottom:10px;">
		<tbody>  
			<tr bgcolor="#396F00">
			  <td bgcolor="#396F00"><h2 style="color:#FFF">Datos de la resevación</h2></td>
			  <td></td>
			  <td>&nbsp;</td>
		  </tr>
			<tr>
   				<td width="530">
                <ul class="datos">
					<li><b>Tour: </b>'.$nom_tour.'</li>
					<li><b>Fecha: </b>'.$fecha.'</li>
					<li><b>Adultos: </b>'.$adultos.' Adutlos ('. $precio_adulto.' c/u) ('. $subtotal1.' sub-total)</li>
					<li><b>Menores: </b>'.$ninos.' Menores ('.$precio_nino.' c/u) ('. $subtotal2.' sub-total)</li>
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
			  <td bgcolor="#396F00"><h2 style="color:#FFF">Datos Personales</h2> </td>
		  </tr>
			<tr>
   				<td>
                <ul class="datos">
					<li><b>Nombre: </b>'.$nombre.'</li>
					<li><b>Correo: </b>'.$email.'</li>
					<li><b>Teléfono; </b>'.$telefono.'</li>
					<li><b>País: </b>'. $pais.'</li>
                    <li><b>Hotel: </b>'. $hotel.'</li>
					<li><b>Forma de pago: </b>'. $FP.'</li>
					<li><b>Comentarios: </b>'.$comen.'</li>
				</ul>
                </td>
		  </tr>
		</tbody>
	</table>
    <div align="center">
    <h2 style="color:#396F00" >Código de reservación</h2> <strong>'. $CR. '</strong> <br />
    Para cualquiera duda o aclaración guarde su código de reservación
    </div>
    </td>
  </tr>
</table>';

$asunto="Reservacion: ".$CR." - Gecko Cancun Tours";
$empresa=" Gecko Cancun Tours ";
$correo_empresa="info@geckocancuntours.com, gecko.cancun@outlook.com, kbronzito@hotmail.com, guako@hotmail.com";
mail($email,$asunto,$reservacion,"MIME-Version:1.0\nContent-type:text/html;charset=UTF-8\nFrom:$empresa<$correo_empresa>");
$asunto .= " Copia ";
mail($correo_empresa,$asunto,$reservacion,"MIME-Version:1.0\nContent-type:text/html;charset=UTF-8\nFrom:$empresa<$correo_empresa>");
		
		
?>
<ul class="datos">
    <li>Nombre <span><?php echo $nombre;  ?></span></li>
    <li>Correo<span><?php echo $email; ?></span></li>
    <li>Teléfono<span><?php echo $telefono; ?></span></li>
    <li>País<span><?php echo $pais; ?></span></li>
    <li>Hotel<span><?php echo $hotel;  ?></span></li>
    <li>Forma de pago: <span><?php echo $FP ?></span></li>
    <li>Comentarios<span><?php echo $comen; ?></span></li>
</ul>
<div align="center">
    <h2>Código de reservación</h2> <strong> <?php echo $CR; ?> </strong> <br />
    <strong>Llegara  a su correo una copia con todos los datos de la reservación que ha realizado</strong> <br />
    Para cualquiera duda o aclaración guarde su código de reservación
</div>
<br />
<?php } else {
	header("location: index.php");
	}?>