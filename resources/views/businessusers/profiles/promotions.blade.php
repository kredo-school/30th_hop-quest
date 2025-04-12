<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Posts')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
@endsection

@section('content')
    @include('businessusers.profiles.header')

<div class="row justify-content-center bg-blue">
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
                <a href="{{ route('profile.quests', $user->id) }}" class="text-decoration-none text-dark" data-category="quest">
                    <h3 class="poppins-semibold {{ request()->is('business/profile/modelquests*') ? 'active' : '' }}">
                        Model Quests
                    </h3>
                </a>
            </div>
        </div>  
        <hr>
        @if($user->id == Auth::user()->id)
            @if($user->official_certification == 1||$user->official_certification == 3)
                <div class="col-2 ms-auto mb-2 ">
                    <a href="{{ route('businesses.create') }}" class="btn btn-sm btn-navy text-white mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
                </div>
            @elseif($user->official_certification == 2)
                <div class="col-2 ms-auto mb-2 ">
                    <button class="btn btn-sm btn-outline-navy text-navy mb-2 w-100" disabled><i class="fa-solid fa-plus"></i> ADD</button>
                </div>
            @endif
        @endif
        {{-- forelse --}}
        <div class="row mb-1">
            <div class="row mb-1">
                @forelse($business_promotions as $post)
                    <div class="col-lg-4 col-md-6 col-sm">
                        @include('businessusers.profiles.post-body-profile')
                    </div>         
                @empty
                    <h4 class="h4 text-center text-secondary">No posts yet</h4>
                @endforelse
            </div>




        </div>
        <div class="d-flex justify-content-end mb-5">
        {{ $business_promotions->links() }}
        </div>
    </div>
</div>
</div>
@endsection
