<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
class Permission extends Model
{
    use HasFactory;

    protected $table = "permissions";

    protected $fillable = [
        'name', 'display_name', 'model_id'
    ];
    
    public $timestamps = false;

    public function model(){
        return $this->belongsTo(Role::class, 'role_id');
    }

}
