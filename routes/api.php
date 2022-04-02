<?php

use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\TypeController;
use App\Http\Controllers\API\VehicleSpecsController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

header('Accept: application/json');

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

Route::post('register', [AuthController::class, 'register']);
Route::post('token', [AuthController::class, 'token']);

// Member API
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Logout URL if User has been logged in
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('brands', [BrandController::class, 'index']);
    Route::get('brand/{brand}', [BrandController::class, 'show']);

    Route::get('types', [TypeController::class, 'index']);
    Route::get('type/{type}', [TypeController::class, 'show']);

    Route::get('vehicles', [VehicleSpecsController::class, 'index']);
    Route::get('vehicle/{vehicle}', [VehicleSpecsController::class, 'show']);
});

// Admin API
Route::group(['middleware' => ['auth:sanctum', 'isAdmin']], function () {
    Route::post('brands', [BrandController::class, 'store']);
    Route::put('brand/{brand}', [BrandController::class, 'update']);
    Route::delete('brand/{brand}', [BrandController::class, 'destroy']);


    Route::post('types', [TypeController::class, 'store']);
    Route::put('type/{type}', [TypeController::class, 'update']);
    Route::delete('type/{type}', [TypeController::class, 'destroy']);

    Route::post('vehicles', [VehicleSpecsController::class, 'store']);
    Route::put('vehicle/{vehicle}', [VehicleSpecsController::class, 'update']);
    Route::delete('vehicle/{vehicle}', [VehicleSpecsController::class, 'destroy']);
});