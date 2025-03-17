<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Articles')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/promotion-body.css')}}">
@endsection

@section('content')
<main>
    <div class="mt-2 row justify-content-center">
        <div class="col-6">
            <div class="row mb-3">
                <div class="col">
                    <h3 class="mb-3 poppins-regular d-inline me-3">Check Promotion</h3>
                </div>
            </div>
            <div class="card p-3 mb-5 rounded-4 border-3 border-navy">
                <div class="card-header border-0 bg-light p-0 ">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-auto">
                            <h3 >🌟Experience the Magic of Summer at HopHotel!🌟</h3>
                        </div>    
                    </div> 
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <h4>2025/01/01 - 2025/01/3</h4>
                        </div>    
                    </div>     
                </div>
                <div class="card-body promotion">  
                    <div class="row mb-0">
                        {{-- Card Image with official mark --}}
                        <img src="{{ asset('images/businessprofile/festival.jpg') }}" class="card-img-top promotion-image" alt="image">
                        {{-- Postdate --}}
                        {{-- <div class="col-auto pe-0 ms-auto">
                            <h5 class="card-subtitle">2025/2/25</h5>
                        </div> --}}
                    </div>                

                    {{-- Description of posts --}}
                    
                </div>

                <div class="card-footer bg-white border-0">
                {{-- description --}}
                    <div class="row ">
                        <div class="col p-3">
                            <p class="card_description">
                                Join us for an unforgettable Summer Festival at [HopHotel! <br>Enjoy a vibrant evening filled with traditional Japanese performances, delicious street food, fun games, and dazzling fireworks. Whether you're visiting with family, friends, or that special someone, there’s something for everyone to enjoy!<br>🎤 Live Performances – Taiko drumming, dance shows, and more!🍢 Food Stalls – Savor authentic festival treats like yakitori, takoyaki, and kakigori.🎯 Game Booths – Try your luck at classic Japanese festival games!🎆 Fireworks Display – A spectacular show to light up the summer sky!<br>📌 Admission: [Free]📞 For Reservations & Inquiries: [Hotel Contact Information]<br>Come and celebrate summer with us at HopHotel]! <br>We look forward to welcoming you!
                            </p>
                        </div>    
                    </div>   
                </div>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-4">
                    <a href="#" class="btn btn-sm btn-green fw-bold mb-2 w-100">CONFIRM</a>
                    {{-- <button type="submit" class="btn btn-green w-100 mb-2">CHECK</button> --}}
                </div>
                <div class="col-2"></div>
                <div class="col-4">
                    <a href="{{ route('profile.promotion.edit') }}" class="btn btn-sm btn-outline-red fw-bold mb-2 w-100">BACK</a>
                </div>
            </div>
        </div>
    </div>   
</main>
@endsection