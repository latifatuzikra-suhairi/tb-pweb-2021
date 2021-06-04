<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PertemuanController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\AbsensiController;
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

Auth::routes(['register' => true, 'reset' =>   false]);


Route::group(['middleware' => ['auth', 'checkRole:mahasiswa']], function(){
    
    // Route::get('/', function () {
    //     return view('user.dashboard');
    // });
    Route::get('/',[KrsController::class, 'info_krs']); //info krs mahasiswa

    Route::get('/krs',[KrsController::class, 'index']); //daftar kelas berdasarkan KRS
    Route::get('/krs/{kelas_id}/detail', [KrsController::class, 'show']); //info detail kelas

});

Route::group(['middleware' => ['auth', 'checkRole:admin']], function(){

    // Route::get('/home', function () {
    //     return view('admin.dashboard');
    // });

    Route::get('/home', [MahasiswaController::class, 'jumlah']);

    Route::get('/kelas/{kelas_id}/pertemuan/{pertemuan_id}', [PertemuanController::class, 'index'])->name('detail.pertemuan'); //info detail pertemuan
    Route::get('/pertemuan/{kelas_id}/create', [PertemuanController::class, 'create'])->name('tambah.pertemuan'); //tambah pertemuan
    Route::post('/pertemuan/{kelas_id}/store', [PertemuanController::class, 'store'])->name('simpan.pertemuan'); //tambah pertemuan
    Route::post('/kelas/{kelas_id}/pertemuan/{pertemuan_id}/upload', [PertemuanController::class, 'upload'])->name('upload.pertemuan'); //upload file pertemuan

    Route::get('/mahasiswa',[MahasiswaController::class, 'index']); //daftar mahasiswa
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create']); //tambah mahasiswa
    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']); //simpan mahasiswa
    Route::delete('/mahasiswa/{id}/destroy', [MahasiswaController::class, 'destroy']); //hapus mahasiswa
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit']); //info detail kelas
    Route::match(['get', 'post'], '/mahasiswa/{id}/update', [MahasiswaController::class, 'update']);

    Route::get('/kelas',[KelasController::class, 'index']); //daftar kelas
    
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('tambah.kelas'); //tambah kelas
    Route::get('/kelas/{kelas_id}', [KelasController::class, 'show'])->name('detail.kelas'); //info detail kelas
    Route::post('/kelas/store', [KelasController::class, 'store']); //simpan kelas
    Route::get('/kelas/{kelas_id}/edit', [KelasController::class, 'edit']); //info detail kelas
    Route::match(['get', 'post'], '/kelas/{kelas_id}/update', [KelasController::class, 'update']);//update kelas
    Route::get('/kelas/{kelas_id}/detail', [KelasController::class, 'show']);
    Route::post('/kelas/{id}/store', [KelasController::class, 'store_peserta']);

    Route::delete('/kelas/{kelas_id}/{mahasiswa_id}/hapus_peserta', [KelasController::class, 'hapus_peserta'])->name('detail.hapus');

    Route::get('/krs/{kelas_id}/create', [KrsController::class, 'create'])->name('tambah.peserta'); //form peserta kelas

});
