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