<?php require_once('../Connections/conexion.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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

mysqli_select_db( $conexion, $database_conexion );
$query_fila = "SELECT folio, nombre, servicio, fServicio, hora FROM cupon";
$fila = mysqli_query( $conexion, $query_fila ) or die(mysqli_error());
$row_fila = mysqli_fetch_assoc($fila);
$totalRows_fila = mysqli_num_rows($fila);
?>
<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php'); 
 mysqli_select_db( $conexion, $database_conexion);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<title>Cupon de Tour</title>
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
</head> 
<body> 
<table width="900" border="0" align="center" cellpadding="1" cellspacing="0"> 
<tbody> 
<tr> 
<td bgcolor="#333333"> <?php include('include/cabecera.php') ?>
<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%"> 
<tbody> 
<tr> 
<td colspan="4"> 
<table width="900" align="center" cellpadding="0" cellspacing="0"> 
<tr> 
<td valign="top" align="left" class="leftbg" width="100"> <?php include ('include/menu.php') ?></td> 
<td valign="top"> 
<h2 align="center">Administrar Cupones<br /></h2>
  <br />
  <br />
  <!--CONTROLES-->
<form name="form1" id="form1" method="post" action="">
    <table width="700" align="center" cellpadding="5" cellspacing="1">
    <tr align="center"  background="images/top-menubg.gif">
      <td width="10%"><strong>Folio</strong></td>
      <td width="22%"><strong>Nombre</strong></td>
      <td width="19%"><strong>Servicio</strong></td>
      <td width="20%"><strong>Fecha/Servicio</strong></td>
      <td width="11%"><strong>Hora</strong></td>
      <td width="18%"><strong>Acciones</strong></td>
    </tr>
       <?php $tr = 0;?>
    <?php do { ?>
      <tr align="center" <?php if ($tr++%2!=0) echo "bgcolor=\"#F3F3F3\"";?>>
        <td><?php echo $row_fila['folio']; ?></td>
        <td><?php echo $row_fila['nombre']; ?></td>
        <td><?php echo $row_fila['servicio']; ?></td>
        <td><?php echo $row_fila['fServicio']; ?></td>
        <td><?php echo $row_fila['hora']; ?></td>
        <td><a href="edit-cupon.php?folio=<?php echo $row_fila['folio']; ?>">[Editar]</a>&nbsp;&nbsp;&nbsp;<a href="imprimir.php?folio=<?php echo $row_fila['folio']; ?>" target="_blank">[Imprimir]</a></td>
      </tr>
      <?php } while ($row_fila = mysqli_fetch_assoc($fila)); ?>
  </table>
</form>
<!--END CONTROLES-->
<h2 align="center">&nbsp; </h2></td> 
</tr> 
</table> </td> 
</tr> 
</tbody> 
</table> </td> 
</tr> 
</tbody> 
</table> 
<?php include ('include/pie.php') ?>
</body>
</html>
<?php
mysqli_free_result($fila);
?>
