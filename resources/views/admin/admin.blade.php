@extends('layouts.app')

@section('title', 'Admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}"> 
@endsection

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">                   
        <div class="col-3">
            <div class="list-group mb-3">
                <h4>Users list</h4>
                <a href="{{ route('admin.users.business') }}" class="list-group-item {{ request()->is('admin/users/business*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Business Users
                </a>
                <a href="{{ route('admin.users.applied') }}" class="list-group-item {{ request()->is('admin/users/applied*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Badge Applied Business Users
                    <span class="badge bg-danger">
                        {{ $user->reviewing()->count() }}
                    </span>
                </a>
                <a href="{{ route('admin.users.tourists') }}" class="list-group-item {{ request()->is('admin/users/tourists*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Tourists
                </a>
            </div>

            <div class="list-group mb-3">
                <h4>Posts list</h4>
                <a href="{{ route('admin.posts') }}" class="list-group-item {{ request()->is('admin/posts/business*') ? 'active' : '' }}">
                    <i class="fa-solid fa-image"></i> Business Posts
                </a>
                <a href="{{ route('admin.posts.applied') }}" class="list-group-item {{ request()->is('admin/posts/applied*') ? 'active' : '' }}">
                    <i class="fa-solid fa-image"></i> Badge Applied Business Posts
                </a>
                <a href="{{ route('admin.posts.tourists') }}" class="list-group-item {{ request()->is('admin/posts/tourists*') ? 'active' : '' }}">
                    <i class="fa-solid fa-image"></i> Tourist Posts
                </a>
            </div>

            <div class="list-group">
                <h4>Comments list</h4>
                <a href="{{ route('admin.posts') }}" class="list-group-item {{ request()->is('admin/comments*') ? 'active' : '' }}">
                    <i class="fa-solid fa-comments"></i> Comments
                </a>
            </div>
        </div>
        <div class="col-9">
            @yield('content')
        </div>
    </div>
</div>