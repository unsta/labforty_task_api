<?php

use App\Http\Controllers\Api\V1\DestroyBookingHourController;
use App\Http\Controllers\Api\V1\ListBookingHoursController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\ShowBookingHourController;
use App\Http\Controllers\Api\V1\StoreBookingHourController;
use App\Http\Controllers\Api\V1\UpdateBookingHourController;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:api'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::post('/login', LoginController::class);

        Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
            Route::get('/list-booking-hours', ListBookingHoursController::class);
        });

        Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
            Route::post('/store-booking-hour', StoreBookingHourController::class);

            Route::get('/show-booking-hour/{bookingHour}', ShowBookingHourController::class)
                ->name('show-booking-hour');

            Route::patch('/update-booking-hour/{bookingHour}', UpdateBookingHourController::class)
                ->name('update-booking-hour');

            Route::delete('/destroy-booking-hour/{bookingHour}', DestroyBookingHourController::class)
                ->name('destroy-booking-hour');
        });
    });
});

