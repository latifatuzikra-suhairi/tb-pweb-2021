@extends('layout/admin')
<style>
   @media (min-width: 992px) { 
       .navbar{
           background-color: #001543;
       }
   }
   </style>
@section('title', 'Tambah Pertemuan | SIRAH')

@section('breadcrumbs')
<div style="background-color: white; margin-top:-5px"> 
   <nav aria-label="breadcrumb">
       <ol class="breadcrumb container" style="background-color: white">
         <li class="breadcrumb-item"><a href="/">Home</a></li>
         <li class="breadcrumb-item"><a href="/kelas">Kelas</a></li>
         <li class="breadcrumb-item"><a href="{{ route('detail.kelas', [$kelas->kelas_id]) }}">{{ $kelas->kode_kelas }}</a></li>
         <li class="breadcrumb-item active" aria-current="page">Tambah Pertemuan</li>
       </ol>
   </nav>
   <div style="border: 2px solid #001136; margin-top:-20px"></div>
</div>
@endsection

@section('content')
    <div class="container mt-4">
      <div class="wrap container shadow-lg p-5" style="background-color:white; border-radius:10px">
         <div style="color: #001136">
            <h3><b>Tambah Pertemuan</b></h3>
            <p>- {{ $kelas->nama_makul }}</p>
             <div class="batas"></div>
        </div>

         <div class="card mt-3">
            <div class="card-body">
               <form action="{{ route('simpan.pertemuan', [$kelas->kelas_id]) }}" method="POST" id="formPertemuan">
                  @csrf
                  <input type="hidden" class="form-control" id="kelas_id" name="kelas_id" value="{{ $kelas->kelas_id }}">
                  <div class="form-group">
                     <label for="kode_kelas">Kode Kelas</label>
                     <input type="text" readonly class="form-control" id="kode_kelas" name="kode_kelas" value="{{ $kelas->kode_kelas }}">
                  </div>
                  <div class="form-group">
                     <label for="pertemuan_ke">Pertemuan Ke-</label>
                     <select class="custom-select form-control @error('pertemuan_ke') is-invalid @enderror" id="pertemuan_ke" name="pertemuan_ke"
                        onmousedown="if(this.options.length>5){this.size=5;}" 
                        onchange='this.size=0;' onblur="this.size=0;" value="{{ old('pertemuan_ke') }}">
                        <option selected disabled value="">-- Pilih Pertemuan Ke --</option>
                        $pert = 1;
                        @for ($pert = 1; $pert < 17; $pert++)
                        <option>{{$pert}}</option>
                        @endfor
                     </select>
                     @error ('pertemuan_ke')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="form-group">
                     <label for="tanggal">Tanggal Pertemuan</label>
                     <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                     @error ('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="form-group">
                     <label for="materi">Materi</label>
                     <textarea class="form-control @error('materi') is-invalid @enderror" id="materi" rows="3" style="resize: none" name="materi" value="{{ old('materi') }}"></textarea>
                     @error ('materi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div>
                     <button type="submit" class="btn btn-sm btn-outline-danger float-right">Tambah</button>
                  </div>
            </form>
         </div>
      </div>
      </div>
    </div>
@endsection
