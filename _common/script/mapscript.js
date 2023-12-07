'use strict';

let map, infoWindow;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 12,
    });
    infoWindow = new google.maps.InfoWindow();

    // 現在位置の取得
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent("現在位置");
                infoWindow.open(map);
                map.setCenter(pos);
            },
            () => {
                handleLocationError(true, infoWindow, map.getCenter());
            }
        );
    } else {
        handleLocationError(false, infoWindow, map.getCenter());
    }

    // 避難場所の検索
    const service = new google.maps.places.PlacesService(map);
    service.nearbySearch(
        {
            location: map.getCenter(),
            radius: 5000, // 検索半径（メートル）
            keyword: "避難場所", // 検索キーワード
        },
        (results, status) => {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                for (let i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
            }
        }
    );
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
        browserHasGeolocation
            ? "エラー: 位置情報の取得に失敗しました。"
            : "エラー: ブラウザが位置情報取得をサポートしていません。"
    );
    infoWindow.open(map);
}

function createMarker(place) {
    const marker = new google.maps.Marker({
        map,
        position: place.geometry.location,
        title: place.name,
    });

    const infowindow = new google.maps.InfoWindow({
        content: place.name,
    });

    marker.addListener("click", () => {
        infowindow.open(map, marker);
    });
}