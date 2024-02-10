<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('administrator/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('administrator/login', [AuthenticatedSessionController::class, 'store']);

    

               
});

