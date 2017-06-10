<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php'); 
?>
<?php
mysqli_select_db( $conexion, $database_conexion);
$query_localizacion = "SELECT * FROM localizacion ORDER BY nom_localizacion ASC";
$localizacion = mysqli_query( $conexion, $query_localizacion ) or die(mysqli_error());
$row_localizacion = mysqli_fetch_assoc($localizacion);
$totalRows_localizacion = mysqli_num_rows($localizacion);

mysqli_select_db( $conexion, $database_conexion);
$query_categorias = "SELECT * FROM categorias ORDER BY nom_cat ASC";
$categorias = mysqli_query( $conexion, $query_categorias ) or die(mysqli_error());
$row_categorias = mysqli_fetch_assoc($categorias);
$totalRows_categorias = mysqli_num_rows($categorias);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Busqueda de Tours</title>
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" /> 
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
<h2 align="center">Búsqueda de tours</h2> 
 
<br />

<form id="form1" method="get" action="por-nombre.php">
<table width="600" align="center" cellpadding="5" cellspacing="1">
  <tr>
    <td width="236" bgcolor="#F3F3F3">Buscar tour por nombre:</td>
    <td width="132"><label>
      <input name="nombre_propiedad" type="text" id="nom_tour" size="18" />
    </label></td>
    <td width="196">
     
        <label>
          <input type="submit" value="Buscar" />
        </label>
      
    </td>
  </tr>
</table>
</form>
<br />
<form id="form2" method="get" action="por-localizacion.php">
<table width="600" align="center" cellpadding="5" cellspacing="1">
  <tr>
    <td width="236" bgcolor="#F3F3F3">Buscar tour por localización:</td>
    <td width="131"><label>
      <select name="id_localizacion">
        <?php
do {  
?>
        <option value="<?php echo $row_localizacion['id_localizacion']?>"><?php echo $row_localizacion['nom_localizacion']?></option>
        <?php
} while ($row_localizacion = mysqli_fetch_assoc($localizacion));
  $rows = mysqli_num_rows($localizacion);
  if($rows > 0) {
      mysqli_data_seek($localizacion, 0);
	  $row_localizacion = mysqli_fetch_assoc($localizacion);
  }
?>
      </select>
    </label></td>
    <td width="197">
     
        <label>
          <input type="submit" value="Buscar" />
        </label>
      
    </td>
  </tr>
</table>
</form>
<br />
<form id="form3" method="get" action="por-categoria.php">
<table width="600" align="center" cellpadding="5" cellspacing="1">
  <tr>
    <td width="236" bgcolor="#F3F3F3">Buscar tours por categoría:</td>
    <td width="131"><label>
      <select name="id_cat">
        <?php
do {  
?>
        <option value="<?php echo $row_categorias['id_cat']?>"><?php echo $row_categorias['nom_cat']?></option>
        <?php
} while ($row_categorias = mysqli_fetch_assoc($categorias));
  $rows = mysqli_num_rows($categorias);
  if($rows > 0) {
      mysqli_data_seek($categorias, 0);
	  $row_categorias = mysqli_fetch_assoc($categorias);
  }
?>
      </select>
    </label></td>
    <td width="197">
     
        <label>
          <input type="submit" value="Buscar" />
        </label>
      
    </td>
  </tr>
</table>
</form>

<br />
<form id="form3" method="get" action="por-destacadas.php">
<table width="600" align="center" cellpadding="5" cellspacing="1">
  <tr>
    <td width="236" bgcolor="#F3F3F3">Buscar tours destacados</span></span>:</td>
    <td width="133"><label>
      <select name="propiedad_destacada" id="propiedad_destacada">
        <option value="SI" selected="selected">Destacadas</option>
        <option value="NO">No destacadas</option>
      </select>
    </label></td>
    <td width="195">
     
        <label>
          <input type="submit" value="Buscar" />
        </label>
      
    </td>
  </tr>
</table>
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
mysqli_free_result($localizacion);
mysqli_free_result($categorias);
?>
