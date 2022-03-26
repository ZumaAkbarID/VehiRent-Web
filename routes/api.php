<?php

use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\TypeController;
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

// Public API
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('brands', [BrandController::class, 'index']);
    Route::get('brands/{brand}', [BrandController::class, 'show']);

    Route::get('types', [TypeController::class, 'index']);
    Route::get('types/{type}', [TypeController::class, 'show']);
});

Route::group(['middleware' => ['auth:sanctum', 'isAdmin']], function () {
    Route::post('brands', [BrandController::class, 'store']);
    Route::put('brands/{brand}', [BrandController::class, 'update']);
    Route::delete('brands/{brand}', [BrandController::class, 'destroy']);


    Route::post('types', [TypeController::class, 'store']);
    Route::put('types/{type}', [TypeController::class, 'update']);
    Route::delete('types/{type}', [TypeController::class, 'destroy']);
});