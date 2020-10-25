<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Posts
/*
Route::get('/posts', [\App\Http\Controllers\Api\PostController::class, 'index']);
Route::get('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'show']);
Route::post('/posts', [\App\Http\Controllers\Api\PostController::class, 'store']);
Route::put('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'update']);`
Route::delete('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'destroy']);
*/
//Route::group(['middleware' => 'auth:api'], function (){
//
//});
Route::get('posts', [PostController::class, 'index'])->middleware('auth:api');
Route::post('posts', [PostController::class, 'store'])->middleware('auth:api');
Route::get('posts/{post}', [PostController::class, 'show'])->middleware('auth:api');
Route::put('posts/{post}', [PostController::class, 'update'])->middleware('auth:api');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->middleware('auth:api');

//Route::apiResource('posts', PostController::class)->middleware('auth:api');


Route::get('comments', [CommentController::class, 'index'])->middleware('auth:api');
Route::post('comments', [CommentController::class, 'store'])->middleware('auth:api');
Route::get('comments/{comment}', [CommentController::class, 'show'])->middleware('auth:api');
Route::put('comments/{comment}', [CommentController::class, 'update'])->middleware('auth:api');
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth:api');

//Route::apiResource('comments', CommentController::class);

Route::apiResource('tags', TagController::class);

//Post comments
Route::get('/posts/{post}/comments', [PostController::class, 'showComments']);

Route::fallback(function(){
    return response()->json(['message' => 'Not Found!'], 404);
});
//Route::get('/comments', [\App\Http\Controllers\Api\CommentController::class, 'store']);

