<?php

namespace Modules\Academic\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Modules\Academic\Entities\Student;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\StudentRegisterCourse;
use Modules\Academic\Entities\StudentAvailableCourse;
use Modules\MainSetting\Entities\MainSetting;

class StudentRegisterImport implements ToModel
{

    public $failedUploadReason = [];
    public $rowNumber = 0;
    public $rowNumberCreated = 0;
    public $rowNumberNotCreated = 0;
    
    
    public function model(array $row)
    {
        return $this->insertStudentRegister($row);
    }

    public function insertStudentRegister(array $row) {
        $year = MainSetting::getCurrentAcademicYear();
        $term = MainSetting::getCurrentAcademicTerm();
        $studentRegisterCourse = null;
        $student = null;
        $course = null;
        $regulationCourse = null;
        $this->rowNumber++;

        $studentCode = str_replace(" ", "", $row[0] ?? null);
        $courseCode = str_replace(" ", "", $row[1] ?? null);
        
        $student = Student::whereRaw('LOWER(code) = ?', [strtolower($studentCode)])->select('id','level_id','division_id')->first();
        $course = Course::whereRaw('LOWER(code) = ?', [strtolower($courseCode)])->select('id')->first();

        $studentRegisterCourse = StudentRegisterCourse::where('student_id',$student->id ?? null)
                                    ->where('course_id', $course->id ?? null)->where('academic_year_id',$year->id)
                                    ->where('academic_term_id',$term->id)->select('id')->first();
       
        if(!is_null($studentRegisterCourse)){
            $message = '   تم تسجيل المادة للطالب من قبل  --  ';
            $this->failedUploadReason[] = [
                'كود الطالب' => $studentCode,
                'كود المادة' => $courseCode,
                'الأسباب' => $message,
            ];
            $this->rowNumberNotCreated++;
            return null;
        }
            
        

        $messages = [
            '0.required' => 'كود الطالب مطلوب',
            '0.exists' => 'كود الطالب غير موجود',
            '1.required' => 'كود المادة مطلوب',
            '1.exists' => 'كود المادة غير موجود',
        ];

        

        $validator = Validator::make($row, [
            '0' => 'required|exists:students,code',
            '1' => 'required|exists:academic_courses,code',
        ],$messages);


        if ($validator->fails()) {
          
            $message = '';
            foreach ($validator->errors()->messages() as $field => $errors) {
                foreach ($errors as $error) {
                    $message .= '  ' .$error. '  --  ';
                }
            }
            $this->failedUploadReason[] = [
                'كود الطالب' => $studentCode,
                'كود المادة' => $courseCode,
                'الأسباب' => $message,
            ];
            $this->rowNumberNotCreated++;
            return null;
        }
        
        if(!$studentRegisterCourse){
            $availableCourse = new StudentAvailableCourse($student->id);
            $regulationCourse = $availableCourse->getCourses()['availableCourses']->where('course_id',$course->id)->first();
           
            if($regulationCourse){
                $studentRegisterCourse =StudentRegisterCourse::create([
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                    'regulation_course_id' => $regulationCourse->id,
                    'level_id' => $student->level_id,
                    'division_id' => $student->division_id,
                    'academic_year_id' => $year->id,
                    'academic_term_id' => $term->id,
                ]); 
                $this->rowNumberCreated++;
            }else{
                $message = '    لا يمكن تسجيل الطالب لهذا المادة برجاء مراجعة الايحة الخاصة بالطالب --  ';
                $this->failedUploadReason[] = [
                    'كود الطالب' => $studentCode,
                    'كود المادة' => $courseCode,
                    'الأسباب' => $message,
                ];
                $this->rowNumberNotCreated++;
                return null;
            }
        }


        return $studentRegisterCourse;
    }
}
