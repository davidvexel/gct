<?php
require_once('Connections/conexion.php');
include("include/config.php");
include('include/function.php');
include('include/idiomas/'.$idioma.'.php');
header("X-UA-Compatible: IE=edge,chrome=1");
mysqli_select_db( $conexion, $database_conexion ); //Conexiona a la base de datos

$colname_tour = "-1";
if (isset($_GET['id_tour'])) {
  $colname_tour = $_GET['id_tour'];
}

$query_tour = sprintf("SELECT * FROM tours AS T INNER JOIN localizacion AS L ON (T.localizacion_id = L.id_localizacion) INNER JOIN  categorias AS C ON (T.cat_id = C.id_cat) WHERE listado = 'SI' AND id_tour = %s", GetSQLValueString($colname_tour, "int"));
$tour = mysqli_query( $conexion, $query_tour ) or die(mysqli_error());
$row_tour = mysqli_fetch_assoc($tour);
$totalRows_tour = mysqli_num_rows($tour);

$query_imagenes = sprintf("SELECT * FROM imagenes WHERE tour_id = %s", GetSQLValueString($colname_tour, "int"));
$imagenes = mysqli_query( $conexion, $query_imagenes ) or die(mysqli_error());
$row_imagenes = mysqli_fetch_assoc($imagenes);
$totalRows_imagenes = mysqli_num_rows($imagenes);

$query_tipoCambio = "SELECT * FROM tipo_cambio WHERE id_tipo = 1";
$tipoCambio = mysqli_query( $conexion, $query_tipoCambio ) or die(mysqli_error());
$row_tipoCambio = mysqli_fetch_assoc($tipoCambio);
$totalRows_tipoCambio = mysqli_num_rows($tipoCambio);
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
<?php include("include/aside.php"); ?>
<?php
	$precio_adulto = $row_tour['precio_adulto'];
	$precio_nino = $row_tour['precio_nino'];
	$tipoCambio = $row_tipoCambio['tipo_cambio'];
	
	$PrecioAdulto = $precio_adulto * $tipoCambio;
	$PrecioNino = $precio_nino * $tipoCambio;
?>


