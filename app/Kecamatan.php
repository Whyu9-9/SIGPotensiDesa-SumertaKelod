<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'tb_kecamatan';
    public function kabupaten(){
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }

    public function desa(){
        return $this->hasMany(Desa::class, 'id_kabupaten');
    }
}
