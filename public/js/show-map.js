let map;

function initMap() {
    // data属性から位置情報を取得
    const mapElement = document.getElementById('map');
    const lat = parseFloat(mapElement.dataset.lat);
    const lng = parseFloat(mapElement.dataset.lng);
    
    // マップの初期化
    map = new google.maps.Map(mapElement, {
        center: { lat: lat, lng: lng },
        zoom: 15,
    });

    // マーカーを作成
    new google.maps.Marker({
        map: map,
        position: { lat: lat, lng: lng },
    });
}

// Google Maps API のコールバック関数として登録
window.initMap = initMap; 