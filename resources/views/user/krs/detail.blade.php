@extends('layout/user')
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
        <li class="breadcrumb-item"><a href="/krs">My Classes</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $data_kelas->kode_kelas }}</li>
        </ol>
    </nav>
    <div style="border: 2px solid #001136; margin-top:-20px"></div>
</div>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="wrap container shadow p-5" style="background-color:white; border-radius:10px">
            <div class="color: #001136">
                <h3><b>{{ $data_kelas->nama_makul }}</b></h3>
                <p class="fs-2">- {{ $data_kelas->kode_makul }}</p>
                 <div class="batas"></div>
            </div>

        <!---- Detail Daftar Kelas ---->
        <div class="mt-2 border-top">
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
                    <button class="btn btn-md float-right" style="background-color: rgb(171, 181, 196, 0.4)" type="button" data-toggle="collapse" data-target="#multiCollapse1" aria-expanded="false" aria-controls="multiCollapse1"><img style="width:100%" src="/img/dropdown.png"></button>
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

                                <!-- Status Kehadiran   -->
                                @if($hadir->pertemuan_id != null)
                                    <td>{{ "Hadir" }}</td>
                                @else
                                    <td>{{ "Tidak Hadir" }}</td>
                                @endif 
                                
                                <!-- Jam masuk, jam keluar, durasi -->
                                <?php
                                    $durasi=$hadir->durasi;
                                    $jam=floor($durasi /(60*60));
                                    $menit=floor((($durasi)-($jam*3600))/60);
                                    $detik=$durasi-($jam*3600)-($menit*60);
                                ?>
                                @if($durasi!=0)
                                    <td>{{ $hadir->jam_masuk}}</td>
                                    <td>{{ $hadir->jam_keluar }}</td>
                                    <td>{{$jam}}h {{$menit}}m {{$detik}}s</td>
                                @else
                                    <td>{{ "-" }}</td>
                                    <td>{{ "-" }}</td>
                                    <td>{{ "-" }}</td>
                                @endif  
                                
                            </tr>
                        @endforeach         
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection