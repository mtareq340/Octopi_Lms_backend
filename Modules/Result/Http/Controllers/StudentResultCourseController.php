<?php
namespace Modules\Result\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MainSearch;
use Modules\Result\Http\Requests\StudentResultCourseRequest;
use Modules\Result\Http\Requests\StudentResultCourseShowRequest;
use Modules\Academic\Entities\StudentRegisterCourse;
use Modules\Student\Entities\Student;
class StudentResultCourseController extends Controller
{
    public function index(MainSearch $request)
    {
        $offsetData = getOffsetData($request->pageNum, $request->perPage);

        $query = StudentRegisterCourse::with(['course', 'student' => function ($query) {
            $query->orderBy('name'); // Order by student name
        }])
            ->where('academic_year_id', $request->academic_year_id)
            ->where('academic_term_id', $request->academic_term_id);
            
          
        if($request->level_id){
            $query->where('level_id', $request->level_id);
        }
        if($request->division_id){
            $query->where('division_id', $request->division_id);
        }
        if($request->course_id){
            $query->where('course_id', $request->course_id);
        }
        if($request->student_id){
            $query->where('student_id', $request->student_id);
        }
        $resources = $query->skip($offsetData)->take($request->perPage)->latest()->get();
        return responseJson(1, 'تم', $resources);
    }
    public function getStudentResultCounts(Request $request)
    {
        $query = StudentRegisterCourse::where('academic_year_id', $request->academic_year_id)->where('academic_term_id', $request->academic_term_id);
        if ($request->student_id) {
            $query->where('student_id',$request->student_id);
        }
        if ($request->course_id) {
            $query->where('course_id',$request->course_id);
        }
        if ($request->level_id) {
            $query->where('level_id',$request->level_id);
        }
        if ($request->division_id) {
            $query->where('division_id',$request->division_id);
        }
        $resources = $query->count();
        return responseJson(1, 'تم', $resources);
    }

    public function update(StudentResultCourseRequest $request, $id)
    {
        $resource = StudentRegisterCourse::find($id);
        if($resource) {
            $resource->update([
                "mid_degree" => $request->mid_degree,
                "work_year_degree" => $request->work_year_degree,
                "amly_degree" => $request->amly_degree,
                "final_degree" => $request->final_degree,
                "total_degree" => $request->total_degree,
            ]);
        }
        else
            return responseJson(0, 'غير موجود', $resource);

        $resource = StudentRegisterCourse::where('id',$id)->with('course','student')->first();
        return responseJson(1, 'تم التعديل بنجاح', $resource);
    }

    

}
