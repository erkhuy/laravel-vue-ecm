<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = [
        'name',
        'display_name',
    ];
    public $timestamps = false;
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
