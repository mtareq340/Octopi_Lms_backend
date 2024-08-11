<?php

namespace Modules\MainSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\MainSetting\Entities\AcademicYear;
use Modules\MainSetting\Entities\AcademicTerm;

class MainSetting extends Model
{
    use HasFactory;

    protected $table="main_settings";

    protected $fillable = [
        'id', 'academic_year_id', 'academic_term_id','notes','created_at', 'updated_at'
    ];

    public static function getCurrentAcademicYear() {
        $resource = AcademicYear::select('id')->where('active', true)->latest()->first();
        return $resource;
    }
    public static function getCurrentAcademicTerm() {
        $resource = AcademicTerm::select('id')->where('active', true)->latest()->first();
        return $resource;
    }

}
