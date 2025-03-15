<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/business/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::get('/business/profile/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('profile.edit');
Route::get('/business/profile/followers', [App\Http\Controllers\HomeController::class, 'followers'])->name('profile.followers');
Route::get('/business/profile/reviews', [App\Http\Controllers\HomeController::class, 'reviews'])->name('profile.reviews');
Route::get('/business/profile/review', [App\Http\Controllers\HomeController::class, 'showreview'])->name('show.review');
Route::get('/business/profile/promotion/create', [App\Http\Controllers\HomeController::class, 'promotion_create'])->name('profile.promotion.create');
Route::get('/business/profile/promotion/edit', [App\Http\Controllers\HomeController::class, 'promotion_edit'])->name('profile.promotion.edit');
Route::get('/business/profile/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('profile.edit');
// Post
Route::get('/tourist/posts/followings', [App\Http\Controllers\HomeController::class, 'posts_followings'])->name('posts.followings');
Route::get('/tourist/posts/quests', [App\Http\Controllers\HomeController::class, 'posts_quests'])->name('posts.quests');
Route::get('/tourist/posts/spots', [App\Http\Controllers\HomeController::class, 'posts_spots'])->name('posts.spots');
Route::get('/tourist/posts/locations', [App\Http\Controllers\HomeController::class, 'posts_locations'])->name('posts.locations');
Route::get('/tourist/posts/events', [App\Http\Controllers\HomeController::class, 'posts_events'])->name('posts.events');

// password reset
Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'show'])->name('password.request');

// register business
Route::get('/register/business', [App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('register.business');

// login business
Route::get('/login/business', [App\Http\Controllers\Auth\LoginController::class, 'show'])->name('login.business');
