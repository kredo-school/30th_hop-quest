let map;
let service;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 35.682839, lng: 139.759455 }, // 東京駅を初期位置に設定
        zoom: 12,
    });
    service = new google.maps.places.PlacesService(map);
}

function geocodeAddress() {
    const address = document.getElementById("address").value;
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ address: address }, (results, status) => {
        if (status === "OK") {
            const location = results[0].geometry.location;
            map.setCenter(location);
            new google.maps.Marker({
                map: map,
                position: location,
            });

            // Place API を使用して場所の画像を取得
            getPlacePhoto(results[0].place_id);
        } else {
            alert("住所の取得に失敗しました: " + status);
        }
    });
}

function getPlacePhoto(placeId) {
    const request = {
        placeId: placeId,
        fields: ["photos"]
    };

    service.getDetails(request, (place, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            if (place.photos) {
                const photoUrl = place.photos[0].getUrl({ maxWidth: 200, maxHeight: 100 });
                document.getElementById("place-photo").innerHTML = `<img src="${photoUrl}" alt="Place Photo" style="width:100%; height:auto;">`;
            } else {
                document.getElementById("place-photo").innerHTML = "写真が見つかりませんでした。";
            }
        } else {
            document.getElementById("place-photo").innerHTML = "写真の取得に失敗しました。";
        }
    });
}

window.initMap = initMap;
