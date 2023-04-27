<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();


Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'UserController@showUser')->name('home');

    Route::match(['get', 'post'], '/book/get-all', 'BookController@getBooks')->name('books');
    Route::get('/book/get-one/{slug}', 'BookController@showBook')->name('book');
    Route::get('/book/get-form/{slug?}', 'BookController@getForm')->name('book-form');
    Route::post('/book/update', 'BookController@updateBook')->name('book-update');
    Route::post('/book/add', 'BookController@addBook')->name('book-add');
    Route::get('/book/delete/{slug}', 'BookController@deleteBook')->name('book-delete');
    Route::post('/book/comments/add', 'BookController@addBookComment')->name('book-comment-add');
    Route::get('/book/import/get-form', 'BookController@getImportForm')->name('book-import-form');
    Route::post('/book/import/xls', 'BookController@XlsBooksImport')->name('book-import-xls');

    Route::match(['get', 'post'], '/category/get-all', 'CategoryController@getCategories')->name('categories');
    Route::get('/category/get-one/{slug}', 'CategoryController@showCategory')->name('category');
    Route::get('/category/get-form/{slug?}', 'CategoryController@getForm')->name('category-form');
    Route::post('/category/update', 'CategoryController@updateCategory')->name('category-update');
    Route::post('/category/add', 'CategoryController@addCategory')->name('category-add');
    Route::get('/category/delete/{slug}', 'CategoryController@deleteCategory')->name('category-delete');

    Route::get('/user/get-form', 'UserController@getForm')->name('user-form');
    Route::post('/user/update', 'UserController@updateUser')->name('user-update');
    Route::get('/user/delete', 'UserController@deleteUser')->name('user-delete');
    
});
