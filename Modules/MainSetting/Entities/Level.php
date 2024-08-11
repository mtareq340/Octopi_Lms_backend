<?php

namespace Modules\MainSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class level extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'updated_at', 'created_at'
    ];
    protected $hidden = ['updated_at', 'created_at'];
}
