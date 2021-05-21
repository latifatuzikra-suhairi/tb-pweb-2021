@extends('layout/admin')
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
        <h1>Daftar Kelas</h1>

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
                <input type="text" readonly class="form-control" id="kode-kelas" 
                    name="kode_kelas" value="{{$data_kelas->kode_kelas}}">
            </div>
            <div class="col-4 form-group">
                <label for="kode-matakul">Kode Mata Kuliah</label>
                <input type="text" readonly class="form-control" id="kode-matakul" \
                    name="kode_makul" value="{{$data_kelas->kode_makul}}">
            </div>
            <div class="col-4 form-group">
                <label for="nama-makul">Nama Mata Kuliah</label>
                <input type="text" readonly class="form-control" id="nama-matakul" 
                    name="nama_makul" value="{{$data_kelas->nama_makul}}">
            </div>
        </div>

        {{-- Data Mahasiswa Yang Mengikuti Kelas --}}
        <div class="card mb-3">
        <div class="card-header" id="headingOne">
        <div class="row">
            <div class="col-6">
                <h5 class="mb-0">Data Mahasiswa Kelas</h5>
            </div>
            <div class="col-6">
                <h5 class="mb-0">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapse1" aria-expanded="false" aria-controls="multiCollapse1">Toggle second element</button>
                </h5>
            </div>
        </div>
        </div>
        <div id="multiCollapse1" class="collapse multi-collapse">
            <div class="card-body">
                <p>Isi Disini</p>
            </div>
        </div>
        </div>

        {{-- Data Pertemuan --}}
        <div class="card">
            <div class="card-header" id="headingOne">
            <div class="row">
                <div class="col-6">
                    <h5 class="mb-0">Data Pertemuan</h5>
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
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Tambah Pertemuan</button>
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

    
            




        <!-- Modal Tambah Pertemuan -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pertemuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/pertemuan/store" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" id="exampleFormControlInput1" value="{{$data_kelas->kelas_id}}" name="kelas_id">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pertemuan Ke-</label>
                        <select class="custom-select form-control" id="exampleFormControlSelect1" name="pertemuan_ke"
                            onmousedown="if(this.options.length>5){this.size=5;}" 
                            onchange='this.size=0;' onblur="this.size=0;">
                            <option selected disabled>--Pilih Pertemuan Ke--</option>
                            $pert = 1;
                            @for ($pert = 1; $pert < 17; $pert++)
                            <option>{{$pert}}</option>
                             @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tanggal Pertemuan</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Materi</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none" name="materi"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                    </form>
            </div>
            </div>
        </div>

    </div>
@endsection