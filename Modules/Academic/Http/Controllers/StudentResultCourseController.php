<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainSearch;
use Modules\Academic\Http\Requests\StudentRegisterCourseRequest;
use Illuminate\Http\Request;
use Modules\Academic\Entities\StudentRegisterCourse;
use Modules\MainSetting\Entities\MainSetting;
class StudentResultCourseController extends Controller
{

    public function index(Request $request)
    {
        $query = StudentRegisterCourse::with('course','student')
                                        ->where('academic_year_id',$request->academic_year_id)
                                        ->where('academic_term_id',$request->academic_term_id);
        if($request->level_id){
            $studentIds = Student::where('level_id', $request->level_id)->pluck('id')->toArray();
            $query->where('student_id', $studentIds);
        }
        if($request->course_id){
            $query->where('course_id', $request->course_id);
        }
        if($request->student_id){
            $query->where('student_id', $request->student_id);
        }
        $resources = $query->latest()->get();
        return responseJson(1, 'تم', $resources);
    }
    public function store(StudentRegisterCourseRequest $request)
    {
       
    }
    public function update(StudentRegisterCourseRequest $request, $id)
    {
     
    }
    
}
