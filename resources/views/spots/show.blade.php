@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/viewspot.css') }}">
<link rel="stylesheet" href="{{ asset('css/viewbusiness.css') }}">

@section('title', 'Edit_Spot')

@section('content')
    {{-- spot main image + title --}}
    <div class="bg-green">
        <meta name="auth-user-id" content="{{ Auth::check() ? Auth::id() : '' }}">

        <div class="container-fluid pt-5 d-flex justify-content-center">
            <div class="col-11 col-md-9">
                <div class="py-4 position-relative w-100">
                    <div class="spot-main-image text-center px-0 rounded-3">
                        <img src="{{ asset($spot->main_image) }}" alt="{{ $spot->title }}" class="h-auto-md-down rounded-3">
                        <h5 class="spot-image-caption w-100 px-3">{{ $spot->title }}</h5>
                    </div>
                </div>

                {{-- spot owner + date --}}
                @include('spots.user-bar')

                {{-- spot introduction + map --}}
                <div class="row text-center w-100 px-0 mx-0 pt-3 pt-md-5">
                    <div class="col-md-4 spot-detail text-center d-flex flex-column ps-md-0 px-sm-0">
                        <h5 class="poppins-semibold fs-4">Detail</h5>
                        <hr class="dashed-hr">
                        <p class="text-start rounded-3 p-3 flex-grow-1 mb-2">{{ $spot->introduction }}</p>
                        <hr class="dashed-hr">
                    </div>
                    <div class="col-md-8 spot-map pe-md-0 ps-md-3 px-sm-0 py-0">
                        <h5 class="poppins-semibold fs-4">Map</h5>
                        <div id="map" class="spot-map-container w-100 rounded-3" data-lat="{{ $spot->geo_lat }}"
                            data-lng="{{ $spot->geo_lng }}">
                        </div>
                    </div>
                </div>


                <h5 class="poppins-semibold fs-4 text-center pt-3">Photos</h5>
                <div class="row spot-photos-grid px-0 justify-content-center">
                    @php
                        // もし$spot->imagesがすでに配列なら、直接使う
                        $images = is_array($spot->images) ? $spot->images : json_decode($spot->images, true) ?? [];
                    @endphp
                    @foreach ($images as $image)
                        <div class="col-6 col-sm-4 col-md-3 mb-4">
                            <div class="w-100">
                                <img src="{{ $image }}" alt="{{ $spot->title }}" class="w-100 rounded-3">
                            </div>
                        </div>
                    @endforeach
                </div>

                <hr>
                <section id="spot-comment-section">
                    <div class="row row-cols-1 row-cols-md-4 py-4 text-center">
                        <div class="col-12 col-md-12 spot-comments">
                            @include('spots.comment.body', ['spot' => $spot])
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    {{-- view Google Maps --}}
    <script src="{{ asset('js/spot/view/show-map.js') }}"></script>
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initMap">
    </script>

    {{-- view images --}}
    <script src="{{ asset('js/spot/view/show-spot.js') }}"></script>
@endsection
