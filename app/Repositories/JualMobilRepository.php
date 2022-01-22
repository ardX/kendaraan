<?php

namespace App\Repositories;

use App\Models\JualMobil;

class JualMobilRepository
{
    /**
     * @var JualMobil
     */
    protected $jualMobil;

    /**
     * JualMobilRepository constructor.
     *
     * @param JualMobil $jualMobil
     */
    public function __construct(JualMobil $jualMobil)
    {
        $this->jualMobil = $jualMobil;
    }

    /**
     * Get all jualMobils.
     *
     * @return JualMobil $jualMobil
     */
    public function getAll()
    {
        return $this->jualMobil
            ->get();
    }

    /**
     * Get jualMobil by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->jualMobil
            ->where('_id', $id)
            ->get();
    }

    /**
     * Count all jualMobils.
     *
     * @return JualMobil $jualMobil
     */
    public function countAll()
    {
        $result = [
            'count' =>  $this->jualMobil->count()
        ];
        return $result;
    }

    /**
     * Save JualMobil
     *
     * @param $data
     * @return JualMobil
     */
    public function save($data)
    {
        $jualMobil = new $this->jualMobil;

        $jualMobil->pembeli = $data['pembeli'];
        $jualMobil->harga_jual = $data['harga_jual'];
        $jualMobil->mobil_id = $data['mobil_id'];

        $jualMobil->save();

        return $jualMobil->fresh();
    }

    /**
     * Update JualMobil
     *
     * @param $data
     * @return JualMobil
     */
    public function update($data, $id)
    {
        $jualMobil = $this->jualMobil->find($id);

        $jualMobil->pembeli = $data['pembeli'];
        $jualMobil->harga_jual = $data['harga_jual'];
        $jualMobil->mobil_id = $data['mobil_id'];

        $jualMobil->update();

        return $jualMobil;
    }

    /**
     * Update JualMobil
     *
     * @param $data
     * @return JualMobil
     */
    public function delete($id)
    {
        $jualMobil = $this->jualMobil->find($id);
        $jualMobil->delete();

        return $jualMobil;
    }
}