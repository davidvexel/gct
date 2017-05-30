<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php'); 
include( "include/resizer.php" );
$max_image_resize_width = 640;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Agregar nueva imagen </title>
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">

function GetFileExtension(Filename) {
var I = Filename.lastIndexOf(".");
return (I > -1) ? Filename.substring(I + 1, Filename.length).toLowerCase() : "";

}
function BeforeSubmit() {
var Form = document.form1;
var imagen<?php echo $_GET['img']; ?> = Form.imagen<?php echo $_GET['img']; ?>.value;
var Ext = "";
if (imagen<?php echo $_GET['img']; ?> == "") { alert("seleccionadar imagen"); return false; }
if (imagen<?php echo $_GET['img']; ?> != "") {
Ext = GetFileExtension(imagen<?php echo $_GET['img']; ?>);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo no es una imagen"); return false; }
}

return true
}

</script>

</head>
<body>


<?php 

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
	$tour_id = $_POST['tour_id'];
	$img =  $_POST['img'];
	$imagen[$img]= "";
	$t = "imagen" .$img;
	error_log ("Comprobacion de la foto" . $img); 
	
	if (!isset ( $_FILES [$t] ) || !is_uploaded_file ($_FILES [$t] ['tmp_name'] ) ){
    error_log ( "Breaking, no uploaded file?" );
    print "<br><p align=\"center\"><strong>No hay cargado la imagen </strong></p>";
  }
 error_log ( "\$_FILES [ " . $t . " ] [ \"error\" ] = " . $_FILES [ $t ] [ "error" ] . " (UPLOAD_ERR_OK = " . UPLOAD_ERR_OK . ")" );
      if ( $_FILES[$t] ["error"] == UPLOAD_ERR_OK ){
	  $tmp_name = $_FILES [$t] ["tmp_name"];
      $name = $_FILES [$t] ["name"];
      $imagen = $tour_id ."-" .$img. "-" .$name;
	  $destino =  "../fotos_tours/$tour_id";
	  ResizeConserveAspectRatio($tmp_name, $destino . "/" . $imagen, $max_image_resize_width); 

      }
	
  $updateSQL = sprintf("UPDATE imagenes SET imagen$img=%s WHERE tour_id=%s",
                       GetSQLValueString($imagen, "text"),
                       GetSQLValueString($tour_id, "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

?>


<h4 align="center"><b>Imagen Actualizada</b><br />
<a href="#" onClick="opener.location.reload(true);window.close();"><b>Cerra Ventana</b></a></h4>
<br />
<?php
}
else
{
?>
<div align="center">
<h2> 
Agregar imagen <?php echo $_GET['img']; ?></h2>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table align="center">
    <tr valign="baseline">
      <td><input type="file" name="imagen<?php echo $_GET['img']; ?>" id="imagen<?php echo $_GET['img']; ?>" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td><input type="submit" value="Agregar imagen" onClick="if (BeforeSubmit(true)){ Upload(); }else{return false;};"></td>
    </tr>
  </table>
  <input type="hidden" name="img" value="<?php echo $_GET['img']; ?>">
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="tour_id" value="<?php echo $_GET['tour_id']; ?>">
</form>

<?php
}
?>
</div>

</body>
</html>
