<?php
require_once('../Connections/conexion.php');
include('../include/function.php');
include('include/negar_acceso.php');

if (!isset($_SESSION)) {
  session_start();
}

mysqli_select_db( $conexion, $database_conexion ); //Conexiona a la base de datos
#proceso de eliminacion
$borrar=false;

if(isset($_POST["borrar"])) {
	$borrar=$_POST["borrar"];
	if($borrar=="true") {
		$id_slider=$_POST["id_slider"];
		$c=0;
		foreach($id_slider as $indice => $laclave) {
			
  $deleteSQL = sprintf("DELETE FROM slider WHERE id_slider=%s", GetSQLValueString($laclave , "int"));
  $Result1 = mysqli_query($deleteSQL, $conexion) or die(mysqli_error());
			
			$c++;
		}
		$borrar=true;
		$msg="<b>AVISO:</b> Se borraron $c Slider(s) ";
	}
}


$query_slider = "SELECT * FROM slider";
$slider = mysqli_query($query_slider, $conexion) or die(mysqli_error());
$row_slider = mysqli_fetch_assoc($slider);
$totalRows_slider = mysqli_num_rows($slider);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<title>Administrador de slider</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="js/script.js"></script>
<script>

function todos() {
	window.location="buscar-propiedad.php";
	
}

function check(valor) {	
	p=document.getElementById("Check").value;
	if(valor) {
		p++;
	}else{
		p--
	}
	document.getElementById("Check").value=p ;
	return;
}

function editar() {
	if(document.getElementById("Check").value==0) {
		alert("Seleccionar un slider para editar") ;
		return;
	}
	
	if(document.getElementById("Check").value>1) {
		alert("Seleccionar solo un slider para editar") ;
		return;
	}
	
	if(document.getElementById("Check").value==1) { 
		if(document.slider.id_slider.length==undefined) {
			window.location="editar-slider.php?id_slider=" + document.slider.id_slider.value;
		}else{
			for(x=0; x<=document.slider.id_slider.length; x++) {			
				if(document.slider.id_slider[x].checked==1) {
					//alert("valor de casilla: " + document.usuarios.idusuario[x].value);
					window.location="editar-slider.php?id_slider=" + document.slider.id_slider[x].value;
				}
			}	
		}
		
	}
}

function eliminar() {
	if(document.getElementById("Check").value==0) {
		alert("Seleccione un sider de la lista para poder eliminarlo!!!") ;
		return;
	}
	if(confirm("¿Deseas eliminar la o las slider seleccionados?")) {
		document.getElementById("borrar").value="true";
		document.slider.submit();
	}
}

</script> 
</head> 
<body> 
<table width="1000" border="0" align="center" cellpadding="1" cellspacing="0"> 
<tbody> 
<tr> 
<td bgcolor="#333333"> <?php include('include/cabecera.php') ?>
<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%"> 
<tbody> 
<tr> 
<td colspan="4"> 
<table width="1000" align="center" cellpadding="0" cellspacing="0"> 
<tr> 
<td valign="top" align="left" class="leftbg" width="100"> <?php include ('include/menu.php') ?></td> 
<td valign="top"> 
<h2 align="center">Administrar Slider</h2> 

<?php if($borrar) { ?>				
            <div align="center" class="mensaje_ok"><?php echo $msg; ?> </div>	
<?php } ?>
<form action="admin-slider.php" name="slider" id="slider" method="POST">
<table cellpadding="4" cellspacing="0" border="0" style="float:right">
<tr>
<td><input type="button" value="Editar" onclick="editar()" ></td>
<td><input type="button" value="Eliminar" onclick="eliminar()"> </td>
<!--<td><input type="button" value="Imprimir" onclick="imprimir()"> </td>
<td><input type="button" value="Enviar por Correo" onclick="enviar()"> </td>-->
</tr>
</table>
<div style="clear:both"></div>
<input type="hidden" name="borrar" id="borrar" value="false" />
<table width="100%" align="center" cellpadding="5" cellspacing="1">
    <tr  background="images/top-menubg.gif">
      <td width="5%">&nbsp;</td>
      <td width="25%"><b>Idioma</b></td>
      <td width="13%"><b>Activo</b></td>
      <td width="8%">&nbsp;</td>
    </tr>
     <?php $fila = 0;?>
  
      <?php do { ?>
        <tr  <?php if ($fila++%2!=0) echo "bgcolor=\"#F3F3F3\"";?>>
          <td >
            <a href="editar-slider.php?id_slider=<?php echo $row_slider['id_slider']; ?>">
              <?php if($row_slider['imgSlider'] != NULL) { ?>
              <img src="../timthumb.php?src=imagenes/slider/<?php echo $row_slider['imgSlider']; ?>&w=216&h=88&zc=1&q=90" />
              <?php } else { echo '<img src="../timthumb.php?src=/adminpanel/images/img_no.jpg&w=216&h=88&zc=1&q=90" alt="" width="216" height="88" />';} ?>
              </a>
          </td>
          <td align="center"><?php echo $row_slider['idiomaSlider']; ?></td>
          <td align="center"><?php if($row_slider['activoSlider'] == 'SI') {
			echo '<img src="images/check.png" border="0" />';
			}else{
				echo '<img src="images/delete.png" border="0" />';
				} ?></td>
          <td align="center">
            
            <input type="checkbox" name="id_slider[]" id="id_slider" value="<?php echo $row_slider['id_slider']; ?>" onclick="check(this.checked);">
          </td>
        </tr>
        <?php } while ($row_slider = mysqli_fetch_assoc($slider)); ?>
</table>
 <input name="Check" id="Check"  type="hidden" value="0" />
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
mysqli_free_result($slider);
?>
