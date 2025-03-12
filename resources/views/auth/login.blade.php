@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@section('content')
    <div class="container-fluid vh-80 d-flex">
        <!-- Login form -->
        <div class="col-md-6 d-flex align-items-center justify-content-center p-3 shadow-lg rounded">
            <div class="w-100" style="max-width: 400px;">
                <div class="text-center mb-4">
                    <h2 class="mt-2">Login
                        <img src="{{ asset('HopQuest_logo.png') }}" alt="HopQuest Logo" class="w-25">
                    </h2>

                </div>

                @if (session('error'))
                    <div class="alert alert-danger text-center">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                placeholder="xxxxxx@email.com" required class="form-control">
                            <span class="input-group-text">
                                <i class="fas fa-envelope text-primary"></i>
                            </span>
                        </div>
                        @error('email')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input id="password" type="password" name="password" required class="form-control">
                            <span class="input-group-text">
                                <i class="fa-solid fa-lock text-primary"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Login Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-danger">LOGIN</button>
                    </div>

                    <!-- Extra Links -->
                    <div class="text-center mt-2">
                        <a href="#" class="text-decoration-none text-white">Create Account for Business</a>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('password.request') }}" class="text-decoration-none text-white">Forgot
                            Password?</a>
                    </div>
                    <div class="text-center mt-2">
                        <a href="{{ route('register') }}" class="text-decoration-none text-white">Create Account</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Background-->
        <div class="col-md-6 d-none d-md-block bg-image"
            style="background-image: url('{{ asset('images/background.jpg') }}'); background-size: cover; background-position: center;">
        </div>
    </div>
@endsection
