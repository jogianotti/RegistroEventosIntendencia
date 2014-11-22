$(document).ready(function () {
    $("#popUp").html("<p>Cargando . . .</p>");
    
    $('#crearEvento').on("click", function () {
        
        $.ajax({
            type: 'GET',
            url: Routing.generate('eventos_new',null,true),
            context: document.body
        })
        .done(function (html) {
            $("#contenidoPopUp").html(html);
            $('#ventana').modal('show');
        }).error(function() {
            alert('ERROR');
        
        });
    });
    
    $(".rectificar").on("click", function () {
        $.ajax({
            type: 'POST',
            data: { id: $(this).attr("data-id") },
            url: Routing.generate('eventos_rectificacion_nueva',null,true),
            context: document.body
        })
        .done(function (html) {
            alert(html);
            $("#contenidoPopUp").html(html);
            $('#popUp').modal('toggle');
        });
    });

    $("#guardarPopUp").on("click", function () {
        $('#formularioEvento').submit();
        $('#evento_rectificar').modal('toggle');
    });
});


