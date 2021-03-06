<?php

use Illuminate\Http\Request;

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

Route::resource('photos','Photo\PhotoController');
Route::get('/temperatura/{request}','Alarma\AlarmaController@temperatura');
Route::get('/gas','Alarma\AlarmaController@gas');
Route::get('/proximidad','Alarma\AlarmaController@proximidad');
Route::get('/panico','Alarma\AlarmaController@panico');
