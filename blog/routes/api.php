<?php

use App\Http\Controllers\api\v1\AuthenticationController;
use App\Http\Controllers\api\v1\PostController;
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

Route::group(['prefix' => 'v1'], function () {
    Route::post('register', [AuthenticationController::class, 'register']);
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('logout', [AuthenticationController::class, 'logout']);

        // post routes
        Route::get('posts', [PostController::class, 'index'])->name('post.index');
        Route::post('post', [PostController::class, 'store'])->name('post.store');
        Route::get('posts/{post}', [PostController::class, 'show'])->name('post.show');
        Route::put('posts/{post}', [PostController::class, 'update'])->name('post.update');
        Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('post.delete');
    });
});
