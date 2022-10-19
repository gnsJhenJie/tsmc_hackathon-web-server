<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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

});
