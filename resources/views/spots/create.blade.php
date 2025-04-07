@extends('layouts.app')

@section('title', 'Add_Spot')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/map.css')}}">
    <link rel="stylesheet" href="{{ asset('css/addspot.css')}}">
@endsection

@section('content')
    @if(session('error'))
    <div class="container">
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    </div>
    @endif

    <div class="container justify-content-center align-items-center text-center">
        {{-- first row: form content --}}
        <div class="row row-cols-1 row-cols-md-2">
            {{-- left side --}}
            <div class="col-12 col-md-6 add-spot-container">
                <form action="{{ route('spot.store') }}" method="POST" class="add-spot-form" id="spot-form" enctype="multipart/form-data">
                    @csrf

                    {{-- title --}}
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" placeholder="What unique spot did you find?" class="form-input" required>
                    </div>

                    {{-- main image --}}
                    <div class="form-group">
                        <label for="main_image" class="form-label fw-bold">Cover Image</label>
                        <input type="file" id="main_image" name="main_image"  class="form-control" aria-describedby="main_image-info">
                        <div class="form-text" id="main_image-info">
                            The acceptable formats are jpeg, jpg, png and gif only.<br>
                            Max file is 1048Kb.
                        </div>
                        @error('main_image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                   
                    {{-- introduction --}}
                    <div class="form-group">
                        <label for="introduction" class="form-label">Introduction</label>
                        <textarea id="introduction" name="introduction" placeholder="This photo viewing introduction on spot page" class="form-textarea" required></textarea>
                    </div>

                    {{-- Images --}}
                    <div class="form-group">
                        <label for="images" class="form-label">Images</label>
                        <input type="file" id="images" name="images[]" class="form-control" multiple>
                        <div id="image-preview" class="mt-2"></div>
                    </div>
                    
                    {{-- hidden input about location --}}
                    <input type="hidden" name="geo_lat" id="geo_lat">
                    <input type="hidden" name="geo_lng" id="geo_lng">
                    <input type="hidden" name="geo_location" id="geo_location">
                </form>

                {{-- submit button --}}
                <div class="d-flex justify-content-center align-items-center text-center">
                    <div class="form-group">
                        <button type="submit" class="submit-button" form="spot-form">Register Spot</button>
                    </div>
                </div>
            </div>

            {{-- right side --}}
            <div class="col-12 col-md-6 map-container">    
                <label for="address" class="form-label">Search Symbol</label>
                <div class="search-container">
                    <input type="text" id="address" placeholder="Input address " class="search-input">
                    <button type="button" onclick="geocodeAddress()" class="search-button">Search</button>
                </div>
                <div id="map" class="spot-map-container"></div>
                <div id="place-photo" class="place-photo mb-5"></div>
            </div>

        </div>

        {{-- Add Google Maps info --}}
        <script src="{{ asset('js/add-map.js') }}"></script>
        <script async
            src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap">
        </script>

        {{-- Add images --}}
        <script src="{{ asset('js/add-images.js') }}"></script>
    </div>

@endsection

