@extends('layouts.app')

@section('title', $user['name'] . "'s Profile")

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profiles/profile.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection

@section('content')
    @if ($user)
        <div class="container-fluid">
            <div class="header-container"></div>

            <div class="row mx-5">
                <!-- Sidebar -->
                <div class="col-md-2 sidebar p-5 poppins-bold">
                    @include('tourists.profiles.public_sidebar')
                </div>

                <!-- Profile Content -->
                <div class="col-md-10 offset-md-2">
                    <div class="profile-container p-4 mx-4">
                        {{-- Profile Header --}}
                        <div class="row align-items-center text-white text-center">
                            <div class="col-md-2 avatar-container d-flex justify-content-center">
                                <img src="{{ $user['avatar'] }}" class="avatar">
                            </div>
                            <div class="col-md-4 text-start">
                                <h4 class="username">{{ $user['name'] }}</h4>
                            </div>
                            <div class="col-md-3 text-center">
                                <button class="btn btn-info text-white rounded fw-bold fs-5 w-75">FOLLOW</button>
                            </div>
                            <div class="col-md-3 text-center">
                                <button class="btn btn-info text-white rounded fw-bold fs-5 w-75">MESSAGE</button>
                            </div>
                        </div>

                        <!-- Stats & Social -->
                        <div class="row mt-3 text-white align-items-center px-3">
                            <div class="user-stats col-md-6 d-flex justify-content-center">
                                <span
                                    class="me-4"><strong>{{ count($user['likedQuests'] ?? []) + count($user['likedSpots'] ?? []) }}</strong>
                                    Posts</span>
                                <span class="me-4"><strong>{{ count($user['followers'] ?? []) }}</strong> Followers</span>
                                <span><strong>{{ count($user['following'] ?? []) }}</strong> Following</span>
                            </div>

                            <div class="col-md-6 d-flex justify-content-end social-icons mb-3">
                                @foreach (['instagram', 'facebook', 'x', 'tiktok'] as $social)
                                    @if (!empty($user[$social]))
                                        <a href="{{ $user[$social] }}" class="social-icon me-3">
                                            <i
                                                class="fa-brands fa-{{ $social == 'x' ? 'x-twitter' : $social }} fa-2x text-white"></i>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="mt-4 text-white">
                            <p>{{ $user['introduction'] }}</p>
                        </div>
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
            <div class="alert alert-danger">User not found.</div>
        </div>
    @endif
@endsection
