<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'parent_id',

    ];
    public $timestamps = false;
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function getParentsNames()
    {
        if ($this->parent) {
            return $this->parent->getParentsNames() . " > " . $this->name;
        } else {
            return $this->name;
        }
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'categories_product');
    }
}