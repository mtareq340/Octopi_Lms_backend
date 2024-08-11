<?php
use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\StudentController;
use Modules\Student\Http\Controllers\StudentResultController;
use Modules\Student\Http\Controllers\ImportController;
use Modules\Student\Http\Controllers\ExportController;

Route::group(['middleware'=>'api_auth','prefix'=>'Student'],function(){

    // Student Routes
    Route::post('/',[StudentController::class,'index']);
    Route::post('/store',[StudentController::class,'store']);
    Route::post('/update/{id}',[StudentController::class,'update']);
    Route::delete('/destroy/{id}',[StudentController::class,'destroy']);
    Route::post('/get', [StudentController::class, 'getStudents']);
    Route::post('counts', [StudentController::class, 'getStudentCounts']);
    Route::post('show-courses/{id}', [StudentController::class, 'showCourses']);
    Route::post('show_facultyMembers_courses/{id}', [StudentController::class, 'showFacultyMemberCourses']);
    Route::post("students/import", [ImportController::class, 'importStudent']);
    Route::post("students/import_active", [ImportController::class, 'importStudentActive']);
    Route::post("students/export", [ExportController::class, 'exportStudent']);
    Route::post('change_student_active', [StudentController::class, 'changeStudentActive']);
    Route::post('changeStatus/{id}', [StudentController::class, 'changeStatus']);


    // Student Result Routes
    Route::post('student_result_course', [StudentResultController::class, 'index']);

   
});
