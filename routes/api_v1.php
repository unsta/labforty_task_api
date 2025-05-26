<?php

use App\Http\Controllers\Api\V1\ListBookingHoursController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\ShowBookingHourController;
use App\Http\Controllers\Api\V1\StoreBookingHourController;
use App\Http\Controllers\Api\V1\UpdateBookingHourController;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:api'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::post('/login', LoginController::class);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/store-booking-hour', StoreBookingHourController::class);
            Route::get('/list-booking-hours', ListBookingHoursController::class);
            Route::get('/show-booking-hour/{id}', ShowBookingHourController::class);
            Route::patch('/update-booking-hour/{id}', UpdateBookingHourController::class);
        });
    });
});

