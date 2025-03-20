<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\PromotionController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//PROFILES
Route::get('/business/profile/{id}/index', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/business/profile/{user_id}/posts', [ProfileController::class, 'showPosts'])->name('profile.posts');
Route::get('/business/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::delete('/business/profile/image', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
Route::patch('/business/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// Route::patch('/business/profile/{id}/promotions', [ProfileController::class, 'showPromotions'])->name('promotions.show');
Route::get('/business/profile/followers', [ProfileController::class, 'followers'])->name('profile.followers');
Route::get('/business/profile/reviews', [ProfileController::class, 'reviews'])->name('profile.reviews');
Route::get('/business/profile/review', [ProfileController::class, 'showreview'])->name('show.review');

//BUSINESS
Route::get('/business/business', [BusinessController::class, 'index'])->name('business.index');

//PROMOTION
Route::group(['prefix' => '/business/promotion', 'as' => 'promotion.'], function(){
    Route::get('/create', [PromotionController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [PromotionController::class, 'edit'])->name('edit');
    Route::patch('/{id}/update', [PromotionController::class, 'update'])->name('update');
    Route::post('/store', [PromotionController::class, 'store'])->name('store');
    Route::get('/{id}/show', [PromotionController::class, 'show'])->name('show');
    Route::get('/confirm', [PromotionController::class, 'confirm'])->name('confirm');
    Route::delete('/{id}/deactivate', [PromotionController::class, 'deactivate'])->name('deactivate');
    Route::patch('/{id}/activate', [PromotionController::class, 'activate'])->name('activate');
});

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
