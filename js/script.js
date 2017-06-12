// Search tour by name
$("#ajxnomTour").autocomplete({
	source: function( request, response ) {
	$.ajax({
		url: "/completar/tours.php",
		dataType: "json",
		data: {nomTour: request.term},
		success: function(data) {
					response($.map(data, function(item) {
    				return {
						label: item.nom_tour,
						id_tour: item.id_tour
						};
				}));
			}
		});
	},
	minLength: 2,
	select: function(event, ui) {
		$('#ajxid_tour').val(ui.item.id_tour);
	}
});


	
$("#formBuscador").submit(function(e){
	e.preventDefault();
	var error = false;

	var nomTour = $('#ajxnomTour').val();
	var id_tour = $('#ajxid_tour').val();
	
	if(id_tour.length == "" ){
		error = true;
		$("#ajxnomTour").css({"color":"#FFF","background-color":"#fbbebe","border":"#fbbebe 1px solid"});
	}

	if(error == false) {
		var v=$("#formBuscador").serialize();

		$.ajax({
			async:true,
			type: "post",
			dataType: "json",
			url: "http://geckocancuntours.dev/ajx-redir-tours.php",
			data:v,
			beforeSend: function(){
				$("#alertafrom").html('<p align="center">Espere un momento</p>');
			},
			success: function(data){
				document.location=data.url;
			}

		});
	}//IF ERROR

}); //submit

// Search hotels
$("#hotel").autocomplete({
	source: function( request, response ) {
	$.ajax({
		url: "/include/ajax-helper.php",
		dataType: "json",
		data: {action: 'search_hotel', hotel: request.term},
			success: function(data) {
				response($.map(data, function(item) {
					return {
						label: item.nombre,
						id: item.id,
						zona: item.zona
						};
				}));
			}
		});
	},
	minLength: 2,
	select: function(event, ui) {
		$('#hotel_id').val( ui.item.id );
		$('#hotel_zone').val( ui.item.zona );
		var tour_id = $('#id_tour').val();
		// @TODO: Update prices on change
		get_price_by_zone( ui.item.zona, tour_id );
	}
});

// Get the tour price and change it according with the zone
function get_price_by_zone( zona, tour_id ) {
	$.ajax({
		url: "/include/ajax-helper.php",
		dataType: "json",
		data: { action: 'get_zone_price', zone: zona, tour: tour_id },
		success: function(data) {
			console.log(data);
		},
		error: function(error) {
			console.error(error);
		}
	});
}

// Show card payment form
$(':radio').click(function () {
	if ($('#card').is(':checked')) {
		$("#card-payment").show("slow");
    } else {
		$("#card-payment").hide("slow");
	}            
});

// Process reservation
Conekta.setPublishableKey('key_EsnjHpWA5rskw9yTNrWyaRA');

var conektaSuccessResponseHandler = function(token) {
	var $form = $("#formulario");
	
	//Inserta el token_id en la forma para que se envíe al servidor
	$form.append($('<input type="hidden" name="conektaTokenId">').val(token.id));
	
	// serialize form
	var values = $($form).serialize();

	// send form to .php
	$.ajax({
		async: true,
		type: "POST",
		dataType: "html",
		url: "/enviar-reservacion.php",
		data: values,
		beforeSend: function() {
			$("#msn").html('<p class="alerta satisfactorio" align="center">Enviando Reservación espere un momento</p>');
		},
		success: function(data){
			$("#formulario").hide();
			$("#msn").html(data);
		}
	});

	// $form.get(0).submit(); //Hace submit
}
var conektaErrorResponseHandler = function(response) {
	var $form = $("#formulario");
	$form.find(".card-errors").text(response.message_to_purchaser);
	$form.find("button").prop("disabled", false);
};

//jQuery para que genere el token después de dar click en submit
$(function() {
	$("#formulario").submit(function(event) {
		var $form = $(this);
		// Previene hacer submit más de una vez
		$form.find("button").prop("disabled", true);
		Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
		return false;
	});
});
