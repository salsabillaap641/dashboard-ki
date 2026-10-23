<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataKiController;
use App\Http\Controllers\PerpustakaanKiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\PenelaahanKiController;
use App\Http\Controllers\RekapKiController;
use App\Http\Controllers\SentraKiController;
use App\Http\Controllers\PotensiKiController;

// Halaman publik
Route::get('/', [DashboardController::class, 'index']);

// Sentra KI dapat dilihat tanpa login.
Route::get('/sentra-ki', [SentraKiController::class, 'index'])->name('sentra-ki.index');

Route::get('/perpustakaan-ki', [PerpustakaanKiController::class, 'index'])
    ->name('perpustakaan-ki.index');

    Route::get('/potensi-ki', [PotensiKiController::class, 'index'])
    ->name('potensi-ki.index');


Route::get('/perpustakaan-ki/{id}', [
    PerpustakaanKiController::class,
    'show'
])->name('perpustakaan-ki.show');

Route::view('/jenis-ki', 'jenis-ki')
    ->name('jenis-ki');

// Login dan logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

// Input Data KI: pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/input-ki', [DataKiController::class, 'create'])
        ->name('data-ki.create');

    Route::post('/input-ki', [DataKiController::class, 'store'])
        ->name('data-ki.store');
    
    Route::get('/pengajuan-saya', [
    DataKiController::class,
    'pengajuanSaya'
])->name('pengajuan-saya');

Route::get('/pengajuan-saya/{pengajuanKi}/detail', [
    DataKiController::class,
    'detailPengajuanSaya'
])->name('pengajuan-saya.detail');


Route::get('/pengajuan-saya/{pengajuanKi}/edit', [
    DataKiController::class,
    'editPengajuan'
])->name('pengajuan-saya.edit');

Route::put('/pengajuan-saya/{pengajuanKi}', [
    DataKiController::class,
    'updatePengajuan'
])->name('pengajuan-saya.update');

});

// Pengelolaan Data KI: khusus Master
Route::middleware(['auth', 'role:master'])->group(function () {
    Route::get('/data-ki', [DataKiController::class, 'index'])
        ->name('data-ki.index');

    Route::get('/data-ki/{id}/edit', [DataKiController::class, 'edit'])
        ->name('data-ki.edit');

    Route::put('/data-ki/{id}', [DataKiController::class, 'update'])
        ->name('data-ki.update');

    Route::delete('/data-ki/{id}', [DataKiController::class, 'destroy'])
        ->name('data-ki.destroy');
        
        Route::get('/data-ki/{dataKi}', [DataKiController::class, 'show'])
    ->name('data-ki.show');

    Route::get('/input-perpustakaan-ki', [PerpustakaanKiController::class, 'create'])
        ->name('perpustakaan-ki.create');

    Route::post('/input-perpustakaan-ki', [PerpustakaanKiController::class, 'store'])
        ->name('perpustakaan-ki.store');

    Route::get('/perpustakaan-ki/{id}/edit', [PerpustakaanKiController::class, 'edit'])
        ->name('perpustakaan-ki.edit');

    Route::put('/perpustakaan-ki/{id}', [PerpustakaanKiController::class, 'update'])
        ->name('perpustakaan-ki.update');

    Route::delete('/perpustakaan-ki/{id}', [PerpustakaanKiController::class, 'destroy'])
        ->name('perpustakaan-ki.destroy');

    Route::get('/users', [UserManagementController::class, 'index'])
        ->name('users.index');

    Route::get('/users/create', [UserManagementController::class, 'create'])
        ->name('users.create');

    Route::post('/users', [UserManagementController::class, 'store'])
        ->name('users.store');

    Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])
        ->name('users.edit');

    Route::put('/users/{user}', [UserManagementController::class, 'update'])
        ->name('users.update');

    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])
        ->name('users.destroy');

    Route::get('/penelaahan-ki', [PenelaahanKiController::class, 'index'])
        ->name('penelaahan-ki.index');

    Route::get('/penelaahan-ki/{pengajuanKi}', [PenelaahanKiController::class, 'show'])
        ->name('penelaahan-ki.show');

    Route::put('/penelaahan-ki/{pengajuanKi}', [PenelaahanKiController::class, 'update'])
        ->name('penelaahan-ki.update');

        Route::post(
    '/penelaahan-ki/{pengajuanKi}/masukkan-data',
    [PenelaahanKiController::class, 'masukkanKeDataKi']
)->name('penelaahan-ki.masukkan-data');

Route::get('/rekap-ki', [RekapKiController::class, 'index'])
    ->name('rekap-ki.index');

Route::post('/rekap-ki', [RekapKiController::class, 'store'])
    ->name('rekap-ki.store');



    // Pengelolaan Sentra KI khusus Master
    Route::get('/sentra-ki/create', [SentraKiController::class, 'create'])->name('sentra-ki.create');
    Route::post('/sentra-ki', [SentraKiController::class, 'store'])->name('sentra-ki.store');
    Route::get('/sentra-ki/{sentraKi}/edit', [SentraKiController::class, 'edit'])->name('sentra-ki.edit');
    Route::put('/sentra-ki/{sentraKi}', [SentraKiController::class, 'update'])->name('sentra-ki.update');
    Route::delete('/sentra-ki/{sentraKi}', [SentraKiController::class, 'destroy'])->name('sentra-ki.destroy');

});
