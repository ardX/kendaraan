<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('mobil', '\App\Http\Controllers\MobilController');
Route::resource('motor', '\App\Http\Controllers\MotorController');
Route::get('stock/mobil', ['as' => 'stock.mobil', 'uses' => '\App\Http\Controllers\MobilController@stock']);
Route::get('stock/motor', ['as' => 'stock.motor', 'uses' => '\App\Http\Controllers\MotorController@stock']);
