<?php

use App\Http\Controllers\Guest\MainController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainController::class, 'index']);
Route::get('/about', [MainController::class, 'about']);
Route::get('/services', [MainController::class, 'services']);
Route::get('/rental', [MainController::class, 'rental']);
Route::get('/vehicle-single', [MainController::class, 'vehicleSingle']);
Route::get('/blog', [MainController::class, 'blog']);
Route::get('/blog-single', [MainController::class, 'singleBlog']);
Route::get('/contact', [MainController::class, 'contact']);

Route::get('/developer', function () {
    return '00=====D';
});
Route::get('/register', function () {
    return '00=====D';
});
Route::get('/login', function () {
    return '00=====D';
});