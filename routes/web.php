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
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create']); //tambah mahasiswa
//Route::get('/mahasiswa/{kelas_id}/detail/pertemuan/{mahasiswa_id}', [Mahasiswa::class, 'push'])->name('detail.pertemuan'); //info pertemuan
Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']); //tambah mahasiswa

Route::delete('/mahasiswa/{mahasiswa_id}/destroy', [MahasiswaController::class, 'destroy']); //hapus mahasiswa
//Route::post('/mahasiswa/{mahasiswa_id}/update', [MahasiswaController::class, 'update']); //hapus mahasiswa
Route::get('/mahasiswa/{mahasiswa_id}/edit', [MahasiswaController::class, 'edit']); //info detail kelas
Route::match(['get', 'post'], '/mahasiswa/{mahasiswa_id}/update', [MahasiswaController::class, 'update']);
