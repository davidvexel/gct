<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php'); 
?>
<?php
$ok = 0;
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE `admin` SET usuario=%s, password=%s WHERE id_admin=%s",
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['id_admin'], "int"));

  mysqli_select_db( $conexion, $database_conexion);
  $Result1 = mysqli_query( $conexion, $updateSQL ) or die(mysqli_error());
$ok = 1;
}

mysqli_select_db( $conexion, $database_conexion);
$query_UsuarioPass = "SELECT id_admin, usuario, password FROM `admin` WHERE id_admin = 1";
$UsuarioPass = mysqli_query( $conexion, $query_UsuarioPass ) or die(mysqli_error());
$row_UsuarioPass = mysqli_fetch_assoc($UsuarioPass);
$totalRows_UsuarioPass = mysqli_num_rows($UsuarioPass);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrador de propiedades</title>
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">

function validacion() {
	
	valor = document.getElementById("usuario").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Escribe tu nombre de usuario');
		valor = document.getElementById("usuario").focus();
    	return false;
  }
  
	valor = document.getElementById("password").value;
   if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Escriba una contraseña');
		valor = document.getElementById("password").focus();
    	return false;
  }
  
  valor = document.getElementById("password2").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Repetir contraseña');
		valor = document.getElementById("password2").focus();
    	return false;
  }
  
  if(document.getElementById("password").value != "" && (document.getElementById("password").value == document.getElementById("password2").value)){
	return true;
  }
  
  else{
	alert("Las contraseñas no coinciden");
	return false;
  }
  
   return false;

 }

</script>  
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
<h2 align="center">Actualizar nombre de usuario y contraseña </h2>
<?php if($ok==1){ ?>
<div align="center" class="mensaje_ok">Datos actualizados correctamente</div>
<?php } ?>
<form action="<?php echo $editFormAction; ?>" method="post" id="form1" onsubmit="return validacion()">
  <table width="400" align="center" cellpadding="5" cellspacing="1">
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Usuario:</td>
      <td><input type="text" name="usuario" id="usuario" value="<?php echo htmlentities($row_UsuarioPass['usuario'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Contraseña:</td>
      <td><input type="password" name="password" id="password" value="<?php echo htmlentities($row_UsuarioPass['password'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Repetir contraseña:</td>
      <td><label>
        <input name="password2" type="password" id="password2" size="32" />
      </label></td>
    </tr>
    <tr valign="baseline">
      <td >&nbsp;</td>
      <td><input type="submit" value="Actualizar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_admin" value="<?php echo $row_UsuarioPass['id_admin']; ?>" />
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
mysqli_free_result($UsuarioPass);
?>
