<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\BookCategory;
use App\Helpers\BookHelpers;
use App\Http\Requests\AddBookCommentRequest;
use App\Http\Requests\AddBookRequest;
use App\Http\Requests\GetBooksRequest;
use App\Http\Requests\ShowBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Requests\XlsBooksImportRequest;
use App\Imports\BooksImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    public function getBooks (GetBooksRequest $request)
    {
        $view_data = BookHelpers::getBooksViewData($request->validated());

        return response()->json($view_data, 200);
    }

    
}
