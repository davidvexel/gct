<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php'); 
?>
<?php
//envia el formulario a la misma pagina
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($_POST['button'])) {
	//vaciando checkbox
	if(isset($_POST['checkbox']))
	{
		$msg = '';
		foreach ($_POST['checkbox'] as $color)
       		$msg.= $color.'|';
	}
	else
	{
		$msg = '';	
	}
	
	//insercion
  $insertSQL = sprintf("INSERT INTO cupon (nombre, habitacion, servicio, confirmacion, fServicio, pax, listo, hora, proveedor, hotel, representante, fGenera, observacion, recomendaciones) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                    
					   GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['habitacion'], "text"),
                       GetSQLValueString($_POST['tour'], "text"),
                       GetSQLValueString($_POST['confirm'], "text"),
                       GetSQLValueString($_POST['dateservicio'], "date"),
                       GetSQLValueString($_POST['pax'], "text"),
                       GetSQLValueString($_POST['listo'], "text"),
                       GetSQLValueString($_POST['hora'], "date"),
                       GetSQLValueString($_POST['proveedor'], "text"),
                       GetSQLValueString($_POST['hotel'], "text"),
                       GetSQLValueString($_POST['representante'], "text"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['observaciones'], "text"),
                       GetSQLValueString($msg, "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  $ok = 'ok';
  header("Location:add-cupon.php?ok=$ok");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<title>Cupon de Tour</title>
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
<link href="css/jquery-ui-1.7.3.custom.css" rel="stylesheet" type="text/css" media="screen" />

<script language="javascript" type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-ui-1.7.3.js"></script>
<script language="javascript" type="text/javascript" src="js/ui.datepicker.js"></script>
<script>
$(document).ready(function() {
    $('#dateservicio, #fecha').datepicker({});
});
</script>
<script type="text/javascript">
function validacion() {

  valor = document.getElementById("nombre").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Escriba el nombre del Cliente');
		valor = document.getElementById("nombre").focus();
    	return false;
  }
  
  valor = document.getElementById("habitacion").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Escriba el numero de habitación');
		valor = document.getElementById("habitacion").focus();
    	return false;
  }
  
  valor = document.getElementById("tour").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Escriba el nombre del Tour');
		valor = document.getElementById("tour").focus();
    	return false;
  }
  
  valor = document.getElementById("confirm").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Escriba el numero de confirmación');
		valor = document.getElementById("confirm").focus();
    	return false;
  }
  
  valor = document.getElementById("dateservicio").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Seleccione la fecha de servicio');
		valor = document.getElementById("dateservicio").focus();
    	return false;
  }
  
  valor = document.getElementById("pax").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Escriba el numero de Fax');
		valor = document.getElementById("pax").focus();
    	return false;
  }
  
  valor = document.getElementById("listo").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Escriba la localidad en la que debe estar listo');
		valor = document.getElementById("listo").focus();
    	return false;
  }
  
  valor = document.getElementById("proveedor").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Escriba el nombre del Proveedor');
		valor = document.getElementById("proveedor").focus();
    	return false;
  }
  
  valor = document.getElementById("hotel").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Escriba el nombre del Hotel');
		valor = document.getElementById("hotel").focus();
    	return false;
  }
  
  valor = document.getElementById("representante").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Escriba el nombre de un Representante');
		valor = document.getElementById("representante").focus();
    	return false;
  }

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
<h2 align="center">Generar Cupón de Tour<br /></h2>
  <?php
  	if(isset($_GET['ok']))
	{
		?>
        	<span class="mensaje_ok" style="margin-left:150px;">El cupón se ha registrado correctamente</span>
        <?php	
	}
  ?>
  <br />
  <br />
  <!--CONTROLES-->
<form name="form1" id="form1" method="post" action="<?php echo $editFormAction; ?>" onsubmit="return validacion()">
<table width="500" border="0" align="center" cellpadding="5" cellspacing="1" >
  <tr>
    <td colspan="2"><strong>Nombre</strong></td>
    <td colspan="2"><strong>Habitación</strong></td>
  </tr>
  <tr>
    <td colspan="2"><label for="nombre"></label>
      <input name="nombre" type="text" id="nombre" size="40" maxlength="50" /></td>
    <td colspan="2"><label for="habitacion"></label>
      <input name="habitacion" type="text" id="habitacion" size="32" maxlength="50" /></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Servicio</strong></td>
    <td colspan="2"><strong>Confirmación</strong></td>
  </tr>
  <tr>
    <td colspan="2"><label for="tour"></label>
      <input name="tour" type="text" id="tour" size="32" maxlength="50" /></td>
    <td colspan="2"><label for="confirm"></label>
      <input name="confirm" type="text" id="confirm" size="32" maxlength="50" /></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Fecha de Servicio</strong></td>
    <td colspan="2"><strong>Pax</strong></td>
  </tr>
  <tr>
    <td colspan="2"><label for="dateservicio"></label>
      <input name="dateservicio" type="text" id="dateservicio" size="32" /></td>
    <td colspan="2"><label for="pax"></label>
      <input name="pax" type="text" id="pax" size="32" /></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Estar Listo</strong></td>
    <td colspan="2"><strong>Hora</strong></td>
  </tr>
  <tr>
    <td colspan="2"><label for="listo"></label>
      <input name="listo" type="text" id="listo" size="32" /></td>
    <td colspan="2"><label for="hora"></label>
      <input name="hora" type="text" id="hora" size="25" /> 
      HH:MM </td>
  </tr>
  <tr>
    <td colspan="2"><strong>Proveedor</strong></td>
    <td colspan="2"><strong>Hotel</strong></td>
  </tr>
  <tr>
    <td colspan="2"><input name="proveedor" type="text" id="proveedor" size="32" /></td>
    <td colspan="2"><input name="hotel" type="text" id="hotel" size="32" /></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><strong>Recomendaciones</strong></td>
  </tr>
  <tr>
    <td width="100"><input type="checkbox" name="checkbox[]" value="Dinero" />Dinero</td>
    <td width="100"><input type="checkbox" name="checkbox[]" value="Toallas" />Toallas</td>
    <td width="100"><input type="checkbox" name="checkbox[]" value="Bronceador" />Bronceador</td>
    <td width="125"><input type="checkbox" name="checkbox[]" value="Equipo de Snorkel" />Equipo de Snorkel</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox[]" value="Camara" />Cámara</td>
    <td><input type="checkbox" name="checkbox[]" value="Sueter" />Sueter</td>
    <td><input type="checkbox" name="checkbox[]" value="Traje de bano" />Traje de Baño</td>
    <td><input type="checkbox" name="checkbox[]" value="Zapatos comodos" />Zapatos Comodos</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Observaciones</strong></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><label for="observaciones"></label>
      <textarea name="observaciones" cols="50" id="observaciones"></textarea></td>
    </tr>
  <tr>
    <td colspan="2"><strong>Representante</strong></td>
    <td colspan="2"><strong>Fecha</strong></td>
  </tr>
  <tr>
    <td colspan="2"><label for="representante"></label>
      <input name="representante" type="text" id="representante" size="32" /></td>
    <td colspan="2"><label for="fecha"></label>
      <input name="fecha" type="text" id="fecha" size="32" /></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="button" id="button" value="Agregar Cupón" /></td>
    <td colspan="2">&nbsp;</td>
  </tr>
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
