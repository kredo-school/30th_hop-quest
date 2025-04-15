@extends('layouts.app')

@section('title', 'My Profile')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profiles/profile.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection

@section('content')
    @if ($user)
        <div class="container-fluid px-0">
            <div class="header-container mt-3 px-0">
                <img src="{{ $user->header ?? asset('images/profiles/header.jpg') }}" alt="Header Image" class="w-100"
                    style="height: 470px; object-fit: cover;">
            </div>

            <div class="row mx-5">
                <!-- Sidebar -->
                <div class="col-md-2 sidebar p-5 poppins-bold">
                    @include('tourists.profiles.sidebar')
                </div>

                <!-- Profile Content -->
                <div class="col-md-10 offset-md-2">
                    <div class="profile-container p-4 mx-4">
                        @include('tourists.profiles.profile_header', ['user' => $user])
                    </div>

                    <!-- Dynamic Content Section -->
                    <div class="posts-section mx-auto mt-4 mx-3 w-100">
                        @php $tab = request('tab'); @endphp

                        @switch($tab)
                            @case('quests')
                                @include('tourists.profiles._liked_quests', ['user' => $user])
                            @break

                            @case('spots')
                                @include('tourists.profiles._liked_spots', ['user' => $user])
                            @break

                            @case('businesses')
                                @include('tourists.profiles._liked_businesses', ['user' => $user])
                            @break

                            @case('followers')
                                @include('tourists.profiles._followers', ['user' => $user])
                            @break

                            @case('following')
                                @include('tourists.profiles._following', ['user' => $user])
                            @break

                            @case('comments')
                                @include('tourists.profiles._comments', ['user' => $user])
                            @break

                            @case('reviews')
                                @include('tourists.profiles._reviews', ['user' => $user])
                            @break

                            @default
                                @include('tourists.profiles._my_posts', ['user' => $user])
                        @endswitch
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container mt-4">
            <div class="alert alert-danger">You need to log in to view this page.</div>
        </div>
    @endif
@endsection
