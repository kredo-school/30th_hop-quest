<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Posts')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
@endsection

@section('content')
    @include('businessusers.profiles.header')

<div class="mb-5 row justify-content-center bg-blue">
    {{-- Promotions --}}
    <div class="col-8 mb-5">
            {{-- Tabs for categories --}}
        <div class="row tag-category">
            <div class="col-auto">
                <a href="{{ route('profile.businesses', $user->id)}}" class="text-decoration-none text-dark" data-category="business">
                    <h3 class="poppins-semibold {{ request()->is('business/profile/businesses*') ? 'active' : '' }}">
                        Management Business
                    </h3>
                </a>
            </div>
            <div class="col-auto ms-5">
                <a href="{{ route('profile.promotions', $user->id) }}" class="text-decoration-none text-dark" data-category="promotions">
                    <h3 class="poppins-semibold {{ request()->is('business/profile/promotions*') ? 'active' : '' }}">
                        Promotions
                    </h3>
                </a>
            </div>
            <div class="col-auto ms-5">
                <a href="{{ route('profile.modelquests', $user->id) }}" class="text-decoration-none text-dark" data-category="quest">
                    <h3 class="poppins-semibold {{ request()->is('business/profile/modelquests*') ? 'active' : '' }}">
                        Model Quests
                    </h3>
                </a>
            </div>
        </div>  
        <hr>
        @if($user->id == Auth::user()->id)
        <div class="row">            
            <div class="col-2 ms-auto mb-2">
                <a href="{{ route('promotion.create') }}" class="btn btn-sm btn-navy text-white mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
            </div>
           
        </div>
        {{-- forelse --}}
        <div class="row mb-1">
            @forelse($all_promotions as $promotion)
            <div class="col-4"> 
                <div class="card p-3">
                    <div class="card-header border-0 bg-light p-0 overflow-hidden">
                        {{-- Image --}}                         
                        <a href="#" class="">
                            <img src="{{ $promotion->photo }}" class="post-image" alt="image">
                        </a>                       
                    </div>
                    <div class="card-body pt-0">            
                        <div class="row mb-2">
                            {{-- Related Business --}}
                            <div class="col-auto p-0">
                                <h5 class="card-subtitle">{{ $promotion->business->name }}</h5>
                            </div>
                            {{-- Postdate --}}
                            <div class="col-auto pe-0 ms-auto">
                                <h5 class="card-subtitle"><span>{{date('M d Y', strtotime($promotion->created_at))}}</span></h5>
                            </div>
                        </div>
                        {{-- Title --}}
                        <div class="row">
                            <div class="col p-0">
                                <a href="#" class="text-decoration-none">
                                    <h4 class="card-title text-dark fw-bold">{{$promotion->title}}</h4>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col p-0">                               
                                {{-- promotion period --}}
                                @if($promotion->promotion_start && $promotion->promotion_end)
                                <h6 class="fw-bold">{{date('M d Y', strtotime($promotion->promotion_start))}} ~ {{date('M d Y', strtotime($promotion->promotion_end))}}</h6>
                                {{-- @else
                                <p>Day: -- --</p> --}}
                                @endif
                            </div>
                        </div>
                            {{-- introduction --}}
                        <div class="row">
                            <div class="col p-0">
                                <p class="card_description">
                                    {{ $promotion->introduction }}
                                </p>
                            </div>    
                        </div>  
                    </div>

                @if($user->id == Auth::user()->id)
                    <div class="card-footer bg-white">
                        {{-- status --}}
                            <div class="row ">
                                <div class="col p-0">
                                    {{-- visibility --}}
                                    @if($promotion->trashed())
                                        Status: <i class="fa-solid fa-circle color-red"></i> Hidden
                                    @else
                                        Status: <i class="fa-solid fa-circle color-green"></i> Visible
                                    @endif

                                    {{-- display --}}
                                    @if($promotion->display_start && $promotion->display_end)
                                    <p>Display period: {{date('M d Y', strtotime($promotion->display_start))}} ~ {{date('M d Y', strtotime($promotion->display_end))}}</p>
                                    @else
                                    <p>Display period: Not defined</p>
                                    @endif
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('promotion.edit', $promotion->id) }}" class="btn btn-sm btn-green fw-bold mb-2 w-100">EDIT</a>
                                </div>
                                <div class="col-6">
                                    @if($promotion->trashed())
                                    {{-- activate --}}
                                        <button class="btn btn-outline-green w-100" data-bs-toggle="modal" data-bs-target="#activate-promotion{{$promotion->id}}">
                                            UNHIDE
                                        </button>
                                    @else
                                        <button class="btn btn-red w-100" data-bs-toggle="modal" data-bs-target="#deactivate-promotion{{ $promotion->id }}">
                                            HIDE
                                        </button>
                                    @endif
                                    @include('businessusers.posts.promotions.modals.hide_unhide')
                                </div>

                            </div>
                    </div>  
                @endif
                </div>
            </div>
            @empty
                <h4 class="h4 text-center text-secondary">No posts yet</h4>
            @endforelse 
            @endif
        </div>
        <div class="d-flex justify-content-end">
        {{ $all_promotions->links() }}
        </div>
    </div>
</div>
</div>
@endsection
