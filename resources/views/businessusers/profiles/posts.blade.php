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
                <h4>Management Business</h4>
            </div>
            <div class="col-2">
                <a href="#" class="btn btn-sm btn-navy text-white mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
            </div>
        </div>
        <div class="row">
            {{-- Kredo cafe --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header bg-white">
                        <h5 class="fw-bold">Kredo Cafe</h5>                       
                    </div>
                    <div class="card-body mx-auto bg-white">
                        <img src="{{asset('images/kredocafeimage.jpg')}}" alt="" class="body-image mb-3">
                    </div>
                    <div class="card-footer bg-white border-0"> 
                        <h6>Mar 5 2025 ~ Apr 26/2025</h6>
                        <div >
                            <p class="card_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, odit? ipsum dolor sit, amet consectetur </p>
                        </div>                      
                    </div>
                </div>
                <div>
                    <p>Status: <i class="fa-solid fa-circle text-success"></i> Visible</p>
                    <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
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
                    <div class="card-header bg-white">
                        <h5 class="fw-bold">Kredo Hotel</h5>                       
                    </div>
                    <div class="card-body mx-auto bg-white">
                        <img src="{{asset('images/kredohotelimage.jpg')}}" alt="" class="body-image mb-3">
                    </div>
                    <div class="card-footer bg-white border-0 "> 
                        <h6>Mar 5 2025 ~ Apr 26/2025</h6>
                        <div >
                            <p class="card_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, odit? ipsum dolor sit, amet consectetur </p>
                        </div>                      
                    </div>
                </div>
                <div>
                    <p>Status: <i class="fa-solid fa-circle text-danger"></i> Invisible</p>
                    <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
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
                    <div class="card-header bg-white">
                        <h5 class="fw-bold">Kredo Pub</h5>                       
                    </div>
                    <div class="card-body mx-auto bg-white">
                        <img src="{{asset('images/kredopubimage.jpg')}}" alt="" class="body-image mb-3">
                    </div>
                    <div class="card-footer bg-white border-0 "> 
                        <h6 class="fw-bold">Mar 5 2025 ~ Apr 26/2025</h6>
                        <div >
                            <p class="card_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, odit? ipsum dolor sit, amet consectetur </p>
                        </div>                      
                    </div>
                </div>
                <div>
                    <p>Status: <i class="fa-solid fa-circle text-success"></i> Visible</p>
                    <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
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
                <h4>Promotions</h4>
            </div>
            <div class="col-2">
                <a href="{{ route('profile.promotion.create')}}" class="btn btn-sm btn-navy mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
            </div>
        </div>
        <div class="row">
            {{-- Excursion --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="fw-bold">Experience the Magic of Summer at HopHotel!</h5>
                    </div>
                    <div class="card-body mx-auto bg-white">
                        <img src="{{asset('images/festival.jpg')}}" alt="" class="body-image mb-3">
                    </div>
                    <div class="card-footer bg-white border-0 "> 
                        <h6 class="fw-bold">Mar 5 2025 ~ Apr 26/2025</h6>
                        <div >
                            <p class="card_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, odit? ipsum dolor sit, amet consectetur </p>
                        </div>                      
                    </div>
                </div>
                <div>
                    <p>Status: <i class="fa-solid fa-circle text-success"></i> Visible</p>
                    <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('profile.promotion.edit')}}" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
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
                        <h5 class="fw-bold">Free Breakfast Promotion at HopHotel!</h5>
                    </div>
                    <div class="card-body mx-auto bg-white">
                        <img src="{{asset('images/breakfast.jpg')}}" alt="" class="body-image mb-3">
                    </div>
                    <div class="card-footer bg-white border-0 "> 
                        <h6 class="fw-bold">Mar 5 2025 ~ Apr 26/2025</h6>
                        <div >
                            <p class="card_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, odit? ipsum dolor sit, amet consectetur </p>
                        </div>                      
                    </div>
                </div>
                <div>
                    <p>Status: <i class="fa-solid fa-circle text-danger"></i> Invisible</p>
                    <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
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
                        <h5 class="fw-bold">Wine Tasting Night at HopHotel!</h5>
                    </div>
                    <div class="card-body mx-auto bg-white">
                        <img src="{{asset('images/winetasting.jpg')}}" alt="" class="body-image mb-3">
                    </div>
                    <div class="card-footer bg-white border-0 "> 
                        <h6 class="fw-bold">Mar 5 2025 ~ Apr 26/2025</h6>
                        <div >
                            <p class="card_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, odit? ipsum dolor sit, amet consectetur </p>
                        </div>                      
                    </div>
                </div>
                <div>
                    <p>Status: <i class="fa-solid fa-circle text-success"></i> Visible</p>
                    <p class="">Display period: Mar 5 2025 ~ Apr 26/2025</p>
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
                <h4>Model Quests</h4>
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
                        <h5 class="fw-bold">Excursion</h5>
                    </div>
                    <div class="card-body mx-auto bg-white">
                        <img src="{{asset('images/excursion.jpg')}}" alt="" class="body-image mb-3">
                    </div>
                    <div class="card-footer bg-white border-0 "> 
                        <h6 class="fw-bold">Mar 5 2025 ~ Apr 26/2025</h6>
                        <div >
                            <p class="card_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, odit? ipsum dolor sit, amet consectetur </p>
                        </div>                      
                    </div>
                </div>
                <div>
                    <p>Status: <i class="fa-solid fa-circle text-success"></i> Visible</p>
                    <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
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
                        <h5 class="fw-bold">Seashore picnic</h5>
                    </div>
                    <div class="card-body mx-auto bg-white">
                        <img src="{{asset('images/seashore.jpg')}}" alt="" class="body-image mb-3">
                    </div>
                    <div class="card-footer bg-white border-0 "> 
                        <h6 class="fw-bold">Mar 5 2025 ~ Apr 26/2025</h6>
                        <div >
                            <p class="card_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, odit? ipsum dolor sit, amet consectetur </p>
                        </div>                      
                    </div>
                </div>
                <div>
                    <p>Status: <i class="fa-solid fa-circle text-danger"></i> Invisible</p>
                    <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
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
                        <h5 class="fw-bold">Bird watching tour</h5>
                    </div>
                    <div class="card-body mx-auto bg-white">
                        <img src="{{asset('images/birdwatching.jpg')}}" alt="" class="body-image mb-3">
                    </div>
                    <div class="card-footer bg-white border-0 "> 
                        <h6 class="fw-bold">Mar 5 2025 ~ Apr 26/2025</h6>
                        <div >
                            <p class="card_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, odit? ipsum dolor sit, amet consectetur </p>
                        </div>                      
                    </div>
                </div>
                <div>
                    <p>Status: <i class="fa-solid fa-circle text-success"></i> Visible</p>
                    <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
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
