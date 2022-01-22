<?php

namespace App\Models;

class Mobil extends Kendaraan
{
    protected $collection = 'mobil';
    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable([
            'mesin',
            'kapasitas_penumpang',
            'tipe'
        ]);
    }
}
