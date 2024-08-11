<?php

namespace Modules\Result\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Modules\Academic\Entities\Student;
use Modules\Academic\Entities\Course;
use Modules\Academic\Entities\StudentRegisterCourse;
use Modules\Academic\Entities\RegulationCourse;
use Modules\MainSetting\Entities\MainSetting;

class StudentResultImport implements ToModel
{

    public $failedUploadReason = [];
    public $rowNumber = 0;
    public $rowNumberCreated = 0;
    public $rowNumberNotCreated = 0;
    
    
    public function model(array $row)
    {
        return $this->insertStudentResult($row);
    }

    public function insertStudentResult(array $row) {
    
        $year = MainSetting::getCurrentAcademicYear();
        $term = MainSetting::getCurrentAcademicTerm();
        $studentRegisterCourse = null;
        $student = null;
        $course = null;
        $studentRegulationIds = [];
        $regulationCourse = null;
        $this->rowNumber++;
      
        $studentCode = str_replace(" ", "", $row[0] ?? null);
        $courseCode = str_replace(" ", "", $row[1] ?? null);
        $midDegree = str_replace(" ", "", $row[2] ?? null);
        $workYearDegree = str_replace(" ", "", $row[3] ?? null);
        $amlyDegree = str_replace(" ", "", $row[4] ?? null);
        $finalDegree = str_replace(" ", "", $row[5] ?? null);
        $totalDegree = str_replace(" ", "", $row[6] ?? null);
       


        $student = Student::where('code', $studentCode)->first();
        $course = Course::where('code', $courseCode)->first();
       

        $studentRegisterCourse = StudentRegisterCourse::where('student_id',$student->id ?? null)
                                    ->where('course_id', $course->id ?? null)->where('academic_year_id',$year->id)
                                    ->where('academic_year_id',$term->id)->first();
                                    

        $messages = [
            '0.required' => 'كود الطالب مطلوب',
            '0.exists' => 'كود الطالب غير موجود',
            '1.required' => 'كود المادة مطلوب',
            '1.exists' => 'كود المادة غير موجود',
            '2.numeric' => 'درجة الميد تيرم يجب ان تكون رقم',
            '2.max' => 'درجة الميد تيرم غير صحيحة',
            '3.numeric' => 'درجة اعمال السنة يجب ان تكون رقم',
            '3.max' => 'درجة اعمال السنة غير صحيحة',
            '4.numeric' => 'درجة العملي يجب ان تكون رقم',
            '4.max' => 'درجة العملي غير صحيحة',
            '5.numeric' => 'درجة الفاينل تحريري يجب ان تكون رقم',
            '5.max' => 'درجة  الفاينل التحريري غير صحيحة',
            '6.numeric' => 'درجة  مجموع الدرجات يجب ان تكون رقم',
            '6.max' => 'درجة مجموع الدرجات غير صحيحة',
        ];

         

        $validator = Validator::make($row, [
            '0' => 'required|exists:students,code',
            '1' => 'required|exists:academic_courses,code',
            '2' => 'nullable|numeric',
            '3' => 'nullable|numeric',
            '4' => 'nullable|numeric',
            '5' => 'nullable|numeric',
            '6' => 'nullable|numeric',
            '7' => 'nullable|numeric',
            '8' => 'nullable|string',
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
                'الميد تيرم' => $midDegree,
                'اعمال السنة' => $workYearDegree,
                'العملي' => $amlyDegree,
                'الفاينل' => $finalDegree,
                'مجموع الدرجات' => $totalDegree,
                'الأسباب' => $message,
            ];
            $this->rowNumberNotCreated++;
            return null;
        }
       

            // if studentRegisterCourse exist
        if($studentRegisterCourse){
            if($midDegree == "" || $midDegree == null)
                $midDegree = $studentRegisterCourse->mid_degree ?? null;
            if($workYearDegree == "" || $workYearDegree == null)
                $workYearDegree = $studentRegisterCourse->work_year_degree ?? null;
            if($amlyDegree == "" || $amlyDegree == null)
                $amlyDegree = $studentRegisterCourse->amly_degree ?? null;
            if($finalDegree == "" || $finalDegree == null)
                $finalDegree = $studentRegisterCourse->final_degree ?? null;
            if($totalDegree == "" || $totalDegree == null)
                $totalDegree = $studentRegisterCourse->total_degree ?? null;
           
            $studentRegisterCourse->update([
                "mid_degree" => $midDegree,
                "work_year_degree" => $workYearDegree,
                "amly_degree" => $amlyDegree,
                "final_degree" => $finalDegree,
                "total_degree" => $totalDegree,
            ]);
            $this->rowNumberCreated++;
        }else{
            return null;
        }


        return $studentRegisterCourse;
    }
}
