<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\StudioController;

Route::middleware('apikey')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
    Route::put('/bookings/{id}', [BookingController::class, 'update']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
    Route::post('/bookings/decrypt', [BookingController::class, 'decryptResponse']);
});

Route::middleware('apikey')->group(function () {
    Route::get('/studios', [StudioController::class, 'index']);
    Route::post('/studios', [StudioController::class, 'store']);
    Route::get('/studios/{id}', [StudioController::class, 'show']);
    Route::put('/studios/{id}', [StudioController::class, 'update']);
    Route::delete('/studios/{id}', [StudioController::class, 'destroy']);
    Route::post('/studios/decrypt', [StudioController::class, 'decryptResponse']); // decrypt endpoint
});
