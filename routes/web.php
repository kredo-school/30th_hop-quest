<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Spot\IndexController;
use App\Http\Controllers\Spot\LikeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//PROFILES
Route::group(['prefix' => '/business/profile', 'as' => 'profile.'], function(){
    Route::get('/{id}/promotions', [ProfileController::class, 'showPromotions'])->name('promotions');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::delete('/image', [ProfileController::class, 'deleteAvatar'])->name('avatar.delete');
    Route::patch('/update', [ProfileController::class, 'update'])->name('update');
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

// Spot 
Route::group(['prefix' => '/spot', 'as' => 'spot.'], function(){
    Route::get('/create', [App\Http\Controllers\Spot\IndexController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\Spot\IndexController::class, 'store'])->name('store');
    Route::get('/{id}', [App\Http\Controllers\Spot\IndexController::class, 'show'])->name('show');
    // Spot Likes
    Route::post('/{spot_id}/like', [App\Http\Controllers\Spot\LikeController::class, 'store'])->name('like');
    Route::delete('/{spot_id}/unlike', [App\Http\Controllers\Spot\LikeController::class, 'destroy'])->name('unlike');
    // Spot Comments
    Route::post('/{spot_id}/comment/store', [App\Http\Controllers\Spot\CommentController::class, 'store'])->name('comment.store');
    Route::delete('/{spot_id}/comment/{comment_id}/destroy', [App\Http\Controllers\Spot\CommentController::class, 'destroy'])->name('comment.destroy');
    // Spot Comment Likes
    Route::post('/{spot_id}/comment/{comment_id}/like', [App\Http\Controllers\Spot\LikeCommentController::class, 'like'])->name('comment.like');
    Route::delete('/{spot_id}/comment/{comment_id}/unlike', [App\Http\Controllers\Spot\LikeCommentController::class, 'unlike'])->name('comment.unlike');
});





// password reset
Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'show'])->name('password.request');

// register business
Route::get('/register/business', [App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('register.business');

// login business
// Route::get('/login/business', [App\Http\Controllers\Auth\LoginController::class, 'show'])->name('login.business');
