<?php 

sleep(1);

if(isset($_POST["name"])) {
	
	$contactoEmail = "info@geckocancuntours.com, gecko.cancun@outlook.com, kbronzito@hotmail.com, guako@hotmail.com";
	if($_POST['name'] == "") {
	$formAsunto = 'Información de Contacto';
	} else {
		$formAsunto = $_POST['subject'];
		
		}
	
	
	$formNombre = $_POST["name"];
	$formTelefono = $_POST["phone"];
	$formEmail = $_POST["email"];
	$formMensaje = $_POST["message"];
	$formAsunto = $_POST["subject"];

	$headers  = "MIME-Version:1.0\nContent-type:text/html;charset=UTF-8\nFrom:".$formEmail;
	
	$mensaje = "<h2>Información de Contacto</h2>";
	$mensaje .= "<b>Nombre: </b> " . $formNombre . "<br />";
	$mensaje .= "<b>Email: </b> " . $formEmail . "<br />";
	$mensaje .= "<b>Teléfono: </b> " . $formTelefono . "<br />";
	$mensaje .= "<b>Asunto: </b> " . $formAsunto . "<br />";
	$mensaje .= "<b>Comentarios: </b> " . $formMensaje . "<br />";
	$mensaje .= "<b>Fecha de envío : </b> " . date('d/m/Y', time()) . "<br />";
	
	$status = @mail($contactoEmail, $formAsunto, $mensaje, $headers);
	
	if($status == true){
	
	echo 'Your message was successfully sent!';
	
	} else {
		echo 'Existen problemas con el servidor de correo. Intente más tarde';
		}

}
	

?>