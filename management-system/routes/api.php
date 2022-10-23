<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\UserController;

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

Route::post('/cameraIncident', [IncidentController::class, 'storeCameraIncidentFromAPI']);
Route::post('/camera', [CameraController::class, 'activeCheckFromAPI']);

Route::post('/registerLine', [UserController::class, 'registerLine']);
Route::put('/incident/{incident}', [IncidentController::class, 'updateFromAPI']);
Route::delete('/incident/{incident}', [IncidentController::class, 'destroyFromAPI']);