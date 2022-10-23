<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\IncidentTypeController;
use App\Http\Controllers\StatisticController;

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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/login', [UserController::class, 'loginIndex'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/area', [AreaController::class, 'index'])->name('area');
    Route::get('/area/create', [AreaController::class, 'create']);
    Route::post('/area/create', [AreaController::class, 'store']);
    Route::get('/area/{area}', [AreaController::class, 'show']);
    Route::get('/area/{area}/edit', [AreaController::class, 'edit']);
    Route::put('/area/{area}', [AreaController::class, 'update']);
    Route::delete('/area/{area}', [AreaController::class, 'destroy']);

    Route::get('/camera', [CameraController::class, 'index'])->name('camera');
    Route::get('/camera/create', [CameraController::class, 'create']);
    Route::post('/camera/create', [CameraController::class, 'store']);
    Route::get('/camera/{camera}', [CameraController::class, 'show']);
    Route::get('/camera/{camera}/edit', [CameraController::class, 'edit']);
    Route::put('/camera/{camera}', [CameraController::class, 'update']);
    Route::delete('/camera/{camera}', [CameraController::class, 'destroy']);

    Route::get('/incident/type/', [IncidentTypeController::class, 'create'])->name('incidentType');
    Route::post('/incident/type', [IncidentTypeController::class, 'store']);

    Route::get('/incident/pending', [IncidentController::class, 'pendingIndex'])->name('incident_pending');
    Route::get('/incident/done', [IncidentController::class, 'doneIndex'])->name('incident_done');
    Route::get('/incident/create', [IncidentController::class, 'create']);
    Route::get('/incident/{incident}', [IncidentController::class, 'show']);
    Route::post('/incident', [IncidentController::class, 'store']);
    Route::put('/incident/{incident}', [IncidentController::class, 'update']);
    Route::delete('/incident/{incident}', [IncidentController::class, 'destroy']);

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class,'create']);
    Route::post('/user', [UserController::class, 'store']);
    Route::put('/user/{user}', [UserController::class, 'update']);
    Route::get('/user/line', [UserController::class, 'showLineToken']);

    Route::get('/testchart', function () {
        return view('chart');
    });

    Route::get('/statistics', function () {
        return redirect('/statistics/incidentPeriodByDay?beginDate='.(new DateTime())->sub(new DateInterval('P14D'))->format('Y-m-d')."&endDate=".date("Y-m-d"));
    });
    Route::get('/statistics/incidentPeriodByDay', [StatisticController::class, 'getPeriodIncidentStatisticsByDay']);
    
});

Route::get('/incident/image/{incident}', [IncidentController::class, 'getIncidentImage']);
