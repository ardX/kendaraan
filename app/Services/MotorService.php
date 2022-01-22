<?php

namespace App\Services;

use App\Models\Motor;
use App\Repositories\MotorRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class MotorService
{
    /**
     * @var $motorRepository
     */
    protected $motorRepository;

    /**
     * MotorService constructor.
     *
     * @param MotorRepository $motorRepository
     */
    public function __construct(MotorRepository $motorRepository)
    {
        $this->motorRepository = $motorRepository;
    }

    /**
     * Delete motor by id.
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
            $motor = $this->motorRepository->delete($id);

        } catch (Exception $e) {
            //DB::rollBack();
            $session->abortTransaction();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete motor data');
        }

        //DB::commit();
        $session->commitTransaction();
        return $motor;
    }

    /**
     * Get all motor.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->motorRepository->getAll();
    }

    /**
     * Get motor by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->motorRepository->getById($id);
    }

    /**
     * Count all motor.
     *
     * @return String
     */
    public function countAll()
    {
        return $this->motorRepository->countAll();
    }

    /**
     * Update motor data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateMotor($data, $id)
    {
        $validator = Validator::make($data, [
            'tahun_keluaran' => 'required|numeric',
            'warna' => 'required',
            'harga' => 'required|numeric',
            'mesin' => 'required',
            'tipe_suspensi' => 'required',
            'tipe_transmisi' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $session = DB::getMongoClient()->startSession();
        $session->startTransaction();

        try {
            $motor = $this->motorRepository->update($data, $id);

        } catch (Exception $e) {
            $session->abortTransaction();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update motor data');
        }

        $session->commitTransaction();
        return $motor;
    }

    /**
     * Validate motor data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function saveMotorData($data)
    {
        $validator = Validator::make($data, [
            'tahun_keluaran' => 'required|numeric',
            'warna' => 'required',
            'harga' => 'required|numeric',
            'mesin' => 'required',
            'tipe_suspensi' => 'required',
            'tipe_transmisi' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->motorRepository->save($data);

        return $result;
    }

}