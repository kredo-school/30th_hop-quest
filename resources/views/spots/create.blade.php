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
                <form action="{{ route('spot.store') }}" method="POST" class="add-spot-form" enctype="multipart/form-data">
                    @csrf

                    {{-- title --}}
                    <div class="form-group">
                        <label for="title" class="form-label">Spot title</label>
                        <input type="text" id="title" name="title" placeholder="What unique spot did you find?" class="form-input" required>
                    </div>

                    {{-- main image --}}
                    <div class="form-group">
                        <label for="main_image" class="custom-file-label">Select your main image</label>
                        <span id="file-name" class="file-name">No Selected</span>
                    </div>

                    {{-- introduction --}}
                    <div class="form-group">
                        <label for="introduction" class="form-label">Spot introduction</label>
                        <textarea id="introduction" name="introduction" placeholder="This photo viewing introduction on spot page" class="form-textarea" required></textarea>
                    </div>

                    {{-- upload photos --}}
                    <div class="form-photo-container">
                        <div class="photo-upload-group">
                            <label for="spot-images" class="form-label">Photos</label>
                            <div class="upload-controls">
                                <input type="file" name="spot-images" id="spot-images" class="custom-file-input" multiple>
                                <button type="button" class="btn btn-green custom-file-label" id="upload-btn">
                                    <i class="fa-solid fa-plus icon-xs"></i>Photo
                                </button>
                            </div>
                            <p class="xsmall">
                                Acceptable formats: jpeg, jpg, png, gif only <br>
                                Max file size is 1048 KB
                            </p>
                        </div>
                    </div>

                    {{-- uploaded file views --}}
                    <div id="uploaded-file-names"></div>
                </form>
            </div>

            {{-- right side --}}
            <div class="col-12 col-md-6 map-container">    
                <label for="address" class="form-label">Search Symbol</label>
                <div class="search-container">
                    <input type="text" id="address" placeholder="Input address " class="search-input">
                    <button onclick="geocodeAddress(); return false;" class="search-button">Search</button>
                </div>
                <div id="map" class="spot-map-container"></div>
                <div id="place-photo" class="place-photo"></div>
            </div>
        </div>

        {{-- second row: submit button --}}
        <div class="row justify-content-end align-items-center text-center">
            <div class="col-4 align-items-center text-center">
                <div class="form-group">
                    <button type="submit" class="submit-button">CHECK</button>
                </div>
            </div>
        </div>
    </div>

    {{-- photo-container.js を読み込む --}}
    <script src="{{ asset('js/quest/photo-container.js') }}"></script>

    {{-- public/map.js を直接読み込む --}}
    <script src="{{ asset('map.js') }}"></script>

    {{-- Google Maps API のスクリプト（callback=initMap） --}}
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap">
    </script>



@endsection

