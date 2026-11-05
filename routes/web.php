<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MutasiController;

Route::redirect('/', '/admin/dashboard');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::middleware(['role:manager,staff'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/mutasi', [MutasiController::class, 'index'])->name('mutasi.index');
        Route::post('/mutasi', [MutasiController::class, 'store'])->name('mutasi.store');
    });
    Route::middleware(['role:manager'])->group(function () {
        Route::get('/barang-trash', [BarangController::class, 'trash'])->name('barang.trash');
        Route::put('/barang/{id}/restore', [BarangController::class, 'restore'])->name('barang.restore');
        Route::delete('/barang/{id}/force-delete', [BarangController::class, 'forceDelete'])->name('barang.forceDelete');

        Route::resource('barang', BarangController::class)->except(['index', 'show']);
        Route::resource('suppliers', SupplierController::class)->except(['show']);

        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });
    Route::middleware(['role:manager,staff'])->group(function () {
        Route::resource('barang', BarangController::class)
            ->only(['index', 'show'])
            ->whereNumber('barang');
    });
});