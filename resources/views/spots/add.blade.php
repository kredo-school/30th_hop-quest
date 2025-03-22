@extends('layouts.app')

@section('title', 'Add_Spot')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/map.css')}}">
    <link rel="stylesheet" href="{{ asset('css/spot/addspot.css')}}">
@endsection

@section('content')
    <h2 class="container">Add Spot</h2>
    <div class="container justify-content-center align-items-center text-center">
        <div class="row row-cols-1 row-cols-md-4">
          <div class="col-12 col-md-4 add-spot-container">
            <form action="" name="add-spot" class="add-spot-form">
            <div class="form-group">
                <label for="title" class="form-label">Spot title</label>
                <input type="text" id="title" placeholder="What unique spot did you find?" class="form-input">
            </div>
            <div class="form-group">
                <label for="image" class="form-label">Spot image</label>
                <input type="file" id="file-input" class="custom-file-input">
                <label for="file-input" class="custom-file-label">Select your header image</label>
                <span id="file-name" class="file-name">No Selected</span>
            </div>
            <div class="form-group">
                <label for="detail" class="form-label">Spot detail</label>
                <textarea id="detail" placeholder="This photo viewing header on spot page" class="form-textarea"></textarea>
            </div>
            <div class="form-group">
                <label for="photo" class="form-label">Upload photo</label>
                <input type="file" id="photo" accept="image/*" class="form-input">
            </div>
            </form>
          </div>
          <div class="col-12 col-md-8 map-container">
            <label for="title" class="form-label">Search Symbol</label>
            <div class="search-container">
                <input type="text" id="address" placeholder="住所を入力" class="search-input">
                <button onclick="geocodeAddress(); return false;" class="search-button">Search</button>
            </div>
            <div id="map" class="spot-map-container"></div>
            <div id="place-photo" class="place-photo"></div>
          </div>
          <div class="col-12 col-md-4">
            <input type="submit" value="CHECK" class="submit-button">
          </div>
        </div>
    </div>

    {{-- public/map.js を直接読み込む --}}
    <script src="{{ asset('map.js') }}"></script>

    {{-- Google Maps API のスクリプト（callback=initMap） --}}
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap">
    </script>
    
@endsection