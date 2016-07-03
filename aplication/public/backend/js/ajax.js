/*
 * Nombre           : ajax.js                                                  
 * Autor            : Cesar Cappetto                                           
 * Descripcion      : En este archivo se alojan todas las funciones JS         
 *                  : que realizan pedidos tipo AJAX                           
 * Fecha            : 03/09/2015                                            
 * Observaciones    : Todos los pedidos, se realizan a traves de JQuery                                                         *
 */

function removeRegister(id, url)
{
    var parametros = { "id" : id};
    
    $.ajax({
        data: parametros,
        url: url,
        type: 'POST',
        beforeSend: function () { },
        success: function () {
            location.reload();
        },
        error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
        }
    });
}