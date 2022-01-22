<?php

namespace App\Http\Controllers;

use App\Models\JualMotor;
use App\Services\JualMotorService;
use Illuminate\Http\Request;
use Exception;

class JualMotorController extends Controller
{
    /**
     * @var jualmotorService
     */
    protected $jualmotorService;
    
    /**
     * JualMotorController Constructor
     *
     * @param JualMotorService $jualmotorService
     *
     */
    public function __construct(JualMotorService $jualmotorService)
    {
        $this->jualmotorService = $jualmotorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->jualmotorService->getAll();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Display count of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stock()
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->jualmotorService->countAll();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'pembeli',
            'harga_jual',
            'motor_id'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->jualmotorService->saveJualMotorData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->jualmotorService->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JualMotor  $jualmotor
     * @return \Illuminate\Http\Response
     */
    public function edit(JualMotor $jualmotor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'pembeli',
            'harga_jual',
            'motor_id'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->jualmotorService->updateJualMotor($data, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->jualmotorService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function report($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->jualmotorService->reportById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
}
