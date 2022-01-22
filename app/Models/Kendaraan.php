<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

abstract class Kendaraan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tahun_keluaran',
        'warna',
        'harga'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
