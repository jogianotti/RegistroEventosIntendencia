$(document).ready(function () {
    
    $('#botonCrearEvento').on("click", function () {
        
        $.ajax({
            type: 'GET',
            url: Routing.generate('eventos_new',null,true),
            context: document.body
        })
        .done(function (html) {
            $('#tituloPopUp').html('Registrar Evento');
            $('#contenidoPopUp').html(html);
            $('#ventanaPopUp').modal('show');
        }).error(function() {
            alert('ERROR');
        });
    });
    
    $(".botonRectificarEvento").on("click", function () {
        $.ajax({
            type: 'POST',
            data: { id: $(this).attr("data-id") },
            url: Routing.generate('eventos_rectificacion_nueva',null,true),
            context: document.body
        })
        .done(function (html) {
            $('tituloPopUp').html('Rectificar Evento');
            $("#contenidoPopUp").html(html);
            $('#ventanaPopUp').modal('toggle');
        });
    });

    $("#botonGuardarPopUp").on("click", function () {
        $('#formularioEvento').submit();
        $('#ventanaPopUp').modal('hide');
    });
});


