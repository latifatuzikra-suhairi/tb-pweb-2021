<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'absensi';
    protected $primaryKey = 'absensi_id';
    protected $fillable = ['krs_id','pertemuan_id','jam_masuk', 'jam_keluar', 'durasi'];

    public function krs()
    {
        return $this->belongsTo(Krs::class);
    }

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class);
    }
}
