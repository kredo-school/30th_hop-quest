@extends('layouts.app')

@section('title', 'Edit_Spot')

@section('content')
    <div class="container">
      <h3>View spot</h3>
    </div>
    
    <div class="container justify-content-center align-items-center text-center">
    <div class="row row-cols-1 row-cols-md-4">
        <div class="col-12 col-md-12" style="position: relative; background-color: #4CAF50; padding: 20px;">
            <img src="{{ asset('images/mtfuji.jpg') }}" alt="" style="width: 75%; height: auto; max-height: 200px; margin-bottom: 20px;">
            <h5 style="position: absolute; bottom: 10px; left: 10px; color: white; background-color: rgba(0, 0, 0, 0.5); padding: 5px;">Beutiful temple and Mt.Fuji from XYZ</h5>
        </div>
    </div>
        
    <hr>

    <div class="row row-cols-1 row-cols-md-4">
        <div class="col-12 col-md-4" style="background-color: #af4ca3">
            <h5>Detail</h5>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus eius voluptatum blanditiis sed nemo dicta sunt sapiente dignissimos odio, illo assumenda voluptatibus omnis. Labore odit error facilis explicabo doloremque impedit.</p>
        </div>
        <div class="col-12 col-md-8" style="background-color: #7a4caf">
            <h5>Map</h5>
            <div id="map" style="height: calc(100vh - 100px); width: 100%; margin-bottom: 10px"></div>
        </div>
    </div>            
    
    <hr>
    <h5>Photos</h5>
    <div class="row row-cols-1 row-cols-md-4">
            @foreach (glob(public_path('images/spot_sample/*')) as $image)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div style="width: 100%; height: 200px; overflow: hidden; margin-bottom: 10px;">
                        <img src="{{ asset('images/spot_sample/' . basename($image)) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            @endforeach
    </div>

    <hr>
    <div class="row row-cols-1 row-cols-md-4">
        <div class="col-12 col-md-12" style="background-color: #219c92">
            @include('components.comment')
        </div>
    </div>


    {{-- public/map.js を直接読み込む --}}
    <script src="{{ asset('map.js') }}"></script>

    {{-- Google Maps API のスクリプト（callback=initMap） --}}
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap">
    </script>

@endsection