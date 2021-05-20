<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempatWisata extends Model
{
    protected $table = 'tb_tempat_wisata';

    public function desa(){
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    public function jenispotensi(){
        return $this->hasMany(JenisPotensi::class, 'id_potensi');
    }
}
