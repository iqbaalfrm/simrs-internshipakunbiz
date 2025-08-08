<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AuthController;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::resource('dokter', DokterController::class);
Route::resource('pendaftaran', PendaftaranController::class);
Route::resource('pasien', PasienController::class);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

