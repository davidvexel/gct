<?php
require_once('../Connections/conexion.php');
include('../include/function.php');
include('include/negar_acceso.php');
mysql_select_db($database_conexion, $conexion); //Conexiona a la base de datos
if (!isset($_SESSION)) {
  session_start();
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$ok = 0;
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

  $updateSQL = sprintf("UPDATE slider SET imgSlider=%s, linkSlider=%s, idiomaSlider=%s, activoSlider=%s WHERE id_slider=%s",
                      GetSQLValueString($_POST['imgSlider'], "text"),
                       GetSQLValueString($_POST['linkSlider'], "text"),
                       GetSQLValueString($_POST['idiomaSlider'], "text"),
                       GetSQLValueString($_POST['activoSlider'], "text"),
					   GetSQLValueString($_POST['id_slider'], "int"));

  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  
  
  $ok = 1;
}

$id_slider = "-1";
if (isset($_GET['id_slider'])) {
  $id_slider = $_GET['id_slider'];
}

$query_slider = sprintf("SELECT * FROM slider WHERE id_slider = %s", GetSQLValueString($id_slider, "int"));
$slider = mysql_query($query_slider, $conexion) or die(mysql_error());
$row_slider = mysql_fetch_assoc($slider);
$totalRows_slider = mysql_num_rows($slider);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<title>Administrador de propiedades</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/script.js"></script>
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
<table width="1000" border="0" align="center" cellpadding="1" cellspacing="0"> 
<tbody> 
<tr> 
<td bgcolor="#333333"> <?php include('include/cabecera.php') ?>
<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%"> 
<tbody> 
<tr> 
<td colspan="4"> 
<table width="1000" align="center" cellpadding="0" cellspacing="0"> 
<tr> 
<td valign="top" align="left" class="leftbg" width="100"> <?php include ('include/menu.php') ?></td> 
<td valign="top"> 
<h2 align="center">Editar Slider</h2>
 <?php if($ok==1){ ?>
<div align="center" class="mensaje_ok">Slider Se edito correctamente</div>
<?php } ?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validacion()">
  <table width="700" border="0" align="center" cellpadding="5" cellspacing="1" >
  <tr valign="baseline">
      <td align="left" valign="middle" colspan="2" background="images/top-menubg.gif" ><b>Agregar Slider</b></td>
      </tr>
        <tr valign="baseline">
      <td width="159" valign="top" bgcolor="#F3F3F3">Imagen:</td>
      <td width="518">
       <?php if($row_slider['imgSlider'] != NULL) { ?>
      <img src="../timthumb.php?src=/imagenes/slider/<? echo $row_slider['imgSlider']; ?>&w=223&h=111&zc=1&q=90" />
      <input name="imgSlider" type="hidden" value="<?php echo $row_slider['imgSlider']; ?>" /><br />
      <a href="eliminar-imagen-slider.php?id_slider=<?php echo $row_slider['id_slider']; ?>&amp;imgSlider=<?php echo $row_slider['imgSlider']; ?>" onclick="return confirm('¿Desea eliminar la foto?');"><b>Eliminar Imagen</b></a>
	  <?php } else { echo '<img src="../timthumb.php?src=/adminpanel/images/img_no.jpg&w=118&h=70&zc=1&q=90" alt="" width="118" height="70" />'; ?> <br />
      <input type="text" name="imgSlider" value="" size="32" />
 <a href="javascript:popupWindow('upload-slider.php',300,200);"><b>Adjuntar imagen</b></a>      <br />
       <i class="row1">Tamaño de la imagen  940 × 420px</i>
	  <?php } ?>
      </td>
    
    <tr valign="baseline">
      <td valign="top" bgcolor="#F3F3F3">Link:</td>
      <td>http://<input type="text" name="linkSlider"  value="<? echo $row_slider['linkSlider']; ?>" size="32" /></td>
    </tr>
    
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Idioma:</td>
      <td><select  name="idiomaSlider">
        <option value="Esp" <?php if (!(strcmp("Esp", $row_slider['idiomaSlider']))) {echo "selected=\"selected\"";} ?>>Español</option>
        <option value="Ing" <?php if (!(strcmp("Ing", $row_slider['idiomaSlider']))) {echo "selected=\"selected\"";} ?>>Ingles</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Activo:</td>
      <td>
        <select  name="activoSlider">
          <option value="SI" <?php if (!(strcmp("SI", $row_slider['activoSlider']))) {echo "selected=\"selected\"";} ?>>SI</option>
          <option value="NO" <?php if (!(strcmp("NO", $row_slider['activoSlider']))) {echo "selected=\"selected\"";} ?>>NO</option>
          </select></td>
    </tr>
    <tr valign="baseline">
      <td>&nbsp;</td>
      <td><input type="submit" value="Editar Slider" /> <input type="button" value="Cerrar" onclick="cerrar();" /></td>
    </tr>
  </table>
  <input type="hidden" name="id_slider" value="<?php echo $row_slider['id_slider']; ?>" />
  <input type="hidden" name="MM_update" value="form1" />
</form>
<p>&nbsp;</p>
<br /></td> 
</tr> 
</table> </td> 
</tr> 
</tbody> 
</table> </td> 
</tr> 
</tbody> 
</table> 
<?php include ('include/pie.php') ?>
<script type="text/javascript">
function cerrar() {
	window.location="admin-slider.php";
	
}
setInterval(function(){ContarCaracteres('textoSlider','Contar1')},55);
</script>
</body>
</html>
<?php
mysql_free_result($slider);
?>