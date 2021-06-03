@extends('layout/admin')

@section('title', 'Sistem Informasi Rekapitulasi Kehadiran')

@section('content')
<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid position-relative" style="background-image: url('../img/jumbotron.jpg'); background-size: cover; height: 550px;">
    <div class="container position-relative" style="z-index:1">
        <h1 class="display-4 text-center">SISTEM INFORMASI<br>REKAPITULASI KEHADIRAN</h1>
    </div>
</div>
<!-- Akhir Jumbotron -->

<!-- Info Panel -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 info-panel shadow-lg rounded p-3" style="background-color: white; margin-top: -90px;">
            <div class="row">
                <div class="col-lg">
                    <img src="img/read.png" alt="mahasiswa" class="float-left mr-3 mb-3">
                    <h4 class="font-weight-bold mt-2" style="font-size: 16px; color: #001950;">MAHASISWA</h4>
                    <p style=" font-size: 14px; color: #1a3f92;">Total: {{$jumlahMahasiswa->count()}} mahasiswa</p>
                </div>
                <div class="col-lg">
                    <img src="img/book.png" alt="kelas" class="float-left mr-3 mb-3">
                    <h4 class="font-weight-bold mt-2" style="font-size: 16px; color: #001950;">KELAS</h4>
                    <p style=" font-size: 14px; color: #1a3f92;">Banyak Kelas: {{$jumlahKelas->count()}} kelas</p>
                </div>
                <div class="col-lg">
                    <img src="img/appointment.png" alt="pertemuan" class="float-left mr-3 mb-3">
                    <h4 class="font-weight-bold mt-2" style="font-size: 16px; color: #001950;">PERTEMUAN</h4>
                    <p style=" font-size: 14px; color: #1a3f92;">Pertemuan Ke-6</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Akhir Info Panel -->
@endsection


