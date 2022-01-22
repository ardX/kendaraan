<?php

namespace App\Repositories;

use App\Models\Mobil;

class MobilRepository
{
    /**
     * @var Mobil
     */
    protected $mobil;

    /**
     * MobilRepository constructor.
     *
     * @param Mobil $mobil
     */
    public function __construct(Mobil $mobil)
    {
        $this->mobil = $mobil;
    }

    /**
     * Get all mobils.
     *
     * @return Mobil $mobil
     */
    public function getAll()
    {
        return $this->mobil
            ->get();
    }

    /**
     * Get mobil by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->mobil
            ->where('_id', $id)
            ->get();
    }

    /**
     * Save Mobil
     *
     * @param $data
     * @return Mobil
     */
    public function save($data)
    {
        $mobil = new $this->mobil;

        $mobil->tahun_keluaran = $data['tahun_keluaran'];
        $mobil->warna = $data['warna'];
        $mobil->harga = $data['harga'];
        $mobil->mesin = $data['mesin'];
        $mobil->kapasitas_penumpang = $data['kapasitas_penumpang'];
        $mobil->tipe = $data['tipe'];

        $mobil->save();

        return $mobil->fresh();
    }

    /**
     * Update Mobil
     *
     * @param $data
     * @return Mobil
     */
    public function update($data, $id)
    {
        $mobil = $this->mobil->find($id);

        $mobil->tahun_keluaran = $data['tahun_keluaran'];
        $mobil->warna = $data['warna'];
        $mobil->harga = $data['harga'];
        $mobil->mesin = $data['mesin'];
        $mobil->kapasitas_penumpang = $data['kapasitas_penumpang'];
        $mobil->tipe = $data['tipe'];

        $mobil->update();

        return $mobil;
    }

    /**
     * Update Mobil
     *
     * @param $data
     * @return Mobil
     */
    public function delete($id)
    {
        $mobil = $this->mobil->find($id);
        $mobil->delete();

        return $mobil;
    }
}