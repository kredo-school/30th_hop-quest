let map;
let service;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 35.682839, lng: 139.759455 },
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
            
            // hidden inputに位置情報を設定
            document.getElementById("geo_lat").value = location.lat();
            document.getElementById("geo_lng").value = location.lng();
            document.getElementById("geo_location").value = results[0].formatted_address;
            
            map.setCenter(location);
            new google.maps.Marker({
                map: map,
                position: location,
            });

            getPlacePhoto(results[0].place_id);
        } else {
            alert("住所の取得に失敗しました: " + status);
        }
    });
    
    // フォーム送信を防止しないように変更
    return true;
}

function getPlacePhoto(placeId) {
    const request = {
        placeId: placeId,
        fields: ["photos"]
    };

    service.getDetails(request, (place, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            if (place.photos) {
                const photoUrl = place.photos[0].getUrl({ maxWidth: 150, maxHeight: 100 });
                document.getElementById("place-photo").innerHTML = `<img src="${photoUrl}" alt="Place Photo" style="width:200px; height:auto; max-width:100%;">`;
            } else {
                document.getElementById("place-photo").innerHTML = "    写真が見つかりませんでした。";
            }
        } else {
            document.getElementById("place-photo").innerHTML = "写真の取得に失敗しました。";
        }
    });
}

// イベントリスナーをform要素に追加してフォーム送信の処理を確実にする
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('spot-form');
    if (form) {
        form.addEventListener('submit', function(event) {
            // フォームの検証（必要に応じて）
            const geoLat = document.getElementById('geo_lat').value;
            const geoLng = document.getElementById('geo_lng').value;
            
            if (!geoLat || !geoLng) {
                alert('Please input your location.');
                event.preventDefault();
                return false;
            }
            return true;
        });
    }
});

// Google Maps API のコールバック関数として登録
window.initMap = initMap;
window.geocodeAddress = geocodeAddress;


