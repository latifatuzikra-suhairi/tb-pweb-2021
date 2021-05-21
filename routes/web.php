<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PertemuanController;
use App\Models\Pertemuan;
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
Route::get('/kelas/{kelas_id}/detail', [KelasController::class, 'show_detail_kelas']); //info detail kelas
Route::get('/kelas/{kelas_id}/detail/pertemuan/{pertemuan_id}', [Pertemuan::class, 'push'])->name('detail.pertemuan'); //info pertemuan

Route::post('/pertemuan/store', [PertemuanController::class, 'store']); //tambah pertemuan

Route::get('/mahasiswa',[MahasiswaController::class, 'index']); //mahasiswa
