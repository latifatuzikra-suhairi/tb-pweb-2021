<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pertemuan;
<<<<<<< HEAD
use App\Models\Krs;
=======
use App\Models\Mahasiswa;
>>>>>>> 46ac3e647d46bc5bab6a16fba147962b3437f282

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kelas = Kelas::orderby('tahun','desc')->orderby('semester','desc')->paginate(5);
        return view('admin.kelas.index', ['data_kelas' => $data_kelas]);
    }


    public function store_peserta(Request $request, $id){
        $request->request->add(['kelas_id' => $id]);
        Krs::create([
            'kelas_id' => $request->kelas_id,
            'mahasiswa_id' => $request->mahasiswa_id,
        ]);
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kelas.create');
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
            'kode_kelas' => 'required',
            'kode_makul' => 'required',
            'nama_makul' => 'required',
            'tahun' => 'required',
            'semester' => 'required',
            'sks' => 'required',
        ], [
            'kode_kelas.required' => 'Kode Kelas tidak boleh kosong',
            'kode_makul.required' => 'Kode Makul tidak boleh kosong',
            'nama_makul.required' => 'Nama Makul tidak boleh kosong',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'semester.required' => 'Semester tidak boleh kosong',
            'sks.required' => 'Sks tidak boleh kosong',
        ]);

        Kelas::create($request->all());
        return redirect('/kelas')->with('status', 'Data Kelas Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




     

    public function show($kelas_id)
    {
        $data_mahasiswa = \App\models\mahasiswa::all();
        $data_kelas = Kelas::findOrFail($kelas_id);
<<<<<<< HEAD
        $data_pert = Pertemuan::where('kelas_id', $kelas_id)->get();
        return view('admin.kelas.detail', compact('data_kelas', 'data_pert','data_mahasiswa')); 
=======
        $data_pert = Pertemuan::where('kelas_id', $kelas_id)
                                ->orderBy('pertemuan_ke', 'asc')
                                ->get();

        $data_mhs = Mahasiswa::join('krs', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                                    ->join('kelas', 'krs.kelas_id', '=', 'kelas.kelas_id')
                                    ->where('krs.kelas_id', $kelas_id)
                                    ->select('mahasiswa.mahasiswa_id','mahasiswa.nama', 'mahasiswa.nim')
                                    ->get();
        return view('admin.kelas.detail', compact('data_kelas', 'data_pert', 'data_mhs'));
>>>>>>> 46ac3e647d46bc5bab6a16fba147962b3437f282
    }








    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kelas_id)
    {
        $data_kelas = Kelas::find($kelas_id);
        return view('admin.kelas.edit', compact('data_kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kelas_id)
    {
        $request->validate([
            'kode_kelas' => 'required',
            'kode_makul' => 'required',
            'nama_makul' => 'required',
            'tahun' => 'required',
            'semester' => 'required',
            'sks' => 'required',
        ], [
            'kode_kelas.required' => 'Kode Kelas tidak boleh kosong',
            'kode_makul.required' => 'Kode Makul tidak boleh kosong',
            'nama_makul.required' => 'Nama Makul tidak boleh kosong',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'semester.required' => 'Semester tidak boleh kosong',
            'sks.required' => 'Sks tidak boleh kosong',
        ]);

        if($request->isMethod('post')){
            $data_kelas = $request->all();  

            Kelas::where(['kelas_id'=> $kelas_id])->update(['kode_kelas'=>$data_kelas['kode_kelas'], 'kode_makul'=>$data_kelas['kode_makul'], 'nama_makul'=>$data_kelas['nama_makul'], 'tahun'=>$data_kelas['tahun'], 'semester'=>$data_kelas['semester'], 'sks'=>$data_kelas['sks']]);
            return redirect('/kelas')->with('status', 'Data Kelas Berhasil Diubah');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kelas_id)
    {
        $data_kelas = Kelas::find($kelas_id);
        $data_kelas->delete();
        return redirect('/kelas')->with('status', 'Data Kelas Berhasil Dihapus');
    }
}
