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

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::resource('mobil', '\App\Http\Controllers\MobilController');
Route::resource('motor', '\App\Http\Controllers\MotorController');
Route::resource('jual/mobil', '\App\Http\Controllers\JualMobilController');
Route::resource('jual/motor', '\App\Http\Controllers\JualMotorController');
Route::get('stock/mobil', ['as' => 'stock.mobil', 'uses' => '\App\Http\Controllers\MobilController@stock']);
Route::get('stock/motor', ['as' => 'stock.motor', 'uses' => '\App\Http\Controllers\MotorController@stock']);
Route::get('report/mobil/{id?}', ['as' => 'report.mobil', 'uses' => '\App\Http\Controllers\JualMobilController@report']);
Route::get('report/motor/{id?}', ['as' => 'report.motor', 'uses' => '\App\Http\Controllers\JualMotorController@report']);
