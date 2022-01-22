<?php

namespace App\Services;

use App\Models\Mobil;
use App\Repositories\MobilRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class MobilService
{
    /**
     * @var $mobilRepository
     */
    protected $mobilRepository;

    /**
     * MobilService constructor.
     *
     * @param MobilRepository $mobilRepository
     */
    public function __construct(MobilRepository $mobilRepository)
    {
        $this->mobilRepository = $mobilRepository;
    }

    /**
     * Delete mobil by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        //DB::beginTransaction();
        $session = DB::getMongoClient()->startSession();
        $session->startTransaction();

        try {
            $mobil = $this->mobilRepository->delete($id);

        } catch (Exception $e) {
            //DB::rollBack();
            $session->abortTransaction();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete mobil data');
        }

        //DB::commit();
        $session->commitTransaction();
        return $mobil;
    }

    /**
     * Get all mobil.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->mobilRepository->getAll();
    }

    /**
     * Get mobil by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->mobilRepository->getById($id);
    }

    /**
     * Update mobil data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateMobil($data, $id)
    {
        $validator = Validator::make($data, [
            'tahun_keluaran' => 'required|numeric',
            'warna' => 'required',
            'harga' => 'required|numeric',
            'mesin' => 'required',
            'kapasitas_penumpang' => 'required|numeric',
            'tipe' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $session = DB::getMongoClient()->startSession();
        $session->startTransaction();

        try {
            $mobil = $this->mobilRepository->update($data, $id);

        } catch (Exception $e) {
            $session->abortTransaction();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update mobil data');
        }

        $session->commitTransaction();
        return $mobil;
    }

    /**
     * Validate mobil data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function saveMobilData($data)
    {
        $validator = Validator::make($data, [
            'tahun_keluaran' => 'required|numeric',
            'warna' => 'required',
            'harga' => 'required|numeric',
            'mesin' => 'required',
            'kapasitas_penumpang' => 'required|numeric',
            'tipe' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->mobilRepository->save($data);

        return $result;
    }

}