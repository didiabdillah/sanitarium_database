<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $primaryKey = 'source_id';
    public $incrementing = false;

    protected $fillable = [
        'source_label',
        'source_link',
    ];
}
