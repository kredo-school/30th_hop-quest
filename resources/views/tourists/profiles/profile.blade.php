{{-- @extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/profiles/profile.css') }}">

@section('title', 'Tourist Profile')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Left Navigation Bar -->
            <div class="col-2 bg-light p-3 rounded">
                <h5 class="fw-bold">Menu</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="nav-link">Liked Quests</a></li>
                    <li><a href="#" class="nav-link">Liked Spots</a></li>
                    <li><a href="#" class="nav-link">Liked Businesses</a></li>
                    <li><a href="#" class="nav-link">Followers</a></li>
                    <li><a href="#" class="nav-link">Following</a></li>
                    <li><a href="#" class="nav-link">Comments</a></li>
                </ul>
            </div>

            <!-- Profile & Content -->
            <div class="col-10">
                <!-- Profile Header -->
                <div class="d-flex align-items-center p-3 bg-primary text-white rounded">
                    <img src="{{ asset('images/default-avatar.png') }}" class="rounded-circle" width="80" height="80"
                        alt="User Avatar">
                    <div class="ms-3">
                        <h4>{{ $user['name'] }}</h4>
                        <p>{{ $user['bio'] ?? 'No bio available' }}</p>
                    </div>
                    <div class="ms-auto">
                        <a href="#" class="btn btn-primary">FOLLOW</a>
                        <a href="#" class="btn btn-primary">MESSAGE</a>
                    </div>
                </div>

                <!-- Display Liked Quests -->
                <div class="mt-4">
                    <h5 class="fw-bold">Liked Quests</h5>
                    <div class="row">
                        @foreach ($user['likedQuests'] as $quest)
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <img src="{{ $quest['image'] }}" class="card-img-top" alt="Quest Image">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $quest['title'] }}</h5>
                                        <p class="card-text">{{ $quest['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
