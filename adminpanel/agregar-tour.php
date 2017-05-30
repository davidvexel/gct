<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php'); 
?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

mysql_select_db($database_conexion, $conexion);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	//Ingresamos los registro en la tabla de tours
   $insertSQL = sprintf(" INSERT INTO tours ( cat_id,  localizacion_id, nom_tour, nom_tourIng, tm, precio_adulto, precio_nino, precio_regular, imagen, descripcion, descripcionIng, texto_tour, texto_tourIng, "
   						." duracion, temporada, disponibilidad, horario, ideal_para, n_personas, l_partida, l_llegada, r_adecuada, "
						." duracionIng, temporadaIng, disponibilidadIng, horarioIng, ideal_paraIng, n_personasIng, l_partidaIng, l_llegadaIng, r_adecuadaIng, "
						." lat, lon, title, keywords, description, titleIng, keywordsIng, descriptionIng, listado, destacado) "
						." VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cat_id'], "int"),
					   GetSQLValueString($_POST['localizacion_id'], "int"),
                       GetSQLValueString($_POST['nom_tour'], "text"),
					   GetSQLValueString($_POST['nom_tourIng'], "text"),
					   GetSQLValueString($_POST['tm'], "text"),
                       GetSQLValueString($_POST['precio_adulto'], "double"),
                       GetSQLValueString($_POST['precio_nino'], "double"),
					   GetSQLValueString($_POST['precio_regular'], "double"),
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['descripcion'], "text"),
					   GetSQLValueString($_POST['descripcionIng'], "text"),
                       GetSQLValueString($_POST['texto_tour'], "text"),
					   GetSQLValueString($_POST['texto_tourIng'], "text"),
                       GetSQLValueString($_POST['duracion'], "text"),
                       GetSQLValueString($_POST['temporada'], "text"),
                       GetSQLValueString($_POST['disponibilidad'], "text"),
                       GetSQLValueString($_POST['horario'], "text"),
                       GetSQLValueString($_POST['ideal_para'], "text"),
					   GetSQLValueString($_POST['n_personas'], "text"),
					   GetSQLValueString($_POST['l_partida'], "text"),
					   GetSQLValueString($_POST['l_llegada'], "text"),
					   GetSQLValueString($_POST['r_adecuada'], "text"),
					   GetSQLValueString($_POST['duracionIng'], "text"),
                       GetSQLValueString($_POST['temporadaIng'], "text"),
                       GetSQLValueString($_POST['disponibilidadIng'], "text"),
                       GetSQLValueString($_POST['horarioIng'], "text"),
                       GetSQLValueString($_POST['ideal_paraIng'], "text"),
					   GetSQLValueString($_POST['n_personasIng'], "text"),
					   GetSQLValueString($_POST['l_partidaIng'], "text"),
					   GetSQLValueString($_POST['l_llegadaIng'], "text"),
					   GetSQLValueString($_POST['r_adecuadaIng'], "text"),
                       GetSQLValueString($_POST['lat'], "double"),
                       GetSQLValueString($_POST['lon'], "double"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['keywords'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
					    GetSQLValueString($_POST['titleIng'], "text"),
                       GetSQLValueString($_POST['keywordsIng'], "text"),
                       GetSQLValueString($_POST['descriptionIng'], "text"),
                       GetSQLValueString($_POST['listado'], "text"),
                       GetSQLValueString($_POST['destacado'], "text"));

  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  $id_tour = mysql_insert_id(); 
  
//Se creara una carpeta única con el nombre del ID para almacenar Imágenes y planos de la propiedad.
  $dircarpeta = "../fotos_tours/$id_tour";
  $old = umask(0);
  mkdir($dircarpeta, 0777, true);
  umask($old); 

// Se ingresa el ID de la propiedad en la tabla Imagenes 
  $insertSQL = "INSERT INTO imagenes (tour_id) VALUES ('$id_tour')";
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  
  header("Location: imagenes.php?id_tour=$id_tour");
}

//Listado de la localización 
$query_localizacion = "SELECT * FROM localizacion ORDER BY nom_localizacion ASC";
$localizacion = mysql_query($query_localizacion, $conexion) or die(mysql_error());
$row_localizacion = mysql_fetch_assoc($localizacion);
$totalRows_localizacion = mysql_num_rows($localizacion);

//Listado del  Categorías
$query_categorias = "SELECT * FROM categorias ORDER BY nom_cat ASC";
$categorias = mysql_query($query_categorias, $conexion) or die(mysql_error());
$row_categorias = mysql_fetch_assoc($categorias);
$totalRows_categorias = mysql_num_rows($categorias);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agregar Tour</title>
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script language="javascript" type="text/javascript">
	//Función apara validar campos
	function validacion() {
		
  valor = document.getElementById("nom_tour").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Escriba el nombre del tour');
		valor = document.getElementById("nom_tour").focus();
    	return false;
  }
  
  valor = document.getElementById("precio_adulto").value;
  if ( isNaN(valor) ) {
	  	alert('El campo precio adulto solo acepta números');
	 	valor = document.getElementById("precio_adulto").focus();
  	  	return false;
  }

