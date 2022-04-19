<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Member\DashboardController as MemberDashboard;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Guest\MainController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\RedirectsController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');
Route::get('/account/reset/{token}', [AuthController::class, 'verifyResetPassword']);

Route::group(['middleware' => 'guest'], function () {

    Route::get('/auth', function () {
        return redirect('/auth/login');
    });

    Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
    Route::get('/auth/register', [AuthController::class, 'register'])->name('register');
    Route::get('/auth/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
    Route::post('/auth/reset-password-process', [AuthController::class, 'resetPasswordProcess'])->name('reset-password-process');
    Route::post('/auth/save-password', [AuthController::class, 'savePassword'])->name('save-password');

    Route::post('/auth/login', [AuthController::class, 'loginProcess'])->name('loginProcess');
    Route::post('/auth/register', [AuthController::class, 'registerProcess'])->name('registerProcess');
});

Route::group(['middleware' => ['auth', 'isEmailVerified']], function () {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('redirects', [RedirectsController::class, 'redirect'])->name('redirects');
});

Route::group(['middleware' => ['auth', 'isEmailVerified', 'isAdmin']], function () {
    Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('adminDashboard');
});

Route::group(['middleware' => ['auth', 'isEmailVerified', 'isMember']], function () {
    Route::get('/dashboard', [MemberDashboard::class, 'index'])->name('memberDashboard');
    Route::get('/profile', [MemberDashboard::class, 'profile'])->name('profileMember');

    Route::get('/history', [MemberDashboard::class, 'history'])->name('historyMember');
    Route::get('/history/{history}', [MemberDashboard::class, 'historyDetail']);

    Route::post('/saveProfile', [ProfileController::class, 'saveProfile'])->name('saveProfile');
    Route::post('/saveLogin', [ProfileController::class, 'saveLogin'])->name('saveLogin');
});

// Kepepet Tok
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});