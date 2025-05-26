<?php

use App\Http\Controllers\Api\V1\ListBookingHoursController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\StoreBookingHourController;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:api'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::post('/login', LoginController::class);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/store-booking-hour', StoreBookingHourController::class);
            Route::get('/list-booking-hours', ListBookingHoursController::class);
        });
    });
});

