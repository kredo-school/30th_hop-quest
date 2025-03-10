<div>
    <input type="text" id="address" placeholder="住所を入力">
    <button onclick="geocodeAddress()">検索</button>
    <div id="map" style="height: 500px;"></div>
    <div id="place-photo"></div>
</div>

@push('scripts')
    <script src="{{ asset('js/map.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap" async defer></script>
@endpush

