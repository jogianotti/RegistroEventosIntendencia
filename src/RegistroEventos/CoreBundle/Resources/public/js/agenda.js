$(document).ready(function(){
	$('.boton-eliminar-contacto').on('click',function(){
		$('#botonGuardarPopUp').attr('data-id',$(this).attr('data-id'));
        $('#ventanaPopUp').modal('show');
	});
	$('#botonGuardarPopUp').on('click', function(){
		$('<form>', {
			"method": 'POST',
    		"action": Routing.generate('agenda_delete',{id: $(this).attr('data-id')},true)
		}).appendTo(document.body).submit();
	});
});