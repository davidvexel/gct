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

$AgregarEvento = sprintf("INSERT INTO Eventos (idEvento, nomNovio, nomNovia, lugarEvento, noPersonas, textoEventoEsp, textoEventoIng, imgPrincipal, video, status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
	GetSQLValueString($_POST['idEvento'], "int"),
	GetSQLValueString($_POST['nomNovio'], "text"),
	GetSQLValueString($_POST['nomNovia'], "text"),
	GetSQLValueString($_POST['lugarEvento'], "text"),
	GetSQLValueString($_POST['noPersonas'], "int"),
	GetSQLValueString($_POST['textoEventoEsp'], "text"),
	GetSQLValueString($_POST['textoEventoIng'], "text"),
	GetSQLValueString($_POST['imgPrincipal'], "text"),
	GetSQLValueString($_POST['video'], "text"),
	GetSQLValueString($_POST['status'], "int"));

mysql_select_db($database, $conexion);
$Resultados = mysql_query($AgregarEvento, $conexion) or die(mysql_error());
$idEvento = mysql_insert_id(); 

//Se creara una carpeta única con el nombre del ID para almacenar Imágenes y planos de la propiedad.
  $dircarpeta = "../../fotos_eventos/".$idEvento;
  $old = umask(0);
  mkdir($dircarpeta, 0777, true);
  umask($old); 

	echo "Evento Agregado Correctamente..";
}
?>

<body>
<script language="JavaScript" type="text/javascript">

var pag="lista-portafolio.php"
function redireccionar() 
{
location.href = pag
} 
setTimeout ("redireccionar()", 2000);

</script>
             
</body>