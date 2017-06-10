<?php
require_once('Connections/conexion.php');
include("include/config.php");
include('include/function.php');
include('include/idiomas/'.$idioma.'.php');
header("X-UA-Compatible: IE=edge,chrome=1");
mysqli_select_db( $conexion, $database_conexion ); //Conexiona a la base de datos

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_TCategoria = 8;
$pageNum_TCategoria = 0;
if (isset($_GET['pageNum_TCategoria'])) {
  $pageNum_TCategoria = $_GET['pageNum_TCategoria'];
}
$startRow_TCategoria = $pageNum_TCategoria * $maxRows_TCategoria;

$colname_id = "-1";
if (isset($_GET['id_cat'])) {
  $colname_id = $_GET['id_cat'];
}

$query_DCategoria = sprintf("SELECT * FROM categorias WHERE id_cat = %s" , GetSQLValueString($colname_id, "int"));
$DCategoria = mysqli_query( $conexion, $query_DCategoria ) or die(mysqli_error());
$row_DCategoria = mysqli_fetch_assoc($DCategoria);
$totalRows_DCategoria = mysqli_num_rows($DCategoria);

$query_TCategoria = sprintf("SELECT * FROM tours AS T INNER JOIN localizacion AS L ON (T.localizacion_id = L.id_localizacion) INNER JOIN  categorias AS C ON (T.cat_id = C.id_cat) WHERE T.listado = 'SI' ORDER BY T.nom_tour ASC");
$query_limit_TCategoria = sprintf("%s LIMIT %d, %d", $query_TCategoria, $startRow_TCategoria, $maxRows_TCategoria);
$TCategoria = mysqli_query( $conexion, $query_limit_TCategoria ) or die(mysqli_error());
$row_TCategoria = mysqli_fetch_assoc($TCategoria);

if (isset($_GET['totalRows_TCategoria'])) {
  $totalRows_TCategoria = $_GET['totalRows_TCategoria'];
} else {
  $all_TCategoria = mysqli_query($query_TCategoria);
  $totalRows_TCategoria = mysqli_num_rows($all_TCategoria);
}
$totalPages_TCategoria = ceil($totalRows_TCategoria/$maxRows_TCategoria)-1;

$queryString_TCategoria = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_TCategoria") == false && stristr($param, "totalRows_TCategoria") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_TCategoria = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_TCategoria = sprintf("&totalRows_TCategoria=%d%s", $totalRows_TCategoria, $queryString_TCategoria);

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
<!--fin .four.columns-->
<div class="eight columns omega">
<h1><?php echo $row_DCategoria['nom_cat'.$idiomaDB]; ?></h1>
 <?php echo $row_DCategoria['texto_cat'.$idiomaDB]; ?>
</div><!--fin .eight.columns-->
<div class="clear"></div>
<h2 class="titulo">Tours <?php echo $row_DCategoria['nom_cat'.$idiomaDB]; ?></h2>
<section class="listado clearfix">
        <?php if ($totalRows_TCategoria > 0) { ?>
        <?php do {
	  $nom_tour = trim($row_TCategoria['nom_tour'.$idiomaDB]);
	  $nom_tour = htmlentities($nom_tour, ENT_COMPAT, 'utf-8');
?>
<article>
<figure class="zoom three columns alpha">
<a href="<?php echo $path; ?>detalles/<?php echo $row_TCategoria['id_tour']."-".urls_amigables($nom_tour).".php"; ?>" title=""><span class="over">&nbsp;</span>
<img src="<?php echo $path; ?>timthumb.php?src=<?php echo $pathImagen.$row_TCategoria['imagen']; ?>&amp;w=160&amp;h=120&amp;zc=1&amp;q=90" alt="" title="" class="imagen">
</a>
</figure><!--fin figure.three.columns-->
<div class="datosTour seven columns">
<h3 class="nomTour"><a class="ax" href="<?php echo $path; ?>detalles/<?php echo $row_TCategoria['id_tour']."-".urls_amigables($nom_tour).".php"; ?>" title=""><?php echo $row_TCategoria['nom_tour'.$idiomaDB]; ?></a></h3>
<p class="desTour"><?php echo $row_TCategoria['descripcion'.$idiomaDB]; ?></p>
</div><!--fin .datosTour.seven.columns-->
<div class="preTour two columns omega">
 <?php $precio_adulto = number_format($row_TCategoria['precio_adulto'],2); ?>
<p><?php echo PRECIOADULTO; ?> <span>$<?php echo $precio_adulto; ?> <?php echo $row_TCategoria['tm']; ?></span></p>
<?php $precio_nino = number_format($row_TCategoria['precio_nino'], 2); ?>
<p><?php echo PRECIONINO; ?> <span>$<?php echo $precio_nino; ?> <?php echo $row_TCategoria['tm']; ?></span></p>
<a href="<?php echo $path; ?>detalles/<?php echo $row_TCategoria['id_tour']."-".urls_amigables($nom_tour).".php"; ?>" class="boton"><?php echo BOTONVERTOUR; ?></a>
</div><!--fin .preTour.two.columns-->
</article>
<?php } while ($row_TCategoria = mysqli_fetch_assoc($TCategoria)); }?>

