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

        {{-- Table Kelas --}}
        <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Kode Kelas</th>
            <th scope="col">Tahun</th>
            <th scope="col">Semester</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data_kelas as $kelas)
          <tr>
            <th scope="row">1</th>
            <td>{{ $kelas->kode_kelas }}</td>
            <td>{{ $kelas->tahun }}</td>
            <td>{{ $kelas->semester }}</td>
            <td>
              <a href="/kelas/{{ $kelas->kelas_id }}/detail" class="btn btn-primary">Detail</a>
              <a href="" class="btn btn-primary">Edit</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
