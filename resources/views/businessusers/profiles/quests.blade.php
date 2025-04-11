{{-- <div class="bg-blue">
@extends('layouts.app')

@section('title', 'Posts')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
@endsection

@section('content')
    @include('businessusers.profiles.header') --}}

<div class="row justify-content-center bg-blue">
    {{-- Model Quests --}}
    {{-- <div class="col-8 mb-3"> --}}
        {{-- @include('businessusers.profiles.tabs', ['activeTab' => 'quests', 'user' => $user]) --}}
            {{-- Tabs for categories --}}
        {{-- <div class="row tag-category">
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
        <div class="row">
            @if($user->id == Auth::user()->id)
                <div class="col-2 ms-auto mb-2">
                    <a href="{{ route('quests.create', $user->id) }}" class="btn btn-sm btn-navy text-white mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
                </div>
            @endif
        </div> --}}

        <div class="row mb-1 mt-4">
            @forelse($quests as $post)
                <div class="col-lg-4 col-md-6 col-sm">
                    @include('businessusers.profiles.post-body-profile')
                </div>         
            @empty
                <h4 class="h4 text-center text-secondary">No posts yet</h4>
            @endforelse
        </div>
        <div class="d-flex justify-content-end mb-5">
            {{ $quests->links() }}
        </div>
    </div>
</div>
</div>
{{-- @endsection --}}