<div class="eight columns">
<div id="slider" class="flexslider">
<ul class="slides">
            <?php
		$i= 0;
		do {
			++$i;
			$imgen = "imagen".$i;
		if($row_imagenes[$imgen] != NULL) { ?>
<li>
<img src="<?php echo $path; ?>timthumb.php?src=<?php echo $pathGaleria.$row_tour['id_tour'].'/'.$row_imagenes[$imgen]; ?>&w=460&h=280&zc=1&q=90" alt="<?php echo $row_tour['nom_tour'];?>" title="<?php echo $row_tour['nom_tour'];?>">
</li>
<?php } }while($i <= 20)?>
</ul>
</div>
<div id="carusel" class="flexslider">
<ul class="slides">
            <?php
		$i= 0;
		do {
			++$i;
			$imgen = "imagen".$i;
		if($row_imagenes[$imgen] != NULL) { ?>
<li><img src="<?php echo $path; ?>timthumb.php?src=<?php echo $pathGaleria.$row_tour['id_tour'].'/'.$row_imagenes[$imgen]; ?>&w=66&h=40&zc=1&q=90" alt="<?php echo $row_tour['nom_tour'];?>" title="<?php echo $row_tour['nom_tour'];?>"></li>
<?php } }while($i <= 20)?>
</ul>
</div><!--fin #carusel-->
<div class="clear"></div>
<h1 class="titulo"><?php echo $row_tour['nom_tour'.$idiomaDB];?></h1>
<?php echo $row_tour['texto_tour'.$idiomaDB]; ?>
<br>
<p class="titulo"><?php echo DESCRIPCION; ?></p>
<ul class="datos">
        <?php if($row_tour['duracion'.$idiomaDB] != NULL) { ?><li>Duración:<span><?php echo $row_tour['duracion'.$idiomaDB]; ?></span></li> <?php } ?>
        <?php if($row_tour['temporada'.$idiomaDB] != NULL) { ?><li>Temporada:<span><?php echo $row_tour['temporada'.$idiomaDB]; ?></span></li> <?php } ?>
        <?php if($row_tour['disponibilidad'.$idiomaDB] != NULL) { ?><li>Disponibilidad:<span><?php echo $row_tour['disponibilidad'.$idiomaDB]; ?></span></li> <?php } ?>
        <?php if($row_tour['horario'.$idiomaDB] != NULL) { ?><li>Horarios:<span><?php echo $row_tour['horario'.$idiomaDB]; ?></span></li> <?php } ?>
        <?php if($row_tour['ideal_para'.$idiomaDB] != NULL) { ?><li>Ideal para:<span><?php echo $row_tour['ideal_para'.$idiomaDB]; ?></span></li> <?php } ?>
	    <?php if($row_tour['n_personas'.$idiomaDB] != NULL) { ?><li>Numero de personas:<span><?php echo $row_tour['n_personas'.$idiomaDB]; ?></span></li> <?php } ?>
		<?php if($row_tour['l_partida'.$idiomaDB] != NULL) { ?><li>Lugar de partida:<span><?php echo $row_tour['l_partida'.$idiomaDB]; ?></span></li><?php } ?>
		<?php if($row_tour['l_llegada'.$idiomaDB] != NULL) { ?><li>Lugar de llegada:<span><?php echo $row_tour['l_llegada'.$idiomaDB]; ?></span></li> <?php } ?>             
		<?php if($row_tour['r_adecuada'.$idiomaDB] != NULL) { ?><li>Ropa adecuada:<span><?php echo $row_tour['r_adecuada'.$idiomaDB]; ?></span></li> <?php } ?>
        <?php if($row_tour['nom_localizacion'.$idiomaDB] != NULL) { ?><li>Ubicación:<span> <?php echo $row_tour['nom_localizacion'.$idiomaDB]; ?></span></li> <?php } ?>
        <?php if($row_tour['nom_cat'.$idiomaDB] != NULL) { ?><li>Categoría:<span><?php echo $row_tour['nom_cat'.$idiomaDB]; ?></span> </li> <?php } ?>
	</ul>
<div class="four columns alpha">
<p class="titulo"><?php echo INCLUYE; //Campo title ?></p>
<ul class="lista">
<?php
$incluye = explode("\n",$row_tour['title'.$idiomaDB]);
foreach($incluye as $key=>$value) {
?>
<li><?php echo $value; ?></li>
<?php }  ?>
</ul>
</div><!--fin .four.columns-->
<div class="four columns omega">
<p class="titulo"><?php echo NOINCLUYE; //Campo keywords?></p>
<ul class="lista">
<?php
$no_incluye = explode("\n",$row_tour['keywords'.$idiomaDB]);
foreach($no_incluye as $key=>$value) {
?>
<li><?php echo $value; ?></li>
<?php }  ?>
</ul>
</div><!--fin .four.columns-->
<div class="clear"></div>
<p class="titulo"><?php echo RECOMENDACION; //Campo description?></p>
<ul class="lista">
<?php
$description = explode("\n",$row_tour['description'.$idiomaDB]);
foreach($description as $key=>$value) {
?>
<li><?php echo $value; ?></li>
<?php }  ?>
</ul>
</div><!--fin .eight.columns-->
<div class="four columns">
<div class="precios">
<p class="titulo"><?php echo RESERVAYA; ?></p>
<div class="preTour middle column">
<?php $precio_adulto = number_format($row_tour['precio_adulto'],2); ?>
<p><?php echo PRECIOADULTO; ?> <span>$<?php echo $precio_adulto; ?> <?php echo $row_tour['tm']; ?></span><a class="preciosmxn" href="#">$<?php echo round($PrecioAdulto,2) ." MXN"; ?></a></p>
</div><!--fin .preTour-->
<div class="preTour middle column">
<?php $precio_nino = number_format($row_tour['precio_nino'], 2); ?>
<p><?php echo PRECIONINO; ?> <span>$<?php echo $precio_nino; ?> <?php echo $row_tour['tm']; ?></span><a class="preciosmxn" href="#">$<?php echo round($PrecioNino,2) ." MXN"; ?></a></p>
</p>
<?php /*?>Precio MXN
<p><span>$<?php echo round($PrecioNino,2) ." MXN"; ?></span></p><?php */?>
</div><!--fin .preTour-->
<div class="clear"></div>
<form class="reservar" id="reservar">
<label>Hotel</label>
<input name="hotel" type="text" class="" id="hotel" />
<label><?php echo FECHA; ?></label>
<input name="fecha" type="text" class="date" id="fecha" autocomplete="off">
<fieldset class="middle column">
<label><?php echo ADULTOS; ?></label>
<select name="adultos" id="adultos">
                <?php $cont = 0; do { $cont ++; ?>
					<option value="<?php echo $cont; ?>"><?php echo $cont; ?></option>
                    <?php }while($cont <= 9); ?>           
            	</select>
</fieldset>
<label><?php echo NINOS; ?></label>
<fieldset class="middle column">
<select name="ninos" id="ninos">
					<option value="0" selected="selected">0</option>
                    <?php $cont2 = 0; do { $cont2 ++; ?>
					<option value="<?php echo $cont2; ?>"><?php echo $cont2; ?></option> 
                       <?php }while($cont2 <= 9); ?>        
            	</select>
</fieldset>
<div class="clear"></div>
<button><?php echo FORMRESERVAR; ?></button>
<input type="hidden" name="id_tour" id="id_tour" value="<?php echo $row_tour['id_tour']; ?>">
<div id="alerta" align="center" style="color:#900">Espere un momento..</div>
</form>
</div>
<div class="borde radius margin-bottom">
<?php if($row_tour['lat'] != NULL && $row_tour['lon'] != NULL) {?>
<div class="frame">
<iframe src="<?php echo $path; ?>mapa.php?lat=<?php echo $row_tour['lat']; ?>&amp;lon=<?php echo $row_tour['lon'];?>&amp;titulo=<?php echo $row_tour['nom_tour'];?>"></iframe>
</div><!--fin .frame-->
<?php  } ?>
</div><!--fin .borde-->
</div><!--fin .four.columns-->
</div><!--fin .container-->
</div><!--fin #wrapper-->
<?php include("include/footer.php"); ?>
<?php include("include/script.php"); ?>
<script src="<?php echo $path; ?>js/jquery.flexslider-min.js"></script>
<script type="text/javascript">
jQuery(window).load(function(){
	$('#carusel').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: true,
		touch: true,
		itemWidth: 76,
		itemMargin: 0,
		asNavFor: '#slider'
	});
	$('#slider').flexslider({
		animation: "fade",
		controlNav: false,
		directionNav: false,
		animationLoop: false,
		slideshow: true,
		slideshowSpeed: 7000,
		animationSpeed: 600,
		sync: "#carusel"
	});
});
$(document).ready(function(){
	$('#fecha').datepicker({changeMonth:true,changeYear:true,minDate:0});
});

$(document).ready(function(e) {
	$("#alerta").hide();
    $("#reservar").submit(function(e) {
		e.preventDefault();
		var error = false; 
		var fecha = $("#fecha").val();
		
		if(fecha == 0){
			error = true;
			$("#fecha").css({"background-color":"#ffcccc"});
			} else {
				$('#fecha').css({'background-color' : '#fff'});
				}
				
		if(error == false){	
			var v=$("#reservar").serialize();	
			$.post("<?php echo $path; ?>datos-sesion.php", v, function(data){ 
			$("#alerta").show();
			setTimeout(function(){document.location = '<?php echo $path; ?>reservar.php'},2000);
			}, "html");
		}	
	});
});

</script>
</body>
</html>
<?php
mysqli_free_result($tour);
mysqli_free_result($imagenes);
?>