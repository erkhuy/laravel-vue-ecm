<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class Permission_role extends Model
{
    protected $table = 'permission_role';
    protected $fillable = [
        'role_id',
        'permission_id',
    ];
}
