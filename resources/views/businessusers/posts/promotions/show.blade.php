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
                            <h5 class="card-subtitle">{{ $promotion->business->name }}</h5>
                        </div>
                        <!--Posted date-->
                        <div class="col-auto ms-auto">
                            <h5>Posted: {{date('M d Y', strtotime($promotion->created_at))}}</h5>
                        </div>    
                    </div>

                    <div class="row mt-3 ">
                        <div class="col-auto">
                            <h3 class="fw-bold">{{$promotion->title}}</h3>
                        </div>    
                    </div> 
                    <div class="row ">
                        <div class="col-auto">
                            @if((!$promotion->promotion_start || !$promotion->promotion_end))
                            @elseif($promotion->promotion_start == $promotion->promotion_end)
                                <h5 class="fw-bold">{{date('M d Y', strtotime($promotion->promotion_start))}}</h5>
                            @elseif($promotion->promotion_start && $promotion->promotion_end)
                                <h5 class="fw-bold">{{date('M d Y', strtotime($promotion->promotion_start))}} ~ {{date('M d Y', strtotime($promotion->promotion_end))}}</h5>                               
                            @endif
                        </div>    
                    </div>     
                </div>
                <div class="card-body promotion">  
                    <div class="row mb-0">
                        <img src="{{ $promotion->photo }}" class="card-img-top post-image" alt="image">
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
                                {{$promotion->introduction}}
                            </p>
                        </div>    
                    </div>   
                </div>

            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-4">
                <a href="{{route('profile.promotions', $promotion->user_id)}}">
                    <button class="btn btn-red w-100 ">BACK</button>
                </a>
            </div>
        </div>
    </div>   
</main>
@endsection