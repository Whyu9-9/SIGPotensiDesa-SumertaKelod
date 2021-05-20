<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'tb_sekolah';

    public function desa(){
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    public function jenispotensi(){
        return $this->hasMany(JenisPotensi::class, 'id_potensi');
    }
}
