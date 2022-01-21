<?php

namespace App\Models;

class Motor extends Kendaraan
{
    protected $collection = 'motor';
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
            'tipe_suspensi',
            'tipe_transmisi'
        ]);
    }
}
