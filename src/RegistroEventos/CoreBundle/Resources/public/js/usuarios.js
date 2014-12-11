$(document).ready(function(){
    $('.botonCambiarClave').on('click',function(){
        $.ajax(
            {
                url : Routing.generate('usuarios_cambiar_clave_form',{id:$(this).attr('data-id')},true),
                type: "GET",
                success: function(datos)
                {
                    $("#contenidoPopUp").html(datos.vista   );
                    $('#ventanaPopUp').modal('show');
                },
                error: function() {
                    alert('error');
                }
            }
        );
    });
    
    $('#ventanaPopUp').on('mouseover',function(){
        $('.botonGuardarPopUp').on('click',function(){
            $.ajax(
                {
                    url : Routing.generate('usuario_cambiar_clave',{id:$(this).attr('data-id')},true),
                    type: "POST",
                    success: function(datos)
                    {
                        if(datos.actualizada){
                            $('#ventanaPopUp').modal('hide');
                        } else {
                            $("#contenidoPopUp").html(datos.vista);
                        }
                    },
                    error: function() {
                        alert('error');
                    }
                }
            );
        });
    });
});