<?php

namespace App\Model;

use App\Model\Backend\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'address',
        'role_id',
        'phone',
        'userID',
        'email',
        'password',
        'image',
        'status',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function hasRole($rol)
    {
        $roles = Role::all();
        foreach ($roles as $role) {
            if ($role->name == $rol) {
                return true;
            }
        }
        return false;
    }
    public function hasAccess(array $permissions): bool
    {
        // check if the permission is available in any role
        // foreach ($this->roles as $role) {
        //     if ($role->hasAccess($permissions)) {
        //         return true;
        //     }
        // }
        // return false;
        if ($this->roles->hasAccess($permissions)) {
            return true;
        }
        return false;
    }
    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('name', $roleSlug)->count() == 1;
    }

}
