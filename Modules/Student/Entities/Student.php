<?php
namespace Modules\Student\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'name', 'code', 'division_id', 'level_id', 'birthdate', 'email','national_id','phone','updated_at', 'created_at'
    ];
   
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id')->select('id', 'active');
    }
    public function division(){
        return $this->belongsTo('Modules\MainSetting\Entities\Division','division_id');
    }
    public function level(){
        return $this->belongsTo('Modules\MainSetting\Entities\Level','level_id');
    }
   
}
