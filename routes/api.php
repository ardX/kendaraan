<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', '\App\Http\Controllers\UserController@register');
Route::post('login', '\App\Http\Controllers\UserController@login');

Route::resource('mobil', '\App\Http\Controllers\MobilController')->middleware('jwt.verify');
Route::resource('motor', '\App\Http\Controllers\MotorController')->middleware('jwt.verify');
Route::resource('jual/mobil', '\App\Http\Controllers\JualMobilController')->middleware('jwt.verify');
Route::resource('jual/motor', '\App\Http\Controllers\JualMotorController')->middleware('jwt.verify');
Route::get('stock/mobil', ['as' => 'stock.mobil', 'uses' => '\App\Http\Controllers\MobilController@stock'])->middleware('jwt.verify');
Route::get('stock/motor', ['as' => 'stock.motor', 'uses' => '\App\Http\Controllers\MotorController@stock'])->middleware('jwt.verify');
Route::get('report/mobil/{id?}', ['as' => 'report.mobil', 'uses' => '\App\Http\Controllers\JualMobilController@report'])->middleware('jwt.verify');
Route::get('report/motor/{id?}', ['as' => 'report.motor', 'uses' => '\App\Http\Controllers\JualMotorController@report'])->middleware('jwt.verify');
