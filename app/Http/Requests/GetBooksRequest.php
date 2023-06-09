<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetBooksRequest extends FormRequest
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
            'category_id' => 'nullable|integer|exists:App\BookCategory,id',
            'page' => 'nullable|integer'
        ];

    }

    public function response(array $errors)
    {
        // Always return JSON.
        return response()->json(['error' => $errors], 400);
    }
}
