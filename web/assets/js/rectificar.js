$(document).ready(function() {
	$("#rectificarPopUp").html("<p>Cargando . . .</p>");
    $(".rectificar").on("click",function() {
        //alert("click bound directly to #test-element" + $(this).attr("data-id"));
        $.ajax({
			url: window.location.origin + window.location.pathname + "rectificacion_nueva?id=" + $(this).attr("data-id"),
			context: document.body
			})
    		.success(function(data) {
				$( this ).addClass( "done" );
				$("#rectificarPopUpBody").html(data);
			});			
	});

	$("#guardarRectificarPopUp").on("click",function() {
		$('formularioRectificacion').submit();
		$('#evento_rectificar').modal('toggle');
	});    
});


