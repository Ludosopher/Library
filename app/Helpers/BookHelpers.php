<?php

namespace App\Helpers;

use App\Book;
use App\BookCategory;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class BookHelpers
{
    public static function getBooks($data)
    {
        if (count($data) && isset($data['category_id'])) {
            $books = Book::with(['category'])->whereHas('category', function ($query) use ($data) {
                $query->where('id', $data['category_id']);
            })->paginate(10);
        } else {
            $books = Book::with(['category'])->paginate(10);
        }

        return $books;
        
    }

    public static function getBooksViewData($data)
    {
        request()->flash();
        return [
            'books' => self::getBooks($data),
            'categories' => BookCategory::all(),
        ];
    }

    public static function addOrUpdate($data)
    {
        if (isset($data['updating_id'])) {
            $instance = Book::where('id', $data['updating_id'])->first();
        } else {
            $instance = new Book();
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
        $instance->slug = Str::slug($instance->title.' '.$instance->author, '_');
        //$instance->save();
        
        return $instance;
    }

    public static function uploadFile($request, $book)
    {
        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $extention = $request->file('cover')->getClientOriginalExtension();
            $path = $image->storeAs('public/covers', "cover_{$book->id}.{$extention}");
            $book->cover = "cover_{$book->id}.{$extention}";
            $book->save();
        }
    }

    public static function addOrUpdateData($request)
    {
        $book = BookHelpers::addOrUpdate($request->validated());
        BookHelpers::uploadFile($request, $book);

        return $book;
    }

    public static function getForm($slug)
    {
        $data = [
            'categories' => BookCategory::all(),
        ];
        
        if (isset($slug)) {
            $data['book'] = Book::with(['category'])
                        ->where('slug', $slug)
                        ->first();
        }

        return $data;
    }

}