<?php require_once('../../Connections/conexion.php'); ?>
<?
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

mysql_select_db($database, $conexion);

$idEvento = "-1";
if (isset($_GET['idEvento'])) {
  $idEvento = $_GET['idEvento'];
}

$query_Eventos = sprintf("SELECT * FROM Eventos WHERE idEvento = %s ORDER BY idEvento DESC", GetSQLValueString($idEvento, "int"));
$Eventos = mysql_query($query_Eventos, $conexion) or die(mysql_error());
$row_Eventos = mysql_fetch_assoc($Eventos);
$totalRows_Eventos = mysql_num_rows($Eventos);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE Eventos SET nomNovio=%s, nomNovia=%s, lugarEvento=%s, noPersonas=%s, textoEventoEsp=%s, textoEventoIng=%s, imgPrincipal=%s, video=%s, status=%s WHERE idEvento=%s",
                       GetSQLValueString($_POST['nomNovio'], "text"),
                       GetSQLValueString($_POST['nomNovia'], "text"),
                       GetSQLValueString($_POST['lugarEvento'], "date"),
                       GetSQLValueString($_POST['noPersonas'], "int"),
                       GetSQLValueString($_POST['textoEventoEsp'], "text"),
                       GetSQLValueString($_POST['textoEventoIng'], "text"),
                       GetSQLValueString($_POST['imgPrincipal'], "text"),
                       GetSQLValueString($_POST['video'], "text"),
                       GetSQLValueString($_POST['status'], "int"),
                       GetSQLValueString($_POST['idEvento'], "int"));

  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  
  	echo "Evento Actualizado Correctamente..";

}
?>
<script type="text/javascript">

var pag="lista-portafolio.php"
function redireccionar() 
{
location.href = pag
} 
setTimeout ("redireccionar()", 2000);

</script>