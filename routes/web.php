<?php

use App\Http\Controllers\PostcardController;
use App\Models\Postcard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if (Auth::check()) {
        return to_route('postcards.create');
    }

    return to_route('login');
});

//signed url with that postcards/shared uri
Route::get('/postcards/shared/{postcard}', [
    PostcardController::class,
    'shared'
])->name('postcards.shared')
->middleware('signed');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {

    Route::group(['prefix' => 'postcards'], function () {
        Route::get('/create', [PostcardController::class, 'create'])
            ->name('postcards.create');
        Route::post('/', [PostcardController::class, 'store'])
            ->name('postcards.store');
        Route::get('/{postcard}', [PostcardController::class, 'show'])
            ->name('postcards.show');
        Route::get('/{postcard}/copy-link', [PostcardController::class, 'copyLink'])
            ->name('postcards.copy-link');
        //upload
        Route::post('/{postcard}/upload-file', [PostcardController::class, 'uploadFile'])
            ->name('postcards.upload-file');
    });
});
