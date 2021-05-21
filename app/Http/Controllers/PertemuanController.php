<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertemuan;
use Illuminate\Support\Facades\DB;


class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        Pertemuan::create($request->all());
        // $data = $request->input();
        // $pertemuan = new Pertemuan;
        // $pertemuan->kelas_id = $data['kelas_id'];
        // $pertemuan->pertemuan_ke = $data['pertemuan_ke'];
        // $pertemuan->tanggal= $data['tanggal'];
        // $pertemuan->materi = $data['materi'];

        // if($pertemuan->save()){
        //     return redirect('/kelas/{$pertemuan->kelas_id}/detail')->with(['psn_sukses' => 'Data Pertemuan Berhasil Ditambahkan!']);
        // }
        // else{
        //     return redirect('/kelas/{$pertemuan->kelas_id}/detail')->with(['psn_gagal' => 'Data Pertemuan Gagal Ditambahkan!']);
        // }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function push($kelas_id, $pertemuan_id)
    {
        dd($kelas_id);
        $detail_pertemuan = DB::table('pertemuan')
                                ->where('pertemuan_id', $pertemuan_id)
                                ->where('kelas_id', $kelas_id)
                                ->get();

        return view('admin.pertemuan.detail', compact($detail_pertemuan));
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
