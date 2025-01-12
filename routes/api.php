<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Add this to define a route for /bookings
// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('bookings', BookingController::class);
//     Route::apiResource('rooms', RoomController::class);
// });
// Route::apiResource('users', UserController::class);
// Route::post('/login', [AuthController::class, 'login']);
// Route::get('rooms', [RoomController::class, 'index']);
// Route::get('rooms/{room}', [RoomController::class, 'show']);
// Route::get('users/email/{email}', [UserController::class, 'showByEmail'])->where('email', '.*');