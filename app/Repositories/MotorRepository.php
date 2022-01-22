<?php

namespace App\Repositories;

use App\Models\Motor;

class MotorRepository
{
    /**
     * @var Motor
     */
    protected $motor;

    /**
     * MotorRepository constructor.
     *
     * @param Motor $motor
     */
    public function __construct(Motor $motor)
    {
        $this->motor = $motor;
    }

    /**
     * Get all motors.
     *
     * @return Motor $motor
     */
    public function getAll()
    {
        return $this->motor
            ->get();
    }

    /**
     * Get motor by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->motor
            ->where('_id', $id)
            ->get();
    }

    /**
     * Count all motors.
     *
     * @return Motor $motor
     */
    public function countAll()
    {
        $semua = $this->motor->count();
        $terjual = \App\Models\JualMotor::with('motor')->get()->count();
        $result = [
            'semua' =>  $semua,
            'terjual' =>  $terjual,
            'belum_terjual' =>  $semua-$terjual
        ];
        return $result;
    }

    /**
     * Save Motor
     *
     * @param $data
     * @return Motor
     */
    public function save($data)
    {
        $motor = new $this->motor;

        $motor->tahun_keluaran = $data['tahun_keluaran'];
        $motor->warna = $data['warna'];
        $motor->harga = $data['harga'];
        $motor->mesin = $data['mesin'];
        $motor->tipe_suspensi = $data['tipe_suspensi'];
        $motor->tipe_transmisi = $data['tipe_transmisi'];

        $motor->save();

        return $motor->fresh();
    }

    /**
     * Update Motor
     *
     * @param $data
     * @return Motor
     */
    public function update($data, $id)
    {
        $motor = $this->motor->find($id);

        $motor->tahun_keluaran = $data['tahun_keluaran'];
        $motor->warna = $data['warna'];
        $motor->harga = $data['harga'];
        $motor->mesin = $data['mesin'];
        $motor->tipe_suspensi = $data['tipe_suspensi'];
        $motor->tipe_transmisi = $data['tipe_transmisi'];

        $motor->update();

        return $motor;
    }

    /**
     * Update Motor
     *
     * @param $data
     * @return Motor
     */
    public function delete($id)
    {
        $motor = $this->motor->find($id);
        $motor->delete();

        return $motor;
    }
}