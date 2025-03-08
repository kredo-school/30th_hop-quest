@extends('layouts.app')

@section('title')

@section('content')

<style>
    .profile-header{
        position: relative;
        width: 100%;
    }
    
    /* .profile-info{
        position: absolute;
        bottom: -200px;

    } */



    .background-blue{
        background-color: #b4d5f4
    }

    .btn-edit{
        background-color: #66bfbf  
             
    }

    .btn-delete{
        background-color: #d24848
    }

    .btn-add{
        background-color: #3b3b6b
    }
 
    .btn-hide{
        background-color: white
        /* outline-color:  */
        }

    .icon-lg{
    font-size:6rem;
}

.body-image{
    height:150px;
}

</style>

<div class="mb-5 row justify-content-center background-blue">
    <div class="col-8">
        <div class="profile-header position-relative">
             <!-- Header image -->
            <div class="header-image">
                <img src="{{ asset('images/resortpool.jpg') }}" class="img-fluid w-100 mb-3" style="height:200px " alt="">
            </div>
            <div class="profile-info container">
                <div class="row ">
                    <!-- Avatar image -->
                    <div class="col-auto profile-image mt-0">
                        <i class="fa-solid fa-circle-user icon-lg text-secondary d-block text-center"></i>
                    </div>
                    
                    <!-- Username buttons -->
                    <div class="col">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="mb-1">Business User name</h3>
                            </div>
                            <div class="col-2">
                                <a href="#" class="btn btn-sm btn-edit fw-bold text-white mb-2 w-100">EDIT</a>
                            </div>
                            <div class="col-2">
                                <a href="#" class="btn btn-sm btn-delete fw-bold text-white mb-2 w-100">DELETE</a>
                            </div>
                        </div>    
                    
                        {{-- url --}}
                        <div class="row mb-3">
                            <div class="col">
                                <a href="#" class="text-decoration-none text-dark">www.hopquest.com</a>
                            </div>
                        </div> 
                        
                        {{-- items --}}
                        <div class="row mb-3">
                            <div class="col-auto">
                                <a href="#" class="text-decoration-none text-dark fw-bold">3 posts</a>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="text-decoration-none text-dark fw-bold">5 followers</a>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="text-decoration-none text-dark fw-bold">7 reviews</a>
                            </div>

                            {{-- SNS icons --}}
                            <div class="col-auto ms-auto">
                                <a href="#">
                                <i class="fa-brands fa-instagram text-dark display-6"></i>
                                </a>
                            </div>
                            <div class="col-auto ms-auto">
                                <a href="#">
                                <i class="fa-brands fa-facebook text-dark display-6"></i>
                                </a>
                            </div>
                            <div class="col-auto ms-auto">
                                <a href="#">
                                <i class="fa-brands fa-twitter text-dark display-6"></i>
                                </a>
                            </div>
                            <div class="col-auto ms-auto">
                                <a href="#">
                                <i class="fa-brands fa-tiktok text-dark display-6"></i>
                                </a>
                            </div>
                        </div>
                    </div> 
                </div>
                {{-- introduction --}}
                <div class="row mb-3">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti ea, adipisci enim neque explicabo doloribus qui aut nemo odit officia a reiciendis, magni beatae voluptates alias deserunt minus maiores! Porro quod vero consequuntur minima amet cum quos quaerat. Quisquam nesciunt natus explicabo quod magnam eum veniam laboriosam consectetur voluptatem suscipit!</p>
                </div>
            </div>
        </div>
    </div>

{{-- Management business --}}
    <div class="col-8 mb-5 ">
        <div class="row">
            <div class="col">
                <h2>Management Business</h2>
            </div>
            <div class="col-2">
                <a href="#" class="btn btn-sm btn-add fw-bold text-white mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
            </div>
        </div>
        <div class="row">
            {{-- Kredo cafe --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Kredo Cafe</h3>
                    </div>
                    <div class="card-body mx-auto">
                        <img src="{{asset('images/kredocafeimage.jpg')}}" alt="" class="body-image">
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
                        <a href="#" class="btn btn-sm btn-edit fw-bold text-white mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-hide fw-bold mb-2 w-100">HIDE</a>
                    </div>
                </div>
            </div>
            {{-- Kredo hotel --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Kredo Hotel</h3>
                    </div>
                    <div class="card-body mx-auto">
                        <img src="{{asset('images/kredohotelimage.jpg')}}" alt="" class="body-image">
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
                        <a href="#" class="btn btn-sm btn-edit fw-bold text-white mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-hide fw-bold mb-2 w-100">UNHIDE</a>
                    </div>
                </div>
            </div>
            {{-- Kredo Pub--}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Kredo Pub</h3>
                    </div>
                    <div class="card-body mx-auto">
                        <img src="{{asset('images/kredopubimage.jpg')}}" alt="" class="body-image">
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
                        <a href="#" class="btn btn-sm btn-edit fw-bold text-white mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-hide fw-bold mb-2 w-100">HIDE</a>
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
                <a href="#" class="btn btn-sm btn-add fw-bold text-white mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
            </div>
        </div>
        <div class="row">
            {{-- Excursion --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Experience the Magic of Summer at HopHotel!</h3>
                    </div>
                    <div class="card-body mx-auto">
                        <img src="{{asset('images/festival.jpg')}}" alt="" class="body-image">
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
                        <a href="#" class="btn btn-sm btn-edit fw-bold text-white mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-hide fw-bold mb-2 w-100">HIDE</a>
                    </div>
                </div>
            </div>
            {{-- Breakfast --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Free Breakfast Promotion at HopHotel!</h3>
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
                        <a href="#" class="btn btn-sm btn-edit fw-bold text-white mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-hide fw-bold mb-2 w-100">UNHIDE</a>
                    </div>
                </div>
            </div>
            {{-- Wine tasting--}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Wine Tasting Night at HopHotel!</h3>
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
                    <h6>Display period: Mar 5 2025 ~ Apr 26/2025</h6>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-edit fw-bold text-white mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-hide fw-bold mb-2 w-100">HIDE</a>
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
                <a href="#" class="btn btn-sm btn-add fw-bold text-white mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
            </div>
        </div>
        <div class="row">
            {{-- Excursion --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Excursion</h3>
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
                        <a href="#" class="btn btn-sm btn-edit fw-bold text-white mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-hide fw-bold mb-2 w-100">HIDE</a>
                    </div>
                </div>
            </div>
            {{-- seashore piknik --}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Seashore picnic</h3>
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
                        <a href="#" class="btn btn-sm btn-edit fw-bold text-white mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-hide fw-bold mb-2 w-100">HIDE</a>
                    </div>
                </div>
            </div>
            {{-- Birdwatching--}}
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Bird watching tour</h3>
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
                        <a href="#" class="btn btn-sm btn-edit fw-bold text-white mb-2 w-100">EDIT</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-sm btn-hide fw-bold mb-2 w-100">HIDE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>


@endsection