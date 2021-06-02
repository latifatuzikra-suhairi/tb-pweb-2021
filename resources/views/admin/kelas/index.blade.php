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
        <a type="button" class="btn btn-primary mb-3" href="/kelas/create">Tambah Kelas</a>
        <br>
        @if (session('status'))
        <br>
            <div class="alert alert-success">
                {{ session('status')}}
            </div>
        @endif 

        {{-- Table Kelas --}}
        <br>
        <div class="card mb-4">
          <div class="card-body">
            <table class="table table-bordered dataTabel">
        <thead>
          <tr>
            
            <th scope="col">Kode Kelas</th>
            <th scope="col">Tahun</th>
            <th scope="col">Semester</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data_kelas as $kelas)
          <tr>
            
            <td>{{ $kelas->kode_kelas }}</td>
            <td>{{ $kelas->tahun }}</td>
            <td>{{ $kelas->semester }}</td>
            <td>
              <a href="/kelas/{{ $kelas->kelas_id }}" class="btn btn-info">Detail</a>
              <a href="/kelas/{{ $kelas->kelas_id }}/edit" class="btn btn-primary">Edit</a>
              <!--<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete{{$kelas->kelas_id}}">Hapus</a>-->
            
              <!-- <form action="/kelas/{{ $kelas->kelas_id }}/destroy" method="post" class="d-inline">
                @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form> -->
                <!-- <a href="/kelas/{{ $kelas->kelas_id }}/destroy" class="btn btn-danger">Hapus</a> -->
            </td>
            @include('admin.kelas.delete')
          </tr>
          @endforeach
        </tbody>
      </table> 
      <div>
        Showing
        {{$data_kelas->firstItem()}}
        to
        {{$data_kelas->lastItem()}}
        of
        {{$data_kelas->total()}}
        entries
      </div>
      <div>
        {{ $data_kelas->links('pagination::bootstrap-4') }}
      </div>
      </div>
    </div>
  </div>
    
@endsection
