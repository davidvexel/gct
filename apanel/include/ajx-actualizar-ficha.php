<?php require_once('../../Connections/conexion.php'); ?>

<?php
sleep(1);

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  // $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysqli_escape_string($theValue);

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

mysqli_select_db( $conexion, $database );

$idEvento = "-1";
if (isset($_GET['idEvento'])) {
  $idEvento = $_GET['idEvento'];
}

$query_Eventos = sprintf("SELECT * FROM Eventos WHERE idEvento = %s ORDER BY idEvento DESC", GetSQLValueString($idEvento, "int"));
$Eventos = mysqli_query( $conexion, $query_Eventos ) or die(mysqli_error());
$row_Eventos = mysqli_fetch_assoc($Eventos);
$totalRows_Eventos = mysqli_num_rows($Eventos);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE Eventos SET nomNovio=%s, nomNovia=%s, fechaEvento=%s, destinoEvento=%s, lugarEvento=%s, resenaEvento=%s, itinerarioEvento=%s, informacionHospedaje=%s, tipsEvento=%s, imgHospedaje=%s, lat=%s, lon=%s, noPersonas=%s, textoEventoEsp=%s, textoEventoIng=%s, imgPrincipal=%s, video=%s, textoConfirmation=%s, usuario=%s, pass=%s, status=%s WHERE idEvento=%s",
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
                       GetSQLValueString($_POST['status'], "int"),
                       GetSQLValueString($_POST['idEvento'], "int"));

  $Result1 = mysqli_query( $conexion, $updateSQL ) or die(mysqli_error());
  
  	echo "Ficha Actualizada Correctamente..";

}
?>

<body>
<script type="text/javascript">

var pag="lista-fichas.php"
function redireccionar() 
{
location.href = pag
} 
setTimeout ("redireccionar()", 2000);

</script>
             
</body>