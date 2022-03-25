<?php

use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\TypeController;
use App\Http\Controllers\Auth\AuthController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

// Public API
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('brands', BrandController::class)->except(['create', 'edit']);
    Route::resource('types', TypeController::class)->except(['create', 'edit']);
});