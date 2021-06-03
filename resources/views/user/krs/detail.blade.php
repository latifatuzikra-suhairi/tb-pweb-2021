@extends('layout/user')
<style>
@media (min-width: 992px) { 
    .navbar{
        background-color: #001543;
    }
}
</style>
@section('title', 'SIRAH | Detail Kelas')

@section('breadcrumbs')
<div style="background-color: white; margin-top:-5px">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb container" style="background-color: white">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/krs">My Classes</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $data_kelas->kode_kelas }}</li>
        </ol>
    </nav>
    <div style="border: 2px solid #001136; margin-top:-20px"></div>
</div>
@endsection

@section('content')
    <div class="container">

        @if(session('psn_sukses')){
            <div class="alert alert-success" role="alert">
                {{ session('psn_sukses') }}
            </div>
        }   
        @elseif(session('psn_gagal')){
            <div class="alert alert-danger" role="alert">
                {{ session('psn_gagal') }}
            </div> 
        }
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
                    @if(($data_kelas->semester)%2 == 0 )
                        <td>{{ "Genap" }}</td>
                    @else
                        <td>{{ "Ganjil" }}</td>
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
 
        <!---- Data Pertemuan ---->
        <div class="card mb-3">
            <div class="card-header" id="headingOne" style="background-color: rgb(204, 207, 215, 0.3)">
            <div class="row">
                <div class="col-9">
                    <p class="mb-0" style="font-size: 17px; font-weight:600; color:#112c66;">Data Kehadiran</p>
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
                    <div class="table-responsive">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr style="font-size: 16px">
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">Pertemuan Ke</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Materi</th>
                                <th scope="col">Status Kehadiran</th>
                                <th scope="col">Jam Masuk</th>
                                <th scope="col">Jam Keluar</th>
                                <th scope="col">Durasi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($list_hadir as $hadir)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td >{{ $hadir->pertemuan_ke }}</td>
                                <td>{{ date('d M Y', strtotime($hadir->tanggal)) }}</td>
                                <td>{{ $hadir->materi }}</td>
                                <!-- Status Kehadiran  -->
                                @if($hadir->jam_masuk != null)
                                    <td>{{ "Hadir" }}</td>
                                @else
                                    <td>{{ "Tidak Hadir" }}</td>
                                @endif 
                                <!-- Jam Masuk  -->
                                @if($hadir->jam_masuk != null)
                                    <td>{{ $hadir->jam_masuk}}</td>
                                @else
                                    <td>{{ "-" }}</td>
                                @endif 
                                <!-- Jam Keluar  -->
                                @if($hadir->jam_masuk != null)
                                    <td>{{ $hadir->jam_keluar }}</td>
                                @else
                                    <td>{{ "-" }}</td>
                                @endif 
                                <!-- durasi -->
                                <td>    
                                    {{ $jam=floor($hadir->durasi /(60*60)) }} jam 
                                    {{ floor((($hadir->durasi) - ($jam*3600))/60) }} menit
                                </td>
                            </tr>
                        @endforeach         
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>



  

    </div>
@endsection