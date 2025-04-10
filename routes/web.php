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
use App\Http\Controllers\Business\QuestLikeController;
use App\Http\Controllers\Business\BusinessCommentController;
use App\Http\Controllers\Business\ProfileController;
use App\Http\Controllers\Spot\LikeCommentController;
use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Business\SpotController;
use App\Http\Controllers\Business\SpotLikeController;
use App\Http\Controllers\Business\BusinessPromotionController;
use App\Http\Controllers\Business\BusinessLikeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BusinessesController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CommentsController;

use App\Http\Controllers\Auth\ForgotPasswordController;

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
    Route::get('/modelquests/{id}', [ProfileController::class, 'showModelQuests'])->name('quests');
    Route::get('/{id}/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::delete('/image', [ProfileController::class, 'deleteAvatar'])->name('avatar.delete');
    Route::patch('/{id}/update', [ProfileController::class, 'update'])->name('update');
    Route::delete('/{id}/deactivate', [ProfileController::class, 'deactivate'])->name('deactivate');
    // Route::patch('/business/profile/{id}/promotions', [ProfileController::class, 'showPromotions'])->name('promotions.show');
    Route::get('/{id}/followers', [ProfileController::class, 'followers'])->name('followers');
    Route::get('/{id}/allreviews', [ProfileController::class, 'allReviews'])->name('allreviews');
    Route::get('/{id}/review', [BusinessCommentController::class, 'showReview'])->name('review');
});

//FOLLOWS
Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
Route::delete('/follow/{user_id}/delete', [FollowController::class, 'delete'])->name('follow.delete');

//BUSINESS
Route::get('/business/business', [BusinessController::class, 'index'])->name('business.index');

//PROMOTION
Route::group(['prefix' => '/business/promotion', 'as' => 'promotions.'], function(){
    Route::get('/create', [BusinessPromotionController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [BusinessPromotionController::class, 'edit'])->name('edit');
    Route::patch('/{id}/update', [BusinessPromotionController::class, 'update'])->name('update');
    Route::post('/store', [BusinessPromotionController::class, 'store'])->name('store');
    Route::get('/show/{id}', [BusinessPromotionController::class, 'show'])->name('show');
    Route::get('/confirm', [BusinessPromotionController::class, 'confirm'])->name('confirm');
    Route::delete('/{id}/deactivate', [BusinessPromotionController::class, 'deactivate'])->name('deactivate');
    Route::patch('/{id}/activate', [BusinessPromotionController::class, 'activate'])->name('activate');
});

//MANAGEMENT BUSINESS
Route::group(['prefix' => '/business/business', 'as' => 'businesses.'], function(){
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
    });

//LIKES BUSINESS
Route::post('/home/like/business/{business_id}/store', [BusinessLikeController::class, 'storeBusinessLike'])->name('businesses.like.store');
Route::delete('/home/like/business/{business_id}/delete', [BusinessLikeController::class, 'deleteBusinessLike'])->name('businesses.like.delete');

//QUESTS simple
Route::group(['prefix' => '/home/modelquest', 'as' => 'quests.'], function(){
    Route::get('/create', [QuestController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [QuestController::class, 'edit'])->name('edit');
    Route::patch('/{id}/update', [QuestController::class, 'update'])->name('update');
    Route::post('/store', [QuestController::class, 'store'])->name('store');
    Route::delete('/{id}/deactivate', [QuestController::class, 'deactivate'])->name('deactivate');
    Route::patch('/{id}/activate', [QuestController::class, 'activate'])->name('activate');
    Route::post('/like/{quest_id}/store', [QuestLikeController::class, 'storeQuestLike'])->name('like.store');
    Route::delete('/like/{quest_id}/delete', [QuestLikeController::class, 'deleteQuestLike'])->name('like.delete');
});

//LIKE QUEST
Route::post('/home/like/quest/{quest_id}/store', [QuestLikeController::class, 'storeQuestLike'])->name('quests.like.store');
Route::delete('/home/like/quest/{quest_id}/delete', [QuestLikeController::class, 'deleteQuestLike'])->name('quests.like.delete');

//SPOT
Route::group(['prefix' => '/home/spot', 'as' => 'spots.'], function(){
    Route::post('/like/{spot_id}/store', [SpotLikeController::class, 'storeLike'])->name('like.store');
    Route::delete('/like/{spot_id}/delete', [SpotLikeController::class, 'deleteLike'])->name('like.delete');
});

// Post
Route::get('/home/posts/all', [HomeController::class, 'showAll'])->name('posts.all');
Route::get('/home/posts/followings', [HomeController::class, 'showFollowings'])->name('posts.followings');
Route::get('/home/posts/quests', [HomeController::class, 'showQuests'])->name('posts.quests');
Route::get('/home/posts/spots', [HomeController::class, 'showSpots'])->name('posts.spots');
Route::get('/home/posts/locations', [HomeController::class, 'showLocations'])->name('posts.locations');
Route::get('/home/posts/events', [HomeController::class, 'showEvents'])->name('posts.events');
Route::get('/home/posts/followings', [HomeController::class, 'showFollowings'])->name('posts.followings');

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
    Route::post('/comment/{comment_id}/like', [App\Http\Controllers\Spot\LikeCommentController::class, 'like'])->name('comment.like');
    Route::delete('/comment/{comment_id}/unlike', [App\Http\Controllers\Spot\LikeCommentController::class, 'unlike'])->name('comment.unlike');
});





