<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $primaryKey = 'id_matakuliah';
    protected $fillable = ['nama_matakuliah', 'sks', 'id_jurusan', 'semester'];
    public $timestamps = false;

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    public function perwalian()
    {
        return $this->hasMany(Perwalian::class, 'id_matakuliah');
    }

    public function relasiKeAkademisi()
    {
        return $this->hasMany(User::class);
    }
}
