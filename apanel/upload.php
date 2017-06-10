<?php 
require_once('../Connections/conexion.php');
include( "../include/function.php" );

/*if (!isset($_SESSION)) {
  session_start();
}

$MM_authorizedUsers = "admin,agente";
include('include/negar_acceso.php');*/ 

$max_image_resize_width = 704;
?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
		<title>Subir Imagen...</title>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="css/base.css" rel="stylesheet" type="text/css">
		<script type="text/javascript">
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
	  $destino =  "../fotos_eventos/principal";
	  ResizeConserveAspectRatio($tmp_name, $destino . "/" . $imagen, $max_image_resize_width); 
	  $cerrar_ventana = '<a href="#" onclick="cierra()"  class="link">Cerrar Ventana </a>';
	  $mensaje = "La imagen se subió correctamente";
} 
?> 

		<script>
            function cierra(){
            window.opener.document.form1.imgPrincipal.value="<?php echo $imagen; ?>"
            window.close();
            }
        </script>
        
<h2><div class="text-center alert alert-info"><strong>Atención! </strong> <?php echo $mensaje; ?><br><a href="#" onClick="opener.location.reload(true);window.close();"><?php echo $cerrar_ventana; ?></div></h2>

<?php } else { ?>

            <div class="text-center">
            
            <h2> Agregar imagen principal </h2>
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <input name="imagen" type="file" id="imagen" class="center form-control">
                <br><input type="submit" value="Agregar imagen" class="btn btn-primary" onClick="if (BeforeSubmit(true)){ Upload(); }else{return false;};">
                <input name="action" type="hidden" value="upload">
            </form>
            
            </div>

<?php } ?>

	</body>
</html>