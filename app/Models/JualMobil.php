<?php

namespace App\Models;

class JualMobil extends Jual
{
    protected $collection = 'jual_mobil';
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
            'mobil_id'
        ]);
    }

    public function mobil()
    {
        return $this->hasOne('App\Models\Mobil::class');
    }
}
