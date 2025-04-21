<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FollowController;
use App\Http\Middleware\PageViewMiddleware;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\TouristProfileController;

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BusinessesController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CommentsController;

use App\Http\Controllers\Business\ProfileController;
use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Business\BusinessLikeController;
use App\Http\Controllers\Business\BusinessCommentController;
use App\Http\Controllers\Business\BusinessPromotionController;
use App\Http\Controllers\Business\PhotoController;

use App\Http\Controllers\Spot\SpotController;
use App\Http\Controllers\Spot\SpotLikeController;
use App\Http\Controllers\Spot\SpotCommentController;
use App\Http\Controllers\Spot\SpotCommentLikeController;

use App\Http\Controllers\Quest\QuestController;
use App\Http\Controllers\Quest\QuestLikeController;
use App\Http\Controllers\Quest\QuestCommentController;
use App\Http\Controllers\Quest\QuestCommentLikeController;
use App\Http\Controllers\Quest\QuestBodyController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/sort', [HomeController::class, 'sort'])->name('sort');


//PROFILES
Route::group(['prefix' => '/business/profile', 'as' => 'profile.'], function () {
    Route::get('/{id}', [ProfileController::class, 'showProfile'])->name('header');
    Route::get('/{id}/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::delete('/image', [ProfileController::class, 'deleteAvatar'])->name('avatar.delete');
    Route::patch('/{id}/update', [ProfileController::class, 'update'])->name('update');
    Route::delete('/{id}/deactivate', [ProfileController::class, 'deactivate'])->name('deactivate');
    // Route::patch('/business/profile/{id}/promotions', [ProfileController::class, 'showPromotions'])->name('promotions.show');
    Route::get('/{id}/followers', [ProfileController::class, 'followers'])->name('followers');
    Route::get('/{id}/allreviews', [BusinessCommentController::class, 'showAllReviews'])->name('allreviews');
    Route::get('/{id}/review', [BusinessCommentController::class, 'showReview'])->name('review');
    Route::get('/{id}/review/index', [BusinessCommentController::class, 'showIndex'])->name('indexreview');
});

//FOLLOWS
Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
Route::delete('/follow/{user_id}/delete', [FollowController::class, 'delete'])->name('follow.delete');

//BUSINESS
Route::get('/business/business', [BusinessController::class, 'index'])->name('business.index');

//PROMOTION
Route::group(['prefix' => '/business/promotion', 'as' => 'promotions.'], function () {
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
Route::group(['prefix' => '/business/business', 'as' => 'businesses.'], function () {
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
Route::group(['prefix' => '/home/modelquest', 'as' => 'quests.'], function () {
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

// Post
Route::get('/home/posts/all', [HomeController::class, 'showAll'])->name('posts.all');
Route::get('/home/posts/followings', [HomeController::class, 'showFollowings'])->name('posts.followings');
Route::get('/home/posts/quests', [HomeController::class, 'showQuests'])->name('posts.quests');
Route::get('/home/posts/spots', [HomeController::class, 'showSpots'])->name('posts.spots');
Route::get('/home/posts/locations', [HomeController::class, 'showLocations'])->name('posts.locations');
Route::get('/home/posts/events', [HomeController::class, 'showEvents'])->name('posts.events');
Route::get('/home/posts/followings', [HomeController::class, 'showFollowings'])->name('posts.followings');

// Spot 
Route::group(['prefix' => '/spot', 'as' => 'spots.'], function () {
    Route::get('/create', [SpotController::class, 'create'])->name('create');
    Route::post('/store', [SpotController::class, 'store'])->name('store');
    Route::get('/{id}', [SpotController::class, 'show'])->middleware(PageViewMiddleware::class)->name('show');
    // Spot Likes
    Route::post('/{spot_id}/like', [SpotLikeController::class, 'store'])->name('like.store');
    Route::delete('/{spot_id}/unlike', [SpotLikeController::class, 'destroy'])->name('like.delete');
    // Spot Comments
    Route::post('/{spot_id}/comment/store', [SpotCommentController::class, 'store'])->name('comment.store');
    Route::delete('/{spot_id}/comment/{comment_id}/destroy', [SpotCommentController::class, 'destroy'])->name('comment.destroy');
    // Spot Comment Likes
    Route::post('/comment/{comment_id}/like', [SpotCommentLikeController::class, 'like'])->name('comment.like');
    Route::delete('/comment/{comment_id}/unlike', [SpotCommentLikeController::class, 'unlike'])->name('comment.unlike');
});





// password reset
Route::get('/password/reset', [ForgotPasswordController::class, 'show'])->name('password.request');

// register business
Route::get('/register/business', [RegisterController::class, 'registerBusiness'])->name('register.business');
Route::post('/store/business', [App\Http\Controllers\Auth\RegisterController::class, 'storeBusiness'])->name('register.business.submit');
Route::get('/register/tourist', [App\Http\Controllers\Auth\RegisterController::class, 'registerTourist'])->name('register.tourist');
Route::post('/store/tourist', [App\Http\Controllers\Auth\RegisterController::class, 'storeTourist'])->name('register.submit');

// tourists profile
Route::middleware('auth')->group(
    function () {
        Route::get('/myprofile/edit', [TouristProfileController::class, 'edit'])->name('myprofile.edit');
        Route::patch('/myprofile/update', [TouristProfileController::class, 'update'])->name('myprofile.update');
    }
);
// Route::get('/profile/{id}', [TouristProfileController::class, 'show'])->name('profile.show');

// tourists profile
Route::get('/myprofile/{id}', [TouristProfileController::class, 'myProfileShow'])->name('myprofile.show');
Route::get('/profile/{id}', [TouristProfileController::class, 'showOtherProfile'])->name('profile.show');

// Password Update
Route::patch('/password/update', [TouristProfileController::class, 'updatePassword'])->name('password.update');

// Delete Modal
Route::delete('/myprofile', [TouristProfileController::class, 'destroy'])->name('myprofile.destroy');

//ADMIN
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    // Route::get('/main', [UsersController::class, 'showLists'])->name('main');
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
    Route::delete('/{id}/business/comment/deactivate', [BusinessCommentController::class, 'deactivateBusinessComment'])->name('deactivate.business.comment');
    Route::patch('/{id}/business/comment/activate', [BusinessCommentController::class, 'activateBusinessComment'])->name('activate.business.comment');
    Route::delete('/{id}/spot/comment/deactivate', [SpotCommentController::class, 'deactivateSpotComment'])->name('deactivate.spot.comment');
    Route::patch('/{id}/spot/comment/activate', [SpotCommentController::class, 'activateSpotComment'])->name('activate.spot.comment');
    Route::delete('/{id}/quest/comment/deactivate', [QuestCommentController::class, 'deactivateQuestComment'])->name('deactivate.quest.comment');
    Route::patch('/{id}/quest/comment/activate', [QuestCommentController::class, 'activateQuestComment'])->name('activate.quest.comment');
});

// =============================== QuestController
Route::prefix('/quest')->name('quest.')->controller(QuestController::class)->group(function () {
    //SHOW - ADD QUEST 
    Route::get('/add', 'showAddQuest')->name('add');
    Route::post('/store', 'storeQuest')->name('store');
    //SHOW - EDIT QUEST
    Route::get('/{quest_id}/edit', 'showQuestEdit')->name('edit');
    Route::put('/{quest_id}/update', 'updateQuest')->name('update');
    //SHOW - CONFIRM QUEST
    Route::get('/confirm/{quest_id}', 'showConfirmQuest')->name('confirm');
    //VIEW QUEST
    Route::get('/{quest_id}', 'showViewQuest')->name('show');
    //RESTORE - UNHIEDE
    Route::post('/{quest_id}/restore', 'restore')->name('restore');
    //SOFT DELETE - HIHE (back to Confirm--> change later redirect to MyPage)
    Route::delete('/{quest_id}/hide', 'softDelete')->name('softDelete');

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
    Route::get('/getAllQuestBodies/{questId}', 'getAllQuestBodies')->name('getAllQuestBody');

    // ✅補助機能（QuestBody関連）
    Route::get('/user/searchbusinesses', 'getMyBusinesses')->name('mybusinesses');
    Route::get('/search/Ajax',  'searchAjax')->name('search');
});

// =============================== QuestCommentController
Route::prefix('/questcomment')->name('questcomment.')->controller(QuestCommentController::class)->group(function () {
    Route::post('/store/{quest_id}', 'storeQuestComment')->name('store');
    Route::delete('/delete/{id}', 'deleteQuestComment')->name('delete');
    Route::post('/{comment_id}/toggle-like', 'toggleCommentLike')->name('toggleLike');
    Route::get('/{commentId}/likes', 'getCommentLikes')->name('likes');

    Route::get('/{quest_id}/stats', 'getQuestCommentStats')->name('stats');
});
