<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookCategory;
use App\Helpers\BookHelpers;
use App\Helpers\UserHelpers;
use App\Http\Requests\AddBookRequest;
use App\Http\Requests\GetBooksRequest;
use App\Http\Requests\ShowBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function showUser()
    {
        return view("home")->with('user', Auth::user());
    }

    public function getForm()
    {
        return view("user.form")->with('user', Auth::user());
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $user = UserHelpers::updateUser($request->validated());
                
        return redirect()->route('home')->with('response', "Данные пользователя '{$user->name}' успешно обновлены.");
    }

    public function deleteUser()
    {
        $user = User::find(Auth::user()->id);

        Auth::logout();

        if ($user->delete()) {
            return redirect()->route('welcome')->with('response', "Ваш аккаунт удалён.");
        }
    }
}
