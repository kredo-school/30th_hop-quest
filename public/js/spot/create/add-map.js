function initMap() {
    const lat = parseFloat(document.getElementById("geo_lat").value);
    const lng = parseFloat(document.getElementById("geo_lng").value);

    const defaultLatLng = { lat: 35.0116, lng: 135.7681 }; // 京都のデフォルト
    const hasLatLng = !isNaN(lat) && !isNaN(lng);
    const initialLatLng = hasLatLng ? { lat, lng } : defaultLatLng;

    const map = new google.maps.Map(document.getElementById("map"), {
        center: initialLatLng,
        zoom: hasLatLng ? 15 : 12,
    });

    const marker = new google.maps.Marker({
        position: initialLatLng,
        map: map,
        draggable: true,
    });

    // ドラッグ後の位置をinputに反映
    marker.addListener("dragend", function (event) {
        document.getElementById("geo_lat").value = event.latLng.lat();
        document.getElementById("geo_lng").value = event.latLng.lng();
    });

    // クリックでピン移動
    map.addListener("click", function (event) {
        marker.setPosition(event.latLng);
        document.getElementById("geo_lat").value = event.latLng.lat();
        document.getElementById("geo_lng").value = event.latLng.lng();
    });
}
