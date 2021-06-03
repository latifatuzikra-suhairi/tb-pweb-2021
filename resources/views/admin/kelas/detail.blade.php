@extends('layout/admin')
<style>
@media (min-width: 992px) { 
    .navbar{
        background-color: #001136;
    }
}
</style>
@section('title', 'SIRAH | Detail Kelas')

@section('breadcrumbs')
<div style="background-color: white; margin-top:-5px">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb container" style="background-color: white">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/kelas">Kelas</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $data_kelas->kode_kelas }}</li>
        </ol>
    </nav>
    <div style="border: 2px solid #001136; margin-top:-20px"></div>
</div>

@endsection

@if (session('status'))
        <br>
            <div class="alert alert-success">
                {{ session('status')}}
            </div>
        @endif 

@section('content')
    <div class="container mt-4">
        <div class="wrap container shadow p-5" style="background-color:white; border-radius:10px">

        <!---- Detail Daftar Kelas ---->
        <div class="color: #001136">
            <h3><b>{{ $data_kelas->nama_makul }}</b></h3>
            <p class="fs-2">- {{ $data_kelas->kode_makul }}</p>
             <div class="batas"></div>
        </div>

        @if($message = Session::get('psn_sukses'))
            <div class="alert alert-success mt-3 alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @elseif($message = Session::get('psn_gagal'))
        <div class="alert alert-danger mt-3 alert-block" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        
        <div class="mt-2 border-top">
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
                    <form action="/kelas/{{$data_kelas->kelas_id}}/store" method="post">
                        @csrf
                        <select name="mahasiswa_id" class="form-select form-select-sm" aria-label=".form-select-sm example"> 
                        <option value="" hidden>-- Pilih Mahasiswa --</option>
                        @forelse ($non_peserta as $mhs)
                            <option value="{{$mhs->mahasiswa_id}}">{{$mhs->nama}}</option>
                        @empty
                            <option value="" disabled>Seluruh Mahasiswa Terdaftar</option>
                        @endforelse
                        </select>
                        <button class="btn btn-primary" type="submit">Tambah Peserta</button>
                    </form>
                    
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
                        @foreach ($data_mhs as $mhs)
                        <tbody>
                            <tr style="font-size: 16px;">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $mhs->nama }}</td>
                                <td>{{ $mhs->nim }}</td>
                                <td>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete{{$mhs->mahasiswa_id}}">Hapus</a>
                                </td>
                            </tr>
                            @include('admin.kelas.deletemahasiswa')
                        </tbody>
                        @endforeach
                    </table>
                    <div>
                        Showing
                        {{$data_mhs->firstItem()}}
                        to
                        {{$data_mhs->lastItem()}}
                        of
                        {{$data_mhs->total()}}
                        entries
                    </div>
                    <div>
                        {{ $data_mhs->links('pagination::bootstrap-4') }}
                    </div>
                    </div>
                </div>
            </div>
            </div>

        <!---- Data Pertemuan ---->
        <div class="card">
            <div class="card-header" id="headingOne" style="background-color: rgb(204, 207, 215, 0.3)">
            <div class="row">
                <div class="col-9">
                    <p class="mb-0" style="font-size: 17px; font-weight:600; color:#112c66;">Data Pertemuan<img class="mb-1 ml-3" src="../img/pertemuan.png"></p>
                </div>
                <div class="col-3">
                    <p class="mb-0">
                        <button class="btn btn-md float-right" style="background-color: rgb(171, 181, 196, 0.4)" type="button" data-toggle="collapse" data-target="#multiCollapse2" aria-expanded="false" aria-controls="multiCollapse2"><img style="width:70%" src="../img/dropdown.png"></button>
                    </p>
                </div>
            </div>
            </div>
            <div id="multiCollapse2" class="collapse multi-collapse">
                <div class="card-body" style="background-color: rgb(237,241,245, 0.6)">
                    <a type="button" class="btn btn-primary mb-3" href="{{ route('tambah.pertemuan', [$data_kelas->kelas_id]) }}">Tambah Pertemuan</a>
                    <div class="row">
                        @forelse ($data_pert as $pert)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <div class="list-pertemuan px-4 py-3">
                                <h5><b>{{ 'PERTEMUAN '.$pert->pertemuan_ke }}</b></h5><hr style="margin-top: -5px">
                                <p class="mb-2" style="margin-top: -10px">Tanggal : {{ date('d M Y', strtotime($pert['tanggal'])) }}</p>
                                <a class="btn px-2 py-1" href="{{ route('detail.pertemuan', [$data_kelas->kelas_id, $pert['pertemuan_id']]) }}">Lihat</a>
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