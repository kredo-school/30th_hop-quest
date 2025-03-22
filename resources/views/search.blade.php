@extends('layouts.app')

@section('title', 'Search-Result')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/search.css')}}">

@section('content')

    <div class="wrapper-tag">
        <div class="search-word">
            <h1 class="h1">Search word :  <strong>Kinkakuji</strong></h1>
        </div>

        <div class="row justify-content-center align-items-center tag-category">

            <div class="col-auto">
                <a href="#" class="text-decoration-none text-dark" data-category="followings">
                    <h1 class="poppins-semibold">
                        <img src="{{ asset('images/オリジナル（透過背景） black.png')}}" alt=""> All
                    </h1>
                </a>
            </div>

            <div class="col-auto ms-5">
                <a href="#" class="text-decoration-none text-dark" data-category="spot">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-location-dot"></i> Spots
                    </h1>
                </a>
            </div>

            <div class="col-auto ms-5">
                <a href="#" class="text-decoration-none text-dark" data-category="quest">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-plane fa-rotate-by" style="--fa-rotate-angle: -30deg;"></i> Quests
                    </h1>
                </a>
            </div>

            <div class="col-auto ms-5">
                <a href="#" class="text-decoration-none text-dark" data-category="location">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-map"></i> Locations
                    </h1>
                </a>
            </div>

            <div class="col-auto ms-5">
                <a href="#" class="text-decoration-none text-dark" data-category="event">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-calendar"></i> Events
                    </h1>
                </a>
            </div>        
        </div>

        <div class="d-flex justify-content-center mt-2">
            <div class="for-line"></div>
        </div>

    </div>

    
    <div class="container wrapper-body">
        <div class="row">
            <div class="col-4 mb-5">
                @include('search-result-body')
            </div>
            <div class="col-4">
                @include('search-result-body')
            </div>
            <div class="col-4">
                @include('search-result-body')
            </div>
            <div class="col-4">
                @include('search-result-body')
            </div>
            <div class="col-4">
                @include('search-result-body')
            </div>
            <div class="col-4">
                @include('search-result-body')
            </div>
        </div>
    </div>


@endsection