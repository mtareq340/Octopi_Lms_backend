<?php
namespace Modules\Student\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Student\Entities\Student;

class StudentExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $query = Student::select('students.name','code','national_id','levels.name as level_name','divisions.name as division_name','email','phone')
            ->join('levels', 'levels.id', '=', 'students.level_id')
            ->join('divisions', 'divisions.id', '=', 'students.division_id');
        if(Request()->level_id){
            $query->where('students.level_id',Request()->level_id);
        }
        if(Request()->division_id){
            $query->where('division_id',Request()->division_id);
        }
        if(Request()->student_id){
            $query->where('students.id',Request()->student_id);
        }
        $students = $query->orderBy('students.level_id')->orderBy('students.division_id')->orderBy('students.name')->get();

        return $students;
    }

    public function headings(): array
    {
        return [
            'الاسم',
            'الكود',
            'الرقم القومي',
            'المستوي',
            'التخصص',
            'البريد الالكتروني',
            'الموبيل'
        ];
    }
}
