<?php 
require_once('../Connections/conexion.php');
include('../include/config.php');
require_once('../include/function.php');

if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
require_once('include/negar_acceso.php');
  
mysqli_select_db( $conexion, $database );

$idEvento = -1;
if(isset($_GET['idEvento'])){
$idEvento = $_GET['idEvento'];	
	}

$query_Galeria = sprintf("SELECT * FROM galeriaEvento WHERE idEvento=%s", GetSQLValueString($idEvento, "int")); 
$Galeria = mysqli_query( $conexion, $query_Galeria ) or die(mysqli_error());
$row_Galeria = mysqli_fetch_assoc($Galeria);
$totalRows_Galeria = mysqli_num_rows($Galeria);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <title>Galeria</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/base.css" rel="stylesheet" type="text/css" media="screen">
		<link rel="stylesheet" type="text/css" href="img-load/uploadifive.css">
		<script src="img-load/jquery.min.js" type="text/javascript"></script>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
		<script language="JavaScript"> <!-- INICIO de función para confirmar eliminación de archivo -->
			function confirma (ur) {
			if (confirm("¿Está segur@ que desea eliminar esta Imagen?")) location.replace(ur);
			}
		</script> <!-- FIN de función para confirmar eliminación de archivo -->
		<script>
			function cerrar() {
				window.location="lista-portafolio.php";
			}
        </script>
        <script src="img-load/jquery.uploadifive.min.js" type="text/javascript"></script>
		<script type="text/javascript">
            <?php $timestamp = time();?>
            $(function() {
                $('#file_upload').uploadifive({
                    'removeCompleted' : true,
                    'auto'             : true,
                    'formData'         : {
                                           'timestamp' : '<?php echo $timestamp;?>',
                                           'token'     : '<?php echo md5('unique_salt' . $timestamp); ?>',
                                           'idEvento' : '<?php echo $idEvento; ?>'
                                         },
                    'queueID'          : 'queue',
                    'uploadScript'     : 'resize-imagen-evento.php',
                    'onQueueComplete' : function redir() { document.location="galeria-evento.php?idEvento=<?php echo $idEvento; ?>"}
                });
            });
        </script>
	</head>

	<div class="container">
<?php include("include/nav.php"); ?> 
	</div>  

	<body>
    
		<div class="container">
        
                <article class="panel panel-default">
                <div class="panel-heading">Acciones</div>
                <div class="panel-body">
                
                    <div class="form-group col-sm-3">
                    	<button class="btn btn-primary" onclick="cerrar()"><span class="glyphicon glyphicon-arrow-left"></span> Atras</button>
                    </div>

                    <div class="form-group col-sm-3">
                    	<button type="submit" data-toggle="modal" data-target="#myModal" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span> Agregar Imagenes</button>
                    </div>

                </div>
            </article>
                
			<article class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                
					<div class="modal-content">
                    
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Galeria</span></h4>
                        </div>
                        
                        <div class="modal-body">
                            <form>
                                <input type="file" id="file_upload" name="file_upload" class="btn btn-primary"  multiple>
                                <div id="queue"></div>
                            </form>
                        </div>
                    
                    </div>
                    
                </div>
			</article>
                            
			<article class="panel panel-default">
				<div class="panel-heading">Galeria</div>
				<div class="panel-body">

<?php do { ?>
					<div class="col-sm-4 col-md-3">
						<a href="JavaScript:confirma('eliminar-img-evento.php?idGaleria=<?php echo $row_Galeria['idGaleria']; ?>&idEvento=<?php echo $idEvento; ?>&nomImg=<?php echo $row_Galeria['nomImg']; ?>')"><img class="img-thumbnail img-responsive center-block" src="<?php echo $pathGaleria; ?><?php echo $idEvento ?>/<?php echo $row_Galeria['nomImg']; ?>" width="300" height="300"></a><br>
					</div>
<?php } while ($row_Galeria = mysqli_fetch_assoc($Galeria)); ?>
                            
				</div>
			</article>
        
        </div>
	</body>
</html>