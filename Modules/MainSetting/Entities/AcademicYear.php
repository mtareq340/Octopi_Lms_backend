<?php

namespace Modules\MainSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;

    protected $table="academic_years";

    protected $fillable = [
        'id', 'name', 'start_date','end_date', 'active', 'created_at', 'updated_at'
    ];

    
    
}
