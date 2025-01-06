<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perwalian extends Model
{
    protected $table = 'perwalian';
    protected $primaryKey = 'id_perwalian';
    protected $fillable = ['nim', 'nip', 'id_matakuliah', 'tahun', 'tahun_ajaran', 'id_tahun', 'jadwal', 'uts', 'uas', 'na', 'index'];
    public $timestamps = false;

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'id_matakuliah');
    }

    public function akademisi()
    {
        return $this->belongsTo(Akademisi::class, 'nim', 'nim_atau_nip');
    }


    public function tahun()
    {
        return $this->belongsTo(Tahun::class, 'id_tahun');
    }
}
