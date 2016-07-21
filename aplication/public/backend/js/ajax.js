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

function getLocation() {
    var value;
    var addressSearch = $("#addressSearch").val();
    
    if(addressSearch === ""){
        return;
    }
    
    value = $("#country").val();
    var country = $("#country option[value='" + value + "']").text();
    
    value = $("#province").val();
    var province = $("#province option[value='" + value + "']").text();
    
    value = $("#state").val();
    var state = $("#state option[value='" + value + "']").text();
    
    value = $("#city").val();
    var city = $("#city option[value='" + value + "']").text();
    
    var address = addressSearch + ", " + city + ", " + state + ", " + province + " , " + country;
    var parametros = {"address": address};

    $.ajax({
        data: parametros,
        url: '../findLocation',
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
            console.log("Solicitando Posicion para \"" + address + "\"");
            $("#imgSearch").append("<img src='../../aplication/public/backend/img/preloader.gif'>");
        },
        success: function (response) {
            $("#imgSearch").empty();
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

function getProvinces(){
    var value = $("#country").val();
    var text = $("#country option[value='" + value + "']").text();
    
    var parametros = {"id": value};

    $.ajax({
        data: parametros,
        url: '../findProvinces',
        type: 'POST',
        beforeSend: function () {
            console.log("Buscando Provincias para Pais \"" + text + "\"");
        },
        success: function (response) {
            console.log("Respuesta Recibida");
            $("#province option").remove(); 
            $("#province").html(response);
            getStates();
        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.Message);
        }

    });
}

function getStates(){
    var value = $("#province").val();
    var text = $("#province option[value='" + value + "']").text();
    
    var parametros = {"id": value};

    $.ajax({
        data: parametros,
        url: '../findStates',
        type: 'POST',
        beforeSend: function () {
            console.log("Buscando Partidos para Provincia \"" + text + "\"");
        },
        success: function (response) {
            console.log("Respuesta Recibida");
            $("#state option").remove(); 
            $("#state").html(response);
            getCities();
        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.Message);
        }

    });
}

function getCities(){
    var value = $("#state").val();
    var text = $("#state option[value='" + value + "']").text();
    
    var parametros = {"id": value};

    $.ajax({
        data: parametros,
        url: '../findCities',
        type: 'POST',
        beforeSend: function () {
            console.log("Buscando Ciudades para Partido \"" + text + "\"");
        },
        success: function (response) {
            console.log("Respuesta Recibida");
            $("#city option").remove(); 
            $("#city").html(response);
            
            var resultValue = $("#city").val();
            if(resultValue === "1"){
                $("#gMapsArea").hide();
            } else{
                $("#gMapsArea").show();
                initMap();
            }
        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err.Message);
        }

    });
}