$(document).ready(function () {
    
    $('#botonCrearEvento').on("click", function () {
        $.ajax({
            type: 'GET',
            url: Routing.generate('eventos_new',null,true),
            context: document.body
        })
        .done(function (respuesta) {
            $('#tituloPopUp').html('Registrar Evento');
            $('#contenidoPopUp').html(respuesta.contenido);
            $('#ventanaPopUp').modal('show');
        }).error(function(respuesta) {
            console.log(respuesta.contenido);
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
            $('#tituloPopUp').html('Rectificar Evento');
            $("#contenidoPopUp").html(html);
            $('#ventanaPopUp').modal('show');
        });
    });

    $("#botonGuardarPopUp").on("click", function () {
//        alert('llegue');
//        $("#formularioRectificarEvento").submit(function()
//        {
            var datosFormulario = $("#formularioRectificarEvento").serializeArray();
            var urlFormulario = $("#formularioRectificarEvento").attr("action");
//            alert('ajax');
            $.ajax(
            {
                url : urlFormulario,
                type: "POST",
                data : datosFormulario,
                success: function(datos)
                {
                    alert(datos.llegue);
//                    if(datos.formulario){
//                        $('#ventanaPopUp').modal('hide');
//                        //Y mostrar mensaje que se guardo correctamente
//                    } else {
//                        $("#contenidoPopUp").html(html);
//                    }
                },
                error: function() {
                    alert('error');
                }
            });
            return false;
//            e.preventDefault();
//            e.unbind();
        });
//        $('#formularioEvento').submit();
//        $('#formularioEvento').submit();
//    });
});