// password reset
Route::get('/password/reset', [ForgotPasswordController::class, 'show'])->name('password.request');

// register business
Route::get('/register/business', [RegisterController::class, 'registerBusiness'])->name('register.business');
Route::post('/store/business', [App\Http\Controllers\Auth\RegisterController::class, 'storeBusiness'])->name('register.business.submit');
Route::get('/register/tourist', [App\Http\Controllers\Auth\RegisterController::class, 'registerTourist'])->name('register.tourist');
Route::post('/store/tourist', [App\Http\Controllers\Auth\RegisterController::class, 'storeTourist'])->name('register.submit');

//ADMIN
Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => 'admin'], function(){
    Route::get('/users/business', [UsersController::class, 'indexBusiness'])->name('users.business');
    Route::get('/users/applied', [UsersController::class, 'indexApplied'])->name('users.applied');
    Route::get('/users/{id}/review', [UsersController::class, 'adminReview'])->name('users.review');
    //admin/users                                                   admin.users
    Route::post('/admin/users/{user}/certify', [UsersController::class, 'certify'])->name('users.certify');
    Route::delete('/users/{id}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate');
    Route::patch('/users/{id}/activate', [UsersController::class, 'activate'])->name('users.activate');
    Route::get('/users/tourists', [UsersController::class, 'indexTourists'])->name('users.tourists');

    Route::get('/posts/business', [BusinessesController::class, 'index'])->name('posts');
    Route::get('/posts/applied', [BusinessesController::class, 'indexApplied'])->name('posts.applied');
    Route::get('/posts/{id}/review', [BusinessesController::class, 'adminReview'])->name('posts.review');
    //admin/users                                                   admin.users
    Route::post('/admin/posts/{post}/certify', [BusinessesController::class, 'certify'])->name('posts.certify');
    Route::delete('/posts/{id}/deactivate', [BusinessesController::class, 'deactivate'])->name('posts.deactivate');
    Route::patch('/posts/{id}/activate', [BusinessesController::class, 'activate'])->name('posts.activate');
    Route::get('/posts/tourists', [PostsController::class, 'indexTourists'])->name('posts.tourists');
    Route::get('/comments', [CommentsController::class, 'indexComments'])->name('comments');
    Route::delete('/comments/{id}/deactivate', [CommentsController::class, 'deactivate'])->name('comments.deactivate');
    Route::patch('/comments/{id}/activate', [CommentsController::class, 'activate'])->name('comments.activate');
});
