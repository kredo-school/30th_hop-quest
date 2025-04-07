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
            <div class="card p-3 mb-5 border-3 border-navy rounded-4">
                <div class="card-header border-0 bg-light ">
                    <div class="row mt-3 ">
                        <!--Related Business-->
                        <div class="col">
                            <h5 class="card-subtitle">{{ $business_promotion->business->name }}</h5>
                        </div>
                        <!--Posted date-->
                        <div class="col-auto ms-auto">
                            <h5>Posted: {{date('M d Y', strtotime($business_promotion->created_at))}}</h5>
                        </div>    
                    </div>

                    <div class="row mt-3 ">
                        <div class="col-auto">
                            <h3 class="fw-bold">{{$business_promotion->title}}</h3>
                        </div>    
                    </div> 
                    <div class="row ">
                        <div class="col-auto">
                            @if((!$business_promotion->promotion_start || !$business_promotion->promotion_end))
                            @elseif($business_promotion->promotion_start == $business_promotion->promotion_end)
                                <h5 class="fw-bold">{{date('M d Y', strtotime($promotion->promotion_start))}}</h5>
                            @elseif($business_promotion->promotion_start && $business_promotion->promotion_end)
                                @if(($business_promotion->promotion_start < $business_promotion->promotion_end))
                                    <h6 class="fw-bold">{{date('M d Y', strtotime($business_promotion->promotion_start))}} ~ {{date('M d Y', strtotime($business_promotion->promotion_end))}}</h6>     
                                @else
                                    <h6 class="fw-bold">{{date('M d Y', strtotime($business_promotion->promotion_end))}} ~ {{date('M d Y', strtotime($business_promotion->promotion_start))}}</h6> 
                                @endif                              
                            @endif
                        </div>    
                    </div>     
                </div>
                <div class="card-body promotion">  
                    <div class="row mb-0">
                        <img src="{{ $business_promotion->image }}" class="card-img-top post-image" alt="image">
                        {{-- Postdate --}}
                        {{-- <div class="col-auto pe-0 ms-auto">
                            <h5 class="card-subtitle">2025/2/25</h5>
                        </div> --}}
                    </div>                                 
                </div>

                <div class="card-footer bg-white border-0">
                {{-- description --}}
                    <div class="row ">
                        <div class="col p-3">
                            <p class="card_description">
                                {{$business_promotion->introduction}}
                            </p>
                        </div>    
                    </div>   
                </div>

            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-4">
                <a href="{{route('profile.promotions', $business_promotion->user_id)}}">
                    <button class="btn btn-red w-100 ">BACK</button>
                </a>
            </div>
        </div>
    </div>   
</main>
@endsection