<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisMobil extends Model
{
    protected $tabel = 'jenis_mobils';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jenis_mobil'
    ];
    public $timestamps = false;
}
