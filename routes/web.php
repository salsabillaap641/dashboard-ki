<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataKiController;
use App\Http\Controllers\PerpustakaanKiController;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/input-ki', [DataKiController::class, 'create'])
    ->name('data-ki.create');

Route::post('/input-ki', [DataKiController::class, 'store'])
    ->name('data-ki.store');

Route::get('/data-ki', [DataKiController::class, 'index'])
    ->name('data-ki.index');

Route::get('/data-ki/{id}/edit', [DataKiController::class, 'edit'])
    ->name('data-ki.edit');

Route::put('/data-ki/{id}', [DataKiController::class, 'update'])
    ->name('data-ki.update');

Route::delete('/data-ki/{id}', [DataKiController::class, 'destroy'])
    ->name('data-ki.destroy');

    Route::get('/perpustakaan-ki', [PerpustakaanKiController::class, 'index'])
    ->name('perpustakaan-ki.index');

Route::get('/input-perpustakaan-ki', [PerpustakaanKiController::class, 'create'])
    ->name('perpustakaan-ki.create');

Route::post('/input-perpustakaan-ki', [PerpustakaanKiController::class, 'store'])
    ->name('perpustakaan-ki.store');

