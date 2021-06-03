@extends('layout/admin')
<style>
@media (min-width: 992px) { 
    .navbar{
        background-color: #001543;
    }
}
</style>
@section('title', 'SIRAH | Mahasiswa')

@section('content')
    <div class="container">
    
 
        <h1 class="mt-2">Daftar Mahasiswa</h1>

        {{-- Btn Tambah Mahasiswa --}}
        <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#formModal">Tambah Mahasiswa</button> -->
        <a href="/mahasiswa/create" class="btn btn-primary" >Tambah Mahasiswa</a>
        <br>
        @if (session('status'))
        <br>
            <div class="alert alert-success">
                {{ session('status')}}
            </div>
        @endif 
        
        {{-- Table Mahasiswa --}}
        <br>
        <div class="card mb-4">
        <div class="card-body">
        <table class="table table-bordered dataTabel">
        
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">NIM</th>
            <th scope="col">Email</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data_mahasiswa as $mahasiswa)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $mahasiswa->nama }}</td>
            <td>{{ $mahasiswa->nim }}</td>
            <td>{{ $mahasiswa->email }}</td>
            <td>

 
            <a href="/mahasiswa/{{ $mahasiswa->id}}/edit" class="btn btn-primary">Edit</a>

            
            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete{{$mahasiswa->id}}">Hapus</a>
            
           </td>
            @include('admin.mahasiswa.delete')
          </tr>
          @endforeach
        </tbody>
      </table> 
        <div>
                Showing
                {{$data_mahasiswa->firstItem()}}
                to
                {{$data_mahasiswa->lastItem()}}
                of
                {{$data_mahasiswa->total()}}
                entries
        </div>
        <div>
                {{ $data_mahasiswa->links('pagination::bootstrap-4') }}
        </div>
        </div>
        </div>
    </div>


  

@endsection


