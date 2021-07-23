<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource_link extends Model
{
    protected $primaryKey = 'resource_link_id';
    public $incrementing = false;

    protected $fillable = [
        'resource_link_resource_id',
        'resource_link_url',
        'resource_link_status',
    ];

    public function resource()
    {
        return $this->belongsTo('App\Models\Resource', 'resource_link_resource_id');
    }
}
