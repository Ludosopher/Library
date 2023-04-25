<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function books()
    {
        return $this->hasMany('App\Book', 'category_id', 'id');
    }
}
