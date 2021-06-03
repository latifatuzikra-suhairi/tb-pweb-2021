<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'mahasiswa';
    protected $primaryKey = 'mahasiswa_id';
    protected $fillable=['user_id','nama', 'nim', 'email'];

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }   

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
