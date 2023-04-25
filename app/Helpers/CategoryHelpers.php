<?php

namespace App\Helpers;

use App\BookCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CategoryHelpers
{
    public static function addOrUpdateCategory($data)
    {
        if (isset($data['updating_id'])) {
            $instance = BookCategory::where('id', $data['updating_id'])->first();
        } else {
            $instance = new BookCategory();
        }

        $db_fields = Schema::getColumnListing($instance->getTable());

        foreach ($db_fields as $field) {
            if (isset($data[$field]) && $instance->$field != $data[$field]) {
                $instance->$field = $data[$field];
            }
        }

        $instance = self::addOrUpdateSlug($instance);

        $instance->save();

        return $instance;
    }

    public static function addOrUpdateSlug($instance)
    {
        $instance->slug = Str::slug($instance->title, '_');
                
        return $instance;
    }

    public static function getForm($slug)
    {
        $category = false;

        if (isset($slug)) {
            $category = BookCategory::where('slug', $slug)->first();
        }

        return $category;
    }

}