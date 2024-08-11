<?php
namespace Modules\Academic\Entities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MainSetting\Entities\MainSetting;
use Modules\Student\Entities\Exam as StudentExam;
class StudentRegisterCourse extends Model
{
    use HasFactory;
    protected $table = "academic_student_register_courses";

    protected $fillable = [
        'student_id','course_id', 'level_id', 'division_id', 'academic_year_id', 'academic_term_id', 'mid_degree','work_year_degree', 'amly_degree', 'final_degree', 'total_degree', 'updated_at', 'created_at'
    ];

    
    public function student(){
        return $this->belongsTo('Modules\Student\Entities\Student', 'student_id')->select('id','name','division_id');
    }
    public function course(){
        return $this->belongsTo('Modules\Academic\Entities\Course', 'course_id')->select('id','name','code','credit_hour');
    }
    public function academicYear(){
        return $this->belongsTo('Modules\MainSetting\Entities\AcademicYear', 'academic_year_id');
    }
    public function academicTerm(){
        return $this->belongsTo('Modules\MainSetting\Entities\AcademicYear', 'academic_term_id');
    }
   
}
