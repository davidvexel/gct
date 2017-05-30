<?php 
include('include/negar_acceso.php'); 
include( "include/resizer.php" );
$max_image_resize_width = 700;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Subir archivo</title>
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">

function GetFileExtension(Filename) {
var I = Filename.lastIndexOf(".");
return (I > -1) ? Filename.substring(I + 1, Filename.length).toLowerCase() : "";

}
function BeforeSubmit() {
var Form = document.form1;
var imagen = Form.imagen.value;
var Ext = "";
if (imagen == "") { alert("Seleccionar imagen"); return false; }
if (imagen != "") {
Ext = GetFileExtension(imagen);
if (Ext != "jpeg" && Ext != "jpg" && Ext != "png" && Ext != "gif") { alert("El archivo no es una imagen"); return false; }
}

return true
}

</script>
</head>
<body>
<?php 
$cerrar_ventana = "";
$mensaje = "";
if ((isset($_POST["action"])) && ($_POST["action"] == "upload")) { 

	$t = "imagen";
	error_log ("Comprobacion de la foto" . 1); 
	
	if (!isset ( $_FILES [$t] ) || !is_uploaded_file ($_FILES [$t] ['tmp_name'] ) ){
    error_log ( "Breaking, no uploaded file?" );
    print "<br><p align=\"center\"><strong>No se ha cargado la imagen </strong></p>";
  }
 error_log ( "\$_FILES [ " . $t . " ] [ \"error\" ] = " . $_FILES [ $t ] [ "error" ] . " (UPLOAD_ERR_OK = " . UPLOAD_ERR_OK . ")" );
      if ( $_FILES[$t] ["error"] == UPLOAD_ERR_OK ){
	  
	  $prefijo = substr(md5(uniqid(rand())),0,6);   
	  $tmp_name = $_FILES [$t] ["tmp_name"];
      $name = $_FILES [$t] ["name"];
      $imagen = $prefijo ."-" .$name;
	  $destino =  "../imagenes/slider";
	  ResizeConserveAspectRatio($tmp_name, $destino . "/" . $imagen, $max_image_resize_width); 
	  $cerrar_ventana = '<a href="#" onclick="cierra()"  class="link">Cerrar Ventana </a>';
	  $mensaje = "La imagen se subió correctamente";
	  
} 

 ?> 
<script>
function cierra(){
window.opener.document.form1.imgSlider.value="<?php echo $imagen; ?>"
window.close();
}
</script>
<h4 align="center"><b><?php echo $mensaje; ?></b><br />
<a href="#" onClick="opener.location.reload(true);window.close();"><b><?php echo $cerrar_ventana; ?></b></a></h4>

<?php } else { ?>

<div align="center">
<h2> 
Agregar imagen Slider</h2>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<table>
  <tr>
    <td><input name="imagen" type="file" id="imagen" size="35" /></td>
  </tr>
  <tr>
    <td><input type="submit" value="Agregar imagen" onClick="if (BeforeSubmit(true)){ Upload(); }else{return false;};">
      <input name="action" type="hidden" value="upload" /></td>
  </tr>
</table></td>
	</form>
</div>
<?php } ?>
</body>
</html>
