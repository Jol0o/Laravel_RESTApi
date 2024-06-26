<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;

Route::resource('bookings', BookingController::class);
Route::resource('users', UserController::class);
Route::resource('rooms', RoomController::class);