@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h2>Add Spot</h2>
    <form action="" name="add-spot" style="max-width: 600px; margin: auto;">
        <div style="margin-bottom: 15px;">
            <label for="title" style="display: block; margin-bottom: 5px;">Spot title</label>
            <input type="text" id="title" placeholder="What unique spot did you find?" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="image" style="display: block; margin-bottom: 5px;">Spot image</label>
            <input type="text" id="image" placeholder="This photo viewing header on spot page" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="detail" style="display: block; margin-bottom: 5px;">Spot detail</label>
            <textarea id="detail" placeholder="This photo viewing header on spot page" style="width: 100%; padding: 8px; box-sizing: border-box;"></textarea>
        </div>
        <div style="margin-bottom: 15px;">
            <label for="photo" style="display: block; margin-bottom: 5px;">Upload photo</label>
            <input type="file" id="photo" accept="image/*" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <input type="text" id="address" placeholder="住所を入力">
            <button onclick="geocodeAddress()">検索</button>
            <div id="map" style="height: 500px;"></div>
            <div id="place-photo"></div>
        </div>

        <input type="submit" value="CHECK" style="width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
    </form>


@vite(['resources/js/map.js'])
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap" async defer></script>

@endsection
