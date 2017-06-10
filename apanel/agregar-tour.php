<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <title>Agregar Tour</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/base.css" rel="stylesheet" type="text/css" media="screen">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
        	function popupWindow(url, width, height) 
			{
				if(width == null){	width =100; }	
				if(height == null){height =100;}
				window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width='+width+',height='+height+',screenX=150,screenY=150,top=150,left=100')
			}
        </script>
		<script> <!-- INICIO de función para confirmar eliminación de archivo -->
			function confirma (ur) {
			if (confirm("¿Está segur@ que desea eliminar esta Imagen?")) location.replace(ur);
			}
		</script> <!-- FIN de función para confirmar eliminación de archivo -->
		<script src="ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">        
            //SET SOME INITIAL VARIABLES THAT WILL BE USED
            var geocoder = new google.maps.Geocoder();
            var marker = null;
            var map = null;
            
            $(document).ready(function(){
                initialize();
            });
            
            function initialize() {
        
                var google_lat  = 21.14082877157637;
                var google_long = -86.85430526733398;
                
                var latLng = new google.maps.LatLng(google_lat, google_long);
                
                map = new google.maps.Map(document.getElementById('mapCanvas'), {
                    zoom: 12,
                    center: latLng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
            
                marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    draggable: true
                });
                
                updateMarkerPosition(latLng);
                updateZoom(map.zoom);
                geocodePosition(latLng);
            
                google.maps.event.addListener(marker, 'drag', function() {
                    updateMarkerPosition(marker.getPosition());
                });
            
                google.maps.event.addListener(marker, 'dragend', function() {
                    geocodePosition(marker.getPosition());
                });
            }
            
            function geocodePosition(pos) {
                geocoder.geocode({
                    latLng: pos
                },
                    function(responses) {
                        void(0);
                    }
                );
            }
            
            //UPDATE FORM FIELDS FOR LAT/LONG
            function updateMarkerPosition(latLng) {
                $('#google_lat').val(latLng.lat());
                $('#google_long').val(latLng.lng());
            }
            
            function updateZoom(zoom) {
                $('#google_zoom').val(zoom);
            }            
        </script>

    </head>
  
	<div class="container">
<?php include("include/nav.php"); ?> 
	</div>  
        
	<body>

		<section class="container">
                
            <article id="agregar" class="panel panel-default">
                <div class="panel-heading">Información del Tour</div>
                <div class="panel-body">
    
                <div id="alerta"></div>
    
                <form method="post" name="form1" id="form1" role="form">
    
                    <div class="form-group col-md-6">
						<label>Categoria</label>
						<select name="cat" id="cat_id"  class="form-control">
							<option value="4">Acuáticos</option>
                            <option value="3">Arqueológicos</option>
                            <option value="2">Aventura</option>
                            <option value="10">Buceo</option>
                            <option value="7">Delfines</option>
                            <option value="6">Golf</option>
                            <option value="9">Noche</option>
                            <option value="1">Parques</option>
                            <option value="5">Pesca</option>
						</select>
					</div>
                    
                    <div class="form-group col-md-6">
						<label>Localización</label>
						<select name="localizacion" id="localizacion_id"  class="form-control">
							<option value="1">Cancún</option>
                            <option value="2">Playa del Carmen</option>
                            <option value="3">Riviera Maya</option>
                            <option value="4">Yucatán</option>
						</select>
					</div>
    
                    <div class="form-group col-sm-6">
                        <label>Nombre en Español</label>
                        <input type="text"  name="nom_tour" id="nom_tour" value="" class="form-control" placeholder="Nombre en Español">
                    </div>
                    
                    <div class="form-group col-sm-6">
                        <label>Nombre en Ingles</label>
                        <input type="text"  name="nom_tourIng" id="nom_tourIng" value="" class="form-control" placeholder="Nombre en Ingles">
                    </div>
                                       
                    <div class="form-group col-sm-2">
						<label>Moneda</label>
						<select name="tm" id="tm"  class="form-control">
                            <option value="USD">USD</option>
                            <option value="MXN">MXN</option>
						</select>
					</div>
                             
                    <div class="form-group col-sm-5">
						<label>Precio Adulto</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
							<input type="text" name="precio_adulto" id="precio_adulto" value="" placeholder="Precio Adulto" class="form-control">
						</div>
                    </div>
                    
					<div class="form-group col-sm-5">
						<label>Precio Niño</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
							<input type="text" name="precio_nino" id="precio_nino" value="" placeholder="Precio Niño" class="form-control">
						</div>
					</div>
                    
					<div class="form-group col-md-6 col-lg-6">
						<label>Imagen Principal</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></span>
							<input type="text" name="imagen" id="imagen" value="" placeholder="Imagen Principal" class="form-control">
						</div>
						<a href="Javascript:popupWindow('upload.php',400,170);"><b>Adjuntar imagen</b></a> - Tamaño de la imagen  704 × 414px
					</div>

					<div style="clear:both;"></div>  
                                      
					<ul class="nav nav-tabs">
						<li class="active"><a href="#Info_Español" data-toggle="tab">Español</a></li>
						<li><a href="#Info_Ingles" data-toggle="tab">Ingles</a></li>
					</ul>
                            
					<div class="tab-content">
                        
						<div class="tab-pane active" id="Info_Español">
                              
                            <br><div class="form-group col-xs-12 col-sm-6">
                                <label>Descripción en Español</label>
                                <textarea name="descripcion" rows="5" class="form-control" id="descripcion" placeholder="Descripción en Español" value=""></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.replace( 'descripcion', { <?php include('ckeditor/basicjs.php'); ?> } )
                                </script>
                            </div>
                            
                            <div class="form-group col-xs-12 col-sm-6">
                                <label>Texto Español</label>
                                <textarea name="texto_tour" rows="5" class="form-control" id="texto_tour" placeholder="Texto en Español" value=""></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.replace( 'texto_tour', { <?php include('ckeditor/basicjs.php'); ?> } )
                                </script>
                            </div>
                                
						</div>
    
						<div class="tab-pane" id="Info_Ingles">
                              
                            <br><div class="form-group col-xs-12 col-sm-6">
                                <label>Descripción en Ingles</label>
                                 <textarea name="descripcionIng" rows="5" class="form-control" id="descripcionIng" placeholder="Descripción en Ingles" value=""></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.replace( 'descripcionIng', { <?php include('ckeditor/basicjs.php'); ?> } )
                                </script>
                            </div>
                            
                            
                            <div class="form-group col-xs-12 col-sm-6">
                                <label>Texto en Ingles</label>
                                 <textarea name="texto_tourIng" rows="5" class="form-control" id="texto_tourIng" placeholder="Texto en Ingles" value=""></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.replace( 'texto_tourIng', { <?php include('ckeditor/basicjs.php'); ?> } )
                                </script>
                            </div>
                          
						</div>
                        
					</div>

                </div>
            </article>

        	<article id="agregar" class="panel panel-default">
                <div class="panel-heading">Características del Tour</div>
                <div class="panel-body">
        
					<ul class="nav nav-tabs">
						<li class="active"><a href="#Caracteristicas_Español" data-toggle="tab">Español</a></li>
						<li><a href="#Caracteristicas_Ingles" data-toggle="tab">Ingles</a></li>
					</ul>
                            
					<div class="tab-content">
                        
						<div class="tab-pane active" id="Caracteristicas_Español">
                              
                            <br><div class="form-group col-sm-6">
                                <label>Duracion</label>
                                <input type="text"  name="duracion" id="duracion" value="" class="form-control" placeholder="Duración">
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>Disponibilidad</label>
                                <input type="text"  name="disponibilidad" id="disponibilidad" value="" class="form-control" placeholder="Disponibilidad">
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>Horarios</label>
                                <input type="text"  name="horario" id="horario" value="" class="form-control" placeholder="Hora">
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>Ideal para</label>
                                <input type="text"  name="ideal_para" id="ideal_para" value="" class="form-control" placeholder="Ideal para ...">
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>Lugar partida</label>
                                <input type="text"  name="l_partida" id="l_partida" value="" class="form-control" placeholder="Lugar de Partida">
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>Nota</label>
                                <textarea name="nom_tour" id="nom_tour" rows="5" class="form-control" placeholder="Nota en Español.."></textarea>
                            </div>
                          
						</div>
                        
						<div class="tab-pane" id="Caracteristicas_Ingles">
                          
                            <br><div class="form-group col-sm-6">
                                <label>Duracion</label>
                                <input type="text"  name="duracionIng" id="duracionIng" value="" class="form-control" placeholder="Duración">
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>Disponibilidad</label>
                                <input type="text"  name="disponibilidadIng" id="disponibilidadIng" value="" class="form-control" placeholder="Disponibilidad en Ingles...">
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>Horarios</label>
                                <input type="text"  name="horarioIng" id="horarioIng" value="" class="form-control" placeholder="Hora">
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>Ideal para</label>
                                <input type="text"  name="ideal_paraIng" id="ideal_paraIng" value="" class="form-control" placeholder="Ideal para en Ingles...">
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>Lugar partida</label>
                                <input type="text"  name="l_partidaIng" id="l_partidaIng" value="" class="form-control" placeholder="Lugar de Partida en Ingles...">
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>Nota</label>
                                <textarea name="nom_tourIng" id="nom_tourIng" rows="5" class="form-control" placeholder="Nota en Ingles..."></textarea>
                            </div>
                          
						</div>
                        
					</div>

                </div>
            </article>
            
            <article class="panel panel-default">
				<div class="panel-heading">Ubicación</div>
				<div class="panel-body">
    
					<div id="mapCanvas" style="height:350px; width:100%;"></div>
                        
                    <div class="form-group col-md-6">
						<label>Latitude</label>
                        <input type="text" name="lat" id="google_lat" value="" class="form-control" placeholder="Latitud">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Longitud</label>
                        <input type="text" name="lon" id="google_long" value="" class="form-control" placeholder="Longitud">
                    </div>

				</div>
			</article>
            
            <article id="agregar" class="panel panel-default">
                <div class="panel-heading">Recomendaciones y Restricciones del Tour</div>
                <div class="panel-body">
        
					<ul class="nav nav-tabs">
						<li class="active"><a href="#RecyRes_Español" data-toggle="tab">Español</a></li>
						<li><a href="#RecyRes_Ingles" data-toggle="tab">Ingles</a></li>
					</ul>
                            
					<div class="tab-content">
                        
						<div class="tab-pane active" id="RecyRes_Español">
                              
                            <br><div class="form-group col-sm-6">
                                <label>Incluye</label>
                                <textarea name="title" id="title" rows="5" class="form-control" placeholder="Incluye..."></textarea>
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>NO Incluye</label>
                                <textarea name="keywords" id="keywords" rows="5" class="form-control" placeholder="NO Incluye..."></textarea>
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>Recomendaciones y restricciones</label>
                                <textarea name="description" id="description" rows="5" class="form-control" placeholder="Recomendaciones y restricciones..."></textarea>
                            </div>
            
						</div>
                        
						<div class="tab-pane" id="RecyRes_Ingles">
                          
                            <br><div class="form-group col-sm-6">
                                <label>Incluye</label>
                                <textarea name="titleIng" id="titleIng" rows="5" class="form-control" placeholder="Incluye en Ingles..."></textarea>
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>NO Incluye</label>
                                <textarea name="keywordsIng" id="keywordsIng" rows="5" class="form-control" placeholder="NO Incluye en Ingles..."></textarea>
                            </div>
            
                            <div class="form-group col-sm-6">
                                <label>Recomendaciones y restricciones</label>
                                <textarea name="descriptionIng" id="descriptionIng" rows="5" class="form-control" placeholder="Recomendaciones y restricciones en Ingles..."></textarea>
                            </div>
                          
						</div>
                        
					</div>

                </div>
            </article>
            
            <article id="agregar" class="panel panel-default">
                <div class="panel-heading">Recomendaciones y Restricciones del Tour</div>
                <div class="panel-body">
            
				<div class="form-group col-md-6">
                    <label>¿Publicar en la WEB?</label>
                    <select name="listado" id="listado"  class="form-control">
                        <option value="SI">SI</option>
                        <option value="NO"  selected >NO</option>
                    </select>
				</div>
                
				<div class="form-group col-md-6">
                    <label>¿Tour Destacado?</label>
                    <select name="destacado" id="destacado"  class="form-control">
                        <option value="SI">SI</option>
                        <option value="NO"  selected >NO</option>
                    </select>
				</div>
                    
                    <div class="form-group col-md-3">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Agregar Nuevo Evento</button>
                        <input type="hidden" name="MM_insert" id="MM_insert" value="form1">
                    </div>
    
                </form>
                
                </div>
            </article>
            
        </section>
        
    <script type="text/javascript" > <!-- INICIO Función de Validación -->
    		$(document).ready(function(e) {
			$("#form1").submit(function(e) { <!-- Se requiere asignar ID en el formulario, se usa el ID del formulario como variable [EJEMPLO: <form method="post" name="form1" id="form1">] -->
			e.preventDefault();
			var error = false;
			var nomNovio = $("#nomNovio").val(); <!-- Campo que se valida, se requiere asignar ID en el formulario [EJEMPLO: <input type="text" name="tituloEsp" id="tituloEsp">]-->
            var nomNovia = $("#nomNovia").val(); <!-- Campo que se valida, se requiere asignar ID en el formulario [EJEMPLO: <input type="text" name="desccEsp" id="desccEsp">]-->
            var lugarEvento = $("#lugarEvento").val();
            var noPersonas = $("#noPersonas").val(); <!-- Campo que se valida, se requiere asignar ID en el formulario [EJEMPLO: <input type="text" name="desccEsp" id="desccEsp">]-->
			var textoEventoEsp = CKEDITOR.instances.textoEventoEsp;
			var textoEventoIng = CKEDITOR.instances.textoEventoIng;
			var imgPrincipal = $("#imgPrincipal").val();
			var video = $("#video").val();
			var status = $("#status").val();
			var idEvento = $("#idEvento").val();
			var MM_insert = $("#MM_insert").val();
						
				if(nomNovio.length == 0) {
				error = true;
				$("#nomNovio").addClass("error"); <!-- Se asigna la clase '.error' que muestra rojo el campo si se cumple la condición de la validación -->
				}
				else {
				$("#nomNovio").removeClass("error"); <!-- Se elimina la clase '.error' que muestra rojo el campo si no se cumple la condición de la validación -->
				}
				if(nomNovia.length == 0) {
				error = true;
				$("#nomNovia").addClass("error");
				}
				else {
				$("#nomNovia").removeClass("error");
				}
				
				if (error == false) {
			var x={
				nomNovio:nomNovio,
				nomNovia:nomNovia,
				lugarEvento:lugarEvento,
				noPersonas:noPersonas,
				textoEventoEsp:textoEventoEsp.getData(),
				textoEventoIng:textoEventoIng.getData(),
				imgPrincipal:imgPrincipal,
				video:video,
				status:status,
				idEvento:idEvento,
				MM_insert:MM_insert
				}
				$.ajax( {
				async: true,
				type: "POST",
				dataType:"html",
				url: "include/ajx-nuevo-evento.php", <!-- Se envia el query del formulario para que sea este archivo el que realice la función -->
				data: x,
				beforeSend: function(){
				$("#alerta").html('<div class="alert alert-success">Agregando Nuevo Evento...</div>'); <!-- Antes de enviar la información se muestra un div de información -->
				},
				 success: function(data) {
				 $("#form1").hide();
				 $("#alerta").html('<div class="alert alert-info">'+data+'</div>'); <!-- Despues de enviar la información se muestra un div de información -->
							}
					}); //ajax
                    } // if errror false
			   }); //submit
			}); // document ready
		</script> 
	</body>
</html>