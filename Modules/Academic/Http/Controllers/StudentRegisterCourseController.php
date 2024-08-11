<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainSearch;
use Modules\Academic\Http\Requests\StudentRegisterCourseRequest;
use Illuminate\Http\Request;
use Modules\Academic\Entities\StudentAvailableCourse;
use Modules\Academic\Entities\StudentRegisterCourse;
use Modules\MainSetting\Entities\MainSetting;
use Modules\Student\Entities\Student;
class StudentRegisterCourseController extends Controller
{
    public function getCourses(Request $request)
    {
        $avaibleCourse = new StudentAvailableCourse($request->student_id);
        return $avaibleCourse->getCourses();
    }
    public function index(MainSearch $request)
    {
        $offsetData = getOffsetData($request->pageNum, $request->perPage);

        $query = StudentRegisterCourse::select('id','course_id','student_id')->with('course','student');
        if($request->course_id){
            $query->where('course_id', $request->course_id);
        }
        if($request->student_id){
            $query->where('student_id', $request->student_id);
        }
        $resources = $query->skip($offsetData)->take($request->perPage)->latest()->get();
        return responseJson(1, 'تم', $resources);
    }
    public function store(StudentRegisterCourseRequest $request)
    {

        $student = Student::where('id',$request->student_id)->select('level_id','division_id')->first();

        $studentRegisterCoursesArr = [];
        foreach($request->regulation_course_Ids as $value){
            $collection = collect($request->except(['regulation_course_Ids','api_token','name']));
            $collection->prepend($student->level_id, 'level_id');
            $collection->prepend($student->division_id, 'division_id');
            $collection->prepend($request->academic_year_id, 'academic_year_id');
            $collection->prepend($request->academic_term_id, 'academic_term_id');
            $collection->prepend($value['course_id'], 'course_id');
            array_push($studentRegisterCoursesArr,$collection);
        }
        $resource = collect($studentRegisterCoursesArr)->toArray();
        $resource = StudentRegisterCourse::insert($resource);
        $courseIds = collect($request->regulation_course_Ids)->pluck('course_id')->toArray();
        $insertedData = StudentRegisterCourse::whereIn('course_id',$courseIds)->where('academic_year_id',$request->academic_year_id)->where('academic_term_id',$request->academic_term_id)->where('student_id',$request->student_id)->select('id','course_id','student_id')->with('course','student')->get();

        return responseJson(1, 'تم الأضافة بنجاح', $insertedData);
    }
    public function update(StudentRegisterCourseRequest $request, $id)
    {
        $resource = StudentRegisterCourse::select('id')->where('id',$id);
        if($resource)
            $resource->update(['course_id'=>$request['regulation_course_id']['course_id']]);
        else
            return responseJson(0, 'غير موجود', $resource);
        $resource = StudentRegisterCourse::where('id',$id)->select('id','course_id','student_id')->with('course','student')->first();
        return responseJson(1, 'تم التعديل بنجاح', $resource);
    }
    
    public function destroy($id)
    {
        $resource = StudentRegisterCourse::find($id);
        if($resource) {
                $resource->delete();
        } else
            return responseJson(0, 'غير موجود', $resource);
        return responseJson(1, 'تم الحذف بنجاح', $resource);
    }
}
