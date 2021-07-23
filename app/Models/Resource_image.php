<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource_image extends Model
{
    protected $primaryKey = 'resource_image_id';
    public $incrementing = false;

    protected $fillable = [
        'resource_image_resource_id',
        'resource_image_link',
        'resource_image_status',
    ];

    public function resource()
    {
        return $this->belongsTo('App\Models\Resource', 'resource_image_resource_id');
    }
}
