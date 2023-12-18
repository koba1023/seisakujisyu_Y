'use strict';

let map, geocoder;

function initMap() {
    const kobeCoords = { lat: 34.6913, lng: 135.1830 }; // 神戸市の緯度経度座標
    const map = new google.maps.Map(document.getElementById("map"), {
        center: kobeCoords, // 神戸市を中心に設定
        zoom: 12, // ズームレベルを調整
    });

    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer({
        map,
    });

    const start = "神戸市の出発地点"; // 出発地点の住所など
    const end = "神戸市の到着地点"; // 到着地点の住所など

    const request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING, // 移動手段を指定
    };

    directionsService.route(request, function (result, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsRenderer.setDirections(result);
        } else {
            window.alert("Directions request failed due to " + status);
        }
    });
}