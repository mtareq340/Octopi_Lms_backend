<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'name', 'phone', 'updated_at', 'created_at'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
