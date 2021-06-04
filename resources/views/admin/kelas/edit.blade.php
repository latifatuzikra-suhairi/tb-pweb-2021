@extends('layout/admin')
<style>
@media (min-width: 992px) { 
    .navbar{
        background-color: #001136;
    }
}
</style>
@section('title', 'SIRAH | Kelas')

@section('breadcrumbs')
<div style="background-color: white; margin-top:-5px"> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb container" style="background-color: white">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/kelas">Kelas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Kelas</li>
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
                    <h3 class="mb-2"><b>Edit Kelas</b></h3>
                    <p class="fs-2">- Kelas {{ $data_kelas->kode_kelas }}</p>
                     <div class="batas"></div>
                </div>
 
        <div class="card mt-3">
        <div class="card-body">
        <form action="/kelas/{{ $data_kelas->kelas_id }}/update" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" placeholder="Masukkan Kode Kelas" id="kode_kelas" name="kode_kelas" value="{{ $data_kelas->kode_kelas }}"> 
                        </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" placeholder="Masukkan Kode Makul" id="kode_makul" name="kode_makul" value="{{ $data_kelas->kode_makul }}"> 
                    </div>
                    <div class="form-group">  
                        <label for="nama_makul">Nama Makul</label>
                        <input type="text" class="form-control @error('nama_makul') is-invalid @enderror" placeholder="Masukkan Nama Makul" id="nama_makul" name="nama_makul" value="{{ $data_kelas->nama_makul }}"> 
                        @error ('nama_makul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <select id="tahun" class="form-control @error('tahun') is-invalid @enderror" name="tahun">
                            <option value="">-Pilih Tahun Kelas-</option>
                            <?php
                                $thn_skr = date('Y');
                                for ($x = $thn_skr; $x >= 2010; $x--) {
                                    if($data_kelas->tahun  == $x )
                                    {
                            ?>
                            <option selected>{{$data_kelas->tahun}}</option>
                            <?php
                                    }else{
                            ?>
                                      <option>{{$x}}</option>  
                            <?php
                                    }
                            }
                            ?>
                        </select>
                        @error ('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input @error('semester') is-invalid @enderror" placeholder="Masukkan Semester" id="semesterganjil" name="semester" value="1" {{ $data_kelas->semester == '1' ? 'checked' : ''  }}> 
                            <label class="custom-control-label" for="semesterganjil">Ganjil</label>
                            @error ('semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input @error('semester') is-invalid @enderror" placeholder="Masukkan Semester" id="semestergenap" name="semester" value="2" {{ $data_kelas->semester == '2' ? 'checked' : ''  }}> 
                            <label class="custom-control-label" for="semestergenap">Genap</label>
                            @error ('semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>  
                    </div>
                    <div class="form-group">
                        <label for="sks">SKS</label>
                        <input type="number" class="form-control @error('sks') is-invalid @enderror" min="1" max="5" placeholder="Masukkan SKS" id="sks" name="sks" value="{{ $data_kelas->sks}}"> 
                        @error ('sks')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                           
                <button type="submit" class="btn btn-primary">Edit Data</button>
                </form>  
            </div>
            </div>
            </div>
     </div>
    </div>
</div>

@endsection