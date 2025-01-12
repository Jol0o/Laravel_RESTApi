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
use App\Http\Controllers\AuthController;



Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('booking', [BookingController::class, 'booking'])->name('booking');


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::resource('bookings', BookingController::class);
    Route::resource('users', UserController::class);
    Route::resource('rooms', RoomController::class);
    Route::get('rooms', [RoomController::class, 'view'])->name('rooms.view');
    Route::get('booking', [BookingController::class, 'booking'])->name('bookings');
    Route::resource('bookings', BookingController::class)->except(['create', 'edit']);
});
