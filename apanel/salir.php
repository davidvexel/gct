<?php
if (!isset($_SESSION)) {
  session_start();
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
	
   // Borra todas las variables de sesión 
  $_SESSION = array(); 
  // Borra la cookie que almacena la sesión 
  if(isset($_COOKIE[session_name()])) { 
    setcookie(session_name(), '', time() - 42000, '/'); 
  } 
  // Finalmente, destruye la sesión 
  session_destroy(); 
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>