<?php require_once('../Connections/conexion.php'); ?>
<?php include('../include/function.php'); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "inicio.php";
  $MM_redirectLoginFailed = "index.php?error=true";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conexion, $conexion);
  
  $LoginRS__query=sprintf("SELECT usuario, password FROM `admin` WHERE usuario=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conexion) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>&Aacute;rea de Administraci&oacute;n</title>
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" /> 
</head> 
<body> 
<table border="0" cellpadding="1" cellspacing="0" width="900" align="center"> 
<tbody> 
<tr> 
<td bgcolor="#333333"> 
<?php include('include/cabecera.php'); ?>
<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="900"> 
<tbody> 
<tr> 
<td colspan="4"> 
<table width="90%" align="center" cellpadding="0" cellspacing="0"> 
<tr> 
<td valign="top"> 
<h2 align="center">&Aacute;rea de Administración</h2> 

<?php if ( !empty($_GET['error']) ) { ?>
<div align="center" style="color:#900">El usuario  o la contraseña son incorrectas. Vuelva a intentarlo.</div>
<?php } ?>

<table width="500" cellpadding="5" cellspacing="1" align="center">
<tr valign="middle">
<td bgcolor="#F3F3F3" valign="middle" align="center" height="90">

<form action="<?php echo $loginFormAction; ?>" name="form1" method="POST">
<table cellpadding="2" cellspacing="5">
<tr>
<td>
<b>Usuario:</b>&nbsp;</td>
<td align="left"><input name="usuario" type="text" id="usuario" /></td>

</tr>
<tr>
<td>
<b>Contraseña:</b>&nbsp;</td>
<td align="left">
<input name="pass" type="password" id="pass"/>
&nbsp;</td>
</tr>
<tr>
  <td align="right">&nbsp;</td>
  <td align="left"><input type="submit" value="Entrar" /></td>
</tr>
</table>
</form></td>
</tr>
</table>
<br />

</td> 

</tr> 
</table> 
<br /><br /><br />
</td> 
</tr> 
</tbody> 
</table> </td> 
</tr> 
</tbody> 
</table> 
</body>
</html>
