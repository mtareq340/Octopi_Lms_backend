<?php
namespace Modules\Result\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Academic\Entities\StudentRegisterCourse;

class StudentResultExport implements FromCollection, WithHeadings
    {
        public function collection()
        {
            $query = StudentRegisterCourse::select('students.name as student_name','students.code as student_code','academic_courses.name as course_name','academic_courses.code as course_code','mid_degree','work_year_degree','final_degree','total_degree')->where('academic_student_register_courses.academic_year_id', Request()->academic_year_id)->where('academic_student_register_courses.academic_term_id', Request()->academic_term_id)
                ->join('students', 'students.id', '=', 'academic_student_register_courses.student_id')
                ->join('academic_courses', 'academic_courses.id', '=', 'academic_student_register_courses.course_id');
            if(Request()->level_id){
                $query->where('academic_student_register_courses.level_id',Request()->level_id);
            }
            if(Request()->division_id){
                $query->where('academic_student_register_courses.division_id',Request()->division_id);
            }
            if(Request()->course_id){
                $query->where('academic_student_register_courses.course_id',Request()->course_id);
            }
            if(Request()->student_id){
                $query->where('academic_student_register_courses.student_id',Request()->student_id);
            }
            $students = $query->orderBy('students.level_id')->orderBy('students.division_id')->orderBy('students.name')->get();

            return $students;
        }

        public function headings(): array
        {
            return [
                'اسم الطالب',
                'كود الطالب',
                'اسم المقرر',
                'كود المقرر',
                'ميد تيرم',
                'اعمال سنة',
                'فاينل',
                'مجموع',

            ];
        }
    }
