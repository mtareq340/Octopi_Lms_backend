<?php
use Illuminate\Support\Facades\Route;
use Modules\Academic\Http\Controllers\CourseController;
use Modules\Academic\Http\Controllers\ImportController;
use Modules\Academic\Http\Controllers\StudentRegisterCourseController;
use Modules\Academic\Http\Controllers\StudentResultCourseController;
use Modules\Academic\Http\Controllers\GuideController;
use Modules\Academic\Http\Controllers\GuideDocumentController;
use Modules\Academic\Http\Controllers\ImportController as AcademicImportController;
Route::group(['middleware' => 'api_auth' , 'prefix'=>'Academic'], function () {

    // Courses Routes
    Route::post('courses', [CourseController::class, 'index']);
    Route::post('courses/get', [CourseController::class, 'getCourses']);
    Route::post('courses/get_by_division', [CourseController::class, 'getCoursesByDivision']);
    Route::post('courses/store', [CourseController::class, 'store']);
    Route::post('courses/update/{course}', [CourseController::class, 'update']);
    Route::post('courses/changeStatus/{course}', [CourseController::class, 'changeStatus']);
    Route::delete('courses/destroy/{course}', [CourseController::class, 'destroy']);
    Route::post("courses/import", [ImportController::class, 'importCourse']);

    // student register Courses Routes
    Route::post('student_register_course', [StudentRegisterCourseController::class, 'index']);
    Route::post('student_register_course/store', [StudentRegisterCourseController::class, 'store']);
    Route::post('student_register_course/update/{course}', [StudentRegisterCourseController::class, 'update']);
    Route::delete('student_register_course/destroy/{course}', [StudentRegisterCourseController::class, 'destroy']);
    Route::post('student_register_course/destroy_group', [StudentRegisterCourseController::class, 'destroyGroup']);
    Route::post("student_register/import", [AcademicImportController::class, 'importStudentRegister']);

    // student Available Courses
    Route::post('student_available_courses', [StudentRegisterCourseController::class, 'getCourses']);

    // student results'
    Route::post('student_result_course', [StudentResultCourseController::class, 'index']);
    Route::post("student_result/import", [AcademicImportController::class, 'importStudentResult']);


});
