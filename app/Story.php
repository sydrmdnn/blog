<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'title', 'body', 'image', 'slug'
    ];

    // Accessor
    public function getImageAttribute($value)
    {
        return asset($value);
    }
}
