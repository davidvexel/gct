<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php');
include('../include/config.php');
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_busqueda = 20;
$pageNum_busqueda = 0;
if (isset($_GET['pageNum_busqueda'])) {
  $pageNum_busqueda = $_GET['pageNum_busqueda'];
}
$startRow_busqueda = $pageNum_busqueda * $maxRows_busqueda;

$colname_busqueda = "-1";
if (isset($_GET['id_localizacion'])) {
  $colname_busqueda = $_GET['id_localizacion'];
}
mysqli_select_db( $conexion, $database_conexion);
$query_busqueda = sprintf("SELECT T.id_tour, T.nom_tour, T.imagen, L.nom_localizacion, C.nom_cat FROM tours AS T INNER JOIN localizacion AS L ON (T.localizacion_id = L.id_localizacion) INNER JOIN  categorias AS C ON (T.cat_id = C.id_cat) WHERE  T.localizacion_id = %s ORDER BY T.id_tour", GetSQLValueString($colname_busqueda, "int"));
$query_limit_busqueda = sprintf("%s LIMIT %d, %d", $query_busqueda, $startRow_busqueda, $maxRows_busqueda);
$busqueda = mysqli_query( $conexion, $query_limit_busqueda ) or die(mysqli_error());
$row_busqueda = mysqli_fetch_assoc($busqueda);

if (isset($_GET['totalRows_busqueda'])) {
  $totalRows_busqueda = $_GET['totalRows_busqueda'];
} else {
  $all_busqueda = mysqli_query($conexion, $query_busqueda);
  $totalRows_busqueda = mysqli_num_rows($all_busqueda);
}
$totalPages_busqueda = ceil($totalRows_busqueda/$maxRows_busqueda)-1;

$queryString_busqueda = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_busqueda") == false && 
        stristr($param, "totalRows_busqueda") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_busqueda = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_busqueda = sprintf("&totalRows_busqueda=%d%s", $totalRows_busqueda, $queryString_busqueda);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Administrador de propiedades</title>
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
<h2 align="center">Tours  en <?php echo $row_busqueda['nom_localizacion']; ?> </h2>
<?php if ($totalRows_busqueda == 0) { // Show if recordset empty ?>
  <h2 align="center">No hay resultados para su búsqueda.</h2>
  <?php } // Show if recordset empty ?>

<?php if ($totalRows_busqueda > 0) { // Show if recordset not empty ?>
  <table width="700" align="center" cellpadding="5" cellspacing="1">
    <tr  background="images/top-menubg.gif">
      <td width="118">&nbsp;</td>
      <td><b>ID</b></td>
      <td><b>Nombre</b></td>
      <td> <b>Status</b></td>
      <td><b>Localizaci&oacute;n</b></td>
      <td colspan="2"><b>Acciones</b></td>
    </tr>
     <?php $fila = 0;?>
    <?php do { ?>
      <tr  <?php if ($fila++%2!=0) echo "bgcolor=\"#F3F3F3\"";?>>
        <td ><img src="../timthumb.php?src=<?php echo $pathImagen.$row_busqueda['imagen']; ?>&w=118&h=70&zc=1&q=90" alt="" width="118" height="70" /></td>
        <td><?php echo $row_busqueda['id_tour']; ?></td>
        <td><?php echo $row_busqueda['nom_tour']; ?></td>
        <td><?php echo $row_busqueda['nom_cat']; ?></td>
        <td><?php echo $row_busqueda['nom_localizacion']; ?></td>
        <td><a href="editar-tour.php?id_tour=<?php echo $row_busqueda['id_tour']; ?>"><img src="images/modificar.gif" width="22" height="22" alt="Editar" /></a></td>
        <td><a href="eliminar-tour.php?id_tour=<?php echo $row_busqueda['id_tour']; ?>" onclick="return confirm('¿Desea eliminar el tour con ID <?php echo $row_busqueda['id_tour']; ?>?');"><img src="images/eliminar.gif" width="22" height="22" alt="Eliminar" /></a></td>
      </tr>
      <?php } while ($row_busqueda = mysqli_fetch_assoc($busqueda)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
<br />
<div align="center">
<?php
// Recordset Navigator by Felixone.it
$fx_start = 0;
$fx_Pages = 10;
$fx_jump = floor($fx_Pages/2);
$fx_numOfPages = ceil($totalRows_busqueda/$maxRows_busqueda);
if ($fx_Pages == -1 || $fx_Pages > $fx_numOfPages) $fx_Pages = $fx_numOfPages;
$fx_end = $fx_Pages;
if ($pageNum_busqueda > $fx_jump) $fx_start += $pageNum_busqueda-$fx_jump;
$fx_end += $fx_start;
if ($fx_end > $fx_numOfPages) {
  $fx_end = $fx_numOfPages;
  $fx_start = $fx_end-$fx_Pages;
}
while ($fx_numOfPages > 1 && $fx_start < $fx_end) {
  $fx_preStr = "<b>[";
  $fx_postStr = "]</b>";
  $fx_delim = "";
  if ($fx_start > $fx_end-$fx_Pages) $fx_delim = "  ";
  if ($fx_start != $pageNum_busqueda) { // fx navbar
    $fx_preStr = "<a href=\"".$currentPage."?pageNum_busqueda=".$fx_start.$queryString_busqueda."\">";
    $fx_postStr = "</a>";
  }
  // set mode ordinal
  echo $fx_delim.$fx_preStr.($fx_start+1).$fx_postStr;
  $fx_start++;
}
?>
</div>
<br />
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
mysqli_free_result($busqueda);
?>
