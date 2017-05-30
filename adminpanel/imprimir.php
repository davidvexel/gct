<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php');
?>
<?php
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

$colname_fila = "-1";
if (isset($_GET['folio'])) {
  $colname_fila = $_GET['folio'];
}
mysql_select_db($database_conexion, $conexion);
$query_fila = sprintf("SELECT * FROM cupon WHERE folio = %s", GetSQLValueString($colname_fila, "int"));
$fila = mysql_query($query_fila, $conexion) or die(mysql_error());
$row_fila = mysql_fetch_assoc($fila);
$totalRows_fila = mysql_num_rows($fila);

//Formato Fecha Europea
function formatoFecha($fecha){
	$fechaFinal = date("d-m-Y",strtotime($fecha));
	return $fechaFinal;
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<title>Cup&oacute;n Electr&oacute;nico folio: <?php echo $row_fila['folio']; ?></title>
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
input,select,textarea,label{font:normal 13px Arial, Helvetica, sans-serif; color:#606060; vertical-align:middle;}
input,select,textarea{height:24px; border:#d8d8d8 1px solid; background-color:#f6f6f6; margin-bottom:10px;}
#contenido{margin:0 auto; width:600px; padding:20px; margin-bottom:10px; background-color:#FFF; border:#b9b9b9 1px solid; border-radius:6px; -webkit-border-radius:6px; -moz-border-radius:6px; border-collapse:collapse;}
header{position:relative; width:100%; height:100px; margin-bottom:20px;}
/*logo*/
h1#logo{position:absolute; left:0; top:0;}
h1#logo a{display:block;}
/*datos cabecera*/
#folio,#fecha,#tel{position:absolute; right:0;}
#folio{top:0;}
#fecha{top:40px;}
#tel{top:80px;}
/*cupon*/
form#cupon{width:100%; overflow:hidden; margin:10px auto; text-align:left;}
form#copon small{color:#606060; text-align:center; font-size:11px;}
form#cupon span{color:#F00;} 
form#cupon fieldset{border:none;}
form#cupon label{display:block;}
form#cupon input{width:90%}
form#cupon textarea{width:90%; height:100px;}
form#cupon input, form#cupon select, form#cupon textarea{color:#999;}
form#cupon input[type="checkbox"]{outline:none; width:auto!important; height:auto!important; border:none!important; clear:both; margin-bottom:12px;}
form#cupon button{width:90px; margin:10px auto; display:block;}
.clear{clear:both;}
</style>
</head> 
<body onload="javascript:window.print()"> 

  <!--CONTROLES-->
	<?php
	$mes = date('m');
	switch($mes){
		case '01':
		$mesImp = 'Enero';
		break;
		case '02':
		$mesImp = 'Febrero';
		break;
		case '03':
		$mesImp = 'Marzo';
		break;
		case '04':
		$mesImp = 'Abril';
		break;
		case '05':
		$mesImp = 'Mayo';
		break;
		case '06':
		$mesImp = 'Junio';
		break;
		case '07':
		$mesImp = 'Julio';
		break;
		case '08':
		$mesImp = 'Agosto';
		break;
		case '09':
		$mesImp = 'Septiembre';
		break;
		case '10':
		$mesImp = 'Octubre';
		break;
		case '11':
		$mesImp = 'Noviembre';
		break;
		case '12':
		$mesImp = 'Diciembre';
		break;
	}
	?>
  <div id="contenido">
    <header>
      <h1 id="logo"><img src="../imagenes/logo.png" alt="" width="304" height="94" /></h1>
      <div id="folio">Folio: <strong><?php echo $row_fila['folio']; ?></strong></div>
      <div id="fecha">Cancún Quintana Roo a <strong><?php echo date('d'); ?></strong> de <?php echo $mesImp; ?> del <strong><?php echo date('Y'); ?></strong></div>
      <div id="tel">Teléfono: <strong>(998) 883 23 93</strong>, Cel: <strong>(998) 120 39 78</strong></div>
    </header>
    <!--fin header-->
    <form action="" method="post" id="cupon" onsubmit="return contacto()">
      <fieldset style=" float:left; width:60%">
        <label>Nombre:</label>
        <input name="nombre"  type="text" id="nombre" tabindex="1" value="<?php echo $row_fila['nombre']; ?>" />
        <label>Servicio:</label>
        <input name="servicio"  type="text" id="servicio" tabindex="3" value="<?php echo $row_fila['servicio']; ?>" />
        <label>Fecha de servicio:</label>
        <input name="fservicio"  type="text" id="fservicio" tabindex="5" value="<?php echo $row_fila['fServicio']; ?>" />
        <label>Estar listo:</label>
        <input name="elisto"  type="text" id="elisto" tabindex="7" value="<?php echo $row_fila['listo']; ?>" />
      </fieldset>
      <fieldset style="float:left; width:28%;">
        <label><span>*</span> Habitación:</label>
        <input name="habitacion"  type="text" id="habitacion" tabindex="2" value="<?php echo $row_fila['habitacion']; ?>" />
        <label>Confirmación:</label>
        <input name="confirmacion"  type="text" id="confirmacion" tabindex="4" value="<?php echo $row_fila['confirmacion']; ?>" />
        <label>Pax:</label>
        <input name="pax"  type="text" id="pax" tabindex="6" value="<?php echo $row_fila['pax']; ?>" />
        <label>Hora:</label>
        <input name="hora"  type="text" id="hora" tabindex="8" value="<?php echo $row_fila['hora']; ?>" />
      </fieldset>
      <div class="clear"></div>
      <fieldset style="width:99%">
        <label>Proveedor:</label>
        <input name="proveedor"  type="text" id="proveedor" tabindex="9" value="<?php echo $row_fila['proveedor']; ?>" />
        <label>Hotel:</label>
        <input name="hotel"  type="text" id="hotel" tabindex="9" value="<?php echo $row_fila['hotel']; ?>" />
        <label>Observaciones:</label>
        <textarea name="observaciones" id="observaciones" tabindex="10"><?php echo $row_fila['observacion']; ?></textarea>
      </fieldset>
      <label>Recomendaciones:</label>
      <div class="clear"></div>
      
      <?php
	  $exp = explode('|',$row_fila['recomendaciones']);
	  $max = sizeof($exp) - 1;
	  for($i = 0; $i < $max; $i++)
	  {
		  ?>
          <fieldset style="float:left; width:120px">
			<input type="text" name="reco" id="reco" value="<?php echo $exp[$i].'&nbsp;&nbsp;&nbsp;';?>" />  
		  </fieldset>
		<?php
        }
	  ?>
     
      <div class="clear"></div>
      <fieldset style="float:left; width:60%">
        <label>Representante:</label>
        <input name="representante"  type="text" id="representante" tabindex="11" value="<?php echo $row_fila['representante']; ?>" />
      </fieldset>
      <fieldset style="float:left; width:28%; margin-left:2%;">
        <label>Fecha:</label>
        <input name="fecha" type="text" tabindex="12" value="<?php echo formatoFecha($row_fila['fGenera']); ?>" />
      </fieldset>
      <div class="clear"></div>
      <!-- <button type="submit" name="submit">Enviar</button>-->
    </form>
    <small style="font-size:10px; font-style:italic; text-align:center; display:block; margin:10px 0;">Cupón Electrónico</small>
</div>
</body>
</html>
<?php
mysql_free_result($fila);
?>
