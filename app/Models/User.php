<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'api_token',
        'category_id',
        'role_id',
        'active',
    ];
    protected $appends = [
        'permissions'
   ];
    protected $hidden = [
        'password',
        'remember_token'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getPermissionsAttribute() {
        $ids = RolePermission::where('role_id', $this->role_id)->pluck('permission_id')->toArray();
        $permissions = Permission::with('model')->whereIn('id', $ids)->pluck('name')->toArray();
        return $permissions;
    }
}
