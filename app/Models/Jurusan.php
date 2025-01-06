<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'id_Jurusan';
    protected $fillable = ['id_jurusan', 'nama_jurusan'];
    public $timestamps = false;

    public function matakuliah()
    {
        return $this->hasMany(Matakuliah::class, 'id_jurusan', 'id_jurusan');
    }
}
