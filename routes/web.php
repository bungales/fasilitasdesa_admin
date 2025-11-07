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
    return view('welcome');
});
Route::get('/fasilitas', [FasilitasController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/logout', [AuthController::class, 'logout']);


Route::resource('login', LoginController::class)->only(['index','store','destroy']);


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('warga', WargaController::class);
Route::resource('fasilitasumum', FasilitasUmumController::class);

Route::resource('user', UserController::class);





