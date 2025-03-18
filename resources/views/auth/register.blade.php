@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

@section('content')
    <div class="container-fluid vh-100 d-flex">
        <!-- Register form -->
        <div class="col-md-6 d-flex align-items-center justify-content-center p-3 rounded">
            <div class="card-login shadow-lg login-card p-5 w-75">
                <div class="container-register w-100">
                    <div class="text-center mb-4">
                        <h2 class="mt-2 poppins-bold">Registration
                            <img src="{{ asset('images/logo/HopQuest_logo.png') }}" alt="HopQuest Logo" class="w-25">
                        </h2>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <input id="username" type="text" name="username" value="{{ old('username') }}"
                                    placeholder="Enter your username" required class="form-control">
                                <span class="input-group-text">
                                    <i class="fas fa-user text-primary"></i>
                                </span>
                            </div>
                            @error('username')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

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

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                    class="form-control">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-lock text-primary"></i>
                                </span>
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Register Button -->
                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-danger">REGISTER</button>
                        </div>

                        <!-- Extra Links -->
                        <div class="text-end mt-5">
                            <a href="{{ route('login') }}" class="text-decoration-none text-dark">Already have an
                                account?
                                Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
