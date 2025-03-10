<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Articles')

@section('content')
    @include('businessusers.profiles.header')

<div class="mb-5 row justify-content-center bg-blue">
{{-- Management business --}}
    <div class="col-8 mb-5 ">
        <div class="row">
            <div class="col">
                <h2>Management Business</h2>
            </div>
            <div class="col-2">
                <a href="#" class="btn btn-sm btn-navy text-white mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
            </div>
        </div>
        <div class="row">
            {{-- Kredo cafe --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Kredo Cafe</h4>
                    </div>
                    <div class="card-body mx-auto">
                        <img src="{{asset('images/kredocafeimage.jpg')}}" alt="" class="body-image">
                    </div>
                    <div class="card-footer">
                        <h5>Mar 5 2025 ~ Apr 26/2025</h5>
                        <p>Join us for an unforgettable Summer Festival at Hop Hotel!</p>
                    </div>
                </div>
                <div>
                    <h6>Status: <i class="fa-solid fa-circle text-success"></i> Visible</h6>
                    <h6>Display period: Mar 5 2025 ~ Apr 26/2025</h6>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-green fw-bold mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-outline-green fw-bold mb-2 w-100">HIDE</a>
                    </div>
                </div>
            </div>
            {{-- Kredo hotel --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Kredo Hotel</h4>
                    </div>
                    <div class="card-body mx-auto">
                        <img src="{{asset('images/kredohotelimage.jpg')}}" alt="" class="body-image">
                    </div>
                    <div class="card-footer">
                        <h5>Mar 5 2025 ~ Apr 26/2025</h5>
                        <p>Join us for an unforgettable Summer Festival at Hop Hotel!</p>
                    </div>
                </div>
                <div>
                    <h6>Status: <i class="fa-solid fa-circle text-danger"></i> Invisible</h6>
                    <h6>Display period: Mar 5 2025 ~ Apr 26/2025</h6>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-red mb-2 w-100">UNHIDE</a>
                    </div>
                </div>
            </div>
            {{-- Kredo Pub--}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Kredo Pub</h4>
                    </div>
                    <div class="card-body mx-auto">
                        <img src="{{asset('images/kredopubimage.jpg')}}" alt="" class="body-image">
                    </div>
                    <div class="card-footer">
                        <h5>Mar 5 2025 ~ Apr 26/2025</h5>
                        <p>Join us for an unforgettable Summer Festival at Hop Hotel!</p>
                    </div>
                </div>
                <div>
                    <h6>Status: <i class="fa-solid fa-circle text-success"></i> Visible</h6>
                    <h6>Display period: Mar 5 2025 ~ Apr 26/2025</h6>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-outline-green mb-2 w-100">HIDE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Promotions --}}
    <div class="col-8 mb-5">
        <div class="row">
            <div class="col">
                <h2>Promotions</h2>
            </div>
            <div class="col-2">
                <a href="#" class="btn btn-sm btn-navy mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
            </div>
        </div>
        <div class="row">
            {{-- Excursion --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Experience the Magic of Summer at HopHotel!</h4>
                    </div>
                    <div class="card-body ">
                        <img src="{{asset('images/festival.jpg')}}" alt="" class="body-image ">
                    </div>
                    <div class="card-footer">
                        <h4>Mar 5 2025 ~ Apr 26/2025</h4>
                        <p>Join us for an unforgettable Summer Festival at Hop Hotel!</p>
                    </div>
                </div>
                <div>
                    <h6>Status: <i class="fa-solid fa-circle text-success"></i> Visible</h6>
                    <h6>Display period: Mar 5 2025 ~ Apr 26/2025</h6>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-outline-green mb-2 w-100">HIDE</a>
                    </div>
                </div>
            </div>
            {{-- Breakfast --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Free Breakfast Promotion at HopHotel!</h4>
                    </div>
                    <div class="card-body mx-auto">
                        <img src="{{asset('images/breakfast.jpg')}}" alt="" class="body-image">
                    </div>
                    <div class="card-footer">
                        <h4>Mar 5 2025 ~ Apr 26/2025</h4>
                        <p>Join us for an unforgettable Summer Festival at Hop Hotel!</p>
                    </div>
                </div>
                <div>
                    <h6>Status: <i class="fa-solid fa-circle text-danger"></i> Invisible</h6>
                    <h6>Display period: Mar 5 2025 ~ Apr 26/2025</h6>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-red mb-2 w-100">UNHIDE</a>
                    </div>
                </div>
            </div>
            {{-- Wine tasting--}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Wine Tasting Night at HopHotel!</h4>
                    </div>
                    <div class="card-body mx-auto">
                        <img src="{{asset('images/winetasting.jpg')}}" alt="" class="body-image">
                    </div>
                    <div class="card-footer">
                        <h4>Mar 5 2025 ~ Apr 26/2025</h4>
                        <p>Join us for an unforgettable Summer Festival at Hop Hotel!</p>
                    </div>
                </div>
                <div>
                    <h6>Status: <i class="fa-solid fa-circle text-success"></i> Visible</h6>
                    <h6 class="">Display period: Mar 5 2025 ~ Apr 26/2025</h6>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-outline-green mb-2 w-100">HIDE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Model Quests --}}
    <div class="col-8">
        <div class="row">
            <div class="col">
                <h2>Model Quests</h2>
            </div>
            <div class="col-2">
                <a href="#" class="btn btn-sm btn-navy mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
            </div>
        </div>
        <div class="row">
            {{-- Excursion --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Excursion</h4>
                    </div>
                    <div class="card-body mx-auto">
                        <img src="{{asset('images/excursion.jpg')}}" alt="" class="body-image">
                    </div>
                    <div class="card-footer">
                        <h4>Mar 5 2025 ~ Apr 26/2025</h4>
                        <p>Join us for an unforgettable Summer Festival at Hop Hotel!</p>
                    </div>
                </div>
                <div>
                    <h6>Status: <i class="fa-solid fa-circle text-success"></i> Visible</h6>
                    <h6>Display period: Mar 5 2025 ~ Apr 26/2025</h6>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-outline-green mb-2 w-100">HIDE</a>
                    </div>
                </div>
            </div>
            {{-- seashore piknik --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Seashore picnic</h4>
                    </div>
                    <div class="card-body mx-auto">
                        <img src="{{asset('images/seashore.jpg')}}" alt="" class="body-image">
                    </div>
                    <div class="card-footer">
                        <h4>Mar 5 2025 ~ Apr 26/2025</h4>
                        <p>Join us for an unforgettable Summer Festival at Hop Hotel!</p>
                    </div>
                </div>
                <div>
                    <h6>Status: <i class="fa-solid fa-circle text-danger"></i> Invisible</h6>
                    <h6>Display period: Mar 5 2025 ~ Apr 26/2025</h6>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-red mb-2 w-100">UNHIDE</a>
                    </div>
                </div>
            </div>
            {{-- Birdwatching--}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Bird watching tour</h4>
                    </div>
                    <div class="card-body mx-auto">
                        <img src="{{asset('images/birdwatching.jpg')}}" alt="" class="body-image">
                    </div>
                    <div class="card-footer">
                        <h4>Mar 5 2025 ~ Apr 26/2025</h4>
                        <p>Join us for an unforgettable Summer Festival at Hop Hotel!</p>
                    </div>
                </div>
                <div>
                    <h6>Status: <i class="fa-solid fa-circle text-success"></i> Visible</h6>
                    <h6>Display period: Mar 5 2025 ~ Apr 26/2025</h6>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-outline-green mb-2 w-100">HIDE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>
</div>
@endsection
