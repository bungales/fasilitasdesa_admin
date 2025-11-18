<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\FasilitasumumController;



Route::get('/', function () {
    return view('pages.login');
});

Route::get('/fasilitas', [FasilitasController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/logout', [AuthController::class, 'logout']);


// Route::resource('login', LoginController::class)->only(['index','store','destroy']);
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


Route::resource('warga', WargaController::class);
Route::resource('fasilitasumum', FasilitasUmumController::class);

Route::resource('user', UserController::class);





