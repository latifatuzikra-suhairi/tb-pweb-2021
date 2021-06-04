<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Pertemuan;
use App\Models\Kelas;
use App\Models\Krs;
use App\Models\Absensi;
use App\Models\Mahasiswa;


class PertemuanController extends Controller
{

    public function index($kelas_id, $pertemuan_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);

        $absensi = Mahasiswa::select('mahasiswa.nama', 'absensi.*')
                            ->join('krs', 'krs.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                            ->join('kelas', 'kelas.kelas_id', '=', 'krs.kelas_id')
                            ->join('pertemuan', 'pertemuan.kelas_id', '=', 'kelas.kelas_id')
                            ->leftjoin('absensi', function ($query){
                                $query->on('absensi.pertemuan_id', '=', 'pertemuan.pertemuan_id');
                                $query->on('absensi.krs_id', '=', 'krs.krs_id');
                            })
                            ->where('krs.kelas_id', $kelas_id)
                            ->where('pertemuan.pertemuan_id', $pertemuan_id)
                            ->paginate(10);

        return view('admin.pertemuan.detail', compact('absensi', 'kelas', 'pertemuan'));
    }


    public function create($kelas_id)
    {   
        $kelas = Kelas::findOrFail($kelas_id);
        return view('admin.pertemuan.tambah', compact('kelas'));
    }


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
        $request->validate([
            'file' => 'required|file'
        ],
        [  
            'file.required' => 'Anda belum mengunggah file'
        ]);

        $getFile = $request->file('file');
        $fileName = $getFile->getClientOriginalName();
        $ekstensiFile = explode('.', $fileName);
        $ekstensiFile = strtolower(end($ekstensiFile));

        $filePath = $getFile->getRealPath();
        $fileSize = $getFile->getSize();

        if($ekstensiFile == "csv"){
            if($fileSize > 0){
                $file = fopen($filePath, 'r');
                    $lineStart = 1;
                    $skipLines = 7;
                    while(fgetcsv($file)){
                        if($lineStart > $skipLines){
                            break;
                        }
                        $lineStart++;
                    }

                    $data = array();
                    $row = 0;
                    while(($cols = fgetcsv($file, 1000, ";"))!== FALSE){
                        $num = count($cols);
                        $num--;
                        for ($c = 0 ; $c < $num ; $c++){
                            if ($c == 1) {
                                $data[$row][$c] = explode(",", $cols[$c]);
                                    if ($c == 1) {
                                        $data[$row][$c] = explode(" ", $cols[$c]);
                                    }
                            }
                            if ($c == 2) {
                                $data[$row][$c] = explode(",",$cols[$c]);
                                if ($c == 2) {
                                    $data[$row][$c] = explode(" ", $cols[$c]);
                                }
                            }

                            $data[$row][] = $cols[$c];
                        }
                        $row++;
                    }
                    $check = count ($data);
                    
                    foreach ($data as $dt) {

                        $cek = DB::table('krs')
                                ->join('mahasiswa', 'mahasiswa.mahasiswa_id', '=', 'krs.mahasiswa_id')
                                ->join('kelas', 'kelas.kelas_id', '=', 'krs.kelas_id')
                                ->where('kelas.kelas_id', $kelas_id)
                                ->where('mahasiswa.email', $dt[5])
                                ->get('krs.krs_id');

                        $jml = count($cek);

                        $durasi=(strtotime($dt[2][1])-strtotime($dt[1][1]));

                        if($jml > 0){

                            foreach ($cek as $c) {

                                Absensi::firstOrCreate([
                                    'krs_id' => $c->krs_id,
                                    'pertemuan_id' => $pertemuan_id,
                                    'jam_masuk' => $dt[1][1],
                                    'jam_keluar' =>$dt[2][1],
                                    'durasi' => (int)$durasi
                                ]);

                            }

                        }
                    }
                    return redirect()->back()->with('psn_sukses', 'File pertemuan berhasil diimport!');
            }
            else{
                return redirect()->back()->with('psn_gagal', 'File Kosong!');
            }
        } 
        else {
            return redirect()->back()->with('psn_gagal', 'Upload File dengan Ekstensi .csv');
        }    
    }

}
