<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPotensi extends Model
{
    protected $table = 'tb_jenis_potensi';

    public function sekolah(){
        return $this->belongsTo(Sekolah::class, 'id');
    }

    public function tempatibadah(){
        return $this->belongsTo(TempatIbadah::class, 'id');
    }

    public function tempatwisata(){
        return $this->belongsTo(TempatWisata::class, 'id');
    }
}
