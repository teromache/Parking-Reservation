<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login_function', [AuthController::class, 'login'])->name('login.function');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/reserve', [ReserveController::class, 'index'])->name('reserve');
    Route::post('/check_parking', [ReserveController::class, 'checkParking'])->name('check.parking');
    Route::get('/payment', [ReserveController::class, 'payment'])->name('payment.index');
    Route::post('/payment/reservation', [ReserveController::class, 'reservation'])->name('payment.reservation');
    Route::get('/payment/receipt', [ReserveController::class, 'receipt'])->name('payment.receipt');
    Route::post('/terminate/session', [ReserveController::class, 'terminateSession'])->name('terminate.session');
    Route::get('/cancel', [ReserveController::class, 'cancelIndex'])->name('cancel.index');
    Route::post('/cancel/check', [ReserveController::class, 'checkReservation'])->name('cancel.check');
    Route::post('/cancel/process/{id}', [ReserveController::class, 'cancelProcess'])->name('cancel.process');
    Route::get('/available', [ReserveController::class, 'availableIndex'])->name('available.index');
    Route::post('/available/process', [ReserveController::class, 'availableCheck'])->name('available.check');
});
