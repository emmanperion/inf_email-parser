<?php

use App\Http\Controllers\Api\SuccessfulEmailController;
use App\Http\Controllers\Api\TokenController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'ability:api:successful-emails'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::resource('successful-emails', SuccessfulEmailController::class);
    });
});

Route::prefix('v1')->group(function () {
    Route::resource('tokens', TokenController::class)->only(['store']);
});
