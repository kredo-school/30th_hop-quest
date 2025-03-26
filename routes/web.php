<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Business\ProfileController;
use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Business\PromotionController;
use App\Http\Controllers\Business\ReviewController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Business\PhotoController;
use App\Http\Controllers\Business\BusinessLikeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//PROFILES
Route::group(['prefix' => '/business/profile', 'as' => 'profile.'], function(){
    Route::get('/promotions/{id}', [ProfileController::class, 'showPromotions'])->name('promotions');
    Route::get('/businesses/{id}', [ProfileController::class, 'showBusinesses'])->name('businesses');
    Route::get('/modelquests/{id}', [ProfileController::class, 'showModelQuests'])->name('modelquests');
    Route::get('/{id}/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::delete('/image', [ProfileController::class, 'deleteAvatar'])->name('avatar.delete');
    Route::patch('/{id}/update', [ProfileController::class, 'update'])->name('update');
    // Route::patch('/business/profile/{id}/promotions', [ProfileController::class, 'showPromotions'])->name('promotions.show');
    Route::get('/{id}/followers', [ProfileController::class, 'followers'])->name('followers');
    Route::get('/{id}/reviews', [ReviewController::class, 'reviews'])->name('reviews');
    Route::get('/{id}/review', [ReviewController::class, 'showReview'])->name('review');
});

//FOLLOWS
Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
Route::delete('/follow/{user_id}/delete', [FollowController::class, 'delete'])->name('follow.delete');

//BUSINESS
Route::get('/business/business', [BusinessController::class, 'index'])->name('business.index');

//PROMOTION
Route::group(['prefix' => '/business/promotion', 'as' => 'promotion.'], function(){
    Route::get('/create', [PromotionController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [PromotionController::class, 'edit'])->name('edit');
    Route::patch('/{id}/update', [PromotionController::class, 'update'])->name('update');
    Route::post('/store', [PromotionController::class, 'store'])->name('store');
    Route::get('/show/{id}', [PromotionController::class, 'show'])->name('show');
    Route::get('/confirm', [PromotionController::class, 'confirm'])->name('confirm');
    Route::delete('/{id}/deactivate', [PromotionController::class, 'deactivate'])->name('deactivate');
    Route::patch('/{id}/activate', [PromotionController::class, 'activate'])->name('activate');
});

//MANAGEMENT BUSINESS
Route::group(['prefix' => '/business/business', 'as' => 'business.'], function(){
    Route::get('/create', [BusinessController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [BusinessController::class, 'edit'])->name('edit');
    Route::patch('/{id}/update', [BusinessController::class, 'update'])->name('update');
    Route::post('/store', [BusinessController::class, 'store'])->name('store');
    Route::get('/show/{id}', [BusinessController::class, 'show'])->name('show');
    Route::resource('businesses', BusinessController::class);
    Route::post('photos/store/{business_id}', [PhotoController::class, 'store'])->name('photos.store');
    Route::get('photos/edit/{business_id}', [PhotoController::class, 'edit'])->name('photos.edit');
    Route::patch('photos/update/{business_id}', [PhotoController::class, 'update'])->name('photos.update');
    Route::delete('/{id}/deactivate', [BusinessController::class, 'deactivate'])->name('deactivate');
    Route::patch('/{id}/activate', [BusinessController::class, 'activate'])->name('activate');
    //LIKES
    Route::post('/like/{business_id}/store', [BusinessLikeController::class, 'storeLike'])->name('like.store');
    Route::delete('/like/{business_id}/delete', [BusinessLikeController::class, 'deleteLike'])->name('like.delete');
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
