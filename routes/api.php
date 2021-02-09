<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\PostController;
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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    Route::get('/users/all/', [HomeController::class, 'index']);
    Route::get('/users/{id}', [HomeController::class, 'show']);
    Route::put('/users/{id}', [HomeController::class, 'update']);
    Route::delete('/users/{id}', [HomeController::class, 'destroy']);

    Route::get('/posts/all/', [PostController::class, 'getAllPosts']);
    Route::get('/comments/all/', [CommentController::class, 'getAllPosts']);
    Route::resource('posts', PostController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('blacklists', \App\Http\Controllers\SubscribersController::class);
    Route::resource('subscribers', \App\Http\Controllers\BlacklistsController::class);
});
