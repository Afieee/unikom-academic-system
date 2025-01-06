<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akademisi extends Model
{
    protected $table = 'akademisi';
    protected $primaryKey = 'nim_atau_nip';
    protected $fillable = ['nim_atau_nip', 'name', 'email', 'no_handpone', 'role', 'semester', 'id_jurusan'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'nim_atau_nip', 'nim_atau_nip'); // Menyesuaikan dengan kolom yang benar
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
    public function perwalian()
    {
        return $this->hasMany(Perwalian::class, 'nim', 'nim_atau_nip');
    }
}
