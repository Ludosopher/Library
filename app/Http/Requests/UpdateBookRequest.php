<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'updating_id' => 'nullable|integer|exists:App\Book,id',
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|integer|exists:App\BookCategory,id',
            'cover' => 'image:jpg,jpeg,png|nullable'
        ];
    }
}
