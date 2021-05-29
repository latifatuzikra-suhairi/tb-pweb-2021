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
      <div class="row">
        <div class="col-8">
        <h1 class="mt-2">Tambah Kelas</h1>
 
        <br>
        <div class="card mb-4">
        <div class="card-body">
        <form action="/kelas/store" method="POST">
                        @csrf
                        <div class="form-group">
                        <label for="kode_kelas">Kode Kelas</label>
                        <input type="text" class="form-control @error('kode_kelas') is-invalid @enderror" placeholder="Masukkan Kode Kelas " id="kode_kelas" name="kode_kelas" value="{{old('kode_kelas')}}"> 
                        @error ('kode_kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="kode_makul">Kode Makul</label>
                        <input type="text" class="form-control @error('kode_makul') is-invalid @enderror" placeholder="Masukkan Kode Makul" id="kode_makul" name="kode_makul" value="{{old('kode_makul')}}"> 
                        @error ('kode_makul')<div class="invalid-feedback">{{ $message }}</div>@enderror

                    </div>
                    <div class="form-group">  
                        <label for="nama_makul">Nama Makul</label>
                        <input type="text" class="form-control @error('nama_makul') is-invalid @enderror" placeholder="Masukkan Nama Makul" id="nama_makul" name="nama_makul" value="{{old('nama_makul')}}"> 
                        @error ('nama_makul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="text" class="form-control @error('tahun') is-invalid @enderror" placeholder="Masukkan Tahun" id="tahun" name="tahun" value="{{old('tahun')}}"> 
                        @error ('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input @error('semester') is-invalid @enderror" placeholder="Masukkan Semester" id="semesterganjil" name="semester" value="1"> 
                            <label class="custom-control-label" for="semesterganjil">Ganjil</label>
                            @error ('semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input @error('semester') is-invalid @enderror" placeholder="Masukkan Semester" id="semestergenap" name="semester" value="2"> 
                            <label class="custom-control-label" for="semestergenap">Genap</label>
                            @error ('semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="sks">SKS</label>
                        <input type="number" class="form-control @error('sks') is-invalid @enderror" min="1" max="5" placeholder="Masukkan SKS" id="sks" name="sks" value="{{old('sks')}}"> 
                        @error ('sks')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                           
                <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>  
        </div>
        </div>
        </div>
        </div>
    </div>

@endsection