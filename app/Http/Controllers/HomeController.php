<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Users;
use App\Models\Kelas;
use App\Models\Pertemuan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function jumlah()
    {
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahKelas = Kelas::count();
        $jumlahPertemuan = Pertemuan::count();
        
        return view('admin.dashboard', compact('jumlahMahasiswa', 'jumlahKelas', 'jumlahPertemuan'));
    
    }
    
}
