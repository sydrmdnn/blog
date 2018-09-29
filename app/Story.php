<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'title', 'body', 'image', 'url'
    ];

    // Accessor
    public function getImageAttribute($value)
    {
        return asset($value);
    }

    // Then run 'php artisan make:migration create_story_tag_table', add post_id and tag_id column
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
