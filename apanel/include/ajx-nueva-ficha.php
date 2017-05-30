<?php require_once('../../Connections/conexion.php'); ?>

<?php
sleep(1);

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

$AgregarEvento = sprintf("INSERT INTO Eventos (idEvento, nomNovio, nomNovia, fechaEvento, destinoEvento, lugarEvento, resenaEvento, itinerarioEvento, informacionHospedaje, tipsEvento, imgHospedaje, lat, lon, noPersonas, textoEventoEsp, textoEventoIng, imgPrincipal, video,  textoConfirmation, usuario, pass, status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
	GetSQLValueString($_POST['idEvento'], "int"),
	GetSQLValueString($_POST['nomNovio'], "text"),
	GetSQLValueString($_POST['nomNovia'], "text"),
	GetSQLValueString($_POST['fechaEvento'], "text"),
	GetSQLValueString($_POST['destinoEvento'], "text"),
	GetSQLValueString($_POST['lugarEvento'], "text"),
	GetSQLValueString($_POST['resenaEvento'], "text"),
	GetSQLValueString($_POST['itinerarioEvento'], "text"),
	GetSQLValueString($_POST['informacionHospedaje'], "text"),
	GetSQLValueString($_POST['tipsEvento'], "text"),
	GetSQLValueString($_POST['imgHospedaje'], "text"),
	GetSQLValueString($_POST['lat'], "text"),
	GetSQLValueString($_POST['lon'], "text"),
	GetSQLValueString($_POST['noPersonas'], "int"),
	GetSQLValueString($_POST['textoEventoEsp'], "text"),
	GetSQLValueString($_POST['textoEventoIng'], "text"),
	GetSQLValueString($_POST['imgPrincipal'], "text"),
	GetSQLValueString($_POST['video'], "text"),
	GetSQLValueString($_POST['textoConfirmation'], "text"),
	GetSQLValueString($_POST['usuario'], "text"),
	GetSQLValueString($_POST['pass'], "text"),
	GetSQLValueString($_POST['status'], "int"));

mysql_select_db($database, $conexion);
$Resultados = mysql_query($AgregarEvento, $conexion) or die(mysql_error());
$idEvento = mysql_insert_id(); 

//Se creara una carpeta única con el nombre del ID para almacenar Imágenes.
  $direventos = "../../fotos_eventos/".$idEvento;
  $old = umask(0);
  mkdir($direventos, 0777, true);
  umask($old); 

  $dirficha = "../../fotos_ficha/".$idEvento;
  $oldx = umask(0);
  mkdir($dirficha, 0777, true);
  umask($oldx); 

  $dirhospedaje = "../../fotos_hospedaje/".$idEvento;
  $oldy = umask(0);
  mkdir($dirhospedaje, 0777, true);
  umask($oldy); 

  $dirtips = "../../fotos_tips/".$idEvento;
  $oldz = umask(0);
  mkdir($dirtips, 0777, true);
  umask($oldz); 

	echo "Ficha Agregada Correctamente..";
}
?>

<body>
<script language="JavaScript" type="text/javascript">

var pag="lista-fichas.php"
function redireccionar() 
{
location.href = pag
} 
setTimeout ("redireccionar()", 2000);

</script>
             
</body>