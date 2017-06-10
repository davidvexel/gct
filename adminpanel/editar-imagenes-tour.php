<?php 
require_once('../Connections/conexion.php'); 
include('../include/function.php');
include('include/negar_acceso.php'); 
include('../include/config.php');
?>

<?php

$colname_imagenes = "-1";
if (isset($_GET['id_tour'])) {
  $colname_imagenes = $_GET['id_tour'];
}
mysqli_select_db( $conexion, $database_conexion);
$query_imagenes = sprintf("SELECT * FROM imagenes, tours WHERE imagenes.tour_id = tours.id_tour  AND tours.id_tour = %s", GetSQLValueString($colname_imagenes, "int"));
$imagenes = mysqli_query( $conexion, $query_imagenes) or die(mysqli_error());
$row_imagenes = mysqli_fetch_assoc($imagenes);
$totalRows_imagenes = mysqli_num_rows($imagenes);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head> 
<title>Editar imagenes</title>
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" /> 
<script language="javascript" type="text/javascript"><!--
function popupWindow(url, width, height) {
	if(width == null){	width =100; }	
	if(height == null){height =100;}
		
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width='+width+',height='+height+',screenX=150,screenY=150,top=150,left=100')
}
//--></script>
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

<h2 align="center"><img src="images/spacer.gif" height="10" width="15" />Editar imágenes de <?php echo $row_imagenes['nom_tour']; ?></h2>
<div>&nbsp;&nbsp;<a href="editar-tour.php?id_tour=<?php echo $row_imagenes['tour_id']; ?>"><b>[Editar propiedad]</b></a> - <a href="#"><b>[Editar Imagenes]</b></a></div>
<table width="650" border="0" align="center" cellpadding="5" cellspacing="1">
  <tr >
    <td height="117">
    <?php if($row_imagenes['imagen1'] != NULL) { ?>
    <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen1']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
     <br /> 
      Imagen 1: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen1']; ?>&amp;nomcampo=imagen1" onclick="return confirm('¿Desea eliminar la imagen 1?');">Eliminar</a></b><?php } ?> 
<?php if($row_imagenes['imagen1'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=1&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 1</b></a> </div><?php }?></td>
    <td><?php if($row_imagenes['imagen2'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen2']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 2: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen2']; ?>&amp;nomcampo=imagen2" onclick="return confirm('¿Desea eliminar la imagen 2?');">Eliminar</a></b><?php }?>
    <?php if($row_imagenes['imagen2'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=2&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 2</b></a> </div><?php }?>
    </td>
    <td><?php if($row_imagenes['imagen3'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen3']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 3:<b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen3']; ?>&amp;nomcampo=imagen3" onclick="return confirm('¿Desea eliminar la imagen 3?');">Eliminar</a></b> <?php }?>
    <?php if($row_imagenes['imagen3'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=3&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 3</b></a> </div><?php }?>
    </td>
    </tr>
  <tr >
    <td height="117"><?php if($row_imagenes['imagen4'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen4']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 4: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen4']; ?>&amp;nomcampo=imagen4" onclick="return confirm('¿Desea eliminar la imagen 4?');">Eliminar</a></b><?php }?> 
    <?php if($row_imagenes['imagen4'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=4&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 4</b></a> </div><?php }?>
    </td>
    <td><?php if($row_imagenes['imagen5'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen5']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 5: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen5']; ?>&amp;nomcampo=imagen5" onclick="return confirm('¿Desea eliminar la imagen 5?');">Eliminar</a></b><?php }?> 
    <?php if($row_imagenes['imagen5'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=5&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 5</b></a> </div><?php }?>
    </td>
    <td><?php if($row_imagenes['imagen6'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen6']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 6: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen6']; ?>&amp;nomcampo=imagen6" onclick="return confirm('¿Desea eliminar la imagen 6?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen6'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=6&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 6</b></a> </div><?php }?>
    </td>
    </tr>
  <tr>
    <td height="117"><?php if($row_imagenes['imagen7'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen7']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 7: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen7']; ?>&amp;nomcampo=imagen7" onclick="return confirm('¿Desea eliminar la imagen 7?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen7'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=7&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 7</b></a> </div><?php }?>
    </td>
    <td><?php if($row_imagenes['imagen8'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen8']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 8: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen8']; ?>&amp;nomcampo=imagen8" onclick="return confirm('¿Desea eliminar la imagen 8?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen8'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=8&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 8</b></a> </div><?php }?>
    </td>
    <td height="117"><?php if($row_imagenes['imagen9'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen9']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 9: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen9']; ?>&amp;nomcampo=imagen9" onclick="return confirm('¿Desea eliminar la imagen 9?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen9'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=9&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 9</b></a> </div><?php }?>
    </td>
    </tr>
  <tr >
    <td><?php if($row_imagenes['imagen10'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen10']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 10: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen10']; ?>&amp;nomcampo=imagen10" onclick="return confirm('¿Desea eliminar la imagen 10?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen10'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=10&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 10</b></a> </div><?php }?>
    </td>
    <td><?php if($row_imagenes['imagen11'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen11']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 11: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen11']; ?>&amp;nomcampo=imagen11" onclick="return confirm('¿Desea eliminar la imagen 11?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen11'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=11&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 11</b></a> </div><?php }?>
    </td>
    <td height="117"><?php if($row_imagenes['imagen12'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen12']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 12: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen12']; ?>&amp;nomcampo=imagen12" onclick="return confirm('¿Desea eliminar la imagen 12?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen12'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=12&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 12</b></a> </div><?php }?>
    </td>
  </tr>
  <tr>
    <td><?php if($row_imagenes['imagen13'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen13']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 13: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen13']; ?>&amp;nomcampo=imagen13" onclick="return confirm('¿Desea eliminar la imagen 13?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen13'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=13&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 13</b></a> </div><?php }?>
    </td>
    <td><?php if($row_imagenes['imagen14'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen14']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 14: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen14']; ?>&amp;nomcampo=imagen14" onclick="return confirm('¿Desea eliminar la imagen 14?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen14'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=14&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 14</b></a> </div><?php }?>
    </td>
    <td height="117"><?php if($row_imagenes['imagen15'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen15']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 15: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen15']; ?>&amp;nomcampo=imagen15" onclick="return confirm('¿Desea eliminar la imagen 15?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen15'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=15&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 15</b></a> </div><?php }?>
    </td>
	</tr>
  <tr>
    <td><?php if($row_imagenes['imagen16'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen16']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 16: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen16']; ?>&amp;nomcampo=imagen16" onclick="return confirm('¿Desea eliminar la imagen 16?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen16'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=16&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 16</b></a> </div><?php }?>
    </td>
    <td><?php if($row_imagenes['imagen17'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen17']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 17: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen17']; ?>&amp;nomcampo=imagen17" onclick="return confirm('¿Desea eliminar la imagen 17?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen17'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=17&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 17</b></a> </div><?php }?>
    </td>
    <td height="117"><?php if($row_imagenes['imagen18'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen18']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 18: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen18']; ?>&amp;nomcampo=imagen18" onclick="return confirm('¿Desea eliminar la imagen 18?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen18'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=18&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 18</b></a> </div><?php }?>
    </td>
	</tr>
  <tr>
    <td height="117"><?php if($row_imagenes['imagen19'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen19']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 19: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen19']; ?>&amp;nomcampo=imagen19" onclick="return confirm('¿Desea eliminar la imagen 19?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen19'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=19&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 19</b></a> </div><?php }?>
    </td>
    <td><?php if($row_imagenes['imagen20'] != NULL) { ?> <img src="../timthumb.php?src=<?php echo $pathGaleria.$row_imagenes['tour_id'].'/'.$row_imagenes['imagen20']; ?>&w=207&h=117&zc=1&q=90" alt="" width="207" height="117" />
    <br /> Imagen 20: <b><a href="eliminar-imagenes-tour.php?tour_id=<?php echo $row_imagenes['tour_id']; ?>&amp;nomimagen=<?php echo $row_imagenes['imagen20']; ?>&amp;nomcampo=imagen20" onclick="return confirm('¿Desea eliminar la imagen 20?');">Eliminar</a></b>    <?php }?>
    <?php if($row_imagenes['imagen20'] == NULL) { ?> <div align="center"><a href="Javascript:popupWindow('pop_agregar_img.php?img=20&amp;tour_id=<?php echo $row_imagenes['tour_id']; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
<b>Agregar imagen 20</b></a> </div><?php }?>
    </td>
    <td>&nbsp;</td>
    </tr>
</table>

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
mysqli_free_result($imagenes);
?>
