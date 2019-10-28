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
}