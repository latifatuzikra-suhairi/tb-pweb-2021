@extends('layout/admin')
<style>
    @media (min-width: 992px) { 
        .navbar{
            background-color: #001136;
        }
    }
</style>
@section('title', 'SIRAH | Mahasiswa')

@section('breadcrumbs')
<div style="background-color: white; margin-top:-5px"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb container" style="background-color: white">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mahasiswa</a></li>
        </ol>
    </nav>
    <div style="border: 2px solid #001136; margin-top:-20px"></div>
</div>
@endsection

@section('content')
    <div class="container mt-4">
      <div class="wrap container shadow p-5" style="background-color:white; border-radius:10px">
        <div class="color: #001136">
            <h3 class="mb-2"><b>Mahasiswa</b></h3>
             <div class="batas"></div>
        </div>

        {{-- Btn Tambah Mahasiswa --}}
        <a href="/mahasiswa/create" class="btn btn-primary mt-3 mb-2" >Tambah Mahasiswa</a>
        @if (session('status'))
        <div class="alert alert-success alert-block" role="alert">
          <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('status')}}
        </div>
        @endif 
        
        {{-- Table Mahasiswa --}}
        <div class="card">
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered">
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
          @foreach ($data_mahasiswa as $index => $mahasiswa)
          <tr>
            <th scope="row">{{ $index + $data_mahasiswa->firstItem() }}</th>
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
      </div>
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
    </div>
@endsection


