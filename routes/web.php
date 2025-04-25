<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/private-image/{folder}/{filename}', function ($folder, $filename) {
    $path = "{$folder}/{$filename}";

    if (!Storage::disk('private')->exists($path)) {
        abort(404);
    }

    return response()->file(storage_path('app/private/' . $path));
})->name('private.image');