@extends('layout/admin')
<style>
@media (min-width: 992px) { 
    .navbar{
        background-color: #001543;
    }
}
</style>
@section('title', 'SIRAH | Detail Kelas')

@section('breadcrumbs')
<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/kelas">Kelas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Kelas</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="wrap container shadow-lg p-5" style="background-color:white; border-radius:10px">
        
        @if(session('psn_sukses'))
            <div class="alert alert-success" role="alert">
                {{ session('psn_sukses') }}
            </div>
        @elseif(session('psn_gagal'))
            <div class="alert alert-danger" role="alert">
                {{ session('psn_gagal') }}
            </div> 
        @endif

        <!---- Detail Daftar Kelas ---->
        <div class="border-bottom"><p>
            <h2><b>{{ $data_kelas->nama_makul }}</b></h2>
             - {{ $data_kelas->kode_makul }}</p>
        </div>
        
        <div>
            <table class="table table-borderless" style="width:70%">
                <tr>
                    <td>Kode Kelas</td>
                    <td>:</td>
                    <td>{{ $data_kelas->kode_kelas }}</td>
                    <td></td>
                    <td>Semester</td>
                    <td>:</td>
                    @if($data_kelas->semester == 1)
                        <td>{{ "Ganjil" }}</td>
                    @else
                        <td>{{ "Genap" }}</td>
                    @endif 
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td>:</td>
                    <td>{{ $data_kelas->tahun }}</td>
                    <td></td>
                    <td>SKS</td>
                    <td>:</td>
                    <td>{{ $data_kelas->sks }} SKS</td>
                </tr>
            </table>
        </div>

        <!---- Data Mahasiswa Yang Mengikuti Kelas ---->
        <div class="card mb-3">
            <div class="card-header" id="headingOne" style="background-color: rgb(204, 207, 215, 0.3)">
            <div class="row">
                <div class="col-9">
                    <p class="mb-0" style="font-size: 17px; font-weight:600; color:#112c66;">Data Mahasiswa</p>
                </div>
                <div class="col-3">
                    <p class="mb-0">
                        <button class="btn btn-md float-right" style="background-color: rgb(171, 181, 196, 0.4)" type="button" data-toggle="collapse" data-target="#multiCollapse1" aria-expanded="false" aria-controls="multiCollapse1"><img style="width:70%" src="../img/dropdown.png"></button>
                    </p>
                </div>
            </div>
            </div>
            <div id="multiCollapse1" class="collapse multi-collapse">
                <div class="card-body" style="background-color: rgb(237,241,245, 0.6)">
                    <a type="button" class="btn btn-primary mb-3" href="{{ route('tambah.peserta', [$data_kelas->kelas_id]) }}">Tambah Peserta Kelas</a>
                    <div class="table-responsive">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr style="font-size: 16px">
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIM</th>
                                <th class="text-center" scope="col">Kelola</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

        <!---- Data Pertemuan ---->
        <div class="card">
            <div class="card-header" id="headingOne">
            <div class="row">
                <div class="col-6">
                    <h5 class="mb-0">Data Pertemuan<img style="margin-bottom:3px; margin-left:10px" src="../img/pertemuan.png"></h5>
                </div>
                <div class="col-6">
                    <h5 class="mb-0">
                        <button class="btn btn-sm btn-outline-primary float-right" type="button" data-toggle="collapse" data-target="#multiCollapse2" aria-expanded="false" aria-controls="multiCollapse2">v</button>
                    </h5>
                </div>
            </div>
            </div>
            <div id="multiCollapse2" class="collapse multi-collapse">
                <div class="card-body" id="addPertemuan">
                    <a type="button" class="btn btn-primary mb-3" href="{{ route('tambah.pertemuan', [$data_kelas->kelas_id]) }}">Tambah Pertemuan</a>
                    <div class="row">
                        @forelse ($data_pert as $pert)
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title border-bottom">Pertemuan {{ $pert['pertemuan_ke'] }}</h5>
                                    <p class="card-subtitle mb-2 text-muted" style="font-size: 12px">Tanggal : {{ date('d M Y', strtotime($pert['tanggal'])) }}</p>
                                    <a href="{{ route('detail.pertemuan', [$data_kelas->kelas_id, $pert['pertemuan_id']]) }}" class="card-link">Lihat Pertemuan >></a>
                                </div>
                              </div>
                        </div> 
                        @empty
                            <h6 class="mx-auto" style="color: silver">Belum Ada Pertemuan!</h6>
                        @endforelse
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection