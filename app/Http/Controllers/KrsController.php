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
    public function info_krs (){
        $userlog=auth()->user()->id;
        $max_semester = DB::table('krs')
                    -> join ('kelas', 'kelas.kelas_id', '=', 'krs.kelas_id')
                    -> join ('mahasiswa', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                    -> where ('mahasiswa.id', $userlog)
                    -> max ('semester');

        $info_kelas = DB::table('krs')
                    -> join ('kelas', 'kelas.kelas_id', '=', 'krs.kelas_id')
                    -> join ('mahasiswa', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                    -> where ('semester', $max_semester)
                    -> count();

        $info_sks = DB::table('krs')
                    -> join ('kelas', 'kelas.kelas_id', '=', 'krs.kelas_id')
                    -> join ('mahasiswa', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                    -> where ('mahasiswa.id', $userlog)
                    -> sum('sks');
        
        $info_makul = DB::table('krs')
                    -> join ('kelas', 'kelas.kelas_id', '=', 'krs.kelas_id')
                    -> join ('mahasiswa', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                    -> where ('mahasiswa.id', $userlog)
                    -> count('kode_makul');

        return view('user.dashboard', compact('info_kelas', 'info_sks', 'info_makul', 'userlog'));
    }

    public function index()
    {
        $userlog=auth()->user()->id;
        $data_krs = DB::table('krs')
                    -> join ('kelas', 'kelas.kelas_id', '=', 'krs.kelas_id')
                    -> join ('mahasiswa', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                    -> where ('mahasiswa.id', $userlog)
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

    public function show($kelas_id)
    {
        $userlog=auth()->user()->id;
        $data_kelas = Kelas::find($kelas_id);
        $list_hadir=DB::table('kelas')
                        -> join('krs', 'kelas.kelas_id', '=', 'krs.kelas_id')
                        -> join('mahasiswa', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                        -> join('pertemuan', 'kelas.kelas_id', '=', 'pertemuan.kelas_id')
                        -> leftjoin('absensi', function($query){
                            $query->on('pertemuan.pertemuan_id', '=', 'absensi.pertemuan_id');
                            $query->on('krs.krs_id', '=', 'absensi.krs_id');
                            })
                        -> where('kelas.kelas_id', $kelas_id)
                        -> where('mahasiswa.id', auth()->user()->id)
                        -> get();
                                                
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
