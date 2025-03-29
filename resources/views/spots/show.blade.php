@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/viewspot.css') }}">

@section('title', 'Edit_Spot')

@section('content')
    {{-- spot main image + title --}}
    <div class="container justify-content-center align-items-center text-center">
    <div class="row row-cols-1 row-cols-md-4">
        <div class="col-12 col-md-12 spot-main-image">
            <img src="{{ asset($spot->main_image) }}" alt="{{ $spot->title }}">
            <h5 class="spot-image-caption">{{ $spot->title }}</h5>
        </div>
    </div>
    <hr>
        

    {{-- spot owner + date --}}
    <div class="row align-items-center spot-user-info">
        <div class="col-auto">
            <a href="{{ route('spot.show', $spot->user->id) }}" class="spot-user-link">
                <img src="{{ asset($spot->user->avatar) }}" alt="{{ $spot->user->name }}" class="spot-user-avatar">
            </a>
        </div>
        <div class="col-auto">
            <a href="{{ route('spot.show', $spot->user->id) }}" class="spot-user-link">
                {{ $spot->user->name }}
            </a>
        </div>
        <div class="col-auto">
            <p class="spot-date">{{ date('M d, Y', strtotime($spot->created_at)) }}</p>
        </div>
    </div>

    {{-- heart button + no. likes + no. views + no. comments --}}
    <div class="row align-items-center">
       <div class="spot-actions">
            {{-- heart button and count--}}
            <div class="spot-action-item">
                <div class="col-auto">
                    @auth
                        {{-- check if the spot is liked by the user --}}
                        @if($spot->likes->where('user_id', Auth::user()->id)->where('spot_id', $spot->id)->count() > 0)
                            {{-- unlike spot --}}
                            <form action="{{ route('spot.unlike', $spot->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="like-button">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                            </form>
                        @else
                            {{-- like spot --}}
                            <form action="{{ route('spot.like', $spot->id) }}" method="post">
                                @csrf
                                <button type="submit" class="like-button">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                            </form>
                        @endif
                    @else
                        <i class="fa-regular fa-heart"></i>
                    @endauth
                </div>
                <span>{{ $spot->likes->count() }}</span>
            </div>

            {{-- View icon &  Number of view --}}
            <div class="spot-action-item">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span class="count">{{ $comment->views_count ?? 0 }}</span>
            </div>

            {{-- no. comments --}}
            <div class="spot-action-item">
                <i class="fa-solid fa-comment"></i>
                <span class="count">{{ $spot->comments->count() }}</span>
            </div>

        </div>
    </div>

    <hr>

    {{-- spot introduction + map --}}
    <div class="row row-cols-1 row-cols-md-4">
        <div class="col-12 col-md-4 spot-detail">
            <h5>Detail</h5>
            <p>{{ $spot->introduction }}</p>
        </div>
        <div class="col-12 col-md-8 spot-map">
            <h5>Map</h5>
            <div id="map" class="spot-map-container" 
                data-lat="{{ $spot->geo_lat }}" 
                data-lng="{{ $spot->geo_lng }}">
            </div>
        </div>
    </div>            
    
    <hr>
    <h5>Photos</h5>
    <div class="row row-cols-1 row-cols-md-4">
        @if($spot->images)
            @foreach(json_decode($spot->images) as $image)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="spot-photo-grid">
                        <img src="{{ asset($image) }}" alt="{{ $spot->title }}">
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <hr>
    <div class="row row-cols-1 row-cols-md-4">
        <div class="col-12 col-md-12 spot-comments">
            @include('spots.comment.body', ['spot' => $spot])
        </div>
    </div>

    {{-- public/map.js --}}
    <script src="{{ asset('map.js') }}"></script>

    {{-- Google Maps API (callback=initMap) --}}
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap">
    </script>

@endsection