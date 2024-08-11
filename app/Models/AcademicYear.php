<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $table = "academic_years";

    protected $fillable = [
        'name', 'start_date', 'end_date', 'updated_at', 'created_at'
    ];

    
}
