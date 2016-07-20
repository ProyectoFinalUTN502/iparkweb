function mapOptions(x, y){
    var options = {
        center: {lat: x, lng: y},
        zoom: 15
    };
    return options;
}

function initMap(lat, long) {
    
    lat = lat || -34.6033451;
    long = long || -58.3814246;
    
    var options = mapOptions(lat, long);
    var map = new google.maps.Map(document.getElementById('map'), options);
    return map;
}

function addMarker(lat, long){
    var map = initMap(lat, long);
    var position = new google.maps.LatLng(lat, long);
    var marker = new google.maps.Marker({position: position, map: map});
    return marker;
}
