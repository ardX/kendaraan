<?php

namespace App\Repositories;

use App\Models\Kendaraan;

class KendaraanRepository
{
    /**
     * @var Kendaraan
     */
    protected $kendaraan;

    /**
     * KendaraanRepository constructor.
     *
     * @param Kendaraan $kendaraan
     */
    public function __construct(Kendaraan $kendaraan)
    {
        $this->kendaraan = $kendaraan;
    }

    /**
     * Get all kendaraans.
     *
     * @return Kendaraan $kendaraan
     */
    public function getAll()
    {
        return $this->kendaraan
            ->get();
    }

    /**
     * Get kendaraan by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->kendaraan
            ->where('_id', $id)
            ->get();
    }

    /**
     * Save Kendaraan
     *
     * @param $data
     * @return Kendaraan
     */
    public function save($data)
    {
        $kendaraan = new $this->kendaraan;

        $kendaraan->tahun_keluaran = $data['tahun_keluaran'];
        $kendaraan->warna = $data['warna'];
        $kendaraan->harga = $data['harga'];

        $kendaraan->save();

        return $kendaraan->fresh();
    }

    /**
     * Update Kendaraan
     *
     * @param $data
     * @return Kendaraan
     */
    public function update($data, $id)
    {
        $kendaraan = $this->kendaraan->find($id);

        $kendaraan->tahun_keluaran = $data['tahun_keluaran'];
        $kendaraan->warna = $data['warna'];
        $kendaraan->harga = $data['harga'];

        $kendaraan->update();

        return $kendaraan;
    }

    /**
     * Update Kendaraan
     *
     * @param $data
     * @return Kendaraan
     */
    public function delete($id)
    {
        $kendaraan = $this->kendaraan->find($id);
        $kendaraan->delete();

        return $kendaraan;
    }
}