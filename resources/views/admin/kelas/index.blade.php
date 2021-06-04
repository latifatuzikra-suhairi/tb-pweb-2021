@extends('layout/admin')
<style>
@media (min-width: 992px) { 
    .navbar{
        background-color: #001136;
    }
}
</style>
@section('title', 'SIRAH | Kelas')

@section('breadcrumbs')
<div style="background-color: white; margin-top:-5px"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb container" style="background-color: white">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kelas</li>
        </ol>
    </nav>
    <div style="border: 2px solid #001136; margin-top:-20px"></div>
</div>
@endsection

@section('content')
    <div class="container mt-4">
      <div class="wrap container shadow p-5" style="background-color:white; border-radius:10px">
        <div class="color: #001136">
            <h3 class="mb-2"><b>Daftar Kelas</b></h3>
             <div class="batas"></div>
        </div>

        {{-- Btn Tambah Kelas --}}
        <a type="button" class="btn btn-primary mb-2 mt-3" href="/kelas/create">Tambah Kelas</a>
        @if (session('psn_sukses'))
          <div class="alert alert-success alert-block" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('psn_sukses')}}
          </div>
        @elseif (session('psn_gagal'))
          <div class="alert alert-danger alert-block" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('psn_gagal')}}
          </div>
        @endif 

        {{-- Table Kelas --}}
        <div class="card mb-4">
          <div class="card-body">
            <table class="table table-bordered dataTabel">
        <thead>
          <tr>
            <th>#</th>
            <th scope="col">Kode Kelas</th>
            <th scope="col">Tahun</th>
            <th scope="col">Semester</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data_kelas as $index => $kelas)
          <tr>
            <th scope="row">{{ $index + $data_kelas->firstItem() }}</th>
            <td>{{ $kelas->kode_kelas }}</td>
            <td>{{ $kelas->tahun }}</td>
            <td>{{ $kelas->semester }}</td>
            <td>
              <a href="/kelas/{{ $kelas->kelas_id }}" class="btn btn-info">Detail</a>
              <a href="/kelas/{{ $kelas->kelas_id }}/edit" class="btn btn-primary">Edit</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table> 
      <div class="row">
        <div class="col-6">
          Showing
          {{$data_kelas->firstItem()}}
          to
          {{$data_kelas->lastItem()}}
          of
          {{$data_kelas->total()}}
          entries
        </div>
        <div class=" col-6 pagination justify-content-end">
          {{ $data_kelas->links('pagination::bootstrap-4') }}
        </div>
      </div>
      </div>
    </div>
  </div>
    
@endsection
