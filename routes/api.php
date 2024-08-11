<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use Modules\Site\Http\Controllers\ContactController;
use Modules\Site\Http\Controllers\NewsController;
use Modules\Site\Http\Controllers\PageController;

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

Route::post('/auth/login',[AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'api_auth'], function () {
    // Auth routes
    Route::post('/auth/logout',[AuthController::class, 'logout'])->name('logout');
    Route::post('auth/check', [AuthController::class, 'checkApiToken']);
    Route::post('auth/check-permission', [AuthController::class, 'checkApiTokenPermission']);

    // Profile Routes
    Route::post('home/update/{id}', [ProfileController::class, 'update']);




});


