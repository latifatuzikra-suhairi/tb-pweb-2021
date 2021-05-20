@extends('layout/admin')
<style>
@media (min-width: 992px) { 
    .navbar{
        background-color: #001543;
    }
}
</style>
@section('title', 'SIRAH | Kelas')

@section('content')
    <div class="container">

        <h1>Daftar Kelas</h1>

        {{-- Btn Tambah Kelas --}}
        <button class="mb-4">Tambah Kelas</button>

        {{-- Card Kelas --}}
        <div class="row">
        @foreach ($data_kelas as $kelas)
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{$kelas->kode_kelas}} - {{$kelas->tahun}}</h5>
                  <p class="card-text">{{$kelas->nama_makul}}</p>
                  <a href="/kelas/detail" class="btn btn-primary">Lihat Detail Kelas</a>
                </div>
              </div>
            </div>
        @endforeach
    </div>
@endsection
