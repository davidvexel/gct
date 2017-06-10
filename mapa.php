<?php 
include("include/config.php");
include('include/idiomas/'.$idioma.'.php');
if(isset($_GET['lat'])){
	$lat = $_GET['lat'];
	} else {
		$lat = 21.158820;
		}
if(isset($_GET['lon'])){
	$lon = $_GET['lon'];
	} else {
		$lon = -86.821770;
		}
?>
<!DOCTYPE HTML>
<html lang="<?php echo IDIOMAHTML; ?>">
<head>
<meta charset="utf-8">
<title><?php if(isset($_GET['titulo'])){ echo $_GET['titulo'];} else {echo EMPRESA; }?></title>
<style type="text/css">
*{padding:0; margin:0;}
html,body{height:100%;}
body{position:absolute; vertical-align:baseline; width:100%; height:100%;}
#gMaps{width:100%; height:100%;}
#cargando{position:absolute; width:100%; height:100%; background:#FFF url(<?php echo $path; ?>imagenes/iconos/loading.gif) no-repeat center; text-indent:-9999px;}
</style>
</head>
<body onload="initialize()">
<div id="cargando">Cargando...</div>
<div id="gMaps">map div</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">
	function initialize()
	{
		var myLatlng = new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $lon; ?>);
		var mapOptions = {zoom:15,center: myLatlng,mapTypeId:google.maps.MapTypeId.ROADMAP}
		var map = new google.maps.Map(document.getElementById('gMaps'),mapOptions);
		var image = '<?php echo $path; ?>imagenes/iconos/marker.png';
		var marker = new google.maps.Marker({position:myLatlng,map:map,icon: image});
		var contentString = '<?php echo EMPRESA; ?>';
		var infowindow = new google.maps.InfoWindow({content:contentString,maxWidth:300});
		google.maps.event.addListener(marker,'click',function(){infowindow.open(map,marker);});
	}
</script>
</body>
</html>