<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $primaryKey = 'author_id';
    public $incrementing = false;

    protected $fillable = [
        'author_label',
        'author_link',
    ];
}
