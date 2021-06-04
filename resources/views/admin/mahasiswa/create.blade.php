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
            <li class="breadcrumb-item"><a href="/mahasiswa">Mahasiswa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Mahasiswa</li>
        </ol>
    </nav>
    <div style="border: 2px solid #001136; margin-top:-20px"></div>
</div>
@endsection

@section('content')
    <div class="container mt-4">
      <div class="row">
        <div class="col-8">
            <div class="wrap container shadow p-5" style="background-color:white; border-radius:10px">
                <div class="color: #001136">
                    <h3 class="mb-2"><b>Tambah Mahasiswa</b></h3>
                     <div class="batas"></div>
                </div>

                <div class="card mt-3">
                <div class="card-body">
                <form action="/mahasiswa/store" method="POST">
                                @csrf
                                <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama" id="nama" name="nama" value="{{old('nama')}}"> 
                                @error ('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" placeholder="Masukkan nim" id="nim" name="nim" value="{{old('nim')}}"> 
                                @error ('nim')<div class="invalid-feedback">{{ $message }}</div>@enderror

                            </div>
                            <div class="form-group">  
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email" id="email" name="email" value="{{old('email')}}"> 
                                @error ('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                        </form>  
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection