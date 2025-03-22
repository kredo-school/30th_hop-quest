@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/spot/viewspot.css') }}">

@section('title', 'Edit_Spot')

@section('content')
    <div class="container">
      <h3>View spot</h3>
    </div>
    
    <div class="container justify-content-center align-items-center text-center">
    <div class="row row-cols-1 row-cols-md-4">
        <div class="col-12 col-md-12 spot-main-image">
            <img src="{{ asset('images/mtfuji.jpg') }}" alt="">
            <h5 class="spot-image-caption">Beutiful temple and Mt.Fuji from XYZ</h5>
        </div>
    </div>
        
    <hr>

    <div class="row row-cols-1 row-cols-md-4">
        <div class="col-12 col-md-4 spot-detail">
            <h5>Detail</h5>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus eius voluptatum blanditiis sed nemo dicta sunt sapiente dignissimos odio, illo assumenda voluptatibus omnis. Labore odit error facilis explicabo doloremque impedit.</p>
        </div>
        <div class="col-12 col-md-8 spot-map">
            <h5>Map</h5>
            <div id="map" class="spot-map-container"></div>
        </div>
    </div>            
    
    <hr>
    <h5>Photos</h5>
    <div class="row row-cols-1 row-cols-md-4">
            @foreach (glob(public_path('images/spot_sample/*')) as $image)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="spot-photo-grid">
                        <img src="{{ asset('images/spot_sample/' . basename($image)) }}" alt="">
                    </div>
                </div>
            @endforeach
    </div>

    <hr>
    <div class="row row-cols-1 row-cols-md-4">
        <div class="col-12 col-md-12 spot-comments">
            @include('comment.body')
        </div>
    </div>

    {{-- public/map.js --}}
    <script src="{{ asset('map.js') }}"></script>

    {{-- Google Maps API (callback=initMap) --}}
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap">
    </script>

@endsection