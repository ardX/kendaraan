<?php

namespace App\Services;

use App\Models\Kendaraan;
use App\Repositories\KendaraanRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class KendaraanService
{
    /**
     * @var $kendaraanRepository
     */
    protected $kendaraanRepository;

    /**
     * KendaraanService constructor.
     *
     * @param KendaraanRepository $kendaraanRepository
     */
    public function __construct(KendaraanRepository $kendaraanRepository)
    {
        $this->kendaraanRepository = $kendaraanRepository;
    }

    /**
     * Delete kendaraan by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $kendaraan = $this->kendaraanRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete kendaraan data');
        }

        DB::commit();

        return $kendaraan;

    }

    /**
     * Get all kendaraan.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->kendaraanRepository->getAll();
    }

    /**
     * Get kendaraan by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->kendaraanRepository->getById($id);
    }

    /**
     * Update kendaraan data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateKendaraan($data, $id)
    {
        $validator = Validator::make($data, [
            'title' => 'bail|min:2',
            'description' => 'bail|max:255'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $kendaraan = $this->kendaraanRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update kendaraan data');
        }

        DB::commit();

        return $kendaraan;

    }

    /**
     * Validate kendaraan data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function saveKendaraanData($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->kendaraanRepository->save($data);

        return $result;
    }

}