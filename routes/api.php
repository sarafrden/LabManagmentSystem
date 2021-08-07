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
Route::apiResource('banner', App\Http\Controllers\BannerController::class);
Route::apiResource('news', App\Http\Controllers\NewsController::class);
Route::apiResource('doctor', App\Http\Controllers\DoctorController::class);
Route::apiResource('patient', App\Http\Controllers\PatientController::class);
