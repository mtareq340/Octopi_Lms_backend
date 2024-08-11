<?php
use Illuminate\Support\Facades\Route;
use Modules\Employee\Http\Controllers\FacultyMemberRatingController;

Route::group(['middleware' => 'api_auth' , 'prefix'=>'Employee'], function () {

    // Faculty Member Rating Routes
    Route::group(['prefix'=> 'faculty_member_rating'], function () {
        Route::post('', [FacultyMemberRatingController::class, 'index']);
    });

});
