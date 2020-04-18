<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_pelanggan', 'no_ktp', 'alamat', 'no_telp', 'foto'
    ];
    public $timestamps = false;
}
