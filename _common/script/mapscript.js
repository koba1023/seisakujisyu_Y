'use strict';

let map, geocoder;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 12,
    });
    geocoder = new google.maps.Geocoder();
}

function searchLocation() {
    const address = document.getElementById('searchInput').value;

    geocoder.geocode({ 'address': address }, (results, status) => {
        if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            const marker = new google.maps.Marker({
                map,
                position: results[0].geometry.location,
                title: address,
            });
        } else {
            alert('位置情報が見つかりませんでした: ' + status);
        }
    });
}