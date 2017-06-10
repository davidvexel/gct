<?php
$idioma = "en";
$idiomaDB = "Ing";
$pathHost = "http://www.geckocancuntours.com/";
$pathImagen = "/fotos_tours/principal/";
$carpetaRaiz = "/";
$pathGaleria = "/fotos_tours/";
$page = basename($_SERVER['SCRIPT_NAME']);
if($_SERVER['SERVER_PORT'] and $_SERVER['SERVER_PORT'] <> 80 ){$path = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$carpetaRaiz;}
else {$path = 'http://'.$_SERVER['SERVER_NAME'].$carpetaRaiz;}
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler");
else ob_start(); 
?>