<?php
require_once('Connections/conexion.php');
include("include/config.php");
include('include/function.php');
include('include/idiomas/'.$idioma.'.php');
header("X-UA-Compatible: IE=edge,chrome=1");
mysqli_select_db($conexion, $database_conexion); //Conexiona a la base de datos

//SELECT * FROM `tours` ORDER BY RAND() LIMIT 4
$arrUtours = array();
$query_Utours = "SELECT * FROM tours WHERE listado = 'SI' AND destacado = 'SI' ORDER BY RAND() LIMIT 4" ;
$Utours = mysqli_query( $conexion, $query_Utours ) or die(mysqli_error());
while ($row_Utours = mysqli_fetch_assoc($Utours)){
	array_push($arrUtours, $row_Utours);
	}

$arrSliders =array();
$selectSliders = "SELECT * FROM slider WHERE idiomaSlider = 'Esp' AND activoSlider = 'SI' ORDER BY RAND() LIMIT 3";
$querySliders = mysqli_query($conexion, $selectSliders) or die(mysqli_error());
$totalSliders = mysqli_num_rows($querySliders);

while($rowSliders = mysqli_fetch_assoc($querySliders)){
	array_push($arrSliders,$rowSliders);
	}

?>
<?php include("include/html.php"); ?>
<head>
<?php include("include/meta.php"); ?>
<meta name="description" content="">
<title><?php echo EMPRESA; ?></title>
<?php include("include/css.php"); ?>
<link rel="stylesheet" href="<?php echo $path; ?>css/flexslider.css">
<?php include("include/ico.php"); ?>
<script src="<?php echo $path; ?>js/modernizr.custom.js"></script>
</head>
<body>
<div id="wrapper">
<div class="container">
<?php include("include/header.php"); ?>
<div class="four columns">
<div id="thumbs" class="flexslider">
<ul class="slides">
<?php foreach($arrSliders as $row_Slider) { ?>
<li><img src="<?php echo $path; ?>timthumb.php?src=imagenes/slider/<?php echo $row_Slider['imgSlider']; ?>&w=220&h=110&zc=1&q=90" class="imagen"></li>
<?php } ?>
</ul>
</div><!--fin #thumbs-->
</div><!--fin .four.columns-->
<div class="twelve columns">
<div id="slider" class="flexslider">
<ul class="slides">
<?php foreach($arrSliders as $row_Slider) { ?>
<li><a href="<?php echo $row_Slider['linkSlider']; ?>"><img src="<?php echo $path; ?>imagenes/slider/<?php echo $row_Slider['imgSlider']; ?>"></a></li>
<?php } ?>
</ul>
</div>
</div><!--fin .twelve.columns-->
<div class="clear"></div>
<?php include("include/aside.php"); ?>
<div class="twelve columns">
<h1><?php echo BIENVENIDA; ?></h1>
<p><?php echo TEXTO_BIENVENIDA; ?></p>
<h2 class="titulo"><?php echo TOURRECIENTE; ?></h2>
<?php foreach($arrUtours as $row_Utours) { 
	  $nom_tour = $row_Utours['nom_tour'.$idiomaDB]; 
	  $nom_tour = trim($nom_tour);
	  $nom_tour = htmlentities($nom_tour, ENT_COMPAT, 'utf-8');
	?>
<section class="listado clearfix">
<article>
<figure class="zoom three columns alpha">
<a href="<?php echo $path; ?>detalles/<?php echo $row_Utours['id_tour']."-".urls_amigables($nom_tour).".php"; ?>" title=""><span class="over">&nbsp;</span><img src="<?php echo $path; ?>timthumb.php?src=<?php echo $pathImagen.$row_Utours['imagen']; ?>&amp;w=160&amp;h=120&amp;zc=1&amp;q=90" alt="" title="" class="imagen"></a>
</figure><!--fin figure.three.columns-->
<div class="datosTour seven columns">
<h3 class="nomTour"><a class="ax" href="<?php echo $path; ?>detalles/<?php echo $row_Utours['id_tour']."-".urls_amigables($nom_tour).".php"; ?>"><?php echo $row_Utours['nom_tour'.$idiomaDB]; ?></a></h3>
<p class="desTour"><?php echo $row_Utours['descripcion'.$idiomaDB]; ?></p>
</div><!--fin .datosTour.seven.columns-->
<div class="preTour two columns omega">
<?php $precio_adulto = number_format($row_Utours['precio_adulto'],2); ?>
<p><?php echo PRECIOADULTO; ?> <span>$ <?php echo $precio_adulto; ?> <?php echo $row_Utours['tm']; ?></span></p>
<?php $precio_nino = number_format($row_Utours['precio_nino'], 2); ?>
<p><?php echo PRECIONINO; ?> <span>$ <?php echo $precio_nino; ?> <?php echo $row_Utours['tm']; ?></span></p>
<a href="<?php echo $path; ?>detalles/<?php echo $row_Utours['id_tour']."-".urls_amigables($nom_tour).".php"; ?>" class="boton"><?php echo BOTONVERTOUR; ?></a>
</div><!--fin .preTour.two.columns-->
</article>
</section>
<?php } ?>
<!--fin section listado-->
</div><!--fin .twelve.columns-->
</div><!--fin .container-->
</div><!--fin #wrapper-->
<?php include("include/footer.php"); ?>
<?php include("include/script.php"); ?>
<script src="<?php echo $path; ?>js/jquery.flexslider-min.js"></script>
<script type="text/javascript">
jQuery(window).load(function(){
	$('#thumbs').flexslider({
		animation: "fade",
		controlNav: false,
		directionNav: false,
		slideshow: false,
		direction: "vertical",
		animationSpeed: 0,
		touch: true,
		itemWidth: 220,
		itemMargin: 0,
		asNavFor: '#slider'
	});
	$('#slider').flexslider({
		animation: "fade",
		controlNav: false,
		slideshow: true,
		slideshowSpeed: 7000,
		animationSpeed: 600,
		sync: "#thumbs"
	});
});
$(document).ready(function(){
	$(".over").css({'opacity':'0'});
	$('.zoom a').hover(function(){
		$(this).find('.over').stop().fadeTo(500, 0.7);},function(){$(this).find('.over').stop().fadeTo(500, 0);})
});
</script>
</body>
</html>
<?php
mysqli_free_result($Utours);
mysqli_free_result($querySliders);
?>