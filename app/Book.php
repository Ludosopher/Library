<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function category()
    {
        return $this->belongsTo(BookCategory::class);
    }

    public function comments()
    {
        return $this->hasMany('App\BookComment');
    }
}
