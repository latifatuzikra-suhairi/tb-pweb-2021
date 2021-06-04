@extends('layout/admin')
<style>
    @media (min-width: 992px) { 
        .navbar{
            background-color: #001136;
        }
    }
</style>

@section('title')
    SIRAH | Detail Pertemuan
@endsection

@section('breadcrumbs')
<div style="background-color: white; margin-top:-5px"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb container" style="background-color: white">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/kelas">Kelas</a></li>
            <li class="breadcrumb-item"><a href="{{ route('detail.kelas', [$kelas->kelas_id]) }}">{{ $kelas->kode_kelas }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ 'Pertemuan-'.$pertemuan->pertemuan_ke }}</li>
        </ol>
    </nav>
    <div style="border: 2px solid #001136; margin-top:-20px"></div>
</div>
@endsection

@section('content')
<div class="container mt-4">
    <div class="wrap container shadow p-5" style="background-color:white; border-radius:10px">
        <div class="color: #001136">
            <h3 class="mb-3"><b>{{ $kelas->nama_makul }}</b></h3>
             <div class="batas"></div>
        </div>
        
    <div class="mt-3">
        <table class="table table-borderless border-bottom">
            <tr>
                <td style="width: 200px">Pertemuan ke-</td>
                <td style="width: 2px">:</td>
                <td>{{ $pertemuan->pertemuan_ke }}</td>
            </tr>
            <tr>
                <td style="width: 200px">Tanggal Pertemuan</td>
                <td style="width: 2px">:</td>
                <td>{{ date('d M Y', strtotime($pertemuan->tanggal)) }}</td>
            </tr>
            <tr>
                <td style="width: 200px">Materi</td>
                <td style="width: 2px">:</td>
                <td>{{ $pertemuan->materi }}</td>
            </tr>
        </table>
    </div>

    {{-- Table Daftar Hadir Mahasiswa --}}
    <div class="card">
        <div class="card-header" style="background-color: rgb(204, 207, 215, 0.3); font-size: 17px; font-weight:600; color:#112c66;">
            Daftar Hadir Mahasiswa
        </div>
        <div class="card-body">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Terdapat Masalah Pada File Anda!
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            @if ($message = Session::get('psn_gagal'))
                <div class="alert alert-danger mt-3 alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif 

            @if($message = Session::get('psn_sukses'))
            <div class="alert alert-success mt-3 alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
                
            <form method="POST" enctype="multipart/form-data" action="{{ route('upload.pertemuan', [$kelas->kelas_id, $pertemuan->pertemuan_id]) }}">
                @csrf
                <div class="form-group table-responsive">
                    <table class="table border-bottom">
                        <tr>
                            <td width="40%" align="right"><label>Upload File Pertemuan .csv</label></td>
                            <td width="30"><input type="file" name="file"></td>
                            <td width="30%" align="left"><button type="submit" class="btn-sm btn-primary">Unggah</button>
                        </tr>
                    </table>
                </div>
            </form>
            <div> 

            <div class="table-responsive" style="margin-top: -10px">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr style="font-size: 16px">
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status Kehadiran</th>
                    <th scope="col">Jam Masuk</th>
                    <th scope="col">Jam Keluar</th>
                    <th scope="col">Durasi</th>
                    </tr>
                </thead>
            @foreach ($absensi as $index => $data)
                <tbody>
                    <?php
                        $jam = floor($data->durasi / 3600);
                        $menit = floor((($data->durasi)-($jam*3600))/60);
                        $detik = floor(($data->durasi)-($jam*3600)-($menit*60));
                    ?> 
                    <tr style="font-size: 16px">
                        <td scope="row" class="text-center">{{ $index + $absensi->firstItem() }}</td>
                        <td>{{ $data->nama }}</td>
                        @if ($data->durasi == null)
                            <td>Tidak Hadir</td>
                            <td>-</td>
                            <td>-</td>
                            <td>0h 0m 0s</td>
                        @else
                            <td>Hadir</td> 
                            <td>{{$data->jam_masuk}}</td>
                            <td>{{$data->jam_keluar}}</td>
                            <td>{{$jam}}h {{$menit}}m {{$detik}}s</td>
                        @endif
                    </tr>
                </tbody>
            @endforeach
            </table>

            <div class="row">
                <div class="col-6 mb-2">
                    Showing
                    {{$absensi->firstItem()}}
                    to
                    {{$absensi->lastItem()}}
                    of
                    {{$absensi->total()}}
                    entries
                </div>
                <div class="col-6">
                {{ $absensi->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
@endsection