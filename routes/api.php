<?php

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
//Posts
Route::get('/posts', [\App\Http\Controllers\Api\PostController::class, 'index']);
Route::get('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'show']);
Route::post('/posts', [\App\Http\Controllers\Api\PostController::class, 'store']);
Route::put('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'update']);
Route::delete('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'destroy']);

//Post comments
Route::get('/posts/{post}/comments', [\App\Http\Controllers\Api\PostController::class, 'showComments']);
//Route::get('/comments', [\App\Http\Controllers\Api\CommentController::class, 'store']);
