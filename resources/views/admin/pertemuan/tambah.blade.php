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
<div>
   <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="/">Home</a></li>
       <li class="breadcrumb-item"><a href="/kelas">Kelas</a></li>
       <li class="breadcrumb-item"><a href="{{ route('detail.kelas', [$kelas_id]) }}">Detail Kelas</a></li>
       <li class="breadcrumb-item active" aria-current="page">Tambah Pertemuan</li>
       </ol>
   </nav>
</div>
@endsection

@section('content')
    <div class="container mt-4">
      <div class="wrap container shadow-lg p-4" style="background-color:white; border-radius:10px">
         <h2 class="mb-4">Tambah Data Pertemuan</h2>
         <form action="{{ route('simpan.pertemuan', [$kelas_id]) }}" method="POST" id="formPertemuan">
               @csrf
               <input type="hidden" class="form-control" id="kelas_id" name="kelas_id" value="{{ $kelas_id }}">
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
                  <button type="submit" class="btn btn-primary">Tambah</button>
               </div>
         </div>
        </form>
      </div>
    </div>
@endsection
