
var lat = document.getElementById("latitude");
var long = document.getElementById("longitude");
var acc = document.getElementById("accuracy");

function getLocation() {
if (navigator.geolocation) {
navigator.geolocation.watchPosition(showPosition);
} else { 
lat.value = "Geolocation is not supported by this browser.";
long.value = "Geolocation is not supported by this browser.";
acc.value = "Geolocation is not supported by this browser.";
}
}

var options = {
enableHighAccuracy: true,
timeout: 5000,
maximumAge: 0
};

function showPosition(position) {
lat.value=position.coords.latitude;
long.value=position.coords.longitude;
acc.value=position.coords.accuracy;
}
                          