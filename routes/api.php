<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller\User\BookingController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// auuthooooo...
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('owner')->group(function () {
        Route::get('properties', [\App\Http\Controllers\Owner\PropertyController::class, 'index']);
        Route::post('properties',[\App\Http\Controllers\Owner\PropertyController::class, 'store']);
    });
    Route::prefix('user')->group(function () {
        Route::get('bookings',[\App\Http\Controllers\User\BookingController::class, 'index']);
    });
    });

 // publicccccoo...



Route::get('search/',
 \App\Http\Controllers\Public\PropertySearchController::class);
Route::get('properties/{property}',
 \App\Http\Controllers\Public\PropertyController::class);
Route::get('apartments/{apartment}',
 \App\Http\Controllers\Public\ApartmentController::class);


///...
Route::post('auth/register', App\Http\Controllers\Auth\RegisterController::class);

