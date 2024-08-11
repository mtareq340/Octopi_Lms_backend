<?php
namespace Modules\MainSetting\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Term extends Model
{
    use HasFactory;
    protected $table="terms";
    protected $hidden = ['updated_at', 'created_at'];
    protected $fillable = [
        'id', 'name', 'created_at', 'updated_at'
    ];
}
