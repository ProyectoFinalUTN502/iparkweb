/*
 * Nombre           : ajax.js                                                  
 * Autor            : Grupo 502                                          
 * Descripcion      : En este archivo se alojan todas las funciones JS         
 *                  : que realizan pedidos tipo AJAX                           
 * Fecha            : 03/09/2015                                            
 * Observaciones    : Todos los pedidos, se realizan a traves de JQuery                                                         *
 */

function removeRegister(id, url)
{
    var parametros = {"id": id};

    $.ajax({
        data: parametros,
        url: url,
        type: 'POST',
        beforeSend: function () { },
        success: function () {
            location.reload();
        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.Message);
        }
    });
}

function getLocation(address) {
    var parametros = {"address": address};

    $.ajax({
        data: parametros,
        url: '../findLocation',
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
            console.log("Solicitando Posicion para \"" + address + "\"");
        },
        success: function (response) {
            if (response.status === "ERROR") {
                showAlert();
                console.log("No se encontro la direccion ingresada");

            } else {
                console.log("Recibido: " + response.lat + " , " + response.lng);
                $("#lat").val(response.lat);
                $("#lng").val(response.lng);
                addMarker(response.lat, response.lng);
                console.log("Marcador Agregado a Mapa");
            }
        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.Message);
        }

    });
}
