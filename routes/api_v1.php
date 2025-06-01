<?php

use App\Http\Controllers\Api\V1\DestroyBookingHourController;
use App\Http\Controllers\Api\V1\ListBookingHoursController;
use App\Http\Controllers\Api\V1\ListNotificationTypesController;
use App\Http\Controllers\Api\V1\ListTimeSlotsController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\LogoutController;
use App\Http\Controllers\Api\V1\ShowBookingHourController;
use App\Http\Controllers\Api\V1\StoreBookingHourController;
use App\Http\Controllers\Api\V1\UpdateBookingHourController;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:api'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::middleware('web')->group(function () {
            Route::post('/login', LoginController::class);
            Route::post('/logout', LogoutController::class);
        });

        Route::middleware(['auth:sanctum', 'role:admin|user'])->group(function () {
            Route::get('/show-booking-hour/{bookingHour}', ShowBookingHourController::class)
                ->name('show-booking-hour');

            Route::get('/list-notification-types', ListNotificationTypesController::class)
                ->name('list-notification-types');

            Route::get('/list-time-slots', ListTimeSlotsController::class)
                ->name('list-time-slots');

            Route::get('/list-booking-hours', ListBookingHoursController::class);
        });

        Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
            Route::post('/store-booking-hour', StoreBookingHourController::class);

            Route::patch('/update-booking-hour/{bookingHour}', UpdateBookingHourController::class)
                ->name('update-booking-hour');

            Route::delete('/destroy-booking-hour/{bookingHour}', DestroyBookingHourController::class)
                ->name('destroy-booking-hour');
        });
    });
});

