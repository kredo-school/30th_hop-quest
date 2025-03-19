<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//PROFILES
Route::get('/business/profile/{id}/posts', [ProfileController::class, 'posts'])->name('profile.posts');
Route::get('/business/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::delete('/business/profile/image', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
Route::patch('/business/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/business/profile/followers', [ProfileController::class, 'followers'])->name('profile.followers');
Route::get('/business/profile/reviews', [ProfileController::class, 'reviews'])->name('profile.reviews');
Route::get('/business/profile/review', [ProfileController::class, 'showreview'])->name('show.review');

Route::get('/business/profile/promotion/create', [App\Http\Controllers\HomeController::class, 'promotion_create'])->name('profile.promotion.create');
Route::get('/business/profile/promotion/edit', [App\Http\Controllers\HomeController::class, 'promotion_edit'])->name('profile.promotion.edit');
Route::get('/business/profile/promotion/check', [App\Http\Controllers\HomeController::class, 'promotion_check'])->name('profile.promotion.check');
Route::get('/business/profile/promotion/show', [App\Http\Controllers\HomeController::class, 'promotion_show'])->name('profile.promotion.show');

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
// Route::get('/login/business', [App\Http\Controllers\Auth\LoginController::class, 'show'])->name('login.business');
