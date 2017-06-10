<?php
$MM_restrictGoTo = "index.php";
$MM_donotCheckaccess = "false";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

//Caducar la session del usuario después de 60 minutos de inactividad
$segundos = time();
$tiempo_transcurrido = $segundos;
$tiempo_maximo = $_SESSION['inicio'] + ( $_SESSION['intervalo'] * 60 ) ; // se multiplica por 60 segundos ya que se configura en minutos
if($tiempo_transcurrido > $tiempo_maximo){
  header("Location: salir.php?doLogout=true"); 
}else{
// se resetea el inicio
$_SESSION['inicio'] = time();
}

?>