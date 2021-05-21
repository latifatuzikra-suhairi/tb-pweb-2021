@extends('layout/admin')

@foreach ($detail_pertemuan as $detail)
    <p>{{$detail['pertemuan_ke']}}</p>
    <p>{{$detail['tanggal']}}</p>
    <p>{{$detail['materi']}}</p>
@endforeach