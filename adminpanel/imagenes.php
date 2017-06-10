<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php'); 
include( "include/resizer.php" );
$max_image_resize_width = 476;
?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
mysqli_select_db( $conexion, $database_conexion);
$colname_tour = "-1";
if (isset($_GET['id_tour'])) {
  $colname_tour = $_GET['id_tour'];
}
$query_tour = sprintf("SELECT id_tour, nom_tour FROM tours WHERE id_tour = %s", GetSQLValueString($colname_tour, "int"));
$tour = mysqli_query( $conexion, $query_tour ) or die(mysqli_error());
$row_tour = mysqli_fetch_assoc($tour);


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
	 for ($i = 0; $i < 20; ++$i){
		$imagenes[$i] = "";
		 $t = "imagen".($i + 1);
		error_log ( "Comprobación de imagen" . ( $i + 1 ) );
		
		 if ( !isset ( $_FILES [$t]) || !is_uploaded_file ( $_FILES [$t] ['tmp_name'] ) ) {
			 
          error_log ( "Breaking, no uploaded file?" );
        continue;
      }
		
		if ($_FILES [$t] ["error"] == UPLOAD_ERR_OK )
      {
        $tmp_name = $_FILES [$t] ["tmp_name"];
        $name = $_FILES [$t] ["name"];
		$imagenes[$i] = $colname_tour."-".$name;
		$destino =  "../fotos_tours/$colname_tour";
		ResizeConserveAspectRatio($tmp_name, $destino . "/" . $imagenes[$i], $max_image_resize_width); 
		
		 
	}
	 }
	
  $updateSQL = sprintf("UPDATE imagenes SET imagen1=%s, imagen2=%s, imagen3=%s, imagen4=%s, imagen5=%s, imagen6=%s, imagen7=%s, imagen8=%s, imagen9=%s, imagen10=%s, imagen11=%s, imagen12=%s, imagen13=%s, imagen14=%s, imagen15=%s, imagen16=%s, imagen17=%s, imagen18=%s, imagen19=%s, imagen20=%s WHERE id_imagen=%s",
                       GetSQLValueString($imagenes [0], "text"),
                       GetSQLValueString($imagenes [1], "text"),
					   					 GetSQLValueString($imagenes [2], "text"),
                       GetSQLValueString($imagenes [3], "text"),
                       GetSQLValueString($imagenes [4], "text"),
                       GetSQLValueString($imagenes [5], "text"),
                       GetSQLValueString($imagenes [6], "text"),
                       GetSQLValueString($imagenes [7], "text"),
                       GetSQLValueString($imagenes [8], "text"),
                       GetSQLValueString($imagenes [9], "text"),
                       GetSQLValueString($imagenes [10], "text"),
                       GetSQLValueString($imagenes [11], "text"),
                       GetSQLValueString($imagenes [12], "text"),
                       GetSQLValueString($imagenes [13], "text"),
                       GetSQLValueString($imagenes [14], "text"),
                       GetSQLValueString($imagenes [15], "text"),
                       GetSQLValueString($imagenes [16], "text"),
                       GetSQLValueString($imagenes [17], "text"),
                       GetSQLValueString($imagenes [18], "text"),
                       GetSQLValueString($imagenes [19], "text"),
                       GetSQLValueString($_POST['id_imagen'], "int"));

  $Result1 = mysqli_query( $conexion, $updateSQL ) or die(mysqli_error());

  header("Location: imagenes-ok.php");
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Administrador de toures</title>
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
<!--
function GetFileExtension(Filename) {
var I = Filename.lastIndexOf(".");
return (I > -1) ? Filename.substring(I + 1, Filename.length).toLowerCase() : "";

}

