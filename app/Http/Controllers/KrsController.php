<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Krs;
use App\Models\Pertemuan;
use App\Models\Absensi;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  
        $data_krs = DB::table('krs')
                    -> join ('kelas', 'krs.kelas_id', '=', 'kelas.kelas_id')
                    -> select ('kode_kelas', 'nama_makul', 'tahun', 'semester')
                    -> where ('mahasiswa_id','=','1')
                    -> orderBy ('tahun', 'desc')
                    -> orderBy ('semester', 'desc')
                    -> get();
        return view('user.krs.index', ['data_krs' => $data_krs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kelas.create_mahasiswa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_detail($kelas_id)
    {
        // $data_krs = Krs::find($kelas_id);
        $data_kelas = Kelas::find($kelas_id);
        $data_pert = Pertemuan::where('kelas_id', $kelas_id)->get();
        return view('user.krs.detail', compact('data_kelas', 'data_pert'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
