<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth.custom'])->group(function () {

    Route::get('profile',[AuthController::class,'profile']);
    Route::apiResource('posts', PostController::class);

});
