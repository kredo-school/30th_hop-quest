@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/viewspot.css') }}">
<link rel="stylesheet" href="{{ asset('css/viewbusiness.css') }}">

@section('title', 'Edit_Spot')

@section('content')
    {{-- spot main image + title --}}
    <div class="container justify-content-center align-items-center text-center mt-5">
        <div class="row row-cols-1 row-cols-md-4">
            <div class="col-12 col-md-12 spot-main-image p-0">
                @if(Str::startsWith($spot->main_image, 'http') || Str::startsWith($spot->main_image, 'data:'))
                    <img src="{{ $spot->main_image }}" alt="header-img" class="img-fluid w-100 ">
                @else
                    <img src="{{ asset('storage/' . $spot->main_image) }}" alt="header-img" 
                    class="img-fluid w-100">
                @endif
                {{-- <img src="{{ asset($spot->main_image) }}" alt="{{ $spot->title }}"> --}}
                <h5 class=" main-title">{{ $spot->title }}</h5>
            </div>
        </div>

    {{-- spot owner + date --}}
    <div class="row align-items-center spot-user-info mt-3">
        <div class="profile-container">
            <div class="profile-left">
                <div class="profile-main">
                    <div class="col-md-auto col-sm-2 my-auto p-0 profile-pic">                   
                        <button class="btn">
                            @if($spot->user->avatar)
                                <img src="{{ $spot->user->avatar }}" alt="" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary profile-sm d-block text-center"></i>
                            @endif
                        </button>
                    </div>

                    <div class="profile-name">{{$spot->user->name}}</div>
                </div>
                
                <!--Follow-->
                <div class="col-md-1 col-sm-1 ">
                    @if($spot->user->isFollowed())
                    {{-- unfollow --}}
                        <form action="{{route('follow.delete', $spot->user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-following btn-sm mt-3 w-100">Following</button>
                        </form>

                    @else
                    {{-- follow --}}
                    <form action="{{route('follow.store', $spot->user->id )}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-follow btn-sm mt-3 w-100">Follow</button>
                    </form>
                    @endif 
                </div>

                <div class="profile-icons ms-5">
                    {{-- red heart/unlike --}}
                    <div class="mt-3">
                        @if($spot->isLiked())                            
                            <form action="{{ route('spots.like.delete', $spot->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn p-0">
                                    <i class="fa-solid fa-heart color-red {{ $spot->isLiked() ? '' : 'text-secondary' }}" ></i>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('spots.like.store', $spot->id) }}" method="post">
                                @csrf
                                <button type="sumbit" class="btn p-0">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <div>
                    <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#">
                        <span>{{ $spot->likes->count() }}</span>
                    </button>
                </div>

                <!--Comment-->
                <div class="ms-3 mt-2 p-0">
                    <div>
                        <i class="fa-regular fa-comment h5"></i>
                    </div>
                </div>
                <div class="px-0">
                    <span>{{ $spot->comments->count()}}</span>
                </div>

                <!--Viewer-->
                <div class="ms-3 p-0">
                    <div>
                        <img src="{{ asset('images/chart.png') }}" alt="">
                    </div>
                </div>
                <div class="px-0">
                    <button class="dropdown-item text-dark">
                        0{{-- <span>{{ $post['views_count'] }}</span> --}}
                    </button>
                </div>

                <div class="col-md-auto col-sm-12 pe-0 ms-auto profile-update">
                    @if($spot->updated_at)
                        <h5 class="card-subtitle">Updated: {{ $spot->updated_at->format('M d Y')}}</h5>
                    @else
                        <h5 class="card-subtitle">Posted: {{ $spot->created_at->format('M d Y')}}</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>

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
    <div class="row spot-photos-grid">
        @php
            $images = json_decode($spot->images) ?? [];
        @endphp
        @foreach($images as $image)
            <div class="col-6 col-sm-4 col-md-3 mb-4">
                <div class="spot-photo-item">
                    <img src="{{ $image }}" alt="{{ $spot->title }}">
                </div>
            </div>
        @endforeach
    </div>

    <hr>
    <div class="row row-cols-1 row-cols-md-4">
        <div class="col-12 col-md-12 spot-comments">
            @include('spots.comment.body', ['spot' => $spot])
        </div>
    </div>


    {{-- view Google Maps --}}
    <script src="{{ asset('js/show-map.js') }}"></script>
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initMap">
    </script>

    {{-- view images --}}
    <script src="{{ asset('js/show-images.js') }}"></script>

@endsection