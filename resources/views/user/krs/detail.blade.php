@extends('layout/user')
<style>
@media (min-width: 992px) { 
    .navbar{
        background-color: #001543;
    }
}
</style>
@section('title', 'SIRAH | Detail Kelas')

@section('content')
    <div class="container">
        <h1>Detail Kelas</h1>

        @if(session('psn_sukses')){
            <div class="alert alert-success" role="alert">
                {{ session('psn_sukses') }}
            </div>
        }   
        @elseif(session('psn_gagal')){
            <div class="alert alert-danger" role="alert">
                {{ session('psn_gagal') }}
            </div> 
        }
        @endif

        {{-- Detail Daftar Kelas --}}
        <div class="row">
            <div class="col-4 form-group">
                <label for="kode-kelas">Kode Kelas</label>
            </div>
            <div class="col-4 form-group">
                <label for="kode-matakul">Kode Mata Kuliah</label>

            </div>
            <div class="col-4 form-group">
                <label for="nama-makul">Nama Mata Kuliah</label>

            </div>
        </div>

        {{-- Data Pertemuan --}}
        <div class="card">
            <div class="card-header" id="headingOne">
            <div class="row">
                <div class="col-6">
                    <h5 class="mb-0">Pertemuan</h5>
                </div>
                <div class="col-6">
                    <h5 class="mb-0">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapse2" aria-expanded="false" aria-controls="multiCollapse2">Toggle second element</button>
                    </h5>
                </div>
            </div>
            </div>
            <div id="multiCollapse2" class="collapse multi-collapse">
                <div class="card-body">
                    <div class="row">
                        @forelse ($data_pert as $pert)
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title border-bottom">Pertemuan {{ $pert['pertemuan_ke'] }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Tanggal : {{ $pert['tanggal'] }}</h6>
                                    <a href="{{route('detail.pertemuan', ['kelas_id'=>$data_kelas->kelas_id,'pertemuan_id'=>$pert['pertemuan_id']])}}" class="card-link">Lihat Pertemuan >></a>
                                </div>
                              </div>
                        </div> 
                        @empty
                            <h6 class="mx-auto">Pertemuan Belum Dilakukan!</h6>
                        @endforelse
                    </div>
                </div>
            </div>
            </div>

    

    </div>
@endsection