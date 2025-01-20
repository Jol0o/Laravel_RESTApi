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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});


Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->post('logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('booking', [BookingController::class, 'booking'])->name('booking');


//protected routes
Route::middleware(['auth'])->group(function () {

    Route::get('/userview', function () {
        return view('userview');
    })->name('userview.view');
    
    Route::resource('rooms', RoomController::class);

    Route::get('profile', [UserController::class, 'index'])->name('profile.show');
    Route::post('profile/update', [UserController::class, 'update'])->name('profile.update');

    Route::get('rooms', [RoomController::class, 'view'])->name('rooms.view');
    Route::get('bookings', [BookingController::class, 'booking'])->name('bookings');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/adminview', function () {
        return view('adminview');
    })->name('adminview.view');

    Route::resource('bookings', BookingController::class);
});