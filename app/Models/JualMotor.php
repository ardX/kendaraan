<?php

namespace App\Models;

class JualMotor extends Jual
{
    protected $collection = 'jual_motor';
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
            'motor_id'
        ]);
    }

    public function motor()
    {
        return $this->hasOne('App\Models\Motor::class');
    }
}
