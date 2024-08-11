<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Student\Exports\StudentExport;
use Illuminate\Http\Request;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportStudent(Request $request){
        return Excel::download(new StudentExport, 'Students.xlsx');
    }
}
