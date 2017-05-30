<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php'); 
include('../include/config.php');
?>
<?php
$ok=0;

mysql_select_db($database_conexion, $conexion);
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf(" UPDATE tours SET  cat_id=%s,  localizacion_id=%s, nom_tour=%s, nom_tourIng=%s, tm=%s, precio_adulto=%s, precio_nino=%s, precio_regular=%s, imagen=%s, descripcion=%s, descripcionIng=%s, texto_tour=%s, texto_tourIng=%s, " 
  						." duracion=%s, temporada=%s, disponibilidad=%s, horario=%s, ideal_para=%s, n_personas=%s, l_partida=%s, l_llegada=%s, r_adecuada=%s, "
						." duracionIng=%s, temporadaIng=%s, disponibilidadIng=%s, horarioIng=%s, ideal_paraIng=%s, n_personasIng=%s, l_partidaIng=%s, l_llegadaIng=%s, r_adecuadaIng=%s, "
						." lat=%s, lon=%s, title=%s, keywords=%s, description=%s, titleIng=%s, keywordsIng=%s, descriptionIng=%s, listado=%s, destacado=%s WHERE id_tour=%s ",
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
                       GetSQLValueString($_POST['destacado'], "text"),
                       GetSQLValueString($_POST['id_tour'], "int"));

  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  
  $ok=1;
}

$colname_tour = "-1";
if (isset($_GET['id_tour'])) {
  $colname_tour = $_GET['id_tour'];
}

$query_tour = sprintf("SELECT * FROM tours WHERE id_tour = %s", GetSQLValueString($colname_tour, "int"));
$tour = mysql_query($query_tour, $conexion) or die(mysql_error());
$row_tour = mysql_fetch_assoc($tour);
$totalRows_tour = mysql_num_rows($tour);

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
<title>Editar tour: <?php echo $row_tour['nom_tour']; ?></title>
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
<td bgcolor="#333333"><?php include('include/cabecera.php') ?>
  <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%"> 
  <tbody> 
