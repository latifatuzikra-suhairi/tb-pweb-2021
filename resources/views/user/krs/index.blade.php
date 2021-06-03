@extends('layout/user')
<style>
@media (min-width: 992px) { 
    .navbar{
        background-color: #001543;
    }
}
</style>
@section('title', 'SIRAH | My Class')

@section('content')
    <div class="container">

        <div class="border-bottom">
            <br>
            <h2><b>Daftar Kelas</b></h2>
        </div>

        {{-- Table Kelas --}}
        <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Kode Kelas</th>
            <th scope="col">Mata Kuliah</th>
            <th scope="col">Tahun</th>
            <th scope="col">Semester</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data_krs as $krs)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $krs->kode_kelas }}</td>
            <td>{{ $krs->nama_makul }}</td>
            <td>{{ $krs->tahun }}</td>
            <td>{{ $krs->semester }}</td>
            <td>
              <a href="/krs/{{ $krs->kelas_id }}/detail" class="btn btn-primary">Detail</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
        
    </div>
@endsection
