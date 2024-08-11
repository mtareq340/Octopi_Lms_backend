<?php

namespace Modules\Result\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Excel;
use Modules\Result\Imports\StudentResultImport;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\StudentRegisterCourse;
use Modules\MainSetting\Entities\MainSetting;


class ImportController extends Controller
{

    public function importStudentResult(Request $request) {
        try {
            $studentResultImport = new StudentResultImport;
            Excel::import($studentResultImport, $request->file('file'));
            $message = ['تم اضافة عدد : '.$studentResultImport->rowNumberCreated, 'لم يتم اضافة عدد : '.$studentResultImport->rowNumberNotCreated];
            $resources = StudentRegisterCourse::with('course','student')->latest()->take(20)->get();
            return responseJson(1, $message, ['dataRegistered' => $resources, 'dataNotRegistered' => $studentResultImport->failedUploadReason]);
        } catch (Exception $exc) {
            return responseJson(0, $exc->getMessage());
        }
    }

    


}
