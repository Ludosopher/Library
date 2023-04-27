<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookCategory;
use App\Helpers\BookHelpers;
use App\Http\Requests\AddBookCommentRequest;
use App\Http\Requests\AddBookRequest;
use App\Http\Requests\GetBooksRequest;
use App\Http\Requests\ShowBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function getBooks (GetBooksRequest $request)
    {
        $view_data = BookHelpers::getBooksViewData($request->validated());

        return view("book.books")->with('data', $view_data);
    }

    public function showBook($slug)
    {
        $data = BookHelpers::showBook($slug, Auth::user()->id);

        return view("book.book")->with('data', $data);
    }

    public function getForm($slug = null)
    {
        $data = BookHelpers::getForm($slug);
        
        return view("book.form")->with('data', $data);
    }

    public function updateBook(UpdateBookRequest $request)
    {
        $book = BookHelpers::addOrUpdateData($request);
        Artisan::call('cache:clear');        
        return redirect()->route('books')->with('response', "Данные книги '{$book->title}' автора {$book->author} успешно обновлены.");
    }

    public function addBook(AddBookRequest $request)
    {
        $book = BookHelpers::addOrUpdateData($request);
        
        request()->flash();
                
        return redirect()->back()->with('response', "Данные книги '{$book->title}' автора {$book->author} успешно добавлены.");
    }

    public function deleteBook($slug)
    {
        $deleted = Book::where('slug', $slug)->first();
        Book::where('slug', $slug)->delete();

        return redirect()->route('books')->with('response', "Данные книги '{$deleted->title}' автора {$deleted->author} успешно удалены.");
    }

    public function addBookComment(AddBookCommentRequest $request)
    {
        BookHelpers::addBookComment($request->validated());
        
        return redirect()->back()->with('response', "Комментарий успешно добавлен.");
    }
}
