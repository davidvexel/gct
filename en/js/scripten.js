$("#ajxnomTour").autocomplete({
				source: function( request, response ) {
				$.ajax({
					url: "http://www.geckocancuntours.com/completar/tours.php",
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
				
		if(error == false){
		var v=$("#formBuscador").serialize();
		$.ajax({
				async:true,
					type: "post",
					dataType: "json",
					url: "http://www.geckocancuntours.com/en/ajx-redir-tours-en.php",
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