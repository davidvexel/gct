<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php'); 
?>
<?php
$ok=0;
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE `admin` SET nombre=%s, empresa=%s, direccion=%s, ciudad=%s, estado=%s, cp=%s, email=%s, sitioweb=%s, telefono=%s, fax=%s, usuario=%s, password=%s WHERE id_admin=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['empresa'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['ciudad'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['cp'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['sitioweb'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['id_admin'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  $ok=1;
}


mysql_select_db($database_conexion, $conexion);
$query_admin = "SELECT * FROM `admin` WHERE id_admin = 1";
$admin = mysql_query($query_admin, $conexion) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);
$totalRows_admin = mysql_num_rows($admin);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrador de propiedades</title>
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
<h2 align="center">Actualizar datos del administrador </h2>
<?php if($ok==1){ ?>
<div align="center" class="mensaje_ok">Datos actualizados correctamente</div>
<?php } ?>

<form action="<?php echo $editFormAction; ?>" method="post" id="form1">
  <table width="500" border="0" align="center"  cellpadding="5" cellspacing="1">
    <tr valign="baseline">
      <td align="left" valign="middle" colspan="2"  background="images/top-menubg.gif"><b>Información admin</b></td>
      </tr>
    <tr valign="baseline">
      <td width="134"  bgcolor="#F3F3F3">Nombre:</td>
      <td width="354"><input type="text" name="nombre" value="<?php echo htmlentities($row_admin['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Empresa:</td>
      <td><input type="text" name="empresa" value="<?php echo htmlentities($row_admin['empresa'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Dirección:</td>
      <td><input type="text" name="direccion" value="<?php echo htmlentities($row_admin['direccion'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Ciudad:</td>
      <td><input type="text" name="ciudad" value="<?php echo htmlentities($row_admin['ciudad'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Estado:</td>
      <td><input type="text" name="estado" value="<?php echo htmlentities($row_admin['estado'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Cp:</td>
      <td><input type="text" name="cp" value="<?php echo htmlentities($row_admin['cp'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Email:</td>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_admin['email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Sitio web:</td>
      <td><input type="text" name="sitioweb" value="<?php echo htmlentities($row_admin['sitioweb'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Teléfono:</td>
      <td><input type="text" name="telefono" value="<?php echo htmlentities($row_admin['telefono'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Fax:</td>
      <td><input type="text" name="fax" value="<?php echo htmlentities($row_admin['fax'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td>&nbsp;</td>
      <td>
      <input type="hidden" name="usuario" value="<?php echo htmlentities($row_admin['usuario'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      <input type="hidden" name="password" value="<?php echo htmlentities($row_admin['password'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      </td>
    </tr>
    <tr valign="baseline">
      <td >&nbsp;</td>
      <td><input type="submit" value="Actualizar Datos" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_admin" value="<?php echo $row_admin['id_admin']; ?>" />
</form>
<p>&nbsp;</p></td> 
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
mysql_free_result($admin);
?>