function BeforeSubmit() {
var Form = document.form1;
var imagen1 = Form.imagen1.value;
var imagen2 = Form.imagen2.value;
var imagen3 = Form.imagen3.value;
var imagen4 = Form.imagen4.value;
var imagen5 = Form.imagen5.value;
var imagen6 = Form.imagen6.value;
var imagen7 = Form.imagen7.value;
var imagen8 = Form.imagen8.value;
var imagen9 = Form.imagen9.value;
var imagen10 = Form.imagen10.value;
var imagen11 = Form.imagen11.value;
var imagen12 = Form.imagen12.value;
var imagen13 = Form.imagen13.value;
var imagen14 = Form.imagen14.value;
var imagen15 = Form.imagen15.value;
var imagen16 = Form.imagen16.value;
var imagen17 = Form.imagen17.value;
var imagen18 = Form.imagen18.value;
var imagen19 = Form.imagen19.value;
var imagen20 = Form.imagen20.value;

var Ext = "";
if (imagen1 + imagen2 + imagen3 + imagen4 + imagen5 + imagen6 + imagen7 + imagen8 + imagen9 + imagen10 + imagen11 + imagen12 + imagen13 + imagen14 + imagen15 + imagen16 + imagen17 + imagen18 + imagen19 + imagen20 == "") { alert("No haz seleccionado ninguna imagen"); return false; }

if (imagen1 != "") {
Ext = GetFileExtension(imagen1);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 1 no es una imagen válida"); return false; }
}

if (imagen2 != "") {
Ext = GetFileExtension(imagen2);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 2 no es una imagen válida"); return false; }
}
if (imagen3 != "") {
Ext = GetFileExtension(imagen3);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 3 no es una imagen válida"); return false; }
}
if (imagen4 != "") {
Ext = GetFileExtension(imagen4);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 4 no es una imagen válida"); return false; }
}
if (imagen5 != "") {
Ext = GetFileExtension(imagen5);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 5 no es una imagen válida"); return false; }
}
if (imagen6 != "") {
Ext = GetFileExtension(imagen6);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 6 no es una imagen válida"); return false; }
}
if (imagen7 != "") {
Ext = GetFileExtension(imagen7);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 7 no es una imagen válida"); return false; }
}
if (imagen8 != "") {
Ext = GetFileExtension(imagen8);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 8 no es una imagen válida"); return false; }
}
if (imagen9 != "") {
Ext = GetFileExtension(imagen9);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 9 no es una imagen válida"); return false; }
}
if (imagen10 != "") {
Ext = GetFileExtension(imagen10);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 10 no es una imagen válida"); return false; }
}
if (imagen11 != "") {
Ext = GetFileExtension(imagen11);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 11 no es una imagen válida"); return false; }
}
if (imagen12 != "") {
Ext = GetFileExtension(imagen12);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 12 no es una imagen válida"); return false; }
}
if (imagen13 != "") {
Ext = GetFileExtension(imagen13);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 13 no es una imagen válida"); return false; }
}
if (imagen14 != "") {
Ext = GetFileExtension(imagen14);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 14 no es una imagen válida"); return false; }
}
if (imagen15 != "") {
Ext = GetFileExtension(imagen15);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 15 no es una imagen válida"); return false; }
}
if (imagen16 != "") {
Ext = GetFileExtension(imagen16);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 16 no es una imagen válida"); return false; }
}
if (imagen17 != "") {
Ext = GetFileExtension(imagen17);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 17 no es una imagen válida"); return false; }
}
if (imagen18 != "") {
Ext = GetFileExtension(imagen18);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 18 no es una imagen válida"); return false; }
}
if (imagen19 != "") {
Ext = GetFileExtension(imagen19);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 19 no es una imagen válida"); return false; }
}
if (imagen20 != "") {
Ext = GetFileExtension(imagen20);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo 20 no es una imagen válida"); return false; }
}

return true
}
//-->
/////////////etiqueta de cierre
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
<h2 align="center"><img src="images/spacer.gif" height="10" width="15" />Subir imagen a la tour <?php echo $row_tour['nom_tour']; ?></h2> 
 
<i class="row1">*Tama&ntilde;o de las imagenes 476 X 310px</i>

<br/><br/>
<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1">
  <table width="600" align="center" >
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 1:</td>
      <td><input type="file" name="imagen1"  value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 2:</td>
      <td><input type="file" name="imagen2" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 3:</td>
      <td><input type="file" name="imagen3" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 4:</td>
      <td><input type="file" name="imagen4" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 5:</td>
      <td><input type="file" name="imagen5" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 6:</td>
      <td><input type="file" name="imagen6" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 7:</td>
      <td><input type="file" name="imagen7" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 8:</td>
      <td><input type="file" name="imagen8" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 9:</td>
      <td><input type="file" name="imagen9" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 10:</td>
      <td><input type="file" name="imagen10" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 11:</td>
      <td><input type="file" name="imagen11" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 12:</td>
      <td><input type="file" name="imagen12" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 13:</td>
      <td><input type="file" name="imagen13" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 14:</td>
      <td><input type="file" name="imagen14" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 15:</td>
      <td><input type="file" name="imagen15" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 16:</td>
      <td><input type="file" name="imagen16" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 17:</td>
      <td><input type="file" name="imagen17" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 18:</td>
      <td><input type="file" name="imagen18" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 19:</td>
      <td><input type="file" name="imagen19" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Imagen 20:</td>
      <td><input type="file" name="imagen20" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td >&nbsp;</td>
      <td><input type="submit" value="Agregar imagen" onClick="if (BeforeSubmit(true)){ Upload(); }else{return false;};"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_imagen" value="<?php echo $row_tour['id_tour']; ?>" />
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
mysqli_free_result($tour);
?>
