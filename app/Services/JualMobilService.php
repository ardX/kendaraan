<?php

namespace App\Services;

use App\Models\JualMobil;
use App\Repositories\JualMobilRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class JualMobilService
{
    /**
     * @var $jualMobilRepository
     */
    protected $jualMobilRepository;

    /**
     * JualMobilService constructor.
     *
     * @param JualMobilRepository $jualMobilRepository
     */
    public function __construct(JualMobilRepository $jualMobilRepository)
    {
        $this->jualMobilRepository = $jualMobilRepository;
    }

    /**
     * Delete jualMobil by id.
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
            $jualMobil = $this->jualMobilRepository->delete($id);

        } catch (Exception $e) {
            //DB::rollBack();
            $session->abortTransaction();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete jualMobil data');
        }

        //DB::commit();
        $session->commitTransaction();
        return $jualMobil;
    }

    /**
     * Get all jualMobil.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->jualMobilRepository->getAll();
    }

    /**
     * Get jualMobil by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->jualMobilRepository->getById($id);
    }

    /**
     * Count all jualMobil.
     *
     * @return String
     */
    public function countAll()
    {
        return $this->jualMobilRepository->countAll();
    }

    /**
     * Update jualMobil data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateJualMobil($data, $id)
    {
        $validator = Validator::make($data, [
            'pembeli' => 'required',
            'harga_jual' => 'required|numeric',
            'mobil_id' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $session = DB::getMongoClient()->startSession();
        $session->startTransaction();

        try {
            $jualMobil = $this->jualMobilRepository->update($data, $id);

        } catch (Exception $e) {
            $session->abortTransaction();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update jualMobil data');
        }

        $session->commitTransaction();
        return $jualMobil;
    }

    /**
     * Validate jualMobil data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function saveJualMobilData($data)
    {
        $validator = Validator::make($data, [
            'pembeli' => 'required',
            'harga_jual' => 'required|numeric',
            'mobil_id' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->jualMobilRepository->save($data);

        return $result;
    }

    /**
     * Get jualMobil by id.
     *
     * @param $id
     * @return String
     */
    public function reportById($id)
    {
        return $this->jualMobilRepository->reportById($id);
    }
}