<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $primaryKey = 'resource_id';
    public $incrementing = false;

    protected $fillable = [
        'resource_category_id',
        'resource_sub_category_id',
        'resource_label',
        'resource_desc',
        'resource_status',
    ];

    public function resource_link()
    {
        return $this->hasMany('App\Models\Resource_link', 'resource_link_resource_id');
    }

    public function resource_image()
    {
        return $this->hasMany('App\Models\Resource_image', 'resource_image_resource_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'resource_category_id');
    }

    public function sub_category()
    {
        return $this->belongsTo('App\Models\Sub_category', 'resource_sub_category_id');
    }
}
