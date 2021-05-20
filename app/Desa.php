<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $table = 'tb_desa';

    public function sekolah(){
        return $this->hasMany(Sekolah::class, 'id');
    }

    public function tempatibadah(){
        return $this->belongsTo(TempatIbadah::class, 'id');
    }

    public function tempatwisata(){
        return $this->belongsTo(TempatWisata::class, 'id');
    }

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }
}
