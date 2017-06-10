<?php 
   require_once('../Connections/conexion.php'); 
   include('../include/function.php');
   include('include/negar_acceso.php'); 
   ?>
<?php
   mysqli_select_db( $conexion, $database_conexion);
   $query_localizacion = "SELECT id_localizacion, nom_localizacion FROM localizacion ORDER BY nom_localizacion ASC";
   $localizacion = mysqli_query( $conexion, $query_localizacion ) or die(mysqli_error());
   $row_localizacion = mysqli_fetch_assoc($localizacion);
   $totalRows_localizacion = mysqli_num_rows($localizacion);
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
                                       <h2 align="center">Lista localizaci&oacute;n</h2>
                                       <table width="400" border="0" align="center" cellpadding="5" cellspacing="1">
                                          <tr>
                                             <td background="images/top-menubg.gif"><b>Localizaci&oacute;n</b></td>
                                             <td background="images/top-menubg.gif"><b>listings</b></td>
                                             <td  background="images/top-menubg.gif"><b>Acci&oacute;n</b></td>
                                          </tr>
                                          <?php $fila = 0;?>
                                          <?php do { ?>
                                          <tr <?php if ($fila++%2!=0) echo "bgcolor=\"#F3F3F3\"";?>>
                                             <td ><?php echo $row_localizacion['nom_localizacion']; ?></td>
                                             <td ><?php 
                                                $id = $row_localizacion['id_localizacion']; 
                                                
                                                mysqli_select_db( $conexion, $database_conexion);
                                                $query_Nlistings = "SELECT * FROM tours WHERE localizacion_id = $id";
                                                $Nlistings = mysqli_query( $conexion, $query_Nlistings ) or die(mysqli_error());
                                                $row_Nlistings = mysqli_fetch_assoc($Nlistings);
                                                $totalRows_Nlistings = mysqli_num_rows($Nlistings);
                                                echo "($totalRows_Nlistings Tours)";
                                                ?>&nbsp;</td>
                                             <td><img src="images/modificar.gif" width="22" height="22" alt="Editar" /></td>
                                          </tr>
                                          <?php } while ($row_localizacion = mysqli_fetch_assoc($localizacion)); ?>
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
<?php
   mysqli_free_result($localizacion);
   
   mysqli_free_result($Nlistings);
?>