<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use Illuminate\Http\Request;
use Excel;
use Modules\Academic\Imports\CourseImport;
use Modules\Academic\Imports\StudentResultImport;
use Modules\Academic\Imports\StudentRegisterImport;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\StudentRegisterCourse;
use Modules\MainSetting\Entities\MainSetting;


class ImportController extends Controller
{
    public function importCourse(Request $request){
        try{
            $courseImport = new CourseImport;
            Excel::import($courseImport,$request->file('file'));
            $message = ['تم اضافة عدد : '.$courseImport->rowNumberCreated, 'تم تعديل عدد : '.$courseImport->rowNumberUpdated, 'لم يتم اضافة عدد : '.$courseImport->rowNumberNotCreated];
            $resources = Course::latest()->get();
            return responseJson(1 , $message , ['dataRegistered'=> $resources , 'dataNotRegistered'=> $courseImport->failedUploadReason]);

        } catch(Exception $exc){
            return responseJson(0,$exc->getMessage());
        }
    }

    public function importStudentResult(Request $request) {
        try {
            $studentResultImport = new StudentResultImport;
            Excel::import($studentResultImport, $request->file('file'));
            $message = ['تم اضافة عدد : '.$studentResultImport->rowNumberCreated, 'لم يتم اضافة عدد : '.$studentResultImport->rowNumberNotCreated];
            $resources = StudentRegisterCourse::with('course')->latest()->take(40)->get();
            return responseJson(1, $message, ['dataRegistered' => $resources, 'dataNotRegistered' => $studentResultImport->failedUploadReason]);
        } catch (Exception $exc) {
            return responseJson(0, $exc->getMessage());
        }
    }

    public function importStudentRegister(Request $request) {
        try {
            $studentRegisterImport = new StudentRegisterImport;
            Excel::import($studentRegisterImport, $request->file('file'));
            $message = ['تم اضافة عدد : '.$studentRegisterImport->rowNumberCreated, 'لم يتم اضافة عدد : '.$studentRegisterImport->rowNumberNotCreated];
            $resources = StudentRegisterCourse::where('academic_year_id',$request->academic_year_id)->where('academic_term_id',$request->academic_term_id)
            ->select('id','course_id','student_id','regulation_course_id')->with('course','student')->latest()->get();
            return responseJson(1, $message, ['dataRegistered' => $resources, 'dataNotRegistered' => $studentRegisterImport->failedUploadReason]);
        } catch (Exception $exc) {
            return responseJson(0, $exc->getMessage());
        }
    }

}
