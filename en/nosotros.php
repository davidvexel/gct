<?php
require_once('../Connections/conexion.php');
include("include/config.php");
include('../include/function.php');
include('../include/idiomas/'.$idioma.'.php');
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
<?php include("../include/html.php"); ?>
<head>
<?php include("../include/meta.php"); ?>
<meta name="description" content="">
<title><?php echo EMPRESA; ?></title>
<?php include("../include/css.php"); ?>
<?php include("../include/ico.php"); ?>
<script src="<?php echo $path; ?>js/modernizr.custom.js"></script>
</head>
<body>
<div id="wrapper">
<div class="container">
<?php include("include/header.php"); ?>
<?php include("include/aside.php"); ?>
<div class="twelve columns">
<img class="imagen radius mbottom" src="<?php echo $path; ?>timthumb.php?src=<?php echo $path; ?>imagenes/nosotros.jpg&w=700&h=300&zc=1&q=90" alt="About us" title="About us">
<div class="clear"></div>
<h1 class="titulo"><?php echo NOSOTROS; ?></h1>
<?php echo TEXT_NOSOTROS; ?>
<div class="clear"></div>
<ul class="proveedores">
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/01.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/02.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/03.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/04.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/05.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/06.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/07.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/08.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/09.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/10.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/11.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/12.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/13.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/14.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/15.jpg" width="171" height="150" /></li>
    	<li><img src="<?php echo $path; ?>imagenes/proveedores/16.jpg" width="171" height="150" /></li>
        <li><img src="<?php echo $path; ?>imagenes/proveedores/17.jpg" width="171" height="150" /></li>
        <li><img src="<?php echo $path; ?>imagenes/proveedores/18.jpg" width="171" height="150" /></li>
        <li><img src="<?php echo $path; ?>imagenes/proveedores/19.jpg" width="171" height="150" /></li>
        <li><img src="<?php echo $path; ?>imagenes/proveedores/20.jpg" width="171" height="150" /></li>
        <li><img src="<?php echo $path; ?>imagenes/proveedores/21.jpg" width="171" height="150" /></li>
        <li><img src="<?php echo $path; ?>imagenes/proveedores/22.jpg" width="171" height="150" /></li>
        <li><img src="<?php echo $path; ?>imagenes/proveedores/23.jpg" width="171" height="150" /></li>
        <li><img src="<?php echo $path; ?>imagenes/proveedores/24.jpg" width="171" height="150" /></li>
        <li><img src="<?php echo $path; ?>imagenes/proveedores/25.jpg" width="171" height="150" /></li>
        <li><img src="<?php echo $path; ?>imagenes/proveedores/26.jpg" width="171" height="150" /></li>
    </ul>
</div><!--fin .borde-->
</div><!--fin .four.columns-->
</div><!--fin .container-->
</div><!--fin #wrapper-->
<?php include("include/footer.php"); ?>
<?php include("include/script.php"); ?>
</body>
</html>
<?php
mysql_free_result($tour);
mysql_free_result($imagenes);
?>