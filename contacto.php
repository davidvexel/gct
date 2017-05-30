<?php
require_once('Connections/conexion.php');
include("include/config.php");
include('include/function.php');
include('include/idiomas/'.$idioma.'.php');
header("X-UA-Compatible: IE=edge,chrome=1");
mysql_select_db($database_conexion, $conexion); //Conexiona a la base de datos

$colname_tour = "-1";
if (isset($_GET['id_tour'])) {
  $colname_tour = $_GET['id_tour'];
}

$query_tour = sprintf("SELECT * FROM tours AS T INNER JOIN localizacion AS L ON (T.localizacion_id = L.id_localizacion) INNER JOIN  categorias AS C ON (T.cat_id = C.id_cat) WHERE listado = 'SI' AND id_tour = %s", GetSQLValueString($colname_tour, "int"));
$tour = mysql_query($query_tour, $conexion) or die(mysql_error());
$row_tour = mysql_fetch_assoc($tour);
$totalRows_tour = mysql_num_rows($tour);

$query_imagenes = sprintf("SELECT * FROM imagenes WHERE tour_id = %s", GetSQLValueString($colname_tour, "int"));
$imagenes = mysql_query($query_imagenes, $conexion) or die(mysql_error());
$row_imagenes = mysql_fetch_assoc($imagenes);
$totalRows_imagenes = mysql_num_rows($imagenes);
?>
<?php include("include/html.php"); ?>
<head>
<?php include("include/meta.php"); ?>
<meta name="description" content="">
<title><?php echo EMPRESA; ?></title>
<?php include("include/css.php"); ?>
<?php include("include/ico.php"); ?>
<script src="<?php echo $path; ?>js/modernizr.custom.js"></script>
</head>
<body>
<div id="wrapper">
<div class="container">
<?php include("include/header.php"); ?>
<?php include("include/aside.php"); ?>
<div class="twelve columns">
<p class="titulo"><?php echo CONTACTO; ?></p>
<p><?php echo TEXTO_CONTACTO; ?></p>
<p class="titulo"><?php echo FORMULARIOCONTACTO; ?></p>
<div id="alertaform"></div>
<form class="form" name="form_contacto" id="form_contacto" role="form" accept-charset="UTF-8">
<fieldset class="six columns alpha">
<label><?php echo FORMNOMBRE; ?></label>
<input name="name" id="name" type="text" tabindex="1">
<label><?php echo FORMCORREO; ?></label>
<input name="email" id="email" type="text" tabindex="2">
</fieldset>
<fieldset class="six columns omega">
<label><?php echo FORMTELEFONO; ?></label>
<input name="phone" id="phone" type="text" tabindex="3">
<label><?php echo FORMASUNTO; ?></label>
<input name="subject" id="subject" type="text" tabindex="4">
</fieldset>
<div class="clear"></div>
<label><?php echo FORMMENSAJE; ?></label>
<textarea name="message" id="message" rows="5" style="height:90px" ></textarea>
<label><?php echo FORMCODIGO; ?></label><br>
<input name="code" id="code" type="text" class="captcha" tabindex="6" autocomplete="off" maxlength="6">
<div style="clear:both;"></div>
<button type="submit" name="submit"><?php echo FORMENVIAR; ?></button>
<input name="frm" id="frm" type="hidden" value="contacto">
</form>
<br>
<p class="titulo"><?php echo DATOSCONTACTO; ?></p>
<p><?php echo TELEFONO; ?>: +52 1 (998) 235 7489</p>
<p>Mail: info@geckocancuntours.com</p>
</div><!--fin .twelve.columns-->
</div><!--fin .container-->
</div><!--fin #wrapper-->
<?php include("include/footer.php"); ?>
<?php include("include/script.php"); ?>
<script type="text/javascript" ><!-- INICIO Función de Validación -->
		$(document).ready(function(e) {
		$("#form_contacto").submit(function(e) {
		 e.preventDefault();
				
		var error = false;
		var name = $("#name").val();
		var email = $("#email").val();
		var phone = $("#phone").val();
		var subject = $("#subject").val();
		var message = $("#message").val();
		var code = $("#code").val(); 
				   
		if(name.length == 0) {
			error = true;
		$("#name").css({"color":"#000","background-color":"#FCCAC3","border":"#EA5338 1px solid"});
		} else {
			$("#name").css({"color":"#777","background-color":"#fff","border":"#ddd 1px solid"});
			}
			
		 if(email.length == 0) {
			error = true;
			$("#email").css({"color":"#000","background-color":"#FCCAC3","border":"#EA5338 1px solid"});
		 } else {
			$("#email").css({"color":"#777","background-color":"#fff","border":"#ddd 1px solid"});
		 } 
		 
		if(code != "<? echo date("jny");?>"){
			error = true;
			$("#code").css({"color":"#000","background-color":"#FCCAC3","border":"#EA5338 1px solid"});
		 } else {
			$("#code").css({"color":"#777","background-color":"#fff","border":"#ddd 1px solid"});
			}
					
			if (error == false) {
				  var v=$("#form_contacto").serialize();
				
					$.ajax( {
							async: true,
							type: "POST",
							dataType:"html",
							url: "include/ajx-contacto.php", <!-- Se envia el query del formulario para que sea este archivo el que realice la función -->
							data: v,
							beforeSend: function(){
							$("#alertaform").html('<p class="alerta informacion"><?php echo ENVIANDO; ?></p>'); <!-- Antes de enviar la información se muestra un div de información -->
							},
							 success: function(data) {
							 $("#form_contacto").hide();
							 $("#alertaform").html('<p class="alerta satisfactorio">'+data+'</p>'); <!-- Despues de enviar la información se muestra un div de información -->
										}
								}); //ajax
				} // if errror false
	   }); //submit
	}); // document ready
			</script>
</body>
</html>
<?php
mysql_free_result($tour);
mysql_free_result($imagenes);
?>