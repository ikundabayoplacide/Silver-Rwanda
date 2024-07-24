<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API_AuthController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\ApiDeviceData;


Route::post('/login', [API_AuthController::class, 'login']);
Route::post('/register', [API_AuthController::class, 'register']);
Route::post('/refresh', [API_AuthController::class, 'refreshToken']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/me', [API_AuthController::class, 'me']);
    Route::post('/logout', [API_AuthController::class, 'logout']);
    Route::get('device-data', [ApiDeviceData::class, 'index']);
    Route::get('device-data/visual', [ApiDeviceData::class, 'visual']);
    Route::get('device-data/{device_data}', [ApiDeviceData::class, 'show']);
});


//API FOR DEVIDE DATA

Route::post('device-data', [ApiDeviceData::class, 'store']);
Route::put('device-data/{device_data}', [ApiDeviceData::class, 'update']);
Route::delete('device-data/{device_data}', [ApiDeviceData::class, 'destroy']);