<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\MainSetting\Http\Controllers\DivisionController;
use Modules\MainSetting\Http\Controllers\LevelController;
use Modules\MainSetting\Http\Controllers\ResetController;
use Modules\MainSetting\Http\Controllers\ResultSettingController;
use Modules\MainSetting\Http\Controllers\TermController;
use Modules\MainSetting\Http\Controllers\TerraceController;
use Modules\MainSetting\Http\Controllers\TerraceTypeController;

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

Route::group(['middleware' => 'api_auth', 'prefix' => 'MainSetting'], function () {

    //levels
    Route::post('levels', [LevelController::class, 'index']);

    //divisions
    Route::post('getDivisions', [DivisionController::class, 'getDivisions']);
    Route::group(['prefix' => 'divisions'], function () {
        Route::post('', [DivisionController::class, 'index']);
        Route::post('store', [DivisionController::class, 'store']);
        Route::post('update/{division}', [DivisionController::class, 'update']);
        Route::delete('destroy/{division}', [DivisionController::class, 'destroy']);
    });

    //terms
    Route::post('getTerms', [TermController::class, 'getTerms']);
    Route::group(['prefix' => 'terms'], function () {
        Route::post('', [TermController::class, 'index']);
        Route::post('store', [TermController::class, 'store']);
        Route::post('update/{term}', [TermController::class, 'update']);
        Route::delete('destroy/{term}', [DivisionController::class, 'destroy']);
    });

    
});
