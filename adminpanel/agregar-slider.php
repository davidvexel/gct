<?php 
require_once('../Connections/conexion.php');
include('../include/function.php');
include('include/negar_acceso.php');

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$ok = 0;
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO slider (imgSlider, linkSlider, idiomaSlider, activoSlider) VALUES ( %s, %s, %s, %s)",
                       GetSQLValueString($_POST['imgSlider'], "text"),
                       GetSQLValueString($_POST['linkSlider'], "text"),
                       GetSQLValueString($_POST['idiomaSlider'], "text"),
					   GetSQLValueString($_POST['activoSlider'], "text"));

mysql_select_db($database_conexion, $conexion); //Conexiona a la base de datos
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  
  $ok = 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<title>Administrador de propiedades</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
	//Función apara validar campos
	function validacion() {
		
  valor = document.getElementById("imgSlider").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Adjuntar imagen');
		valor = document.getElementById("imgSlider").focus();
    	return false;
  }
   
  return true;
}

//Funciona Pop Up
function popupWindow(url, width, height) {
	if(width == null){	width =100; }	
	if(height == null){height =100;}
		
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width='+width+',height='+height+',screenX=150,screenY=150,top=150,left=100')
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
<h2 align="center">Agregar Slider</h2>
 <?php if($ok==1){ ?>
<div align="center" class="mensaje_ok">El Slider se agrego correctamente</div>
<?php } ?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validacion()">
  <table width="700" border="0" align="center" cellpadding="5" cellspacing="1" >
  <tr valign="baseline">
      <td align="left" valign="middle" colspan="2" background="images/top-menubg.gif" ><b>Agregar Slider</b></td>
      </tr>
      <tr valign="baseline">
      <td width="159" bgcolor="#F3F3F3">Imagen:</td>
      <td width="518"><input name="imgSlider" type="text" id="imgSlider"  value="" size="32" readonly="readonly" />
      <a href="Javascript:popupWindow('upload-slider.php',300,200);"><b>Adjuntar imagen</b></a>
      <br />
      <i class="row1">Tamaño de la imagen  700 × 340px</i>
      </td>
    </tr>
    <tr valign="baseline">
      <td valign="top" bgcolor="#F3F3F3">Link:</td>
      <td>http://<input type="text" name="linkSlider"  value="" size="32" /></td>
    </tr>
    
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Idioma:</td>
      <td><select  name="idiomaSlider">
        <option value="Esp">Español</option>
        <option value="Ing">Ingles</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Activo:</td>
      <td>
        <select  name="activoSlider">
          <option value="SI">SI</option>
          <option value="NO" selected="selected">NO</option>
          </select></td>
    </tr>
    <tr valign="baseline">
      <td>&nbsp;</td>
      <td><input type="submit" value="Agregar Slider" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<br />
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
