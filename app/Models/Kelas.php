<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = ['kode_kelas', 'kode_makul', 'nama_makul', 'tahun', 'semester', 'sks'];

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    public function pertemuan()
    {
        return $this->hasMany(Kelas::class);
    }   
}
