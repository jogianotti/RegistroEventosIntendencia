$(document).ready(function(){
    $('.botonVerDetallesEvento').on('click',function(){
        var id = $(this).attr('data-id');
        $.ajax(
            {
                url : Routing.generate('eventos_supervision_detalle',{ id: id },true),
                type: "GET",
                success: function(datos)
                {
                    $('#contenidoPopUp').html(datos);
                    $('#ventanaPopUp').modal('show');
                },
                error: function() {
                    alert('error');
                }
            }
        );
    });
    
    $('#dtp-fecha-desde').datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
    });
    
    $('#dtp-fecha-hasta').datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
    });
});


