<?php
namespace Modules\Result\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Result\Exports\StudentResultExport;
class ExportController extends Controller
{
    public function exportStudentResult(Request $request) {
        return Excel::download(new StudentResultExport, 'StudentResult.xlsx');
    }
}
