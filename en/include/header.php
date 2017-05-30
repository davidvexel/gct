<?php
$arrCategoria = array();
$query_categorias = "SELECT * FROM categorias ORDER BY nom_cat ASC";
$categorias = mysql_query($query_categorias, $conexion) or die(mysql_error());
while ($row_categorias = mysql_fetch_assoc($categorias)){
	array_push( $arrCategoria,$row_categorias );
	}
?>
<header class="sixteen columns">
<a href="<?php echo $path; ?>en/" title="<?php echo EMPRESA; ?>" id="logo"><img src="<?php echo $path; ?>imagenes/logo.png" alt="<?php echo EMPRESA; ?>"></a>
<a href="http://www.geckocancuntours.com/" title="<?php echo IDIOMA; ?>" id="idioma"><span class="<?php echo BANDERA; ?>"><?php echo IDIOMA; ?></span></a>
<p id="contacto"><img src="<?php echo $path; ?>imagenes/iconos/whatsapp.png"><span> +52 1 (998) 235 7489</span></p>
<ul id="rs">
<li><a href="https://www.facebook.com/geckocancun" class="facebook" title="Facebook" target="_blank">Facebook</a></li>
</ul>
<ul class="menu">
  <li><a href="<?php echo $path; ?>en/"<?php if ($page == 'index.php') {?> class="activo"<?php } ?>><?php echo NAVINICIO; ?></a></li>
  <li><a href="<?php echo $path; ?>en/nosotros.php"><?php echo NAVNOSOTROS; ?></a></li>
  <li><a href="<?php echo $path; ?>en/contacto.php" <?php if ($page == 'contacto.php') {?> class="activo" <?php } ?>><?php echo NAVCONTACTO; ?></a></li>
</ul>
<nav>
<ul>
<?php foreach($arrCategoria as $categoria) {
$nom_cat = htmlentities($categoria['nom_cat'.$idiomaDB], ENT_COMPAT, 'utf-8');
?>
<li>
<a href="<?php echo $path; ?>en/tours/<?php echo $categoria['id_cat']."-".urls_amigables($nom_cat).".php"; ?>" <?php if(isset($_GET['id_cat']) && $_GET['id_cat'] == $categoria['id_cat']){?> class="activo" <?php } ?>><?php echo $nom_cat; ?></a>
</li>
<?php } ?>
</ul>
</nav>
</header><!--fin header-->
