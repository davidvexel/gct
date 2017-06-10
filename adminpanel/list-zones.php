<?php 
	require_once('../Connections/conexion.php'); 
	include('../include/function.php');
	include('include/negar_acceso.php'); 
	?>
<?php
	mysqli_select_db( $conexion, $database_conexion );

	$query_zonas = "SELECT * FROM zonas ORDER BY id ASC";
	
	$hoteles = mysqli_query( $conexion, $query_zonas ) or die( mysqli_error( $conexion ) );
	
	$row_zonas = mysqli_fetch_assoc( $hoteles );
	
	$total_rows_zonas = mysqli_num_rows( $hoteles );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Lista de Localizacion</title>
			<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
			<table width="900" border="0" align="center" cellpadding="1" cellspacing="0">
				<tbody>
						<tr>
							<td bgcolor="#333333">
									<?php include('include/cabecera.php') ?>
									<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%">
										<tbody>
												<tr>
													<td colspan="4">
															<table width="900" align="center" cellpadding="0" cellspacing="0">
																<tr>
																		<td valign="top" align="left" class="leftbg" width="100"> <?php include ('include/menu.php') ?></td>
																		<td valign="top">
																			<h2 align="center">Lista de Zonas</h2>
																			<h4 align="center">Agregar nueva</h3>

																			<table align="center">
																				<form method="POST" name="new_hotel">
																				<tr>
																					<td><input type="text" name="hotel" placeholder="Nombre de la Zona" /></td>
																					<td><button name="add_new_hotel" type="submit">Agregar</button></td>
																					</form>
																			</table>

																			<table width="400" border="0" align="center" cellpadding="5" cellspacing="1">
																					<tr>
																						<td background="images/top-menubg.gif"><b>ID</b></td>
																						<td  background="images/top-menubg.gif"><b>Zona</b></td>
																						<td  background="images/top-menubg.gif"><b>Editar</b></td>
																					</tr>
																					<?php $fila = 0;?>
																					<?php do { ?>
																					<tr <?php if ($fila++%2!=0) echo "bgcolor=\"#F3F3F3\"";?>>
																						<td><?php echo $row_zonas['id']; ?></td>
																						<td>
																							<?php echo $row_zonas['nombre']; ?>
																							
																						</td>
																						<td><img src="images/modificar.gif" width="22" height="22" alt="Editar" /></td>
																					</tr>
																					<?php } while ( $row_zonas = mysqli_fetch_assoc( $hoteles ) ); ?>
																			</table>
																		</td>
																</tr>
															</table>
													</td>
												</tr>
										</tbody>
									</table>
							</td>
						</tr>
				</tbody>
			</table>
			<?php include ('include/pie.php') ?>
	</body>
</html>

<?php mysqli_free_result($hoteles); ?>
