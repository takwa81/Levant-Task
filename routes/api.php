<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth.custom'])->group(function () {

    Route::get('profile',[AuthController::class,'profile']);
    Route::apiResource('posts', PostController::class);
    Route::post('posts/{post_id}/comments', [CommentController::class, 'store']);
    Route::get('posts/{post_id}/comments', [CommentController::class, 'index']);
    Route::middleware(['role.admin'])->group(function () {
        Route::apiResource('users', UserController::class);
    });

});