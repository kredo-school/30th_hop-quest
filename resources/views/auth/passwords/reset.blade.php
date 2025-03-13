@extends('layouts.app')

@section('content')
    <div class="container-fluid reset-container vh-100 d-flex align-items-center">
        <div class="row w-100">
            <!-- 左側のフォーム部分 -->
            <div class="col-md-5 d-flex align-items-center">
                <div class="card reset-card shadow-lg p-4">
                    <div class="text-center">
                        <img src="{{ asset('images/logo.png') }}" alt="HopQuest" class="logo mb-3">
                        <h3 class="fw-bold">Reset Password</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <!-- Email Input -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <!-- Reset Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger fw-bold">RESET</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- 右側の背景画像エリア -->
            <div class="col-md-7 d-none d-md-block reset-bg"></div>
        </div>
    </div>
@endsection
