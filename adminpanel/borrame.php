
<?php

$array = array("Dinero", "Toallas", "Bronceador", "Equipo de Snorkel", " Cámara", "Sueter" ,"Traje de bano", "Zapatos comodos");
$count = count($array);

for ($i = 0; $i < $count; $i++) { ?>
	
   <? echo $array[$i]; ?>  <input type="checkbox" name="checkbox[]" value="<? echo $array[$i]; ?>" /> </br>
	
<? } ?>
