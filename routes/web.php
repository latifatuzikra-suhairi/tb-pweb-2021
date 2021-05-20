<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('/kelas',[KelasController::class, 'index']); //daftar kelas
Route::get('/kelas/detail',[KelasController::class, 'show']); //detail kelas

Route::get('/mahasiswa', [MahasiswaController::class, 'index']); //mahasiswa
