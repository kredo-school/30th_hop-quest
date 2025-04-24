function initMap() {
    const mapElement = document.getElementById('map');
    const lat = parseFloat(mapElement.dataset.lat);
    const lng = parseFloat(mapElement.dataset.lng);

    if (isNaN(lat) || isNaN(lng)) {
        console.warn("❗地図を初期化できません：位置情報が無効です");
        return; // 初期化中止
    }

    map = new google.maps.Map(mapElement, {
        center: { lat: lat, lng: lng },
        zoom: 15,
    });

    new google.maps.Marker({
        map: map,
        position: { lat: lat, lng: lng },
    });
}
