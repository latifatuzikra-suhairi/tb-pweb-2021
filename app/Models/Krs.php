<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;
    protected $table = 'krs';
    protected $primaryKey = 'krs_id';
    protected $fillable = ['kelas_id', 'mahasiswa_id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }  

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }   
}
