<?php
//session_start();

//$code = substr(md5(uniqid(rand())),0,4);

$code = date("jny");
// Define el ancho del texto usando la funcion creada anteriormente.
//$_SESSION['captcha'] = $code;

// Crea una imagen gif en memoria.
$captcha = imagecreatefromgif("imagenes/captcha.gif");

// Asigna un color para una imagen
$letras = imagecolorallocate($captcha,0,0,0);

// Unir el texto en la imagen gif creada.
imagestring($captcha,4,4,6,$code,$letras);

// Pone la imagen en cabezera.
header("Content-type: image/gif");

// Muestra la imagen.
imagegif($captcha);
?>