<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Result\Http\Controllers\StudentResultCourseController;
use Modules\Result\Http\Controllers\ImportController;
use Modules\Result\Http\Controllers\ExportController;
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


Route::group(['middleware' => 'api_auth' , 'prefix'=>'Result'], function () {

    // student results
    Route::post('student_result_course', [StudentResultCourseController::class, 'index']);
    Route::post("student_result_course/update/{id}", [StudentResultCourseController::class, 'update']);
    Route::post("student_result_course/show", [StudentResultCourseController::class, 'showStudentResults']);
    Route::post('student_result_course/counts', [StudentResultCourseController::class, 'getStudentResultCounts']);

    Route::post("student_result_course/import", [ImportController::class, 'importStudentResult']);
    Route::post("student_result_course/export", [ExportController::class, 'exportStudentResult']);


});
