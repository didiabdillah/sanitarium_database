<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';
    protected $table = 'categories';
    public $incrementing = false;

    protected $fillable = [
        'category_label',
    ];

    public function sub_category()
    {
        return $this->hasMany('App\Models\Sub_category', 'sub_category_category_id');
    }

    public function resource()
    {
        return $this->hasMany('App\Models\Resource', 'resource_category_id');
    }
}
