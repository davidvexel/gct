<?
sleep(2);
include("include/config.php");
include('include/function.php');
$nomTour = trim($_REQUEST['nomTour']);
$nomTour = htmlentities($nomTour, ENT_COMPAT, 'utf-8');
$id_tour = $_REQUEST['id_tour'];
$url = $path."en/detalles/".$id_tour."-".urls_amigables($nomTour).".php"; 
$json = json_encode(array("url" => $url));
echo $json;
?>
