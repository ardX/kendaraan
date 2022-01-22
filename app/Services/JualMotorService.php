<?php

namespace App\Services;

use App\Models\JualMotor;
use App\Repositories\JualMotorRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class JualMotorService
{
    /**
     * @var $jualMotorRepository
     */
    protected $jualMotorRepository;

    /**
     * JualMotorService constructor.
     *
     * @param JualMotorRepository $jualMotorRepository
     */
    public function __construct(JualMotorRepository $jualMotorRepository)
    {
        $this->jualMotorRepository = $jualMotorRepository;
    }

    /**
     * Delete jualMotor by id.
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
            $jualMotor = $this->jualMotorRepository->delete($id);

        } catch (Exception $e) {
            //DB::rollBack();
            $session->abortTransaction();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete jualMotor data');
        }

        //DB::commit();
        $session->commitTransaction();
        return $jualMotor;
    }

    /**
     * Get all jualMotor.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->jualMotorRepository->getAll();
    }

    /**
     * Get jualMotor by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->jualMotorRepository->getById($id);
    }

    /**
     * Count all jualMotor.
     *
     * @return String
     */
    public function countAll()
    {
        return $this->jualMotorRepository->countAll();
    }

    /**
     * Update jualMotor data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function updateJualMotor($data, $id)
    {
        $validator = Validator::make($data, [
            'pembeli' => 'required',
            'harga_jual' => 'required|numeric',
            'motor_id' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $session = DB::getMongoClient()->startSession();
        $session->startTransaction();

        try {
            $jualMotor = $this->jualMotorRepository->update($data, $id);

        } catch (Exception $e) {
            $session->abortTransaction();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update jualMotor data');
        }

        $session->commitTransaction();
        return $jualMotor;
    }

    /**
     * Validate jualMotor data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function saveJualMotorData($data)
    {
        $validator = Validator::make($data, [
            'pembeli' => 'required',
            'harga_jual' => 'required|numeric',
            'motor_id' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->jualMotorRepository->save($data);

        return $result;
    }

}