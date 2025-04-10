<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Quest\QuestController;
use App\Http\Controllers\Quest\QuestBodyController;
use App\Http\Controllers\Quest\QuestCommentController;
use App\Http\Controllers\Spot\IndexController;
use App\Http\Controllers\Spot\LikeController;
use App\Http\Controllers\Business\PhotoController;
use App\Http\Controllers\Business\ReviewController;
use App\Http\Controllers\Business\ProfileController;
use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Business\PromotionController;
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
Route::get('/register/business', [App\Http\Controllers\Auth\RegisterController::class, 'registerBusiness'])->name('register.business');
Route::post('/store/business', [App\Http\Controllers\Auth\RegisterController::class, 'storeBusiness'])->name('register.business.submit');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

// login business
// Route::get('/login/business', [App\Http\Controllers\Auth\LoginController::class, 'show'])->name('login.business');

Route::get('/business', [App\Http\Controllers\HomeController::class, 'viewBusiness'])->name('view.business');

// =============================== QuestController
Route::prefix('/quest')->name('quest.')->controller(QuestController::class)->group(function () {
    //SHOW - ADD QUEST 
    Route::get('/add', 'showAddQuest')->name('add');
    Route::post('/store', 'storeQuest')->name('store');
    //SHOW - EDIT QUEST
    Route::get('/{quest_id}/edit', 'showQuestEdit')->name('edit');
    Route::put('/{quest_id}/update', 'updateQuest')->name('update');
    //RESTORE - UNHIEDE
    Route::post('/{quest_id}/restore', 'restore')->name('restore');
    //SOFT DELETE - HIHE (back to Confirm--> change later redirect to MyPage)
    Route::delete('/{quest_id}/hide', 'softDelete')->name('softDelete');
    //SHOW - CONFIRM QUEST
    Route::get('/confirm-quest/{quest_id}', 'showConfirmQuest')->name('confirm');
    //VIEW QUEST
    Route::get('/{quest_id}', 'showViewQuest')->name('show'); 
    Route::post('/{id}/toggle-like', 'toggleLike')->name('toggle-like');
    Route::get('/{id}/likes', 'getLikes')->name('likes');
    Route::delete('/delete/{questId}', 'deleteQuest')->name('delete');

    
    Route::post('/follow/{userId}', [QuestController::class, 'toggleFollow'])->name('quest.toggleFollow');
});


// =============================== QuestBodyController
Route::prefix('/questbody')->name('questbody.')->controller(QuestBodyController::class)->group(function () {
    Route::post('/store', 'storeQuestBody')->name('store');
    Route::put('/update/{id}', 'updateQuestBody')->name('update');
    Route::delete('/delete/{id}', 'deleteQuestBody')->name('delete');
    Route::post('/image/delete', 'deleteImage')->name('image.delete');
    Route::post('/agenda/{id}', 'toggleAgenda')->name('toggleAgenda');
    Route::get('/getAllQuestBodies/{questId}','getAllQuestBodies')->name('getAllQuestBody');

    // ✅ 補助機能（QuestBody関連）
    Route::get('/user/searchbusinesses', 'getMyBusinesses')->name('mybusinesses');
    Route::get('/search/Ajax',  'searchAjax')->name('search');
});

// =============================== QuestCommentController
Route::prefix('/questcomment')->name('questcomment.')->controller(QuestCommentController::class)->group(function () {
    Route::post('/store/{quest_id}', 'storeQuestComment')->name('store');
    Route::delete('/delete/{id}', 'deleteQuestComment')->name('delete');
    Route::post('/{comment_id}/toggle-like', 'toggleCommentLike')->name('toggleLike');
    Route::get('/{quest_id}/stats', 'getQuestCommentStats')->name('stats');
});

