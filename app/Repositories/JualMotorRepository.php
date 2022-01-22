<?php

namespace App\Repositories;

use App\Models\JualMotor;

class JualMotorRepository
{
    /**
     * @var JualMotor
     */
    protected $jualMotor;

    /**
     * JualMotorRepository constructor.
     *
     * @param JualMotor $jualMotor
     */
    public function __construct(JualMotor $jualMotor)
    {
        $this->jualMotor = $jualMotor;
    }

    /**
     * Get all jualMotors.
     *
     * @return JualMotor $jualMotor
     */
    public function getAll()
    {
        return $this->jualMotor
            ->get();
    }

    /**
     * Get jualMotor by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->jualMotor
            ->where('_id', $id)
            ->get();
    }

    /**
     * Count all jualMotors.
     *
     * @return JualMotor $jualMotor
     */
    public function countAll()
    {
        $result = [
            'count' =>  $this->jualMotor->count()
        ];
        return $result;
    }

    /**
     * Save JualMotor
     *
     * @param $data
     * @return JualMotor
     */
    public function save($data)
    {
        $jualMotor = new $this->jualMotor;

        $jualMotor->pembeli = $data['pembeli'];
        $jualMotor->harga_jual = $data['harga_jual'];
        $jualMotor->motor_id = $data['motor_id'];

        $jualMotor->save();

        return $jualMotor->fresh();
    }

    /**
     * Update JualMotor
     *
     * @param $data
     * @return JualMotor
     */
    public function update($data, $id)
    {
        $jualMotor = $this->jualMotor->find($id);

        $jualMotor->pembeli = $data['pembeli'];
        $jualMotor->harga_jual = $data['harga_jual'];
        $jualMotor->motor_id = $data['motor_id'];
        $jualMotor->update();

        return $jualMotor;
    }

    /**
     * Update JualMotor
     *
     * @param $data
     * @return JualMotor
     */
    public function delete($id)
    {
        $jualMotor = $this->jualMotor->find($id);
        $jualMotor->delete();

        return $jualMotor;
    }
    
    /**
     * Get jualMotor by id
     *
     * @param $id
     * @return mixed
     */
    public function reportById($id)
    {
        $data = $this->jualMotor->where('_id', $id)->first();
        $motor = \App\Models\Motor::where('_id', $data['motor_id'])->first();
        $data['motor'] = $motor;
        $data['keuntungan'] = $data['harga_jual']-$motor['harga'];
        return $data;
    }
}