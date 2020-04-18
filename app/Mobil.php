<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table = 'mobil';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_jenis_mobil', 'plat_mobil', 'biaya_sewa', 'tahun_pembuatan'
    ];
    public $timestamps = false;
}
