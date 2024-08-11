<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Student\Imports\StudentImport;
use Illuminate\Http\Request;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Student\Entities\Student;
use Modules\Student\Http\Requests\StudentActiveImportRequest;
use Modules\Student\Imports\StudentActiveImport;

class ImportController extends Controller
{

    public function importStudent(Request $request){
        try {
            $studentImport = new StudentImport;
            Excel::import($studentImport, $request->file('file'));
            $message = ['تم اضافة عدد : '.$studentImport->rowNumberCreated, 'تم تعديل عدد : '.$studentImport->rowNumberUpdated, 'لم يتم اضافة عدد : '.$studentImport->rowNumberNotCreated];
            $resources = Student::with('division', 'level','user')->latest()->take(40)->get();
            return responseJson(1, $message, ['dataRegistered' => $resources, 'dataNotRegistered' => $studentImport->failedUploadReason]);
        } catch (Exception $exc) {
            return responseJson(0, $exc->getMessage());
        }
    }
    
}
