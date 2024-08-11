<?php

namespace Modules\MainSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicTerm extends Model
{
    use HasFactory;

    protected $table="academic_terms";

    protected $fillable = [
        'id', 'name', 'academic_year_id','start_date','end_date', 'active', 'created_at', 'updated_at'
    ];

    public function academicYear(){
        return $this->belongsTo('Modules\MainSetting\Entities\AcademicYear','academic_year_id');
    }
    
}