<div id="paginacion">
			<?php if ($pageNum_TCategoria > 0) { // Show if not first page ?>
  <a href="<?php printf("%s?pageNum_TCategoria=%d%s", $currentPage, max(0, $pageNum_TCategoria - 1), $queryString_TCategoria); ?>" class="previous">Anterior</a>
<?php } // Show if not first page ?>
			
          <?php
// Recordset Navigator by Felixone.it
$fx_start = 0;
$fx_Pages = 10;
$fx_jump = floor($fx_Pages/2);
$fx_numOfPages = ceil($totalRows_TCategoria/$maxRows_TCategoria);
if ($fx_Pages == -1 || $fx_Pages > $fx_numOfPages) $fx_Pages = $fx_numOfPages;
$fx_end = $fx_Pages;
if ($pageNum_TCategoria > $fx_jump) $fx_start += $pageNum_TCategoria-$fx_jump;
$fx_end += $fx_start;
if ($fx_end > $fx_numOfPages) {
  $fx_end = $fx_numOfPages;
  $fx_start = $fx_end-$fx_Pages;
}
while ($fx_numOfPages > 1 && $fx_start < $fx_end) {
  $fx_preStr = "<a href=\"#\" class=\"current\">";
  $fx_postStr = "</a>";
  $fx_delim = "";
  if ($fx_start > $fx_end-$fx_Pages) $fx_delim = "  ";
  if ($fx_start != $pageNum_TCategoria) { // fx navbar
    $fx_preStr = "<a href=\"".$currentPage."?pageNum_TCategoria=".$fx_start.$queryString_TCategoria."\">";
    $fx_postStr = "</a>";
  }
  // set mode ordinal
  echo $fx_delim.$fx_preStr.($fx_start+1).$fx_postStr;
  $fx_start++;
}
?>	
<?php if ($pageNum_TCategoria < $totalPages_TCategoria) { // Show if not last page ?>
    <a  href="<?php printf("%s?pageNum_TCategoria=%d%s", $currentPage, min($totalPages_TCategoria, $pageNum_TCategoria + 1), $queryString_TCategoria); ?>" class="next">Siguiente</a>
    <?php } // Show if not last page ?>						
		</div>
</section><!--fin section listado-->
</div><!--fin .twelve.columns-->
</div><!--fin .container-->
</div><!--fin #wrapper-->
<?php include("include/footer.php"); ?>
<?php include("include/script.php"); ?>
<script type="text/javascript">
$(document).ready(function(){
	$(".over").css({'opacity':'0'});
	$('.zoom a').hover(function(){
		$(this).find('.over').stop().fadeTo(500, 0.7);},function(){$(this).find('.over').stop().fadeTo(500, 0);})	
});
</script>
</body>
</html>
<?php
mysqli_free_result($DCategoria);
mysqli_free_result($TCategoria);
?>