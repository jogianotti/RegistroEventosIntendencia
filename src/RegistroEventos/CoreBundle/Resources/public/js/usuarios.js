$(document).ready(function(){
    $('.botonCambiarClave').on('click',function(){
        $('#botonGuardarPopUp').attr('data-id',$(this).attr('data-id'));
        $('#ventanaPopUp').modal('show');
    });

    $('#botonGuardarPopUp').on('click',function(){
        var id = $(this).attr('data-id');
        if (String($("#plainPassword").val()) != String($("#repeatPlainPassword").val())){
            $("#error").removeClass('oculto');
        }else{
            $("#error").addClass('oculto');
            $.ajax(
                {
                    url : Routing.generate('usuarios_cambiar_clave',{ 'id': id }, true),
                    type: "POST",
                    data: $("#formularioCambiarClave").serializeArray(),
                    success: function(datos)
                    {
                        if(datos.actualizada){
                            $('#ventanaPopUp').modal('hide');
                        } else {
                            $("#contenidoPopUp").html(datos);
                            $('#botonGuardarPopUp').attr('data-id',id);
                        }
                    },
                    error: function() {
                        alert('error');
                    }
                }
            );
    }
});
});