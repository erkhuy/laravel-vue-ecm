<?php

namespace App\Model\Backend;

use App\Model\Backend\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'display_name',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');

    }
    public function hasAccess(array $permissions): bool
    {
        foreach ($this->permissions as $per) {
            if (in_array($per->name, $permissions)) {
                return true;
            }
        }
        return false;
    }

    // private function hasPermission(string $permission): bool
    // {

    //     foreach (Permission::all() as $per) {
    //         if ($per->name == $permission) {
    //             return true;
    //         }

    //     }
    //     return false;
    // }
}