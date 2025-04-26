@extends('layouts.app')

@section('title', 'Edit Profile')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profiles/profile_edit.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection

@section('content')
<div class="container mb-5 profile-edit-spacing">
    <form action="{{ route('myprofile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="profile-container">
            <label class="header d-block mb-3">
                <input type="file" id="header" name="header" accept="image/*" class="d-none">
                @php
                    $headerPath = $user->header;
                    if (Str::startsWith($headerPath, 'data:image')) {
                        $headerSrc = $headerPath;
                    } elseif (Str::startsWith($headerPath, 'images/') && file_exists(public_path('storage/' . $headerPath))) {
                        $headerSrc = asset('storage/' . $headerPath);
                    } elseif (file_exists(public_path('storage/' . $headerPath))) {
                        $headerSrc = asset('storage/' . $headerPath);
                    } else {
                        $headerSrc = asset('images/profiles/header.jpg');
                    }
                @endphp
                <img id="headerPreview" src="{{ $headerSrc }}" alt="Header Image">
            </label>
            <input type="hidden" name="header_base64" id="headerBase64">
            <label class="avatar">
                <input type="file" id="avatar" name="avatar" accept="image/*">
                @php
                    $avatarPath = $user->avatar;
                    if (Str::startsWith($avatarPath, 'data:image')) {
                        $avatarSrc = $avatarPath;
                    } elseif (Str::startsWith($avatarPath, 'images/') && file_exists(public_path('storage/' . $avatarPath))) {
                        $avatarSrc = asset('storage/' . $avatarPath);
                    } elseif (file_exists(public_path('storage/' . $avatarPath))) {
                        $avatarSrc = asset('storage/' . $avatarPath);
                    } else {
                        $avatarSrc = asset('images/profiles/avatar.jpg');
                    }
                @endphp
                <img id="avatarPreview" src="{{ $avatarSrc }}" alt="Avatar Image">
            </label>
            <input type="hidden" name="avatar_base64" id="avatarBase64">
        </div>
        <div class="card rounded bg-white px-5 py-3 mt-5">
            <h3 class="text-center mb-4 fw-bold">Edit Profile</h3>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Username</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user['name']) }}" required>
                @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user['email']) }}" required>
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="introduction" class="form-label fw-bold">Introduction</label>
                <textarea class="form-control" id="introduction" name="introduction" rows="3">{{ old('introduction', $user['introduction']) }}</textarea>
                @error('introduction')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4 text-dark">
                @php
                    $socials = ['instagram' => 'Instagram', 'x' => 'X', 'facebook' => 'Facebook', 'tiktok' => 'TikTok'];
                @endphp
                @foreach ($socials as $key => $social)
                    <div class="row mb-3 d-flex align-items-center">
                        <div class="col-3 text-center">
                            <i class="fa-brands fa-{{ $key == 'x' ? 'x-twitter' : $key }} fa-3x me-3"></i>
                        </div>
                        <div class="col-9 flex-grow-1">
                            <label for="{{ $key }}" class="form-label fw-bold">{{ $social }}</label>
                            <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{ old($key, $user[$key]) }}">
                            @error($key)
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endforeach
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5">SAVE</button>
                </div>
            </div>
        </div>
    </form>

    <div class="mt-5 p-4 px-5 bg-white rounded shadow-sm">
        <h4 class="fw-bold text-center mb-4">Change Password</h4>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="current_password" class="form-label fw-bold">Old Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
                @error('current_password')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label fw-bold">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
                @error('new_password')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="new_password_confirmation" class="form-label fw-bold">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success w-50">UPDATE PASSWORD</button>
            </div>
        </form>
    </div>
</div>
@endsection

@vite('resources/js/profile_edit.js')
