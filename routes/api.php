<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfilesController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->group(function (){

    //User routes
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    //Loged in User
    Route::get('logedinUser', [ProfilesController::class, 'showLogenInUser']);

    //logout
    Route::post('/logout', [AuthController::class, 'logout']);
    //User Posts
    Route::get('users/{user}/posts', [PostController::class, 'userIndex']);
    //Any user profile
    Route::get('profiles/{user:username}', [ProfilesController::class, 'show']);
    Route::patch('profiles/{user:username}', [ProfilesController::class, 'update']);

    //Post routes
    Route::get('posts', [PostController::class, 'index']);
    Route::post('posts', [PostController::class, 'store']);
    Route::get('posts/{post}', [PostController::class, 'show']);
    Route::put('posts/{post}', [PostController::class, 'update']);
    Route::delete('posts/{post}', [PostController::class, 'destroy']);
    Route::get('/posts/{post}/comments', [PostController::class, 'showComments']);
    //Comment routes
    Route::get('comments', [CommentController::class, 'index']);
    Route::post('comments', [CommentController::class, 'store']);
    Route::get('comments/{comment}', [CommentController::class, 'show']);
    Route::put('comments/{comment}', [CommentController::class, 'update']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);

    //Following
    Route::get('following', [FollowController::class, 'following']);
    Route::get('timeline', [FollowController::class, 'index']);
    Route::post('profiles/{user:username}/follow', [FollowController::class, 'store']);
    Route::get('profiles/{user:username}/isFollowing', [FollowController::class, 'isFollowing']);
});

//Tag routes
Route::apiResource('tags', TagController::class);

//Login and Register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);





