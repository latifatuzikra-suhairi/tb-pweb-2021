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
                    -> join ('kelas', 'kelas.kelas_id', '=', 'krs.kelas_id')
                    -> join ('mahasiswa', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                    -> where ('mahasiswa.id','=','user.id')
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
    public function show($kelas_id)
    {
        $data_kelas = Kelas::find($kelas_id);
        $list_hadir=DB::table('absensi')
                        ->join('pertemuan', 'pertemuan.pertemuan_id', '=', 'absensi.pertemuan_id')
                        ->join('krs', 'krs.krs_id', '=', 'absensi.krs_id')
                        ->join('kelas', 'kelas.kelas_id', '=', 'pertemuan.kelas_id')
                        ->join('mahasiswa', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                        ->where ('id','=','2')
                        ->orderBy ('tanggal', 'asc')
                        ->get();
                                                
        return view('user.krs.detail', compact('data_kelas', 'list_hadir'));
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
