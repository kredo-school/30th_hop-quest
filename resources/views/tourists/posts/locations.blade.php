<div class="bg-green">
    @extends('layouts.app')
    
    @section('title', 'Locations')
    
    @section('content')
    
    <div class="mt-4 mb-5 row justify-content-center">

        <div class="col-8 mb-5 ">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <ul class="navbar-nav d-flex flex-row gap-3 mx-auto h5">
                        <li class="nav-item">
                            <a href="{{ route('posts.followings') }}" class="nav-link">Followings'</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posts.quests') }}" class="nav-link">Quests</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posts.spots') }}" class="nav-link">Spots</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posts.locations') }}" class="nav-link color-red fw-bold">Locations</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posts.events') }}" class="nav-link">Events</a>
                        </li>
                    </ul>
                </div>
            </div>    
            <hr>
    {{-- Followings --}}
            <div class="row mb-3">
                <div class="col">
                    <h4>Locations</h4>
                </div>
                <div class="col-auto">
                    <label for="" class="form-label"></label>
                    <select name="" id="" class="form-control" placeholder="Select">
                        <option value="">Number of viewers</option>
                        <option value="">Number of likes</option>
                        <option value="">Number of comments</option>
                        <option value="">Latest</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    @include('tourists.posts.post-body')
                </div>
                <div class="col-4">
                    @include('tourists.posts.post-body')
                </div>
                <div class="col-4">
                    @include('tourists.posts.post-body')
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    @include('tourists.posts.post-body')
                </div>
                <div class="col-4">
                    @include('tourists.posts.post-body')
                </div>
                <div class="col-4">
                    @include('tourists.posts.post-body')
                </div>
            </div>
        </div>   
    </div>
    @endsection
    