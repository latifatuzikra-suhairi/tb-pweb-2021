<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Pertemuan;
use App\Models\Kelas;
use App\Models\Krs;
use App\Models\Absensi;
use App\Models\Mahasiswa;
use Carbon\Carbon;

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

        $data_mhs = Mahasiswa::join('krs', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                                ->leftjoin('absensi', 'krs.krs_id', '=', 'absensi.krs_id')
                                ->where('krs.kelas_id', $kelas_id)
                                ->where(function($query) use ($pertemuan_id){
                                    $query->where('absensi.pertemuan_id', $pertemuan_id)
                                    ->orWhereNull('absensi.pertemuan_id');
                                })->get();    

        return view('admin.pertemuan.detail', compact('data_mhs', 'kelas', 'pertemuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kelas_id)
    {   
        $kelas = Kelas::findOrFail($kelas_id);
        return view('admin.pertemuan.tambah', compact('kelas'));
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
            'materi' => 'required|max:50'
        ], [
            'pertemuan_ke.required' => 'Pertemuan tidak boleh kosong',
            'tanggal.required' => 'Tanggal Pertemuan tidak boleh kosong',
            'materi.required' => 'Materi Pertemuan tidak boleh kosong',
            'materi.max' => 'Maksimal penjabaran materi hanya 50 Karakter'
        ]);

        //cek tahun sama dengan tahun sekarang atau tidak
        $thn_skrg = date('Y');
        $input_tahun = $request->tanggal;
        $cek_tahun = substr($input_tahun, 0, 4);

        //cek udah ada pertemuan yang dimaksud atau belum
        $cek_pert = Pertemuan::where('kelas_id', $request->kelas_id)
                            ->where('pertemuan_ke', $request->pertemuan_ke)
                            ->doesntExist();
        if($thn_skrg == $cek_tahun)
        {
            if($cek_pert == true)
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
        else
        {
            return redirect()->route('detail.kelas', [$request->kelas_id])->with('psn_gagal', 'Tanggal Pertemuan Tidak Valid');
        }
    }


    public function upload(Request $request, $kelas_id, $pertemuan_id)
    {
        // $request->validate([
        //     'file' => 'required|file'
        // ],
        // [  
        //     'file.required' => 'Anda belum mengunggah file'
        // ]);
        
        $getFile = $request->file('file');

        if (($file = fopen($getFile, "r")) !== FALSE) {
            $skipLines = 6;
            $lineStart = 1;
            while(fgetcsv($file)){
                if($lineStart > $skipLines){
                    break;
                }
                $lineStart++;
            }

            while (($col = fgetcsv($file, 1000, "\t")) !== FALSE) {
                {
                    if (isset($col[1])) {
                        $coljointime = $col[1];
                        $pcsjointime = preg_split('/[, ]/', $coljointime);
                        $jam_masuk = $pcsjointime[2];
                    }
    
                    if (isset($col[2])) {
                        $colleavetime = $col[2];
                        $pcsleavetime = preg_split('/[, ]/', $colleavetime);
                        $jam_keluar = $pcsleavetime[2];
                        // $leave= strtotime($jam_keluar);
                    }

                    if (isset($col[3])) {
                        $duration = $col[3];
                    }

                    if (isset($column[4])) {
                        $colemail = $column[4];
                    }
    
                    
                    // ($jam_masuk); 
                    var_dump($jam_keluar);
                    var_dump($duration);       
                    
            }
                
            }
            
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
