<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PasienController;

// (Stub) Controller lain — bikin kalau belum ada:
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\ApotekController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Apoteker\ResepController;

// ===================== Redirect root =====================
Route::get('/', fn () => redirect()->route('dashboard.index'));

// ===================== Auth (guest) =====================
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// ===================== App (auth) =====================
Route::middleware('auth')->group(function () {

    // Dashboard (GET saja)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard.index');

    // -------- ADMIN: full akses --------
    Route::middleware('role:admin')->group(function () {
        // Manage User (Admin)
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('users',           [UserManagementController::class, 'index'])->name('users.index');
            Route::get('users/create',    [UserManagementController::class, 'create'])->name('users.create');
            Route::post('users',          [UserManagementController::class, 'store'])->name('users.store');
            Route::delete('users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
        });

        // Master Data Dokter (CRUD)
        Route::resource('dokter', DokterController::class);

        // Pendaftaran pasien (frontdesk/admin)
        Route::resource('pendaftaran', PendaftaranController::class)->only(['index','create','store']);

        // (Opsional) master lain: jadwal, pegawai, laporan, dsb.
        // Contoh stub route names agar sidebar tidak error:
        Route::get('/jadwal', fn() => view('stub.jadwal'))->name('jadwal.index');
        Route::get('/antrian', fn() => view('stub.antrian'))->name('antrian.index');
        Route::get('/laporan', fn() => view('stub.laporan'))->name('laporan.index');
        Route::get('/pegawai', fn() => view('stub.pegawai'))->name('pegawai.index');
    });

    // -------- DOKTER: Data Pasien + Rekam Medis --------
    Route::middleware('role:dokter|admin')->group(function () {
        // Rekam Medis (contoh minimal: index per pasien & store entri)
        Route::get('/rekam-medis',                [RekamMedisController::class, 'index'])->name('rekam.index'); // bisa list RM terkini
        Route::get('/rekam-medis/{pasien}',       [RekamMedisController::class, 'show'])->name('rekam.show');   // lihat RM per pasien
        Route::post('/rekam-medis/{pasien}',      [RekamMedisController::class, 'store'])->name('rekam.store'); // tambah entri RM (keluhan/diagnosa/resep)
    });

    // -------- APOTEKER: Data Pasien + Apotek/Stok + Antrean Resep --------
    Route::middleware('role:apoteker|admin')->group(function () {
        Route::get('/apotek', [ApotekController::class, 'index'])->name('apotek.index');

        // antrean resep dari dokter
        Route::prefix('apoteker')->name('apoteker.')->group(function () {
            Route::get('resep',                 [ResepController::class, 'index'])->name('resep.index');
            Route::post('resep/{rm}/status',    [ResepController::class, 'updateStatus'])->name('resep.updateStatus');
            Route::post('notifications/read-all',[ResepController::class,'readAll'])->name('notif.readAll');
        });
    });

    // -------- KASIR: Data Pasien + Pembayaran --------
    Route::middleware('role:kasir|admin')->group(function () {
        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        // tambahkan route proses pembayaran sesuai kebutuhan
    });

    // -------- Data Pasien (boleh diakses semua role operasional) --------
    Route::resource('pasien', PasienController::class)->only(['index','show'])
        ->middleware('role:admin|dokter|apoteker|kasir');

    // Logout (POST)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/test-role', fn() => 'OK admin')->middleware('role:admin');

});
