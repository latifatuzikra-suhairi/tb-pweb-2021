@extends('layout/user')
<style>
@media (min-width: 992px) { 
    .navbar{
        background-color: #001543;
    }
}
</style>
@section('title', 'SIRAH | My Class')

@section('breadcrumbs')
<div style="background-color: white; margin-top:-5px">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb container" style="background-color: white">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">My Classes</li>
        </ol>
    </nav>
    <div style="border: 2px solid #001136; margin-top:-20px"></div>
</div>
@endsection

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
            <td>
                @if(($krs->semester)%2 == 0 )
                    Genap
                @else
                    Ganjil
                @endif 
            </td>
            <td>
              <a href="/krs/{{ $krs->kelas_id }}/detail" class="btn btn-primary">Detail</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
        
    </div>
@endsection
