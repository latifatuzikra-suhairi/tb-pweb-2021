<?php

namespace App\Http\Controllers;

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

        // $datas = Mahasiswa::join('krs', 'mahasiswa.mahasiswa_id', '=', 'krs.mahasiswa_id')
        //                     ->join('kelas', 'krs.kelas_id', '=', 'kelas.kelas_id')
        //                     ->leftjoin('absensi', 'krs.krs_id', '=', 'absensi.krs_id')
        //                     ->leftjoin('pertemuan', 'absensi.pertemuan_id', '=', 'pertemuan.pertemuan_id')
        //                     ->where('absensi.kelas_id', $kelas_id)
        //                     ->get();

        $datas = Mahasiswa::join('krs', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                            ->leftjoin('absensi', 'krs.krs_id', '=', 'absensi.krs_id')
                            ->where ('absensi.pertemuan_id','=', '1')
                            ->get();

        return view('admin.pertemuan.detail', compact('datas', 'kelas', 'pertemuan'));                          
        // return dd($datas);
    }


    public function upload(Request $request, $kelas_id, $pertemuan_id)
    {
        $request->validate([
            'file' => 'required|file'
        ],
        [  
            'file.required' => 'Anda belum mengunggah file'
        ]);

        $fileName = $_FILES["file"]["tmp_name"];
        $nameFile = $_FILES["file"]["name"];
        $ekstensiValid = 'csv';
        $ekstensiFile = explode('.', $nameFile);
        $ekstensiFile = strtolower(end($ekstensiFile));

        if($ekstensiFile != $ekstensiValid)
        {
            $type="error";
            $message="File tidak valid. Upload file .csv";
        }else
        {
            if($_FILES["file"]["size"]>0)
            {
                $file = fopen($fileName,"r");
                $skipLines = 7;
                $lineStart = 1;
                while(fgetcsv($file)){
                    if($lineStart > $skipLines)
                    {
                        break;
                    }
                    $lineStart++;
                }

                while (($col = fgetcsv($file, 1000, "\t")) !== FALSE) 
                {

                    if (isset($col[4])) {
                        $col_email = $col[4];
                        
                        $data = Mahasiswa::join('krs', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                                ->join('kelas', 'kelas.kelas_id', '=', 'krs.kelas_id')
                                ->where('krs.kelas_id', $kelas_id)
                                ->where('mahasiswa.email', $col_email)
                                ->get();
                                echo $col_email;
                        dd($data);

                    }

                    
                    if (isset($col[1])) {
                        $coljointime = $col[1];
                        $jam_masuk= substr($col[1], -11, -3);
                        $pcsjointime = preg_split('/[, ]/', $coljointime);
                        $jam_masuk1 = $pcsjointime[2];


                        // $date = Carbon::parse('h:mm:ss a', $pcsjointime);
                        // $datef = $date->isoFormat('YYYY-MM-DD, h:mm:ss a');
                        
                        // $join= $date->isoFormat('hh:mm:ss a');

                        // $join= $jam_masuk->isoFormat('h:mm:ss a');
                    }
    
                    if (isset($col[2])) {
                        $colleavetime = $col[2];
                        $jam_keluar= substr('3/25/2021, 3:37:34 PM', -11, -3);

                        $pcsleavetime = preg_split('/[, ]/', $colleavetime);
                        // $jam_keluar = $pcsleavetime[2];
                        // $leave= strtotime($jam_keluar);
                    }

                    // if (isset($col[3])) {
                    //     $duration = $col[3];
                    //     $jam= substr('3/25/2021, 2:58:34 PM', 0, 1);
                    //     $menit= substr('3/25/2021, 2:58:34 PM', 0, 1);


                    // }

                    // $join = Carbon::parse($jam_masuk)->format('h:m:s');
                    // $leave = Carbon::parse($jam_keluar)->format('h:m:s');

                    // $joinn = strtotime($join);
                    // $leavee = strtotime($leave);
                    // $durasi = $leavee - $joinn;
                    // $join= strtotime($jam_masuk);
                    
                    echo $col[1]."\n";
                    // echo $pcsjointime."\n";
                    echo $jam_masuk1."\n";
                    echo $jam_masuk."--\n";

                    // var_dump(col[1]);
                    // var_dump($date); 
                    // var_dump($jam_keluar);
                    // var_dump($duration);
                
                    $import = Absensi::create([
                        'krs_id'=> '1',
                        'pertemuan_id'=> $pertemuan_id,
                        'jam_masuk' => $jam_masuk1,
                        // 'jam_keluar' =>$leave,
                        // 'durasi' => $durasi
                    ]);

                    if($import ->affected_rows > 0){
                        return redirect('detail.pertemuan')->with('psn_sukses', 'Data Berhasil Diimport');
                    } else
                        return redirect('detail.pertemuan')->with('psn_gagal', 'Data Gagal Diimport');
                    
                }
                
                    
            }
        }
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
