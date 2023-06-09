<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KerusakanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['guest']], function () {
    // Login
    Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'authLogin'])->middleware('guest');
    // Register
    Route::get('/register', [AuthController::class, 'regis'])->middleware('guest');
    Route::post('/register', [AuthController::class, 'authregister'])->middleware('guest');
    // Logout
});
Route::post('/logout', [AuthController::class, 'logout']);
Route::group(['middleware' => ['auth', 'ceklevel:1']], function () {
    // Kerusakan
    Route::get('/data-kerusakan', [KerusakanController::class, 'index'])->middleware('auth');
    Route::get('/data-kerusakan/{id}/hapus', [KerusakanController::class, 'hapus']);
    Route::get('/data-kerusakan/{id}/edit', [KerusakanController::class, 'edit']);
    Route::put('/data-kerusakan/update', [KerusakanController::class, 'update']);
    Route::post('/data-kerusakan', [KerusakanController::class, 'tambah']);

    // Gejala
    Route::get('/data-gejala', [GejalaController::class, 'index'])->middleware('auth');
    Route::get('/data-gejala/{id}/hapus', [GejalaController::class, 'hapus']);
    Route::get('/data-gejala/{id}/edit', [GejalaController::class, 'edit']);
    Route::put('/data-gejala/update', [GejalaController::class, 'update']);
    Route::post('/data-gejala', [GejalaController::class, 'tambah']);

    // Rule
    Route::get('/rule', [RuleController::class, 'index'])->middleware('auth');
    Route::get('/rule/{id}/hapus', [RuleController::class, 'hapus']);
    Route::get('/rule/{id}/edit', [RuleController::class, 'edit']);
    Route::put('/rule/update', [RuleController::class, 'update']);
    Route::post('/rule', [RuleController::class, 'tambah']);
});
Route::group(['middleware' => ['auth', 'ceklevel:2']], function () {

    // Diagnosa
    Route::get('/diagnosa', [DiagnosaController::class, 'index'])->middleware('auth');
    Route::post('/diagnosa', [DiagnosaController::class, 'perhitungan'])->middleware('auth');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
