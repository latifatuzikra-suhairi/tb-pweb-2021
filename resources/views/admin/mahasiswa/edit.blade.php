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
            <li class="breadcrumb-item active" aria-current="page">Edit Data Mahasiswa</li>
        </ol>
    </nav>
    <div style="border: 2px solid #001136; margin-top:-20px"></div>
</div>
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-8">
        
        <div class="container mt-4">
            <div class="wrap container shadow p-5" style="background-color:white; border-radius:10px">
                <div class="color: #001136">
                    <h3 class="mb-2"><b>Edit Data Mahasiswa</b></h3>
                        <div class="batas"></div>
                </div>

                <div class="card mt-3">
                <div class="card-body">

                    @foreach ($data_mahasiswa as $data_mahasiswa)
                    <form action="/mahasiswa/{{ $data_mahasiswa->id }}/update" method="POST">
                                    @csrf
                                    <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama" id="nama" name="nama" value="{{ $data_mahasiswa->nama }}"> 
                                    @error ('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" class="form-control @error('nim') is-invalid @enderror" placeholder="Masukkan nim" id="nim" name="nim" value="{{ $data_mahasiswa->nim }}"> 
                                    @error ('nim')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                </div>
                                <div class="form-group">  
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email" id="email" name="email" value="{{ $data_mahasiswa->email }}"> 
                                    @error ('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                
                                    
                            <button type="submit" class="btn btn-primary">Edit Data</button>
                            @endforeach
                            </form>  
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>

@endsection