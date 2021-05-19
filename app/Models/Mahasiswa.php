<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $fillable=['nama', 'nim', 'email', 'tipe', 'password'];

    public function krs()
    {
        return $this->hasMany(Mahasiswa::class);
    }   
}
