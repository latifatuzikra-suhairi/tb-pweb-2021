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
      <div class="row">
        <div class="col-8">
        <h1 class="mt-2">Tambah Mahasiswa</h1>
 
        <br>
        <div class="card mb-4">
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

@endsection