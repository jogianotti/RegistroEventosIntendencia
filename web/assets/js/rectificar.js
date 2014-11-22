$(document).ready(function () {
    $("#popUp").html("<p>Cargando . . .</p>");
    
    $('#crearEvento').on("click", function () {
        $.ajax({
            type: 'GET',
            url: Routing.generate('eventos_new'),
            context: document.body
        })
        .done(function (html) {
            $("#popUpBody").html(html);
            $('#popUp').modal();
        });
    });
    
    $(".rectificar").on("click", function () {
        $.ajax({
            type: 'POST',
            data: { id: $(this).attr("data-id") },
            url: Routing.generate('eventos_rectificacion_nueva'),
            context: document.body
        })
        .done(function (html) {
            $("#popUpBody").html(html);
            $('#popUp').modal();
        });
    });

    $("#guardarPopUp").on("click", function () {
        $('#formularioEvento').submit();
        $('#evento_rectificar').modal('toggle');
    });
});


