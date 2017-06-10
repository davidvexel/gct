<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>jQuery UI Autocomplete - PHP Example</title>
		<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
       
		<script type="text/javascript">
		$(function() {
		
		
			
			$("#ajxnomTour").autocomplete({
				source: function( request, response ) {
				$.ajax({
					url: "tours.php",
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
		});

		</script>
	</head>
<body>



	<label for="hotel">Hotel</label>

   
    <input type="text" name="nomTour" id="ajxnomTour" class="hotel">
    <input type="text" id="ajxid_tour" name="id_tour" />
    








</body>
</html>