valor = document.getElementById("precio_nino").value;
  if ( isNaN(valor) ) {
	  	alert('El campo precio niños solo acepta números');
	 	valor = document.getElementById("precio_nino").focus();
  	  	return false;
  }
  
  valor = document.getElementById("descripcion").value;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    	alert('Escriba una breve descripcion del tour');
		valor = document.getElementById("descripcion").focus();
    	return false;
  }
 
  return true;
}

// Funciona para limitar el número de caracteres de un campo 
function limita(obj,elEvento, maxi) {
  var elem = obj;

  var evento = elEvento || window.event;
  var cod = evento.charCode || evento.keyCode;

  if(cod == 37 || cod == 38 || cod == 39|| cod == 40 || cod == 8 || cod == 46){
	return true;
  }

  if(elem.value.length < maxi ){
    return true;
  }

  return false;
}

function cuenta(obj,evento,maxi,div){
	var elem = obj.value;
	var info = document.getElementById(div);

	info.innerHTML = maxi-elem.length;
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
<h2 align="center">Agregar tour</h2> 
 
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validacion()">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" >
    <tr valign="baseline">
      <td align="left" valign="middle" colspan="2" background="images/top-menubg.gif" ><b>Información del tour</b></td>
      </tr>
      <tr valign="baseline">
      <td bgcolor="#F3F3F3">Categoría:</td>
      <td><select name="cat_id">
        <?php
do {  
?>
        <option value="<?php echo $row_categorias['id_cat']?>"><?php echo $row_categorias['nom_cat']?></option>
        <?php
} while ($row_categorias = mysql_fetch_assoc($categorias));
  $rows = mysql_num_rows($categorias);
  if($rows > 0) {
      mysql_data_seek($categorias, 0);
	  $row_categorias = mysql_fetch_assoc($categorias);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td  bgcolor="#F3F3F3">Localización:</td>
      <td ><select name="localizacion_id">
        <?php
do {  
?>
        <option value="<?php echo $row_localizacion['id_localizacion']?>"><?php echo $row_localizacion['nom_localizacion']?></option>
        <?php
} while ($row_localizacion = mysql_fetch_assoc($localizacion));
  $rows = mysql_num_rows($localizacion);
  if($rows > 0) {
      mysql_data_seek($localizacion, 0);
	  $row_localizacion = mysql_fetch_assoc($localizacion);
  }
?>
      </select></td>
    </tr>
    
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Nombre Español:</td>
      <td><input name="nom_tour" type="text" id="nom_tour" value="" size="32" maxlength="50" onkeypress="return limita(this, event,50)"
    onkeyup="cuenta(this, event,50,'contaNomEsp')"/><i class="row1">(Máximo de <span id="contaNomEsp"  style="color:#906">50</span> caracteres)</i></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Nombre del Ingles</td>
      <td><input name="nom_tourIng" type="text" id="nom_tourIng" value="" size="32" maxlength="50" onkeypress="return limita(this, event,50)"
    onkeyup="cuenta(this, event,50,'contaNomIng')"/><i class="row1">(Máximo de <span id="contaNomIng"  style="color:#906">50</span> caracteres)</i></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Tipo de Moneda:</td>
      <td><select name="tm">
        <option value="USD">USD</option>
        <option value="MXN">MXN</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Precio adulto</td>
      <td><input name="precio_adulto" id="precio_adulto" type="text" value="" size="10" maxlength="20" /> <br /><i class="row1">(No utilice comas, espacios o signos de puntuación)</i></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Precio de niños:</td>
      <td><input name="precio_nino" id="precio_nino" type="text" value="" size="10" maxlength="20" /> <br /><i class="row1">(No utilice comas, espacios o signos de puntuación)</i>
        </td>
    </tr>
        
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Imagen Principal:</td>
      <td><input type="text" name="imagen" id="imagen" value="" size="32" /><a href="Javascript:popupWindow('upload.php',300,200);"><b>Adjuntar imagen</b></a> <br /><i class="row1">Tamaño de la imagen  718 × 292px</i></td>
    </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Descripción Español</td>
      <td>
      <textarea name="descripcion" id="descripcion" rows="5" cols="50" onkeypress=" return limita(this, event,255)"
    onkeyup="cuenta(this, event,255,'contaDescEsp')"></textarea><br /> <i class="row1">(Máximo de <span id="contaDescEsp" style="color:#900">255</span> caracteres)</i></td>
    </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Descripción Ingles</td>
      <td>
      <textarea name="descripcionIng" id="descripcionIng" rows="5" cols="50" onkeypress=" return limita(this, event,255)"
    onkeyup="cuenta(this, event,255,'contaDescIng')"></textarea><br /> <i class="row1">(Máximo de <span id="contaDescIng" style="color:#900">255</span> caracteres)</i></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" valign="middle" bgcolor="#F3F3F3">
        
        <strong>Texto Español</strong><br />
        <textarea name="texto_tour" id ="texto_tour" rows="10" cols="90" ></textarea> 
        <script type="text/javascript">
				CKEDITOR.replace( 'texto_tour', { <?php include('ckeditor/basicjs.php'); ?> } )
			</script>  
        
        
        </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" valign="middle" bgcolor="#F3F3F3">
        
        <strong>Texto Ingles</strong><br />
        <textarea name="texto_tourIng" id ="texto_tourIng" rows="10" cols="90" ></textarea> 
        <script type="text/javascript">
				CKEDITOR.replace( 'texto_tourIng', { <?php include('ckeditor/basicjs.php'); ?> } )
			</script>  
        
        
        </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" background="images/top-menubg.gif"><b>Características del Tour Español</b></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Duracion:</td>
      <td><input type="text" name="duracion" value="" size="32" /></td>
    </tr>
    
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Disponibilidad:</td>
      <td><input type="text" name="disponibilidad" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Horarios:</td>
      <td><input type="text" name="horario" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Ideal para:</td>
      <td><input type="text" name="ideal_para" value="" size="32" /></td>
    </tr>
    
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Lugar partida:</td>
      <td><input type="text" name="l_partida" value="" size="32" /></td>
    </tr>
    
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Nota:</td>
      <td><textarea name="r_adecuada" rows="5" cols="50" ></textarea></td>
    </tr>
        <tr valign="baseline">
      <td colspan="2" background="images/top-menubg.gif"><b>Características del Tour Ingles</b></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Duracion:</td>
      <td><input type="text" name="duracionIng" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Disponibilidad:</td>
      <td><input type="text" name="disponibilidadIng" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Horarios:</td>
      <td><input type="text" name="horarioIng" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Ideal para:</td>
      <td><input type="text" name="ideal_paraIng" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Lugar partida:</td>
      <td><input type="text" name="l_partidaIng" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Nota:</td>
      <td>
      <textarea name="r_adecuadaIng" rows="5" cols="50" ></textarea>
      </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" background="images/top-menubg.gif"><b>Google maps:</b></td>
    </tr>
    <tr valign="baseline">
      <td valign="middle" >Latitude: <input type="text" name="lat" value=""/></td>
      <td>
      Longitude: <input type="text" name="lon" value=""/> <a href="http://itouchmap.com/latlong.html" target="_blank"><b>Obtener coordenadas</b></a>
      </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" background="images/top-menubg.gif"><b>Recomendaciones y Restricciones Español</b></td>
      </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Incluye</td>
      <td>
      <textarea name="title" rows="5" cols="50" ></textarea>
      
      </td>
    </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">No incluye</td>
      <td>
      <textarea name="keywords" rows="5" cols="50"></textarea>
      </td>
    </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Recomendaciones y restricciones</td>
      <td>
      <textarea name="description" rows="5" cols="50"></textarea> 
      </td>
    </tr>
     <tr valign="baseline">
      <td colspan="2" background="images/top-menubg.gif"><b>Recomendaciones y Restricciones Ingles</b></td>
      </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Incluye</td>
      <td>
      <textarea name="titleIng" rows="5" cols="50" ></textarea>
      
      </td>
    </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">No incluye</td>
      <td>
      <textarea name="keywordsIng" rows="5" cols="50"></textarea>
      </td>
    </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Recomendaciones y restricciones</td>
      <td>
      <textarea name="descriptionIng" rows="5" cols="50"></textarea> 
      </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2"  background="images/top-menubg.gif"><b>0tras opciones</b></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">¿Publicar en la web?</td>
      <td>
      <select name="listado">
        <option value="SI">SI</option>
        <option value="NO"  selected="selected">NO</option>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Propiedad destacada:</td>
      <td><select name="destacado">
        <option value="NO" selected="selected">NO</option>
        <option value="SI">SI</option>
       
      </select></td>
    </tr>
    <tr valign="baseline">
      <td align="right">&nbsp;</td>
      <td><input name="Enviar"  type="submit"  value="Siguiente &#8250;&#8250;"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
  <input name="precio_regular" id="precio_regular" type="hidden"/>
<input type="hidden" name="temporada" value="" size="32" />
<input type="hidden" name="n_personas" value="" size="32" />
<input type="hidden" name="l_llegada" value="" size="32" />
<input type="hidden" name="temporadaIng" value="" size="32" />
<input type="hidden" name="n_personasIng" value="" size="32" />
<input type="hidden" name="l_llegadaIng" value="" size="32" />
</form>
</td> 
</tr> 
</table> </td> 
</tr> 
</tbody> 
</table> </td> 
</tr> 
</tbody> 
</table> 
<?php include ('include/pie.php'); ?>
</body>
</html>
<?php
mysql_free_result($localizacion);
mysql_free_result($categorias);
?>