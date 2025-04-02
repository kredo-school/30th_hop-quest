<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FollowController;

use App\Http\Middleware\PageViewMiddleware;
use App\Http\Controllers\Spot\LikeController;
use App\Http\Controllers\Spot\IndexController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Business\PhotoController;
use App\Http\Controllers\Business\QuestController;
use App\Http\Controllers\Business\ReviewController;
use App\Http\Controllers\Business\ProfileController;
use App\Http\Controllers\Spot\LikeCommentController;
use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Business\PromotionController;
use App\Http\Controllers\Business\QuestLikeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Business\BusinessLikeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');


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
    Route::get('/{id}/allreviews', [ProfileController::class, 'allReviews'])->name('allreviews');
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
    Route::post('photos/{business}/store', [PhotoController::class, 'store'])->name('photos.store');
    Route::get('photos/edit/{business}', [PhotoController::class, 'edit'])->name('photos.edit');
    Route::patch('photos/{business}/update', [PhotoController::class, 'update'])->name('photos.update');
    Route::delete('/{id}/deactivate', [BusinessController::class, 'deactivate'])->name('deactivate');
    Route::patch('/{id}/activate', [BusinessController::class, 'activate'])->name('activate');
    //LIKES
    Route::post('/like/{business_id}/store', [BusinessLikeController::class, 'storeLike'])->name('like.store');
    Route::delete('/like/{business_id}/delete', [BusinessLikeController::class, 'deleteLike'])->name('like.delete');
});

//QUESTS simple
Route::group(['prefix' => '/business/modelquest', 'as' => 'modelquest.'], function(){
    Route::get('/create', [QuestController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [QuestController::class, 'edit'])->name('edit');
    Route::patch('/{id}/update', [QuestController::class, 'update'])->name('update');
    Route::post('/store', [QuestController::class, 'store'])->name('store');
    Route::post('/like/{quest_id}/store', [QuestLikeController::class, 'storeLike'])->name('like.store');
    Route::delete('/like/{quest_id}/delete', [QuestLikeController::class, 'deleteLike'])->name('like.delete');
    Route::delete('/{id}/deactivate', [QuestController::class, 'deactivate'])->name('deactivate');
    Route::patch('/{id}/activate', [QuestController::class, 'activate'])->name('activate');
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
    Route::get('/{id}', [App\Http\Controllers\Spot\IndexController::class, 'show'])->middleware(PageViewMiddleware::class)->name('show');
    // Spot Likes
    Route::post('/{spot_id}/like', [App\Http\Controllers\Spot\LikeController::class, 'store'])->name('like');
    Route::delete('/{spot_id}/unlike', [App\Http\Controllers\Spot\LikeController::class, 'destroy'])->name('unlike');
    // Spot Comments
    Route::post('/{spot_id}/comment/store', [App\Http\Controllers\Spot\CommentController::class, 'store'])->name('comment.store');
    Route::delete('/{spot_id}/comment/{comment_id}/destroy', [App\Http\Controllers\Spot\CommentController::class, 'destroy'])->name('comment.destroy');
    // Spot Comment Likes
    Route::post('/{spot_id}/comment/{comment_id}/like', [LikeCommentController::class, 'like'])->name('comment.like');
    Route::delete('/{spot_id}/comment/{comment_id}/unlike', [App\Http\Controllers\Spot\LikeCommentController::class, 'unlike'])->name('comment.unlike');
});





// password reset
Route::get('/password/reset', [ForgotPasswordController::class, 'show'])->name('password.request');

// register business
Route::get('/register/business', [RegisterController::class, 'registerBusiness'])->name('register.business');
Route::post('/store/business', [App\Http\Controllers\Auth\RegisterController::class, 'storeBusiness'])->name('register.business.submit');
Route::get('/register/tourist', [App\Http\Controllers\Auth\RegisterController::class, 'registerTourist'])->name('register.tourist');
Route::post('/store/tourist', [App\Http\Controllers\Auth\RegisterController::class, 'storeTourist'])->name('register.submit');

