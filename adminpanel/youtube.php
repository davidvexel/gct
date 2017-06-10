<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php if(!empty($_GET['v'])) {
	
	$video = $_GET['v'];
	?>
<iframe width="625" height="400" src="http://www.youtube.com/embed/<?php echo $video;?>?rel=0" frameborder="0" allowfullscreen></iframe>
<?php } ?>
</body>
</html>