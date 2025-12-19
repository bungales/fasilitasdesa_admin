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



// Route yang memerlukan login (dilindungi dengan middleware)
// Route::group(['middleware' => ['checkislogin']], function () {
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Resource routes yang memerlukan login
Route::resource('warga', WargaController::class);
Route::resource('fasilitasumum', FasilitasUmumController::class);
Route::resource('user', UserController::class);
Route::resource('petugas-fasilitas', PetugasFasilitasController::class);

// Syarat Fasilitas Routes (jika ingin di dalam middleware)
Route::resource('syarat-fasilitas', SyaratFasilitasController::class);
Route::resource('syarat-fasilitas', SyaratFasilitasController::class);

Route::get(
    '/syarat-fasilitas/{id}/download',
    [SyaratFasilitasController::class, 'downloadDokumen']
)->name('syarat-fasilitas.download');

Route::get('/petugas-fasilitas/fasilitas/{fasilitas_id}', [PetugasFasilitasController::class, 'byFasilitas'])
    ->name('petugas-fasilitas.byFasilitas');
Route::get('/petugas-fasilitas/warga/{warga_id}', [PetugasFasilitasController::class, 'byWarga'])
    ->name('petugas-fasilitas.byWarga');

Route::resource('peminjaman', PeminjamanFasilitasController::class);
Route::resource('pembayaran', PembayaranFasilitasController::class);

// Route untuk menghapus file media
Route::delete('/fasilitasumum/{fasilitasId}/media/{mediaId}', [FasilitasUmumController::class, 'deleteMedia'])
    ->name('fasilitasumum.deleteMedia');

// KOMEN kalau mau bisa akses semua
// Route::group(['middleware' => ['checkrole:Super Admin']], function () {
//     Route::resource('user', UserController::class);
// });

// });
