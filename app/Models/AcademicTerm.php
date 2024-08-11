<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicTerm extends Model
{
    use HasFactory;

    protected $table = "academic_terms";

    protected $fillable = [
        'name', 'academic_term_id', 'start_date', 'end_date', 'updated_at', 'created_at'
    ];

    
}
