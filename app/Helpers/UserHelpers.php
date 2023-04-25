<?php

namespace App\Helpers;

use App\Book;
use App\BookCategory;
use App\Http\Requests\UpdateBookRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UserHelpers
{
    public static function updateUser($data)
    {
        $user = User::find(Auth::user()->id);
        $db_fields = Schema::getColumnListing('users');

        foreach ($db_fields as $field) {
            if (isset($data[$field]) && $user->$field != $data[$field]) {
                if ($field === 'password') {
                    $user->$field = bcrypt($data[$field]);
                } else {
                    $user->$field = $data[$field];
                }
            }
        }

        $user->save();

        return $user;
    }
}