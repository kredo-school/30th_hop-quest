@extends('layouts.app')

@section('title', 'Edit Profile')

@section('css')
<link href="{{ asset('css/profiles/profile_edit.css') }}" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet"/>
@endsection

@section('content')
<div class="container mb-5">
 <div class="profile-container">
  <label class="header d-block mb-3">
   <input accept="image/*" class="d-none" id="headerInput" type="file"/>
   <img alt="Header Image" id="headerPreview" src="{{ asset('images/profiles/header.jpg') }}"/>
  </label>
  <label class="avatar">
   <input accept="image/*" id="avatarInput" type="file"/>
   <img alt="Avatar Image" id="avatarPreview" src="{{ asset('images/profiles/avatar.jpg') }}"/>
  </label>
 </div>
 <!-- Header Image -->
 {{--
 <div class="mb-4">
  @if ($user['header'])
  <div class="header-container mb-2">
   <label>
    <span class="header">
     👤
    </span>
    <span class="camera">
     📷
    </span>
    <input name="header" type="file"/>
   </label>
  </div>
  @endif
  <div class="form-text">
   Supported: jpeg, jpg, png, gif (max 1048Kb)
  </div>
  @error('header')
  <div class="text-danger small">
   {{ $message }}
  </div>
  @enderror
 </div>
 --}}
 <!-- Avatar Image -->
 {{--
 <div class="mb-4">
  @if ($user['avatar'])
  <div class="avatar-container mb-2">
   <label>
    <span class="user">
     👤
    </span>
    <span class="camera">
     📷
    </span>
    <input name="avatar" type="file"/>
   </label>
  </div>
  @endif
  <div class="form-text">
   Supported: jpeg, jpg, png, gif (max 1048Kb)
  </div>
  @error('avatar')
  <div class="text-danger small">
   {{ $message }}
  </div>
  @enderror
 </div>
 --}}
 <!-- Profile Form -->
 <div class="card rounded bg-white px-5 py-3 mt-5">
  <h3 class="text-center mb-4 fw-bold">
   Edit Profile
  </h3>
  <form action="{{ route('myprofile.update', $user['id']) }}" enctype="multipart/form-data" method="POST">
   @csrf
                @method('PATCH')
   <!-- Username -->
   <div class="mb-3">
    <label class="form-label fw-bold" for="name">
     Username
    </label>
    <input class="form-control" id="name" name="name" required="" type="text" value="{{ old('name', $user['name']) }}"/>
    @error('name')
    <div class="text-danger small">
     {{ $message }}
    </div>
    @enderror
   </div>
   <!-- Email -->
   <div class="mb-3">
    <label class="form-label fw-bold" for="email">
     Email
    </label>
    <input class="form-control" id="email" name="email" required="" type="email" value="{{ old('email', $user['email']) }}"/>
    @error('email')
    <div class="text-danger small">
     {{ $message }}
    </div>
    @enderror
   </div>
   <!-- Introduction -->
   <div class="mb-5">
    <label class="form-label fw-bold" for="introduction">
     Introduction
    </label>
    <textarea class="form-control" id="introduction" name="introduction" rows="3">{{ old('introduction', $user['introduction']) }}</textarea>
    @error('introduction')
    <div class="text-danger small">
     {{ $message }}
    </div>
    @enderror
   </div>
   <!-- Social Media Section -->
   <div class="mb-4 text-dark">
    @php
                        $socials = [
                            'instagram' =&gt; 'Instagram',
                            'x' =&gt; 'X',
                            'facebook' =&gt; 'Facebook',
                            'tiktok' =&gt; 'TikTok',
                        ];
                    @endphp
                    @foreach ($socials as $key =&gt; $social)
    <div class="row mb-3 d-flex align-items-center">
     <div class="col-3 text-center">
      <i class="fa-brands fa-{{ $key == 'x' ? 'x-twitter' : $key }} fa-3x me-3">
      </i>
     </div>
     <div class="col-9 flex-grow-1">
      <label class="form-label fw-bold" for="{{ $key }}">
       {{ $social }}
      </label>
      <input class="form-control" id="{{ $key }}" name="{{ $key }}" type="text" value="{{ old($key, $user[$key]) }}"/>
      @error($key)
      <div class="text-danger small">
       {{ $message }}
      </div>
      @enderror
     </div>
    </div>
    @endforeach
    <!-- Save Button -->
    <div class="text-center">
     <button class="btn btn-success px-5" type="submit">
      SAVE
     </button>
    </div>
   </div>
  </form>
 </div>
</div>
<!-- Password Change -->
<div class="mt-5 p-4 px-5 bg-white rounded shadow-sm">
 <h4 class="fw-bold text-center mb-4">
  Change Password
 </h4>
 <form action="{{ route('password.update') }}" method="POST">
  @csrf
            @method('PATCH')
  <!-- Current Password -->
  <div class="mb-3">
   <label class="form-label fw-bold" for="current_password">
    Old Password
   </label>
   <input class="form-control" id="current_password" name="current_password" required="" type="password"/>
   @error('current_password')
   <div class="text-danger small">
    {{ $message }}
   </div>
   @enderror
  </div>
  <!-- New Password -->
  <div class="mb-3">
   <label class="form-label fw-bold" for="new_password">
    New Password
   </label>
   <input class="form-control" id="new_password" name="new_password" required="" type="password"/>
   @error('new_password')
   <div class="text-danger small">
    {{ $message }}
   </div>
   @enderror
  </div>
  <!-- Confirm New Password -->
  <div class="mb-4">
   <label class="form-label fw-bold" for="new_password_confirmation">
    Confirm New Password
   </label>
   <input class="form-control" id="new_password_confirmation" name="new_password_confirmation" required="" type="password"/>
  </div>
  <div class="text-center">
   <button class="btn btn-success w-50" type="submit">
    UPDATE PASSWORD
   </button>
  </div>
 </form>
</div>
@section('scripts')
<script src="{{ asset('js/profile_edit.js') }}">
</script>
@endsection
