<?php

use App\Http\Controllers\PostcardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if (Auth::check()) {
        return to_route('postcards.create');
    }

    return to_route('login');
});

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
            ->name('postcards.show')
            ->middleware('signed');
    });
});
