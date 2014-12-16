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
    
    $(".botonRectificarEvento").on("click", function () {
        $.ajax({
            type: 'POST',
            data: { id: $(this).attr("data-id") },
            url: Routing.generate('eventos_rectificacion_nueva',null,true),
            context: document.body
        })
        .done(function (datos) {
            if(datos.estado) {
                $('#tituloPopUp').html('Rectificar Evento');
                $("#contenidoPopUp").html(datos.vista);
                $('.modal-dialog').removeClass('modal-lg');
                $('#piePopUp').addClass('show');
                $('#ventanaPopUp').modal('show');
            }
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
                    if(datos.estado){
                        if(datos.rectificado){
                            $('#ventanaPopUp').modal('hide');
                            $( location ).attr("href", Routing.generate('eventos',null,true));
                        } else {
                            $("#contenidoPopUp").html(datos.html);
                        }
                    }
                },
                error: function() {
                    alert('error');
                }
            });
            return false;
        });
   
    // Visualizar detalles
    $('.botonMostrarDetallesEvento').on('click',function(){
        $.ajax({
            type: 'GET',
            url: Routing.generate('eventos_detalle',{ id: $(this).attr('data-id') },true),
            context: document.body
        })
        .done(function (html) {
            $('#tituloPopUp').html('Detalle eventos');
            $("#contenidoPopUp").html(html);
            $('.modal-dialog').addClass('modal-lg');
            $('#piePopUp').addClass('hide');
            $('#piePopUp').removeClass('show');
            $('#ventanaPopUp').modal('show');
        });
        
    });
    
    //Agregar nuevo detalle
    $('#ventanaPopUp').on("click",'#botonAgregarDetalle',function(){
        var datosFormulario = $("#formularioAgregarDetalle").serializeArray();
        var urlFormulario = Routing.generate('eventos_detalle_crear',null,true);
        $.ajax(
        {
            url : urlFormulario,
            type: "POST",
            data : datosFormulario,
            success: function(datos)
            {
                $("#contenidoPopUp").html(datos.html);
            }
        });
        return false;
    });
    
    $('#ventanaPopUp').on('mouseover','#dp-detalle',function(){
        $('#dp-detalle').datetimepicker({
            format: 'DD/MM/YYYY HH:mm'
        });
    });
    
    $('#ventanaPopUp').on('mouseover','#dp-rectificar',function(){
        $('#dp-rectificar').datetimepicker({
            format: 'DD/MM/YYYY HH:mm'
        });
    });
    
    $(".estado-switch").bootstrapSwitch();
    
    $('#botonFormularioRegistro').on('click',function(){
        if(! $('#botonFormularioRegistro').hasClass('active')) {
            $(':input','#formularioBusqueda')
             .not(':button, :submit, :reset, :hidden')
             .val('')
             .removeAttr('checked')
             .removeAttr('selected');

            $('#formularioBusqueda').append('<input type="hidden" name="seccion" value="registro" />');
            $('#formularioBusqueda').submit();
        }
//        $('#botonFormularioBusqueda').removeClass('active');
//        $(this).addClass('active');
//        $('#divFormularioRegistro').removeClass('hide');
//        $('#divFormularioRegistro').addClass('show');
//        $('#divFormularioBusqueda').removeClass('show');
//        $('#divFormularioBusqueda').addClass('hide');
    });
    
    $('#botonFormularioBusqueda').on('click',function(){
        $('#botonFormularioRegistro').removeClass('active');
        $(this).addClass('active');
        $('#divFormularioBusqueda').removeClass('hide');
        $('#divFormularioBusqueda').addClass('show');
        $('#divFormularioRegistro').removeClass('show');
        $('#divFormularioRegistro').addClass('hide');
    });
    
    $('#dtp-fecha-desde').datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
    });
    
    $('#dtp-fecha-hasta').datetimepicker({
        format: 'DD/MM/YYYY HH:mm'
    });
});
