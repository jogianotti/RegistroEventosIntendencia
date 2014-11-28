function closeObject(id) {
  document.getElementById(id).style.display = 'none';
}

function openObject(id) {
  document.getElementById(id).style.display = 'block';
}

function openClose(id){
    if (document.getElementById(id).style.display == 'block'){
        console.log('intenta cerrar');
        closeObject(id);
    }else{
        console.log('intenta abrir');
        openObject(id);
    }
}
$(document).ready(function () {
    $('#datetimepicker1').datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
    }); 

//    $('#botonCrearEvento').on("click", function () {
//        $.ajax({
//            type: 'GET',
//            url: Routing.generate('eventos_new',null,true),
//            context: document.body
//        })
//        .done(function (respuesta) {
//            $('#tituloPopUp').html('Registrar Evento');
//            $('#contenidoPopUp').html(respuesta.contenido);
//            $('#ventanaPopUp').modal('show');
//        }).error(function(respuesta) {
//            console.log(respuesta.contenido);
//        });
//    });
    
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
                        $('.modal-dialog').removeClass('modal-lg');
            $('#ventanaPopUp').modal('show');
        });
    });
    
    $('.botonMostrarDetallesEvento').on('click',function(){
        $.ajax({
            type: 'GET',
            url: Routing.generate('eventos_detalle',{'id': $(this).attr('data-id')},true),
            context: document.body
        })
        .done(function (html) {
            $('#tituloPopUp').html('Detalle eventos');
            $("#contenidoPopUp").html(html);
            $('.modal-dialog').addClass('modal-lg');
            $('#ventanaPopUp').modal('show');
        });
    });

    $("#botonGuardarPopUp").on("click", function () {
            var datosFormulario = $("#formularioRectificarEvento").serializeArray();
            var urlFormulario = Routing.generate('eventos_rectificacion_crear',null,true);
            $.ajax(
            {
                url : urlFormulario,
                type: "POST",
                data : datosFormulario,
                success: function(datos)
                {
                    if(datos.rectificado){
                        $('#ventanaPopUp').modal('hide');
                        $( location ).attr("href", Routing.generate('eventos',null,true));
                    } else {
                        $("#contenidoPopUp").html(datos.html);
                    }
                },
                error: function() {
                    alert('error');
                }
            });
            return false;
        });
    
    $('#botonAgregarDetalle').on("click",function(){
        var datosFormulario = $("#formularioAgregarDetalle").serializeArray();
        var urlFormulario = Routing.generate('eventos_rectificacion_crear',null,true);
        alert('LLEGUE');
        $.ajax(
        {
            url : urlFormulario,
            type: "POST",
            data : datosFormulario,
            success: function(datos)
            {
                if(datos.rectificado){
                    $('#ventanaPopUp').modal('hide');
                    $( location ).attr("href", Routing.generate('eventos',null,true));
                } else {
                    $("#contenidoPopUp").html(datos.html);
                }
            },
            error: function() {
                alert('error');
            }
        });
        return false;
    });
});
