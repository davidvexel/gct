<?php
require_once('../Connections/conexion.php'); 
include('../include/function.php');

if (!isset($_SESSION)) {
  session_start();
}

$MM_authorizedUsers = "admin";
include('include/negar_acceso.php'); 

mysql_select_db($database_conexion, $conexion);

$ok = false;

if(isset($_POST['submit'])) {
		
    $tipoCambio = $_POST['tipoCambio'];
	
	$updateSQL = sprintf("UPDATE tipo_cambio SET tipo_cambio=%s WHERE id_tipo = 1", GetSQLValueString($tipoCambio, "double"));
    $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
		
	$ok = true; 
}
	
	
$query_cambio = "SELECT * FROM tipo_cambio WHERE id_tipo = 1";
$cambio= mysql_query($query_cambio, $conexion) or die(mysql_error());
$row_cambio = mysql_fetch_assoc($cambio);

$tipoCambio = $row_cambio['tipo_cambio'];
	
	
?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8">
		<title>Tipo de Cambio</title>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="css/base.css" rel="stylesheet" type="text/css">
	</head>
    
	<body style="height: 100%;">

<? if($ok) { ?>
<br><div class="alert alert-info"><strong>Atención! </strong> Se ha actualizado el precio de los Tours en PESOS MXN correctamente.. <a href="#" onClick="window.close();" class="rojo alert-link">Cerrar</a></div>
<? } ?>

        <div style="overflow: hidden;" class="centrar">
        
            <h2>Tipo de Cambio USD</h2>
            
            <form action="" method="post" name="form1" id="form1" role="form">
            
                <div class="form-group">
                    <input name="tipoCambio" type="text" id="tipoCambio" class="center form-controlx" value="<? echo $tipoCambio; ?>">
                </div>
                    
                <div class="form-group">
                    <input type="submit" name="submit" value="Actualizar" class="btn btn-primary"></td>
                </div>
<? if(!$ok) { ?>
                <div class="row form-group">
                    <div class="alert alert-info"><strong>Atención! </strong><br>Al actualizar el tipo de cambio, automáticamente<br>se actualizaran los precios de cada tour en pesos..</div>
                </div>
<? } ?>

            </form>
            
        </div>

</body>
</html>