<tr> 
<td colspan="4"> 
<table width="900" align="center" cellpadding="0" cellspacing="0"> 
<tr> 
<td valign="top" align="left" class="leftbg" width="100"> <?php include ('include/menu.php') ?></td> 
<td valign="top"> 
<h2 align="center"><img src="images/spacer.gif" height="10" width="15" />Editar tour: <?php echo $row_tour['nom_tour']; ?></h2> 
 <div>&nbsp;&nbsp;<a href="#"><b>[Editar tour]</b></a> - <a href="editar-imagenes-tour.php?id_tour=<?php echo $row_tour['id_tour']; ?>"><b>[Editar Imagenes]</b></a></div> 

 <?php if($ok==1){ ?>
<div align="center" class="mensaje_ok">Datos actualizados correctamente</div>
<?php } ?>
<form action="<?php echo $editFormAction; ?>" method="post" id="form1" name="form1" onsubmit="return validacion()">
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
        <option value="<?php echo $row_categorias['id_cat'];?>" <?php if (!(strcmp($row_categorias['id_cat'], $row_tour['cat_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_categorias['nom_cat'];?></option>
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
        <option value="<?php echo $row_localizacion['id_localizacion']?>" <?php if (!(strcmp($row_localizacion['id_localizacion'], $row_tour['localizacion_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_localizacion['nom_localizacion']?></option>
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
      <td><input name="nom_tour" type="text" id="nom_tour" value="<? echo $row_tour['nom_tour'];?>" size="32" maxlength="50" onkeypress="return limita(this, event,50)"
    onkeyup="cuenta(this, event,50,'contaNomEsp')"/><i class="row1">(Máximo de <span id="contaNomEsp"  style="color:#906">50</span> caracteres)</i></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Nombre del Ingles</td>
      <td><input name="nom_tourIng" type="text" id="nom_tourIng" value="<? echo $row_tour['nom_tourIng'];?>" size="32" maxlength="50" onkeypress="return limita(this, event,50)"
    onkeyup="cuenta(this, event,50,'contaNomIng')"/><i class="row1">(Máximo de <span id="contaNomIng"  style="color:#906">50</span> caracteres)</i></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Tipo de Moneda:</td>
      <td><select name="tm">
        <option value="USD" <?php if (!(strcmp("USD", $row_tour['tm']))) {echo "selected=\"selected\"";} ?>>USD</option>
        <option value="MXN" <?php if (!(strcmp("MXN", $row_tour['tm']))) {echo "selected=\"selected\"";} ?>>MXN</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Precio adulto</td>
      <td><input name="precio_adulto" id="precio_adulto" type="text" value="<?php echo $row_tour['precio_adulto']; ?>" size="10" maxlength="20" /> <br /><i class="row1">(No utilice comas, espacios o signos de puntuación)</i></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Precio de niños:</td>
      <td><input name="precio_nino" id="precio_nino" type="text" value="<?php echo $row_tour['precio_nino']; ?>" size="10" maxlength="20" /> <br /><i class="row1">(No utilice comas, espacios o signos de puntuación)</i>
        </td>
    </tr>
    
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Imagen Principal:</td>
      <td>
      <?php if($row_tour['imagen'] != NULL) { ?>
      <img src="../timthumb.php?src=<?php echo $pathImagen.$row_tour['imagen']; ?>&w=223&h=111&zc=1&q=90" alt="" width="223" height="111" />
      <input name="imagen" type="hidden" value="<?php echo $row_tour['imagen']; ?>" /><br />
      <a href="eliminar-imagen-grande.php?id_tour=<?php echo $row_tour['id_tour']; ?>&amp;imagen=<?php echo $row_tour['imagen']; ?>" onclick="return confirm('¿Desea eliminar la foto principal?');"><b>Eliminar Imagen</b></a>
	  <?php } else {?>
      <input type="text" name="imagen" value="" size="32" />
      <a href="upload.php" target="_blank" onClick="window.open(this.href, this.target, 'width=434,height=190'); return false;"><b>Adjuntar imagen</b></a> 
      <br /><i class="row1">Tamaño de la imagen  718 × 292px</i>
	  <?php } ?></td>
    </tr>
        <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Descripción Español</td>
      <td>
      <textarea name="descripcion" id="descripcion" rows="5" cols="50" onkeypress=" return limita(this, event,255)"
    onkeyup="cuenta(this, event,255,'contaDescEsp')"><?php echo $row_tour['descripcion']; ?></textarea><br /> <i class="row1">(Máximo de <span id="contaDescEsp" style="color:#900">255</span> caracteres)</i></td>
    </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Descripción Ingles</td>
      <td>
      <textarea name="descripcionIng" id="descripcionIng" rows="5" cols="50" onkeypress=" return limita(this, event,255)"
    onkeyup="cuenta(this, event,255,'contaDescIng')"><?php echo $row_tour['descripcionIng']; ?></textarea><br /> <i class="row1">(Máximo de <span id="contaDescIng" style="color:#900">255</span> caracteres)</i></td>
    </tr>
     <tr valign="baseline">
      <td colspan="2" valign="middle" bgcolor="#F3F3F3">
        
        <strong>Texto Español</strong><br />
        <textarea name="texto_tour" id ="texto_tour" rows="10" cols="90" ><?php echo $row_tour['texto_tour']; ?></textarea> 
        <script type="text/javascript">
				CKEDITOR.replace( 'texto_tour', { <?php include('ckeditor/basicjs.php'); ?> } )
			</script>  
        
        
        </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" valign="middle" bgcolor="#F3F3F3">
        
        <strong>Texto Ingles</strong><br />
        <textarea name="texto_tourIng" id ="texto_tourIng" rows="10" cols="90" ><?php echo $row_tour['texto_tourIng']; ?></textarea> 
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
      <td><input type="text" name="duracion" value="<?php echo $row_tour['duracion']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Disponibilidad:</td>
      <td><input type="text" name="disponibilidad" value="<?php echo $row_tour['disponibilidad']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Horarios:</td>
      <td><input type="text" name="horario" value="<?php echo $row_tour['horario']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Ideal para:</td>
      <td><input type="text" name="ideal_para" value="<?php echo $row_tour['ideal_para']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Lugar partida:</td>
      <td><input type="text" name="l_partida" value="<?php echo $row_tour['l_partida']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Nota</td>
      <td>
      <textarea name="r_adecuada" rows="5" cols="50" ><?php echo $row_tour['r_adecuada']; ?></textarea>
      </td>
    </tr>
        <tr valign="baseline">
      <td colspan="2" background="images/top-menubg.gif"><b>Características del Tour Ingles</b></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Duracion:</td>
      <td><input type="text" name="duracionIng" value="<?php echo $row_tour['duracionIng']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Disponibilidad:</td>
      <td><input type="text" name="disponibilidadIng" value="<?php echo $row_tour['disponibilidadIng']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Horarios:</td>
      <td><input type="text" name="horarioIng" value="<?php echo $row_tour['horarioIng']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Ideal para:</td>
      <td><input type="text" name="ideal_paraIng" value="<?php echo $row_tour['ideal_paraIng']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Lugar partida:</td>
      <td><input type="text" name="l_partidaIng" value="<?php echo $row_tour['l_partidaIng']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Nota:</td>
      <td>
        <textarea name="r_adecuadaIng" rows="5" cols="50" ><?php echo $row_tour['r_adecuadaIng']; ?></textarea>
        </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" background="images/top-menubg.gif"><b>Google maps:</b></td>
    </tr>
    <tr valign="baseline">
      <td valign="middle" >Latitude: <input type="text" name="lat" value="<?php echo $row_tour['lat']; ?>"/></td>
      <td>
      Longitude: <input type="text" name="lon" value="<?php echo $row_tour['lon']; ?>"/> <a href="http://itouchmap.com/latlong.html" target="_blank"><b>Obtener coordenadas</b></a>
      </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" background="images/top-menubg.gif"><b>Recomendaciones y Restricciones Español</b></td>
      </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Incluye</td>
      <td>
    <textarea name="title" rows="5" cols="50" ><?php echo $row_tour['title']; ?> </textarea>
    </td>
    </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">No incluye</td>
      <td>
      <textarea name="keywords" rows="5" cols="50"><?php echo $row_tour['keywords']; ?></textarea>
      </td>
    </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Recomendaciones y restricciones</td>
      <td>
      <textarea name="description" rows="5" cols="50"><?php echo $row_tour['description']; ?></textarea>  
      </td>
    </tr>
   <tr valign="baseline">
      <td colspan="2" background="images/top-menubg.gif"><b>Recomendaciones y Restricciones Ingles</b></td>
      </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Incluye</td>
      <td>
    <textarea name="titleIng" rows="5" cols="50" ><?php echo $row_tour['titleIng']; ?> </textarea>
    </td>
    </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">No incluye</td>
      <td>
      <textarea name="keywordsIng" rows="5" cols="50"><?php echo $row_tour['keywordsIng']; ?></textarea>
      </td>
    </tr>
    <tr valign="baseline">
      <td valign="middle" bgcolor="#F3F3F3">Recomendaciones y restricciones</td>
      <td>
      <textarea name="descriptionIng" rows="5" cols="50"><?php echo $row_tour['descriptionIng']; ?></textarea>  
      </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2"  background="images/top-menubg.gif"><b>0tras opciones</b></td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">¿Publicar en la web?</td>
      <td>
      <select name="listado">
        <option value="SI" <?php if (!(strcmp("SI", $row_tour['listado']))) {echo "selected=\"selected\"";}?>>SI</option>
        <option value="NO" <?php if (!(strcmp("NO", $row_tour['listado']))) {echo "selected=\"selected\"";}?>>NO</option>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td bgcolor="#F3F3F3">Propiedad destacada:</td>
      <td>
      <select name="destacado">
        <option value="SI" <?php if (!(strcmp("SI", $row_tour['destacado']))) {echo "selected=\"selected\"";} ?>>SI</option>
        <option value="NO" <?php if (!(strcmp("NO", $row_tour['destacado']))) {echo "selected=\"selected\"";} ?>>NO</option>
      </select>
      
      </td>
    </tr>
    <tr valign="baseline">
      <td align="right">&nbsp;</td>
      <td><input name="Enviar"  type="submit"  value="Actualizar tour"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_tour" value="<?php echo $row_tour['id_tour']; ?>" />
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
<?php include ('include/pie.php') ?>
</body>
</html>
<?php
mysql_free_result($localizacion);
mysql_free_result($categorias);
mysql_free_result($tour);
?>