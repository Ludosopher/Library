<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    public function books()
    {
        return $this->hasMany('App\Book');
    }
}
