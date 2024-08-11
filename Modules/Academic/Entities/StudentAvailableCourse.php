<?php
namespace Modules\Academic\Entities;
use Modules\MainSetting\Entities\MainSetting;
use Modules\Student\Entities\Student;
use Modules\Academic\Entities\StudentRegisterCourse;
use Modules\Academic\Entities\Course;
class StudentAvailableCourse
{
    private $student = null;
    private $studentRegulations = [];
    private $courses = [];
    private $coursesIsRegister = [];
    private $year;
    private $term;
    public function __construct($id) {
        $this->student = Student::where('id',$id)->select('id','division_id','level_id')->first();
        $this->courses = Course::query();
        $this->year_id = Request()->academic_year_id;
        $this->term_id = Request()->academic_term_id;
        $this->coursesIsRegister = StudentRegisterCourse::select('id','course_id')->where('student_id',$id)
        ->where('academic_year_id',$this->year_id)->where('academic_term_id',$this->term_id)->with('course')->get();
    }

    public function coursesIsRegisterFilter(){
        $regulationCourseIds = collect($this->coursesIsRegister)->pluck('course_id')->toArray();
        $this->courses = $this->courses->whereNotIn('id', $regulationCourseIds);
    }
   
    public function getCourses() {
        $this->coursesIsRegisterFilter();
        $courses = $this->courses->get();
        return [
            'availableCourses'=> $courses,
            'registeredCourses'=> $this->coursesIsRegister
        ];
    }
}
