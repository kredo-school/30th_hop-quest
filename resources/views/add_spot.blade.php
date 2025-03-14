@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h2  class="container">Add Spot</h2>
    <div class="container justify-content-center align-items-center text-center">
        <div class="row row-cols-1 row-cols-md-4">
          <div class="col-12 col-md-4" style="background-color: #4CAF50">
            <form action="" name="add-spot" style="max-width: 600px; margin: auto;">
            <div style="margin-bottom: 20px;">
                <label for="title" style="display: block; margin-bottom: 5px;">Spot title</label>
                <input type="text" id="title" placeholder="What unique spot did you find?" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </div>
            <div style="margin-bottom: 20px;">
                <label for="image" style="display: block; margin-bottom: 5px;">Spot image</label>
                <!-- 隠されたファイル入力 -->
                <input type="file" id="file-input" class="custom-file-input">
                <!-- カスタムボタン（ラベル） -->
                <label for="file-input" class="custom-file-label">Select your header image</label>
                <!-- ファイル名表示エリア -->
                <span id="file-name" class="file-name">No Selected</span>

            </div>
            <div style="margin-bottom: 20px;">
                <label for="detail" style="display: block; margin-bottom: 5px;">Spot detail</label>
                <textarea id="detail" placeholder="This photo viewing header on spot page" style="width: 100%; height: 250px; padding: 8px; box-sizing: border-box;"></textarea>
            </div>
            <div style="margin-bottom: 20pxpx;">
                <label for="photo" style="display: block; margin-bottom: 5px;">Upload photo</label>
                <input type="file" id="photo" accept="image/*" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </div>
            </form>
          </div>
          <div class="col-12 col-md-8" style="background-color: #b92836">
            <label for="title" style="display: block; margin-bottom: 5px;">Search Symbol</label>
            <div style="display: flex; margin-bottom: 15px;">
                <input type="text" id="address" placeholder="住所を入力" style="flex: 1; padding: 8px; box-sizing: border-box;">
                <button onclick="geocodeAddress(); return false;" style="padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer; margin-left: 10px;">Search</button>
            </div>
            <div id="map" style="height: calc(100vh - 100px); width: 100%; margin-bottom: 10px"></div>
            <div id="place-photo" style="width: 20%; height:10%"></div>
          </div>
          <div class="col-12 col-md-4">
            <input type="submit" value="CHECK" style="width: 100%; padding: 10px; background-color: #3b28b9; color: white; border: none; cursor: pointer; margin-top: 10px;">
          </div>
        </div>
    </div>

{{-- need to npm run dev/build --}}
{{-- @vite(['resources/js/map.js'])
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap" async defer></script> --}}

{{-- No need to npm run dev/build --}}
@push('scripts')
    <script src="{{ asset('js/map.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap" async defer></script>
@endpush

@push('css')
    <link href="{{ asset('css/map.css') }}" rel="stylesheet">
@endpush

<script>
    // ファイルが選択されたら、ファイル名を表示する
    document.getElementById('file-input').addEventListener('change', function(event) {
        const fileName = event.target.files.length > 0 ? event.target.files[0].name : 'No Selected';
        document.getElementById('file-name').textContent = fileName;
    });
</script>


@endsection
