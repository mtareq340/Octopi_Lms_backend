<?php
namespace Modules\Student\Http\Controllers;
use App\Http\Requests\MainSearch;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Modules\Academic\Entities\StudentRegisterCourse;
use Modules\Student\Entities\Student;
use Modules\Student\Entities\StudentDivision;
use Modules\Student\Entities\StudentLevel;
use Modules\Student\Entities\StudentRegulation;
use Modules\Student\Entities\StudentSetNumber;
use Modules\Student\Http\Requests\StudentRequest;
use Modules\Student\Http\Requests\ChangeStudentActiveRequest;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Employee\Entities\Employee;
use Modules\FacultyMember\Entities\RegisterCourse;
use Modules\Student\Exports\StudentExport;
class StudentController extends Controller
{
    public function index(MainSearch $request)
    {
        $offsetData = getOffsetData($request->pageNum, $request->perPage);
        $query = Student::with('user');
        if ($request->student_id) {
            $query->where('id',$request->student_id);
        }
        if ($request->level_id) {
            $query->where('level_id',$request->level_id);
        }
        if ($request->division_id) {
            $query->where('division_id',$request->division_id);
        }
        if ($request->active) {
            $userIds = User::where('active', $request->active)->where('category_id',1)->pluck('id')->toArray();
            $query->where('user_id',$userIds);
        }
        $resources = $query->with('division', 'level','user')->skip($offsetData)->take($request->perPage)->latest()->get();
        return responseJson(1, 'تم', $resources);
    }
    public function getStudentCounts(Request $request)
    {
        $query = Student::query();
        if ($request->student_id) {
            $query->where('id',$request->student_id);
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
    public function store(StudentRequest $request)
    {
        $employee = Employee::where('id',$request->user_id)->select('user_id')->first();
        $user = User::create([
            'name' => $request->name,
            'username' => $request->national_id,
            'email' => $request->email,
            'password' => Hash::make($request->national_id),
            'category_id' => 1,
            'role_id' => 3
        ]);
        $request->merge(['user_id' => $user->id]);
        $resources = Student::create($request->all());
        $request->merge(['student_id' => $resources->id]);
        
        return responseJson(1, 'تم', $resources);
    }
    public function update(StudentRequest $request, $id)
    {
        $student = Student::find($id);
        if ($student) {
                $user = User::find($student->user_id);
                $user->update([
                    "username"=>$request->national_id,
                    "password"=>Hash::make($request->national_id),
                    "name"=>$request->name,
                    "email"=>$request->email
                ]);
            $resources = $student->update($request->all());
           
            return responseJson(1, 'تم التعديل بنجاح', $resources);
        } else {
            return responseJson(0, 'الطالب غير موجود');
        }
    }
    public function getStudents(Request $request)
    {
        if ($request->searchKey) {
            $query = Student::select('id', 'name')->limit(5);
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->searchKey . '%')
                    ->orWhere('code', 'Like', '%' . $request->searchKey . '%');
            });
            $resources = $query->get();
            return responseJson(1, 'تم', $resources);
        }
        return responseJson(1, 'تم', []);
    }
    public function showCourses(Request $request, $id)
    {
        if(!$id) {return responseJson(0, 'من فضلك إختر الطالب');}
        $courses = StudentRegisterCourse::where('student_id', $id)->where('academic_year_id', $request->academic_year_id)->where('academic_term_id', $request->academic_term_id)->select('course_id')->with('course')->get();
        return responseJson(1, 'تم ', $courses);
    }
    public function showFacultyMemberCourses(Request $request, $id)
    {
        if(!$id) {return responseJson(0, 'من فضلك إختر الطالب');}
        $courses = StudentRegisterCourse::where('student_id', $id)->where('academic_year_id', $request->academic_year_id)->where('academic_term_id', $request->academic_term_id)->pluck('course_id')->toArray();
        $facultyMembers = RegisterCourse::whereIn('course_id',$courses)->where('academic_year_id', $request->academic_year_id)->where('academic_term_id', $request->academic_term_id)->select('faculty_member_id')->with('facultyMember')->get();
        return responseJson(1, 'تم ', $facultyMembers);
    }
    public function changeStudentActive(ChangeStudentActiveRequest $request)
    {
        $query = Student::query();
        if ($request->student_id) {
            $query->where('id',$request->student_id);
        }
        if ($request->level_id) {
            $query->where('level_id',$request->level_id);
        }
        if ($request->division_id) {
            $query->where('division_id',$request->division_id);
        }
        $studentUserIds = $query->pluck('user_id')->toArray();
        $resources = User::whereIn('id', $studentUserIds)
                            ->update([ 'active' => $request->active ]);

        return responseJson(1, 'تم', null);
    }
    public function changeStatus($id)
    {
        $resource = Student::find($id);
        if($resource) {
            $user = User::find($resource->user_id);
            $user->update(['active' => !$user->active, 'api_token' => null]);
        }
        else
            return responseJson(0, 'غير موجود', $resource);

        return responseJson(1, 'تم تغيير الحالة بنجاح ', $resource);
    }
    public function destroy($id)
    {
        return 0; // when make delete will launch it

        if ($id) {
            $student = Student::find($id);
            if ($student) {
                if ($student->is_application == 1) {
                    // $student->StudentCaseConstraint()->delete();
                    $student->StudentDivision()->delete();
                    $student->StudentLevel()->delete();
                    $student->StudentRegulation()->delete();
                    $student->StudentSetNumber()->delete();
                    $student->delete();
                    $student->user()->delete();
                    return responseJson(1, 'تم المسح بنجاح');
                } else {
                    return responseJson(1, 'غير مسموح بالمسح');
                }
            } else {
                return responseJson(0, 'الطالب غير موجود');
            }
        } else {
            return responseJson(0, 'الطالب غير موجود');
        }
    }
    public function export(Request $request)
    {
        return Excel::download(new StudentExport, 'Students.xlsx');
    }
}
