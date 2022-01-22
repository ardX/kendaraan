<?php

namespace App\Http\Controllers;

use App\Models\JualMobil;
use App\Services\JualMobilService;
use Illuminate\Http\Request;
use Exception;

class JualMobilController extends Controller
{
    /**
     * @var jualmobilService
     */
    protected $jualmobilService;
    
    /**
     * JualMobilController Constructor
     *
     * @param JualMobilService $jualmobilService
     *
     */
    public function __construct(JualMobilService $jualmobilService)
    {
        $this->jualmobilService = $jualmobilService;
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
            $result['data'] = $this->jualmobilService->getAll();
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
            $result['data'] = $this->jualmobilService->countAll();
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
            'mobil_id'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->jualmobilService->saveJualMobilData($data);
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
            $result['data'] = $this->jualmobilService->getById($id);
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
     * @param  \App\Models\JualMobil  $jualmobil
     * @return \Illuminate\Http\Response
     */
    public function edit(JualMobil $jualmobil)
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
            'mobil_id'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->jualmobilService->updateJualMobil($data, $id);

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
            $result['data'] = $this->jualmobilService->deleteById($id);
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
            $result['data'] = $this->jualmobilService->reportById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
}
