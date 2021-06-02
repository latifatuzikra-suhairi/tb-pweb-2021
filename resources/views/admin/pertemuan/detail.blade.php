@extends('layout/admin')
<style>
    @media (min-width: 992px) { 
        .navbar{
            background-color: #001543;
        }
    }
</style>

@section('title')
    SIRAH | Detail Pertemuan
@endsection

@section('breadcrumbs')
<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/kelas">Kelas</a></li>
            <li class="breadcrumb-item"><a href="{{ route('detail.kelas', [$kelas->kelas_id]) }}">Detail Kelas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pertemuan</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container mt-5">
    <div class="wrap container shadow-lg p-5" style="background-color:white; border-radius:10px">
        <h3><b>{{ $kelas->nama_makul }}</b></h3>

    <div>
        <table class="table table-borderless border-bottom">
            <tr>
                <td style="width: 200px">Pertemuan ke-</td>
                <td style="width:2px">:</td>
                <td>{{ $pertemuan->pertemuan_ke }}</td>
            </tr>
            <tr>
                <td style="width: 200px">Tanggal Pertemuan</td>
                <td style="width: 2px">:</td>
                <td>{{ date('d M Y', strtotime($pertemuan['tanggal'])) }}</td>
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

          <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Status Kehadiran</th>
                  <th scope="col">Jam Masuk</th>
                  <th scope="col">Jam Keluar</th>
                  <th scope="col">Durasi (menit)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $data->nama }}</td>
                    @if ($data->absensi_id == null)
                        <td>{{ "Tidak Hadir" }}</td>
                    @else
                        <td>{{ "Hadir" }}</td> 
                    @endif
                    <td>{{ $data->jam_masuk }}</td>
                    <td>{{ $data->jam_keluar }}</td>
                    <td>
                        {{ $jam=floor($data->durasi /(60*60)) }} jam 
                        {{ floor((($data->durasi) - ($jam*3600))/60) }} menit
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
    </div>

    </div>
</div>
@endsection