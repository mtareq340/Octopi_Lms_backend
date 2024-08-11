<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = "academic_courses";

    protected $fillable = [
        'name', 'code', 'credit_hour', 'updated_at', 'created_at'
    ];
    protected $hidden = ['updated_at', 'created_at'];

   
    
    public function courseDivisions(){
        return $this->hasMany('Modules\Academic\Entities\CourseDivision', 'course_id');
    }
  

}
