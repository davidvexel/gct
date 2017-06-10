<aside class="four columns">
<div class="box">
<form class="buscar" id="formBuscador" name="formBuscador">
<p class="titulo"><?php echo FORMBUSCARTITULO ?></p>
    <input type="text" name="nomTour" id="ajxnomTour">
    <input  type="hidden" name="id_tour" id="ajxid_tour"  />
<button><?php echo FORMBUSCARBOTON ?></button>
<a href="<?php echo $path; ?>todos.php"><span class="bustour">Ver todos los Tours..</span></a>
<div id="alertafrom"></div>
</form>
</div>
<script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
<div id="SkypeButton_Call_gecko.cancun_1" class="skype">
  <script type="text/javascript">
    Skype.ui({
      "name": "call",
      "element": "SkypeButton_Call_gecko.cancun_1",
      "participants": ["gecko.cancun"],
      "imageSize": 32
    });
  </script>
</div>
<div class="box">
<?php include("include/likebox.php"); ?>
</div>
</aside><!--fin aside-->
