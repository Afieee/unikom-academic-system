<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;
    protected $table = 'tahun';
    protected $primaryKey = 'id_tahun';
    protected $fillable = ['tahun_sekarang', 'tahun_ajaran'];
    public $timestamps = false;


    public function perwalian()
    {
        return $this->hasMany(Perwalian::class, 'id_tahun');
    }
}
