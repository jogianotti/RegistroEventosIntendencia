$(document).ready(function(){
	$('.boton-eliminar-tipo-evento').on('click',function(){
            $('#botonGuardarPopUp').attr('data-id',$(this).attr('data-id'));
            $('#ventanaPopUp').modal('show');
	});
	$('#botonGuardarPopUp').on('click', function(){
		$('<form>', {
                    "method": 'POST',
                    "action": Routing.generate('tipos_eventos_delete',{id: $(this).attr('data-id')},true)
		}).appendTo(document.body).submit();
	});
});