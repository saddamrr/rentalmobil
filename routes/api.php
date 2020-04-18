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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Petugas
Route::post('register', 'petugascontroller@register');
Route::post('login', 'petugascontroller@login');

//Mobil
Route::post('/mobil', 'mobilcontroller@store')->middleware('jwt.verify');
Route::put('/mobil/{id}', 'mobilcontroller@update')->middleware('jwt.verify');
Route::delete('/mobil/{id}', 'mobilcontroller@destroy')->middleware('jwt.verify');
Route::get('/mobil', 'mobilcontroller@show')->middleware('jwt.verify');

//Jenis
Route::post('/jenis', 'jeniscontroller@store')->middleware('jwt.verify');
Route::put('/jenis/{id}', 'jeniscontroller@update')->middleware('jwt.verify');
Route::delete('/jenis/{id}', 'jeniscontroller@destroy')->middleware('jwt.verify');
Route::get('/jenis', 'jeniscontroller@show')->middleware('jwt.verify');

Route::post('/pelanggan', 'pelanggancontroller@store')->middleware('jwt.verify');
Route::put('/pelanggan/{id}', 'pelanggancontroller@update')->middleware('jwt.verify');
Route::delete('/pelanggan/{id}', 'pelanggancontroller@destroy')->middleware('jwt.verify');
Route::get('/pelanggan', 'pelanggancontroller@show')->middleware('jwt.verify');