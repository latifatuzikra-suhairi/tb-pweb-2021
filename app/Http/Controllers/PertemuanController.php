<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertemuan;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\Mahasiswa;

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kelas_id, $pertemuan_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);

        // $datas = Mahasiswa::join('krs', 'mahasiswa.mahasiswa_id', '=', 'krs.mahasiswa_id')
        //                     ->join('kelas', 'krs.kelas_id', '=', 'kelas.kelas_id')
        //                     ->leftjoin('absensi', 'krs.krs_id', '=', 'absensi.krs_id')
        //                     ->leftjoin('pertemuan', 'absensi.pertemuan_id', '=', 'pertemuan.pertemuan_id')
        //                     ->where('absensi.kelas_id', $kelas_id)
        //                     ->get();

        $datas = Mahasiswa::join('krs', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                            ->leftjoin('absensi', 'krs.krs_id', '=', 'absensi.krs_id')
                            ->get();
        //view('admin.pertemuan.detail', compact('datas', 'kelas', 'pertemuan'));                          
        return dd($datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kelas_id)
    {   
        return view('admin.pertemuan.tambah', compact('kelas_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'pertemuan_ke' => 'required',
            'tanggal' => 'required',
            'materi' => 'max:70'
        ], [
            'pertemuan_ke.required' => 'Pertemuan tidak boleh kosong',
            'tanggal.required' => 'Tanggal Pertemuan tidak boleh kosong',
            'materi.max' => 'Maksimal penjabaran materi hanya 70 Karakter'
        ]);

        //cek udah ada pertemuan yang dimaksud atau belum
        $cek = Pertemuan::where('kelas_id', $request->kelas_id)
                            ->where('pertemuan_ke', $request->pertemuan_ke)
                            ->doesntExist();
        if($cek == true)
        {
             if(Pertemuan::create($request->all()))
             {
                 return redirect()->route('detail.kelas', [$request->kelas_id])->with('psn_sukses', 'Pertemuan Berhasil Ditambahkan!');
             }
             else
             {
                 return redirect()->route('detail.kelas', [$request->kelas_id])->with('psn_gagal', 'Pertemuan Gagal Ditambahkan!');
             }
        }
        else{
            return redirect()->route('detail.kelas', [$request->kelas_id])->with('psn_gagal', 'Pertemuan ke-'.$request->pertemuan_ke.' telah diadakan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
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

}
