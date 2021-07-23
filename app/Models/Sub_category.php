<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{
    protected $primaryKey = 'sub_category_id';
    protected $table = 'sub_categories';
    public $incrementing = false;

    protected $fillable = [
        'sub_category_id',
        'sub_category_category_id',
        'sub_category_label',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'sub_category_category_id');
    }

    public function resource()
    {
        return $this->hasMany('App\Models\Resource', 'resource_sub_category_id');
    }
}
