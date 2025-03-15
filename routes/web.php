<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::get('/profile/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('profile.edit');
Route::get('/profile/followers', [App\Http\Controllers\HomeController::class, 'followers'])->name('profile.followers');
Route::get('/profile/reviews', [App\Http\Controllers\HomeController::class, 'reviews'])->name('profile.reviews');
Route::get('/profile/review', [App\Http\Controllers\HomeController::class, 'showreview'])->name('show.review');
Route::get('/profile/promotion/create', [App\Http\Controllers\HomeController::class, 'promotion_create'])->name('profile.promotion.create');
Route::get('/profile/promotion/edit', [App\Http\Controllers\HomeController::class, 'promotion_edit'])->name('profile.promotion.edit');
Route::get('/profile/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('profile.edit');

// password reset
Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'show'])->name('password.request');

// register business
Route::get('/register/business', [App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('register.business');

// login business
Route::get('/login/business', [App\Http\Controllers\Auth\LoginController::class, 'show'])->name('login.business');
