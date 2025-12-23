<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\FasilitasUmumController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembayaranFasilitasController;
use App\Http\Controllers\PeminjamanFasilitasController;
use App\Http\Controllers\PetugasFasilitasController;
use App\Http\Controllers\SyaratFasilitasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.login');
});

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/logout', [AuthController::class, 'logout']);

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

// Route yang TIDAK memerlukan login (akses publik)
Route::get('/fasilitas', [FasilitasController::class, 'index']);

// ============== TAMBAHAN ROUTE UNTUK CREATE USER ==============
Route::get('/register', function () {
    return view('pages.register');
})->name('register.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
// ==============================================================

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Resource routes
Route::resource('warga', WargaController::class);
Route::resource('fasilitasumum', FasilitasUmumController::class);
Route::resource('user', UserController::class);
Route::resource('petugas-fasilitas', PetugasFasilitasController::class);
Route::resource('syarat-fasilitas', SyaratFasilitasController::class);

// Route khusus untuk Syarat Fasilitas
Route::get(
    '/syarat-fasilitas/{id}/download',
    [SyaratFasilitasController::class, 'downloadDokumen']
)->name('syarat-fasilitas.download');

// Route khusus untuk Petugas Fasilitas
Route::get('/petugas-fasilitas/fasilitas/{fasilitas_id}', [PetugasFasilitasController::class, 'byFasilitas'])
    ->name('petugas-fasilitas.byFasilitas');
Route::get('/petugas-fasilitas/warga/{warga_id}', [PetugasFasilitasController::class, 'byWarga'])
    ->name('petugas-fasilitas.byWarga');


// Resource untuk Peminjaman Fasilitas
Route::resource('peminjaman', PeminjamanFasilitasController::class);

// Route khusus untuk Media pada Peminjaman Fasilitas
Route::post('/peminjaman/{id}/upload-media', [PeminjamanFasilitasController::class, 'uploadMedia'])
    ->name('peminjaman.upload-media');

Route::delete('/peminjaman/{id}/delete-media/{mediaId}', [PeminjamanFasilitasController::class, 'deleteMedia'])
    ->name('peminjaman.delete-media');


// Route untuk Pembayaran Fasilitas
Route::resource('pembayaran', PembayaranFasilitasController::class);

// Route untuk menghapus file media pada Fasilitas Umum
Route::delete('/fasilitasumum/{fasilitasId}/media/{mediaId}', [FasilitasUmumController::class, 'deleteMedia'])
    ->name('fasilitasumum.deleteMedia');

// Route untuk Media pada Pembayaran Fasilitas
Route::delete('/pembayaran/{bayarId}/media/{mediaId}', [PembayaranFasilitasController::class, 'deleteMedia'])
    ->name('pembayaran.deleteMedia');

Route::post('/pembayaran/{id}/upload-media', [PembayaranFasilitasController::class, 'uploadMedia'])
    ->name('pembayaran.uploadMedia');

// Route untuk Media Controller (untuk upload umum)
Route::resource('media', MediaController::class);
Route::post('/media/upload-ajax', [MediaController::class, 'uploadAjax'])->name('media.uploadAjax');
Route::post('/media/reorder', [MediaController::class, 'reorder'])->name('media.reorder');
Route::get('/media/by-reference/{refTable}/{refId}', [MediaController::class, 'getByReference'])->name('media.byReference');

// ==============================================================
